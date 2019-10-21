<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

        $model = $this->nameSpace . ucfirst(substr_replace($type ,"",-1));

        if (!class_exists($model)) {
            return response()->json([ 'error' => 400, 'message' => 'Missing or unsupported type' ], 400);
        }

        $items = request()->get('as_tree') ? $model::get()->toTree() : $model::paginate();

        return response()->json($items);
    }

    /**
     * @param $type
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($type, $id)
    {
        $model = $this->nameSpace . ucfirst(substr_replace($type ,"",-1));

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

        $type = substr_replace($request->get('type') ,"",-1);
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
