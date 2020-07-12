<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;

class ImageMetadataController extends Controller
{
    public function store(Request $request) {
        $imagesIds = [];

        foreach ($request->input('images') as $imageData) {
            if (isset($imageData['image'])) {
                $image = Image::findOrFail($imageData['image']['id']);
            } else {
                $image = Image::where('def', $imageData['storage_path'])
                    ->firstOrFail();
            }
            $image->update($request->input('metadata'));

            $imagesIds[] = $image->id;
        }

        return Image::whereIn('id', $imagesIds)->with(['copyright', 'photographer'])->get();
    }
}
