<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Item;

class ItemsController extends Controller
{
    public function index(Request $request)
    {

        $origin = $request->query('origin');

        if (!empty($origin)) {
            $items = Item::whereHas('origins', function($q) use ($origin) {
                $q->where('id', $origin);
            })->paginate();

            return response()->json($items);
        }

        $collection = Item::with('images')->get()->toTree();
        return response()->json($collection);
    }

    public function show(Item $item)
    {
        $item->loadMissing(['children', 'parent']);
        return response()->json($item);
    }
}
