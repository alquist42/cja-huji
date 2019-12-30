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
use App\Models\Tenant;
use App\Models\Search as SearchIndex;
use Illuminate\Support\Facades\DB;

class Search
{
    public function findByTaxonomy($filters){
        DB::enableQueryLog();
        $project = app()->make(Tenant::class)->slug();
        $collection = collect([]);
        foreach ($filters as $type => $values) {
            $model = '\\App\\Models\\Taxonomy\\' . ucfirst(str_singular($type));
            $selected = $model::select("id", "_lft", "_rgt")->find($values);
            foreach ($selected as $sModel) {
                $descendants = $model::select("id","name")->
                where(function ($query) use ($sModel) {
                    $query->where('_lft', '>=', $sModel->_lft);
                    $query->where('_lft', '<=', $sModel->_rgt);
                })->get();
                $taxonomyIds = array_map(function ($u) {return $u['id'];}, $descendants->toArray());
            }
        }
       // dd(DB::getQueryLog());

        $result = DB::table('taxonomy')
            ->select('sets.id as set','items.id as item')
            ->leftJoin('sets', function ($join) {
                $join->on('sets.id', '=', 'taxonomy.entity_id')->
                where('taxonomy.entity_type', '=', 'set')->
                where('sets.publish_state', '>', 0);
            })
            ->leftJoin('items', function ($join) {
                $join->on('items.id', '=', 'taxonomy.entity_id')->
                where('taxonomy.entity_type', '=', 'item')->
                where('items.publish_state', '>', 0);
            })
            ->where('taxonomy.taxonomy_type', '=', str_singular($type))
            ->whereIn('taxonomy.taxonomy_id', $taxonomyIds)
            ->when($project != 'CJA', function ($q) use ($project) {
                $q->where(function ($query) use ($project) {
                    $query->whereExists(function ($query) use ($project) {
                        $query->select(DB::raw(1))
                            ->from('projects')
                            ->whereRaw('projects.taggable_id = sets.id')
                            ->where('projects.taggable_type', 'set')
                            ->where('projects.tag_slug', $project);
                    })
                        ->orWhereExists(function ($query) use ($project) {
                            $query->select(DB::raw(1))
                                ->from('projects')
                                ->whereRaw('projects.taggable_id = items.id')
                                ->where('projects.taggable_type', 'item')
                                ->where('projects.tag_slug', $project);
                        });

                });
            })
            ->paginate(20);

        $total = $result->total();
        $data = $result->toArray()['data'];
        $setObjects= array_filter($data, function($v) {
            return !empty($v->set);
        });
        $itemObjects= array_filter($data, function($v) {
            return !empty($v->item);
        });


        if(!empty($setObjects)){
            $setIds = array_map(function ($u) { return $u->set; }, $setObjects);

            $ids_ordered = implode(',', $setIds);
            $sets = Set::select("id","name")
                ->whereIn('id',$setIds)
                ->orderByRaw(DB::raw("FIELD(id, $ids_ordered)"))
                ->with('images')
                ->get();
            $collection = $sets;
        }

        if(!empty($itemObjects)){
            $itemIds = array_map(function ($u) { return $u->item; }, $itemObjects);
            $items = Item::select("id","ntl")
                ->whereIn('id',$itemIds)
                ->with('images')->get();
            // TODO find good method to push collection
            $items->each(function ($item, $key) use ($collection) {
                $collection->push($item);
            });
        }
        return ['collection' =>  $collection,
            'pagination' => $result,
            'setsCount' => $total,
            'itemsCount' => 0 ];

        /* PRIORITY FOR SETS WITH IMAGES */

        /*   $query->leftJoin('entity_images', function ($join) {
               $join->on('entity_images.entity_id', '=', 'sets.id')->where(
                   'entity_images.entity_type', '=', 'set');
           });
           $query->leftJoin('images', function ($join) {
               $join->on('images.id', '=', 'entity_images.image_id');
           });
           $query->orderByRaw(
               "CASE WHEN (images.medium is null AND images.def is null AND images.batch_url is null) THEN 1 ELSE 2 END DESC"
           );*/
    }

