<?php

namespace App\Http\Controllers\Api;

use App\Models\Image;
use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ItemImagesController extends Controller
{
    public function store(Request $request)
    {
        $item = Item::findOrFail($request->input('itemId'));

        $images = [];
        foreach ($request->input('images') as $imageData) {
            $image = Image::where('def', 'images_db/'.$imageData['storage_path'])->firstOrFail();
            $images[$image->id] = ['entity_type' => 'set'];
        }

        $item->images()->syncWithoutDetaching($images);

        return $item->images;
    }
}
