<?php

namespace App\Http\Controllers\Api;

use App\Models\Item;
use App\Services\ItemService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ItemImagesController extends Controller
{
    public function update(Item $item, Request $request)
    {
        (new ItemService($item))->updateImages($request->input('images'));

        return $item->images;
    }
}