    public function find($filters, $search, $text, $categories){
        DB::enableQueryLog();
        $project = app()->make(Tenant::class)->slug();
        $collection = collect([]);
        $result = null;
        $total = 0;
        if(!empty($text)){
            $text = explode(" ",$text);
            $text = implode(array_map(function ($u) { if(strlen($u)>3) {return " +" . $u;} return " ".$u;}, $text));


        //    $text = "+" . implode(' +', explode(" ",$text));
        }
            $result = DB::table('search')
                ->select('search.id','search.type')
                ->where('search.publish_state','>',0)
                ->when($project != 'CJA', function ($q) use ($project) {
                    $q->where('projects', 'LIKE', "%".$project."%");
                })
                ->when(!empty($text), function ($q) use ($text) {
                    $q->selectRaw('MATCH (`text`) AGAINST ("'.$text.'") as rel')
                        ->whereRaw('MATCH (`text`) AGAINST ("'.$text.'" IN BOOLEAN MODE) > 0');
                })
                ->when(!empty($filters), function($q) use ($filters){
                    $q->where(function ($query) use ($filters) {
                        foreach ($filters as $type => $values) {
                            $field=str_singular($type);
                            // TODO move from here
                         //   $model = '\\App\\Models\\Taxonomy\\' . ucfirst($field);
                         //   $selected = $model::select("name")->find($values);
                            $names = "";
                            foreach ($filters[$type] as $name) {
                                $names .=" " . $name->name;
                            }
                             $query->whereRaw('MATCH ('.$field.') AGAINST ("'.$names.'" IN BOOLEAN MODE) > 0');
                        }
                    });
                })
                ->when(!empty($categories), function($q) use ($categories){
                    $q->where(function ($query) use ($categories) {
                        $firstCategory = array_shift($categories);
                        $query->where('category',$firstCategory);
                        foreach ($categories as $category){
                            $query->orWhere('category', $category);
                        }
                    });
                })
                ->when(!empty($search), function($q) use ($search){
                    $q->selectRaw('MATCH (`title`) AGAINST (" +'.$search.'") as rel2')
                        ->whereRaw('MATCH (`title`) AGAINST (" +'.$search.'" IN BOOLEAN MODE) > 0');
                })

                /*----- REMOVE IMAGES FOR FOUNDED SETS -------*/
                ->where(function ($q) use ($text,$filters,$categories,$search) {
                    $q->whereNull('set_id')
                        ->orWhereNotIn("set_id", function($query) use ($text,$filters,$categories,$search){
                            $query->select('id')
                                ->from('search')
                                ->where('search.type','=','set')
                                ->when(!empty($text), function ($q) use ($text) {
                                    $q->whereRaw('MATCH (`text`) AGAINST ("'.$text.'" IN BOOLEAN MODE) > 0');
                                })
                                ->when(!empty($filters), function($q) use ($filters){
                                   $q->where(function ($query) use ($filters) {
                                       foreach ($filters as $type => $values) {
                                           $field=str_singular($type);
                                           // TODO move from here
                                       //    $model = '\\App\\Models\\Taxonomy\\' . ucfirst($field);
                                         //  $selected = $model::select("name")->find($values);
                                           $names = "";
                                           foreach ($filters[$type] as $name) {
                                               $names .=" " . $name->name;
                                           }
                                           $query->whereRaw('MATCH ('.$field.') AGAINST ("'.$names.'" IN BOOLEAN MODE) > 0');
                                       }
                                   });
                                })
                                ->when(!empty($categories), function($q) use ($categories){
                                    $q->where(function ($query) use ($categories) {
                                        $firstCategory = array_shift($categories);
                                        $query->where('category',$firstCategory);

                                        foreach ($categories as $category){
                                            $query->orWhere('category', $category);
                                        }
                                    });
                                })
                                ->when(!empty($search), function($q) use ($search){
                                    $q->whereRaw('MATCH (`title`) AGAINST (" +'.$search.'" IN BOOLEAN MODE) > 0');
                                });

                        });
                })


                // TMP NOT SHOW ALL
                ->when(empty($filters) && empty($text) && empty($search) && empty($categories), function($q) {
                    $q->where('search.id','=',0);
                })
                ->orderBy('set_id')
                ->orderBy('search.image','DESC')
                ->when(!empty($search), function($q) {
                    $q->orderBy('rel2','DESC');
                })
                ->when(!empty($text), function($q) {
                    $q->orderBy('rel','DESC');
                })

                ->orderBy('search.id','DESC')
                ->paginate(50);

        //    dd(DB::getQueryLog());

            $total = $result->total();
            $data = $result->toArray()['data'];
            $setsCount = 0;
            $itemsCount=0;
            $setObjects= array_filter($data, function($k) {
                return $k->type=='set';
            });
            $itemObjects= array_filter($data, function($k) {
                return $k->type=='item';
            });



            if(!empty($setObjects)){
                $setIds = array_map(function ($u) { return $u->id; }, $setObjects);
             //   dd($setIds);
                $ids_ordered = implode(',', $setIds);
                $sets = Set::select("id","name")
                ->with('collections')
                ->with('collection_details')
                ->whereIn('id',$setIds)
                ->orderByRaw(DB::raw("FIELD(id, $ids_ordered)"))
                ->with('images')
                    ->get();
             //   dd(DB::getQueryLog());
                $collection = $sets;
                $setsCount = count($sets);
            }

            if(!empty($itemObjects)){
                $itemIds = array_map(function ($u) { return $u->id; }, $itemObjects);
                $items = Item::select("id","ntl")
                    ->whereIn('id',$itemIds)
                    ->with('collections')
                    ->with('collection_details')
                    ->with('images')->get();
                // TODO find good method to push collection
                $items->each(function ($item, $key) use ($collection) {
                    $collection->push($item);
                });
                $itemsCount = count($items);
             //   $collection->concat($items);
              //  dd($items);
            }

        //    dd(DB::getQueryLog());
    //    }
     //   dd($collection);
     //   $query = $model::project($name)->published()->select("{$name}s.id","{$name}s.ntl");
//        if($name == 'item'){
//            $query->whereNotIn("{$name}s.set_id", function($query) use ($text){
//                $query->select('id')
//                    ->from('search')
//                    ->where('search.text', 'LIKE', "%$text%")
//                    ->where('search.type','=','set');
//            });
//        }

//        $descendantsFilters=[];
//        foreach ($filters as $type => $values) {
//            $model = '\\App\\Models\\Taxonomy\\' . ucfirst(str_singular($type));
//            $selected = $model::select("id", "_lft", "_rgt")->find($values);
//             foreach ($selected as $sModel) {
//                 $descendantsFilters[$type][$sModel->id]['_lft'] = $sModel->_lft;
//                 $descendantsFilters[$type][$sModel->id]['_rgt'] = $sModel->_rgt;
//            }
//        }
//
//        $query->where(function ($query) use ($filters,$descendantsFilters) {
//            foreach ($filters as $type => $values) {
//                $query->WhereHas($type, function($q) use ($type, $values, $descendantsFilters) {
//                    $q->whereIn($type . '.id', $values);
//                    if(!empty($descendantsFilters)){
//                        foreach($values as $value){
//                            $q->orWhereBetween($type . '._lft', [$descendantsFilters[$type][$value]['_lft']+1,$descendantsFilters[$type][$value]['_rgt']]);
//                        }
//                    }
//                });
//            }
//        });

//
//        if (!empty($search)) {
//            $query->where('name', 'LIKE', "%$search%");
//        }
//
//        if (!empty($categories)) {
//            $query->where(function ($query) use ($categories) {
//                $query->where('category', array_shift($categories));
//                foreach ($categories as $category){
//                    $query->orWhere('category', $category);
//                }
//            });
//        }

        /* PRIORITY FOR SETS WITH IMAGES */

        /*$query->leftJoin('entity_images', function ($join) use ($name) {
            $join->on('entity_images.entity_id', '=', "{$name}s.id")->where(
                'entity_images.entity_type', '=', $name);
        });
        $query->leftJoin('images', function ($join) {
            $join->on('images.id', '=', 'entity_images.image_id');
        });
        $query->orderByRaw(
            "CASE WHEN (images.medium is null AND images.def is null AND images.batch_url is null) THEN 1 ELSE 2 END DESC"
        );*/

    //    $query->orderBy("{$name}s.id", 'DESC');
     //   $query->with('images');
       // ->paginate(50);
     //   dd(DB::getQueryLog());
    //    dd($collection);
        return ['collection' =>  $collection,
            'pagination' => $result,
            'setsCount' => $total,
            'itemsCount' => 0 ];
    }

