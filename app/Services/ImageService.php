<?php


namespace App\Services;

use App\Models\Image;
use App\Models\Item;
use Illuminate\Database\Eloquent\Collection;

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
            ->with([
                'copyright',
                'photographer',
                'items' => function ($query) {
                    $query->select('entity_images.entity_id as id');
                }
            ])
            ->first();

        return $image ? $image->toArray() : [];
    }

    /**
     * Get images not attached to any item.
     *
     * @return Collection
     */
    public function getOrphans()
    {
        return Image::select('images.*', 'entity_images.image_id')
            ->leftJoin('entity_images', 'images.id', '=', 'entity_images.image_id')
            ->whereNull('entity_id')
            ->with(['copyright', 'photographer', 'items'])
            ->get();
    }

    /**
     * Get item's images.
     *
     * @param integer $itemId
     * @return Collection
     */
    public function getItemImages($itemId)
    {
        $item = Item::findOrFail($itemId);

        return $item->images()
            ->with([
                'copyright',
                'photographer',
                'items' => function ($query) {
                    $query->select('entity_images.entity_id as id');
                }
            ])
            ->get();
    }

    /**
     * Get images belonging to a whole item's tree.
     *
     * @param integer $itemId
     * @return Collection
     */
    public function getWholeTree($itemId)
    {
        $itemsIds = Item::ancestorsAndSelf($itemId)
            ->merge(Item::descendantsOf($itemId))->pluck('id');

        return Image::select('images.*')
            ->join('entity_images', function ($join) use ($itemsIds) {
                $join->on('images.id', '=', 'entity_images.image_id')
                    ->whereIn('entity_images.entity_id', $itemsIds);
            })
            ->with([
                'copyright',
                'photographer',
                'items' => function ($query) {
                    $query->select('entity_images.entity_id as id');
                }
            ])
            ->distinct()
            ->get();
    }
}
