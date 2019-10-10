<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AutocompleteController extends Controller
{

    public function autocomplete(Request $request)
    {

        $nameSpace = '\\App\\Models\\';
        $model = $nameSpace . ucfirst($request->get('type'));

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
