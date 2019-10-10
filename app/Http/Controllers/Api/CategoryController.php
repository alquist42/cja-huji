<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Origin;

class CategoryController extends Controller
{
    public function index(Request $request)
    {

        $items = $request->get('as_tree') ? Origin::get()->toTree() : Origin::paginate();

        return response()->json($items);
    }

    public function show(Origin $item)
    {
        $item->loadMissing(['children', 'parent']);
        return response()->json($item);
    }
}
