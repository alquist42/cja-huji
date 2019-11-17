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
    public function find($filters, $search, $categories){
        $query = Set::project()->select("sets.id","sets.name")->where('sets.publish_state','>',0);
        foreach ($filters as $type => $values) {
            $model = '\\App\\Models\\Taxonomy\\' . ucfirst(str_singular($type));
            $selected = $model::select("id", "_lft", "_rgt")->find($values);
             foreach ($selected as $sModel) {
                 $descendantsFilters[$type][$sModel->id]['_lft'] = $sModel->_lft;
                 $descendantsFilters[$type][$sModel->id]['_rgt'] = $sModel->_rgt;
            }
        }

        $query->where(function ($query) use ($filters,$descendantsFilters) {
            foreach ($filters as $type => $values) {
                foreach($values as $value){
                    $query->orWhereHas($type, function($q) use ($type, $value, $descendantsFilters) {
                        $q->where($type . '.id','=', $value)
                            ->orWhereBetween($type . '._lft', [$descendantsFilters[$type][$value]['_lft']+1,$descendantsFilters[$type][$value]['_rgt']]);
                    });
                }
            }
        });



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

        return $query;
    }

}