    public function findMissedParents($elements,$model)
    {
        $elements_array = array_column($elements->toArray(),'parent_id', 'id');
        $missed = [];
        foreach($elements_array as $k=>$v){
            if(!array_key_exists($v,$elements_array) && !in_array($v,$missed) && !is_null($v)){
                $missed[]= $v;
            }
        }
        if(empty($missed)){
            return $elements;
        }

            $missedElements = $model::whereIn('id',$missed)->orderBy('id')->get();
            $elements = $elements->merge($missedElements);
            return self::findMissedParents($elements,$model);

    }

    public function addToIndex($type,$offset){
   //     DB::enableQueryLog();
        $step = 500;
        DB::statement("SET group_concat_max_len=15000000000;");
        $countData = DB::select( DB::raw("select count(id) as c from {$type}s"));

        $count =  $countData[0]->c;
        echo $count . '<br>';

        for($i = $offset; $i<=$count;){
            echo $i . ' ';
            $ids = DB::select( DB::raw("select id from {$type}s ORDER BY id LIMIT ?,?"), array($i,$step));
            $ids = array_map(function($n){
                return $n->id;
            }, $ids);
            $ids = implode(', ',$ids);

        //    var_dump($ids);
            $name = ($type =='set') ? "COALESCE(s.name,'')," : "";
            $groupByName = ($type =='set') ? "s.name, " : "";
            // ". $type =='set'? "COALESCE(s.name,'')," : "" . "
            DB::insert("insert into search(
                     id,type,publish_state,text,subject,object,maker,period,
                     origin,historical_origin,school,community,
                     collection,site,location,image
                     ) 
                     SELECT s.id,'{$type}',s.publish_state,
                     CONCAT_WS(' ',{$name} COALESCE(s.ntl,''),COALESCE(s.addenda,''),COALESCE(s.description,''),
                     COALESCE(GROUP_CONCAT(DISTINCT  sbj.name SEPARATOR ' '),''),
                     COALESCE(GROUP_CONCAT(DISTINCT  obj.name SEPARATOR ' '),''),
                     COALESCE(GROUP_CONCAT(DISTINCT  p.name SEPARATOR ' '),''),
                     COALESCE(GROUP_CONCAT(DISTINCT  sc.name SEPARATOR ' '),''),
                     COALESCE(GROUP_CONCAT(DISTINCT  com.name SEPARATOR ' '),''),
                     COALESCE(GROUP_CONCAT(DISTINCT  col.name SEPARATOR ' '),''),
                     COALESCE(GROUP_CONCAT(DISTINCT  site.name SEPARATOR ' '),''),
                     COALESCE(GROUP_CONCAT(DISTINCT  artists.name SEPARATOR ' '),''),
                     COALESCE(GROUP_CONCAT(DISTINCT  professions.name SEPARATOR ' '),''),
                     COALESCE(GROUP_CONCAT(DISTINCT  l2.name SEPARATOR ' '),''),
                     COALESCE(GROUP_CONCAT(DISTINCT  ors2.name SEPARATOR ' '),''),
                     COALESCE(GROUP_CONCAT(DISTINCT  hors2.name SEPARATOR ' '),''),
                     COALESCE(GROUP_CONCAT(DISTINCT  dates.name SEPARATOR ' '),''),
                     COALESCE(GROUP_CONCAT(DISTINCT  per.name SEPARATOR ' '),''),
                     COALESCE(GROUP_CONCAT(DISTINCT  ep.value SEPARATOR ' '),'')
                    ) as text,
                    COALESCE(GROUP_CONCAT(DISTINCT  sbj.name SEPARATOR ' '),''),
                    COALESCE(GROUP_CONCAT(DISTINCT  obj.name SEPARATOR ' '),''),
                    CONCAT_WS(' ',COALESCE(GROUP_CONCAT(DISTINCT  artists.name SEPARATOR ' '),''),
                     COALESCE(GROUP_CONCAT(DISTINCT  professions.name SEPARATOR ' '),'')),
                     COALESCE(GROUP_CONCAT(DISTINCT  per.name SEPARATOR ' '),''),
                    COALESCE(GROUP_CONCAT(DISTINCT  ors2.name SEPARATOR ' '),''),
                    COALESCE(GROUP_CONCAT(DISTINCT  hors2.name SEPARATOR ' '),''),
                    COALESCE(GROUP_CONCAT(DISTINCT  sc.name SEPARATOR ' '),''),
                     COALESCE(GROUP_CONCAT(DISTINCT  com.name SEPARATOR ' '),''),
                     COALESCE(GROUP_CONCAT(DISTINCT  col.name SEPARATOR ' '),''),
                     COALESCE(GROUP_CONCAT(DISTINCT  site.name SEPARATOR ' '),''),
                     COALESCE(GROUP_CONCAT(DISTINCT  l2.name SEPARATOR ' '),''),
                     (CASE WHEN CONCAT(COALESCE(ii.medium,''), COALESCE(ii.def,''), COALESCE(ii.batch_url,'')) = '' THEN 0 ELSE 1 END)
                    
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
                    
                    LEFT JOIN taxonomy tper ON s.`id` = tper.`entity_id` AND tper.`entity_type` = '{$type}' AND tper.taxonomy_type = 'period'
                    LEFT JOIN `periods` per on per.`id` = tper.`taxonomy_id`
                    
                    LEFT JOIN `dates` on s.`date` = dates.`id`
                    
                    LEFT JOIN taxonomy tsite ON s.`id` = tsite.`entity_id` AND tsite.`entity_type` = '{$type}' AND tsite.taxonomy_type = 'site'
                    LEFT JOIN `sites` site on site.`id` = tsite.`taxonomy_id`
                    LEFT JOIN taxonomy tm ON s.`id` = tm.`entity_id` AND tm.`entity_type` = '{$type}' AND tm.taxonomy_type = 'maker'
                    LEFT JOIN `makers` m on m.`id` = tm.`taxonomy_id`
                    LEFT JOIN artists on artists.id = m.maker_name_id
                    LEFT JOIN professions on professions.id = m.maker_profession_id
                    
                    LEFT JOIN taxonomy tors ON s.`id` = tors.`entity_id` AND tors.`entity_type` = '{$type}' AND tors.taxonomy_type = 'origin'
                    LEFT JOIN `origins` ors on ors.`id` = tors.`taxonomy_id`
                    LEFT JOIN `origins` ors2 on ors._rgt  between ors2.`_lft` and ors2.`_rgt` 
                    
                    LEFT JOIN taxonomy thors ON s.`id` = thors.`entity_id` AND thors.`entity_type` = '{$type}' AND thors.taxonomy_type = 'historical_origin'
                    LEFT JOIN `historical_origins` hors on hors.`id` = thors.`taxonomy_id`
                    LEFT JOIN `historical_origins` hors2 on hors._rgt  between hors2.`_lft` and hors2.`_rgt` 
                    
                    LEFT JOIN taxonomy tl ON s.`id` = tl.`entity_id` AND tl.`entity_type` = '{$type}' AND tl.taxonomy_type = 'location'
                    LEFT JOIN `locations` l on l.`id` = tl.`taxonomy_id`
                    LEFT JOIN `locations` l2 on l._rgt  between l2.`_lft` and l2.`_rgt` 
                    
                    LEFT JOIN entity_properties ep ON s.id = ep.entity_id AND ep.`entity_type` = '{$type}'
                    
                    LEFT JOIN entity_images ei on ei.entity_id = s.id AND ei.entity_type = '{$type}'
                    LEFT JOIN images ii on ei.image_id = ii.id
                    WHERE s.id in ({$ids})
                    GROUP BY s.id
                  
                    ");

// TODO : add category, projects, title fields
            // TODO add collection details to collection and may be other details
        // TODO:   add id to text (include id in fulltext search)
            // TODO: renae maker to artist and remove profession and unknown value
            /*
             * update search
set projects =
 (select  COALESCE(GROUP_CONCAT(DISTINCT  p.tag_slug SEPARATOR ' '),'')  as value
from projects p WHERE p.taggable_id = search.id and p.taggable_type = 'item')
where   search.`type` = 'item';

             * SET group_concat_max_len=15000;
update search
set text =
CONCAT_WS(' ',COALESCE(text,''),  (select  COALESCE(GROUP_CONCAT(DISTINCT  ep.value SEPARATOR ' '),'')  as value
from entity_properties ep WHERE ep.entity_id = search.id and ep.entity_type = 'set'))
where   search.`type` = 'set';



            + set_id
            update search set set_id = (select set_id  from items where items.id = search.id) where type='item'

            */
          //  dd(DB::getQueryLog());
            if(($i+$step) <= $count){
                $incr = $step;
            } else {
                break;
            }
            $i += $incr;
        }

    }


}
