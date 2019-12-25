<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Services\Search;
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

        $model = $this->nameSpace . ucfirst(str_singular($type));
        if (!class_exists($model)) {
            return response()->json([ 'error' => 400, 'message' => 'Missing or unsupported type' ], 400);
        }
        if(request()->get('as_tree')){
            $elements = $model::where('id', '!=', '-1')
                ->where(function ($q)  {
                    $q->whereHas('sets', function($q) {
                        $q->join('projects', 'sets.id', '=', 'projects.taggable_id');
                    });
                    $q->orWhereHas('items', function($q) {
                        $q->join('projects', 'items.id', '=', 'projects.taggable_id');
                    });
                })
            //    ->orderBy('id')
                ->get();


            $elements = $this->search->findMissedParents($elements,$model);
            $elements = $elements->sortBy('name')->values()->toTree()->toArray();

//            ini_set('xdebug.var_display_max_depth', 90);
//            ini_set('xdebug.var_display_max_children', 2545);
//            ini_set('xdebug.var_display_max_data', 10424);
         //   dd($elements);
        } else {
            $elements =  $model::paginate();
        }

      //  dd(DB::getQueryLog());
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

        $type = str_singular($request->get('type'));
        $model = $this->nameSpace . ucfirst($type);

        $search = $request->get('term');

        if (!class_exists($model)) {
            return response()->json([ 'error' => 400, 'message' => 'Missing or unsupported type' ], 400);
        }

        if (!$search) {
            return response()->json([ 'error' => 400, 'message' => 'Missing query term' ], 400);
        }

        $data = $model::select("id", "name")
            ->where('name', 'LIKE', "%$search%")
            ->get();


        return response()->json($data);
    }
}
