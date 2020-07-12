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
}
