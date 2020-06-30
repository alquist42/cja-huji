<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Services\Search;
use App\Models\Tenant;
class TaxonomyController extends Controller
{

    /**
     * Taxonomy dynamic model class
     *
     * @var string|null
     */
    protected $model = null;
    protected $nameSpace = '\\App\\Models\\Taxonomy\\';

    public function __construct(Search $search)
    {
        $this->search = $search;
    }
    /**
     * @param $type
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($type)
    {
        DB::enableQueryLog();

        $type_plural = $type;
        $type = str_singular($type);
        $model = $this->nameSpace . ucfirst($type);


        if($type == 'artist'){
            $type = 'maker';
            $type_plural = 'makers';
            $model = $this->nameSpace . 'Artist';
        }
        $project = app()->make(Tenant::class)->slug();
        if (!class_exists($model)) {
            return response()->json([ 'error' => 400, 'message' => 'Missing or unsupported type' ], 400);
        }
        if(request()->get('as_tree')){
        //    $elements = $model::where($type_plural.'.id', '!=', '-1')
            $elements = $model::select($type_plural.".*")
                ->when($type == 'maker', function ($q) use ($type,$type_plural,$project) {
                    $q->select("artists.*");
                })
                ->when($type == 'maker', function ($q) use ($type,$type_plural,$project) {
                    $q->join('makers', function ($join) use ($type,$type_plural,$project){
                        $join->on('makers.maker_name_id', '=', 'artists.id');
                    });
                })
                ->join('taxonomy', function ($join) use ($type,$type_plural){
                    $join->on('taxonomy.taxonomy_id', '=', $type_plural . '.id')->
                    where('taxonomy.taxonomy_type', $type);

                })
                ->join('sets', function ($join) use ($type,$type_plural){
                    $join->on('sets.id', '=', 'taxonomy.entity_id');
                      //  ->where('taxonomy.entity_type', '=', 'set');
                })

                ->when($project != 'CJA', function ($q) use ($type,$type_plural,$project) {
                    $q->join('projects', function ($join) use ($type,$type_plural,$project){
                        $join->on('sets.id', '=', 'projects.taggable_id')->
                        where('projects.taggable_type', '=', 'set')
                            ->where('projects.tag_slug', $project);
                    });
                })
                ->where('sets.publish_state', '>', 0)
                ->where($type_plural.'.id', '!=', '-1')
                ->distinct()
                ->get();
          //  dd($elements);


            $elements = $this->search->findMissedParents($elements,$model);
            $elements = $elements->sortBy('name')->values()->toTree();

//            ini_set('xdebug.var_display_max_depth', 90);
//            ini_set('xdebug.var_display_max_children', 2545);
//            ini_set('xdebug.var_display_max_data', 10424);
         //   dd($elements);
        } else {
            $elements =  $model::paginate();
        }

        dd(DB::getQueryLog());
        return response()->json($elements);
    }

    /**
     * @param $type
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($type, $id)
    {
        $model = $this->nameSpace . ucfirst(str_singular($type));

        if (!class_exists($model)) {
            return response()->json([ 'error' => 400, 'message' => 'Missing or unsupported type' ], 400);
        }

        $taxon = $model::find($id);

        $taxon->loadMissing(['children', 'parent']);
        return response()->json($taxon);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        DB::enableQueryLog();
        $type_plural = $request->get('type');
        $type = str_singular($request->get('type'));
        $model = $this->nameSpace . ucfirst($type);

//        if($type == 'object'){
//            $model = $this->nameSpace . 'IObject';
//        }
        $search = $request->get('term');

        if (!class_exists($model)) {
            return response()->json([ 'error' => 400, 'message' => 'Missing or unsupported type' ], 400);
        }

        if (!$search) {
            return response()->json([ 'error' => 400, 'message' => 'Missing query term' ], 400);
        }

        $project = app()->make(Tenant::class)->slug();

        if ($type_plural === 'artists' || $type_plural === 'professions') {
            return response()->json($model::select($type_plural.".id", $type_plural.".name")->where($type_plural.'.name','LIKE',"%$search%")
                ->distinct()
                ->get());
        }

    $data = $model::select($type_plural.".id", $type_plural.".name")
        ->join('taxonomy', function ($join) use ($type,$type_plural){
            $join->on('taxonomy.taxonomy_id', '=', $type_plural . '.id')->
            where('taxonomy.taxonomy_type', $type);

        })
        ->join('sets', function ($join) use ($type,$type_plural){
            $join->on('sets.id', '=', 'taxonomy.entity_id');
              //  ->where('taxonomy.entity_type', '=', 'set');
        })

        ->when($project != 'CJA', function ($q) use ($type,$type_plural,$project) {
                $q->join('projects', function ($join) use ($type,$type_plural,$project){
                    $join->on('sets.id', '=', 'projects.taggable_id')->
                    where('projects.taggable_type', '=', 'set')
                        ->where('projects.tag_slug', $project);
                });
        })
        ->where('sets.publish_state', '>', 0)
        ->where($type_plural.'.name','LIKE',"%$search%")
        ->distinct()
        ->get();

   //     dd(DB::getQueryLog());

        return response()->json($data);
    }
}
