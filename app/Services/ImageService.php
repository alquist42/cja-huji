<?php


namespace App\Services;

use App\Models\Image;

class ImageService
{
    /**
     * Find an image by a storage path.
     *
     * @param $path
     * @return array
     */
    public function findByPath($path)
    {
        $image = Image::where('def', $path)
            ->with(['copyright', 'photographer'])
            ->first();

        return $image ? $image->toArray() : [];
    }

    public function getOrphans()
    {
        return Image::select('images.*', 'entity_images.image_id')
            ->leftJoin('entity_images', 'images.id', '=', 'entity_images.image_id')
            ->whereNull('entity_id')
            ->with(['copyright', 'photographer'])
            ->get();
    }
}
