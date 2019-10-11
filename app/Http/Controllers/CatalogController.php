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
        $origins = [];

//        $search = $request->query('search');
        $origin = $request->query('origin');


        if (!empty($origin)) {
            $items = Item::whereHas('origins', function($q) use ($origin) {
                $q->whereIn('id', $origin);
            })->get();
            $origins = Origin::select(['name', 'id'])->find($origin);
        }
        else {
            $items = Item::paginate(20)->appends($page);
        }

        return view('index', [ "items" => $items , "origins" => $origins ]);
    }

    public function show($project, $id)
    {
        $item = Item::with(['images'])->find($id);

        return view('item', compact('item'));
    }
}
