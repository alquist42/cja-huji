<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Kalnoy\Nestedset\NodeTrait;

class Set extends Classifiable
{
    use NodeTrait;

    public $timestamps = false;

    /**
     * DB Table name
     *
     * @var string
     */
    protected $table = 'sets';
    protected $searchableColumns = ['name'];

    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'parent_id',

        'name',
        'description',
        'short_description',
        'agenda',

        'category',

        'lat',
        'lon',
        'geo_options',

        'order',

        'publish_state',
        'publish_state_reason',

        'artifact_at_risk',
        'parental_state',

        'ntl',
        'ntl_localname',

        'date',

        'remarks',
    ];

    public static $relationships = [
        'locations',
        'origins',
        'schools',
        'properties',
        'objects',
        'subjects',
        'historic_origins',
        'periods',
        'collections',
        'communities',
        'origin_details',
        'collection_details',
        'makers',
        'makers.artist',
        'makers.profession',
        'creation_date',

      /*  'items',
        'items.locations',
        'items.origins',
        'items.schools',
        'items.properties',
        'items.objects',
        'items.subjects',
        'items.historic_origins',
        'items.periods',
        'items.collections',
        'items.communities',
        'items.origin_details',
        'items.collection_details',
        'items.makers',
        'items.makers.artist',
        'items.makers.profession',
        'items.creation_date',

        'items.images',
        'items.images.photographer',
        'items.images.copyright',*/


        'images',
        'images.photographer',
        'images.copyright',

        'children',
        'children.images',
        'children.collections',

        'ancestors',
        'descendants'
    ];

    /**
     * @return HasMany
     */
    public function items()
    {
        $descendants = $this->descendantsOf($this->id);
        $parents = [];
        foreach($descendants as $descendant){
            if(!in_array($descendant->parent_id,$parents)){
                $parents[] = $descendant->parent_id;
            }
        }

        $children = $this->children;
    //    dd($children);
        foreach($children as $key => $child){
            if(in_array($child->id,$parents)){
                unset($children[$key]);
            }
        }

       return $children;
    }

    public static function withAllRelations() {
        return static::with(Set::$relationships);
    }

    /**
     * @return string
     */
    public function name() {
        return $this->name ? $this->name : $this->ntl;
    }

    public function ntl() {
        return $this->ntl ? $this->ntl : $this->name;
    }

    public function name_in_tree() {
        $name =  $this->name ? $this->name : $this->ntl;
        $names = explode(" - ",$name);
        return end($names);
    }

    public function leaf() {
        $ancestors = Set::ancestorsAndSelf($this->id);
        foreach ($ancestors as $anc){
            if(empty($anc->parent_id)){
                $descendants = $anc->descendantsOf($anc->id);
                break;
            }
        }
       $parents = [];
        foreach($descendants as $descendant){
            if(!in_array($descendant->parent_id,$parents)){
                $parents[] = $descendant->parent_id;
            }
        }

        foreach($descendants as $key => $descendant){
            if(!in_array($descendant->id,$parents)){
                unset($descendants[$key]);
            }
        }

        return $ancestors->merge($descendants)->toTree();
       // return Set::ancestorsAndSelf($this->id)->merge($this->descendants)->toTree();

    }

    public function url(){
        return request()->project . "/items/" . $this->id;
    }

    public function image_url(){
        return  "/images/s-" . $this->id ;
    }
}
