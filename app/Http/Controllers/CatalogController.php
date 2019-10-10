<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Origin;
use App\Models\Post;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(Request $request)
    {

        $page = $request->query('page');

//        $search = $request->query('search');
        $origin = $request->query('origin');


        if (!empty($origin)) {
            $items = Item::whereHas('origins', function($q) use ($origin) {
                $q->whereIn('id', $origin);
            })->get();
        }
        else {
            $items = Item::paginate(30)->appends($page);
        }

        return view('index', [ "items" => $items ]);
    }

    public function show(Item $item)
    {
        $item = $item->load(['images']);

        return view('item', compact('item'));
    }
}
