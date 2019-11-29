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
use Illuminate\Support\Facades\DB;

class Search
{
    public function find($filters, $search, $text, $categories){
        $query = Set::project()->published()->select("sets.id","sets.name");

        if(!empty($text)){
            $query->join('search', function ($join) {
                $join->on('search.id', '=', 'sets.id')->where(
                    'search.type', '=', 'set');
            });
            $query->where('search.text', 'LIKE', "%$text%");
        }
        $descendantsFilters=[];
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
                $query->WhereHas($type, function($q) use ($type, $values, $descendantsFilters) {
                    $q->whereIn($type . '.id', $values);
                    if(!empty($descendantsFilters)){
                        foreach($values as $value){
                            $q->orWhereBetween($type . '._lft', [$descendantsFilters[$type][$value]['_lft']+1,$descendantsFilters[$type][$value]['_rgt']]);
                        }
                    }
                });
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

    public function addToIndex($type,$offset){

        $step = 10;
        $countData = DB::select( DB::raw("select count(id) as c from {$type}s"));

        $count =  $countData[0]->c;
        echo $count . '<br>';

        for($i = $offset; $i<=$count;){
            echo $i . ' ';
            // ". $type =='set'? "COALESCE(s.name,'')," : "" . "
            DB::insert("insert into search(id,type,text) 
                     SELECT s.id,'{$type}',
                     CONCAT(  COALESCE(s.category,'') ,COALESCE(s.ntl,''),COALESCE(s.addenda,''),
                     COALESCE(GROUP_CONCAT(DISTINCT  sbj.name SEPARATOR ' '),''),
                     COALESCE(GROUP_CONCAT(DISTINCT  obj.name SEPARATOR ' '),''),
                     COALESCE(GROUP_CONCAT(DISTINCT  p.name SEPARATOR '  '),''),
                     COALESCE(GROUP_CONCAT(DISTINCT  sc.name SEPARATOR '  '),''),
                     COALESCE(GROUP_CONCAT(DISTINCT  com.name SEPARATOR '  '),''),
                     COALESCE(GROUP_CONCAT(DISTINCT  col.name SEPARATOR '  '),''),
                     COALESCE(GROUP_CONCAT(DISTINCT  site.name SEPARATOR '  '),''),
                     COALESCE(GROUP_CONCAT(DISTINCT  artists.name SEPARATOR '  '),''),
                     COALESCE(GROUP_CONCAT(DISTINCT  professions.name SEPARATOR '  '),''),
                     COALESCE(GROUP_CONCAT(DISTINCT  l2.name SEPARATOR '  '),''),
                     COALESCE(GROUP_CONCAT(DISTINCT  ors2.name SEPARATOR '  '),'')
                    ) as text
                    FROM {$type}s s
                    LEFT JOIN taxonomy tsbj ON s.`id` = tsbj.`entity_id` AND tsbj.`entity_type` = '{$type}' AND tsbj.taxonomy_type = 'subject'
                    LEFT JOIN `subjects` sbj on sbj.`id` = tsbj.`taxonomy_id` 
                    
                    LEFT JOIN taxonomy tobj ON s.`id` = tobj.`entity_id` AND tobj.`entity_type` = '{$type}' AND tobj.taxonomy_type = 'object'
                    LEFT JOIN `objects` obj on obj.`id` = tobj.`taxonomy_id`
                    
                    LEFT JOIN taxonomy tp ON s.`id` = tp.`entity_id` AND tp.`entity_type` = '{$type}' AND tp.taxonomy_type = 'period'
                    LEFT JOIN `periods` p on p.`id` = tp.`taxonomy_id`
                    
                    LEFT JOIN taxonomy tsc ON s.`id` = tsc.`entity_id` AND tsc.`entity_type` = '{$type}' AND tsc.taxonomy_type = 'school'
                    LEFT JOIN `schools` sc on sc.`id` = tsc.`taxonomy_id`
                    
                    LEFT JOIN taxonomy tcom ON s.`id` = tcom.`entity_id` AND tcom.`entity_type` = '{$type}' AND tcom.taxonomy_type = 'community'
                    LEFT JOIN `communities` com on com.`id` = tcom.`taxonomy_id`
                    
                    LEFT JOIN taxonomy tcol ON s.`id` = tcol.`entity_id` AND tcol.`entity_type` = '{$type}' AND tcol.taxonomy_type = 'collection'
                    LEFT JOIN `collections` col on col.`id` = tcol.`taxonomy_id`
                    
                    LEFT JOIN taxonomy tsite ON s.`id` = tsite.`entity_id` AND tsite.`entity_type` = '{$type}' AND tsite.taxonomy_type = 'site'
                    LEFT JOIN `sites` site on site.`id` = tsite.`taxonomy_id`
                    LEFT JOIN taxonomy tm ON s.`id` = tm.`entity_id` AND tm.`entity_type` = '{$type}' AND tm.taxonomy_type = 'maker'
                    LEFT JOIN `makers` m on m.`id` = tm.`taxonomy_id`
                    LEFT JOIN artists on artists.id = m.maker_name_id
                    LEFT JOIN professions on professions.id = m.maker_profession_id
                    LEFT JOIN taxonomy tors ON s.`id` = tors.`entity_id` AND tors.`entity_type` = '{$type}' AND tors.taxonomy_type = 'origin'
                    LEFT JOIN `origins` ors on ors.`id` = tors.`taxonomy_id`
                    LEFT JOIN `origins` ors2 on ors._rgt  between ors2.`_lft` and ors2.`_rgt` 
                    LEFT JOIN taxonomy tl ON s.`id` = tl.`entity_id` AND tl.`entity_type` = '{$type}' AND tl.taxonomy_type = 'location'
                    LEFT JOIN `locations` l on l.`id` = tl.`taxonomy_id`
                    LEFT JOIN `locations` l2 on l._rgt  between l2.`_lft` and l2.`_rgt` 
                    
                    GROUP BY s.id, s.category,s.ntl,s.addenda
                    LIMIT ?,?
                    ", array($i,$step));
// GROUP BY ,s.name
            if(($i+$step) <= $count){
                $incr = $step;
            } else {
                break;
            }
            $i += $incr;
        }

    }

}
