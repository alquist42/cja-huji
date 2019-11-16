<?php
/**
 * Created by PhpStorm.
 * User: suspensk
 * Date: 15.11.2019
 * Time: 11:38
 */

namespace App\Services;

use App\Models\Set;
use App\Models\Item;


class Search
{
    public function find($filters,$search,$categories){
        $query = Set::select("sets.id","sets.name")->where('sets.publish_state','>',0);

        foreach ($filters as $type => $values) {
            $query->whereHas($type, function($q) use ($type, $values) {
                $q->whereIn($type . '.id', $values);
            });
        }


        if (!empty($search)) {
            $query->where('name', 'LIKE', "%$search%");
        }

        if (!empty($categories)) {
            $query->where(function ($query) use ($categories) {
                $query->where('category', array_shift($categories));
                foreach ($categories as $category){
                    $query->orWhere('category', $category);
                }
            });
        }

        /* PRIORITY FOR SETS WITH IMAGES */

        $query->leftJoin('entity_images', function ($join) {
            $join->on('entity_images.entity_id', '=', 'sets.id')->where(
                'entity_images.entity_type', '=', 'set');
        });
        $query->leftJoin('images', function ($join) {
            $join->on('images.id', '=', 'entity_images.image_id');
        });
        $query->orderByRaw(
            "CASE WHEN (images.medium is null AND images.def is null AND images.batch_url is null) THEN 1 ELSE 2 END DESC"
        );


        $query->orderBy('sets.id', 'DESC');
        $query->with('images');

        return $query->paginate(50);
    }

}