<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Origin;
//use App\Models\Taxonomy\IObject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataController extends Controller
{

    public function index(Request $request )
    {
        echo 'hi data';

    }

    public function analize()
    {

        /*$results = DB::select( DB::raw("
                    SELECT objects.id,objects.name
                    FROM sets
                    INNER JOIN objects
                    INNER JOIN taxonomy
                    INNER JOIN projects
                    ON sets.id =taxonomy.entity_id AND objects.id = taxonomy.taxonomy_id AND projects.taggable_id = sets.id
                    WHERE
                     taxonomy.taxonomy_type='object' AND taxonomy.entity_type = 'set'
                      AND projects.tag_slug = 'SCH' AND projects.taggable_type='set'
                    GROUP BY objects.id,objects.name
                    UNION
                    (
                    SELECT objects.id,objects.name
                    FROM items
                    INNER JOIN objects
                    INNER JOIN taxonomy
                    INNER JOIN projects
                    ON items.id =taxonomy.entity_id AND objects.id = taxonomy.taxonomy_id AND projects.taggable_id = items.id
                    WHERE
                     taxonomy.taxonomy_type='object' AND taxonomy.entity_type = 'item'
                      AND projects.tag_slug = 'SCH' AND projects.taggable_type='item'
                    GROUP BY objects.id,objects.name
                    )
"

    ), array(

    ));*/

        /* VIEW IMAGES, THAT HAVE TAG SCH AND THEIR SETS HAVE NO TAG SCH (IMGS OBJECTS ARE OVERPOWERED) */

        $results = DB::select( DB::raw("
        SELECT items.id, projects.tag_slug,sets.id as set_id
            FROM items
            LEFT JOIN taxonomy
            ON items.id =taxonomy.entity_id and taxonomy.taxonomy_type = 'object' and taxonomy.entity_type = 'item'
            INNER JOIN projects 
            ON projects.taggable_id = items.id AND projects.tag_slug = 'SCH' AND projects.taggable_type='item'
            inner join sets ON items.set_id = sets.id
            
            WHERE taxonomy.id is null AND sets.id not in 
            (
            SELECT distinct sets.id
            FROM sets
            INNER JOIN objects
            INNER JOIN taxonomy
            INNER JOIN projects 
            ON sets.id =taxonomy.entity_id AND objects.id = taxonomy.taxonomy_id AND projects.taggable_id = sets.id
            WHERE 
             taxonomy.taxonomy_type='object' AND taxonomy.entity_type = 'set'
              AND projects.tag_slug = 'SCH' AND projects.taggable_type='set'
            
            )
"

        ), array(

        ));

        foreach($results as $result ){
            echo 'img id: ' . $result->id . ' , set id: ' . $result->set_id . '<br>';
        }



        /*foreach($results as $result ){
            $obj = IObject::where("id",$result->id)->first();
            echo $obj->name . ' (' .$obj->id. ')<br>';
            foreach ($obj -> getAncestors() as $anc){
                echo '--' . $anc->name . ' (' .$anc->id. ')<br>';
                if($anc->id != 313){
                    echo '@@@@@';
                }
                break;
            }
        }*/

      //  var_dump($results);
    }

    public function searchIndex()
    {
        ob_start();
        $step = 100;
        $countData = DB::select( DB::raw("select count(id) as c from sets"));

        $count =  $countData[0]->c;
        echo $count . '<br>';

        for($i = 0; $i<=$count;){

            flush();
            ob_flush();
            echo $i . ' ';
            DB::insert("insert into search(id,type,text) 
                     SELECT s.id,'set',
                     CONCAT( COALESCE(s.name,''), COALESCE(s.category,'') ,COALESCE(s.ntl,''),COALESCE(s.addenda,''),
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
                    FROM sets s
                    LEFT JOIN taxonomy tsbj ON s.`id` = tsbj.`entity_id` AND tsbj.`entity_type` = 'set' AND tsbj.taxonomy_type = 'subject'
                    LEFT JOIN `subjects` sbj on sbj.`id` = tsbj.`taxonomy_id` 
                    
                    LEFT JOIN taxonomy tobj ON s.`id` = tobj.`entity_id` AND tobj.`entity_type` = 'set' AND tobj.taxonomy_type = 'object'
                    LEFT JOIN `objects` obj on obj.`id` = tobj.`taxonomy_id`
                    
                    LEFT JOIN taxonomy tp ON s.`id` = tp.`entity_id` AND tp.`entity_type` = 'set' AND tp.taxonomy_type = 'period'
                    LEFT JOIN `periods` p on p.`id` = tp.`taxonomy_id`
                    
                    LEFT JOIN taxonomy tsc ON s.`id` = tsc.`entity_id` AND tsc.`entity_type` = 'set' AND tsc.taxonomy_type = 'school'
                    LEFT JOIN `schools` sc on sc.`id` = tsc.`taxonomy_id`
                    
                    LEFT JOIN taxonomy tcom ON s.`id` = tcom.`entity_id` AND tcom.`entity_type` = 'set' AND tcom.taxonomy_type = 'community'
                    LEFT JOIN `communities` com on com.`id` = tcom.`taxonomy_id`
                    
                    LEFT JOIN taxonomy tcol ON s.`id` = tcol.`entity_id` AND tcol.`entity_type` = 'set' AND tcol.taxonomy_type = 'collection'
                    LEFT JOIN `collections` col on col.`id` = tcol.`taxonomy_id`
                    
                    LEFT JOIN taxonomy tsite ON s.`id` = tsite.`entity_id` AND tsite.`entity_type` = 'set' AND tsite.taxonomy_type = 'site'
                    LEFT JOIN `sites` site on site.`id` = tsite.`taxonomy_id`
                    LEFT JOIN taxonomy tm ON s.`id` = tm.`entity_id` AND tm.`entity_type` = 'set' AND tm.taxonomy_type = 'maker'
                    LEFT JOIN `makers` m on m.`id` = tm.`taxonomy_id`
                    LEFT JOIN artists on artists.id = m.maker_name_id
                    LEFT JOIN professions on professions.id = m.maker_profession_id
                    LEFT JOIN taxonomy tors ON s.`id` = tors.`entity_id` AND tors.`entity_type` = 'set' AND tors.taxonomy_type = 'origin'
                    LEFT JOIN `origins` ors on ors.`id` = tors.`taxonomy_id`
                    LEFT JOIN `origins` ors2 on ors._rgt  between ors2.`_lft` and ors2.`_rgt` 
                    LEFT JOIN taxonomy tl ON s.`id` = tl.`entity_id` AND tl.`entity_type` = 'set' AND tl.taxonomy_type = 'location'
                    LEFT JOIN `locations` l on l.`id` = tl.`taxonomy_id`
                    LEFT JOIN `locations` l2 on l._rgt  between l2.`_lft` and l2.`_rgt` 
                    
                    GROUP BY s.id,s.name, s.category,s.ntl,s.addenda
                    LIMIT ?,?
                    ", array($i,$step));

            if(($i+$step) <= $count){
                $incr = $step;
            } else {
                break;
            }
            $i += $incr;
        }


        ob_end_flush();
    }
}
