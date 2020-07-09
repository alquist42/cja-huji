<?php

namespace App\Http\Controllers\Api;

use App\Models\Image;
use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ItemImagesController extends Controller
{
    public function update(Item $item, Request $request)
    {
        $images = [];

        foreach ($request->input('images') as $imageData) {
            if (isset($imageData['id'])) {
                $image = $imageData;
            } else {
                $image = Image::where('def', 'images_db/' . $imageData['storage_path'])
                    ->firstOrFail()
                    ->toArray();
            }

            $images[$image['id']] = ['entity_type' => 'set'];
        }

        $item->images()->sync($images);

        return $item->images;
    }
}
