<?php

namespace App\Http\Controllers\Api;

use App\Models\Item;
use App\Services\ItemService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ItemImagesController extends Controller
{
    public function index(Item $item)
    {
        return $item->images;
    }

    public function update(Item $item, Request $request)
    {
        (new ItemService($item))->updateImages($request->input('images'), $request->input('detach_from', []));

        return $item->images;
    }
}
