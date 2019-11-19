<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class TaxonomyController extends Controller
{

    /**
     * Taxonomy dynamic model class
     *
     * @var string|null
     */
    protected $model = null;
    protected $nameSpace = '\\App\\Models\\Taxonomy\\';

    /**
     * @param $type
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($type)
    {
        DB::enableQueryLog();

        $model = $this->nameSpace . ucfirst(str_singular($type));
   //     var_dump($model);
        if (!class_exists($model)) {
            return response()->json([ 'error' => 400, 'message' => 'Missing or unsupported type' ], 400);
        }
        if(request()->get('as_tree')){
            $items = $model::where('id', '!=', '-1')
                ->whereHas('sets', function($q) {
                    $q->join('projects', 'sets.id', '=', 'projects.taggable_id');
                })
                ->get();

            $first_names = array_column($items->toArray(),'parent_id', 'id');
//            $first_names =array_flip($first_names);
            $missed = [];
            foreach($first_names as $k=>$v){
                if(!isset($first_names[$v]) && !in_array($v,$missed)){
                    $missed[]= $v;
                }
            }
            if(!empty($missed)){
                $AddedItems = $model::whereIn('id',$missed)->get();
            }
            $items = $items->merge($AddedItems)->sortBy('id');
            $items = $items->toTree();

        } else {
            $items =  $model::paginate();
        }

    //    dd(DB::getQueryLog());
        return response()->json($items);
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
