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

        'ancestors',
        'descendants'
    ];

    /**
     * @return HasMany
     */
    public function items()
    {
        $children = $this->children;
        $items = [];
        foreach($children as $child){
          if(!count($child->children) && $child->published()){
              $items[] = $child;
          }
        }
       return $items;
      //  return $this->hasMany(Item::class)->where('publish_state','>',0);
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

        foreach($descendants as $key => $descendant){
            if(!count($descendant->children)){
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

    /*public function getObjects()
    {
        return $this->objects;
    }

    public function getMakers()
    {
        return $this->makers;
    }

    public function getSubjects(){
        return $this->subjects;
    }

    public function getOrigins(){
        return $this->origins;
    }*/
/* comment this function in new branch*/
//    public function getCollections(){
//        return $this->collections;
//    }

    public function getCommunities(){
        return $this->communities;
    }

    public function getLocations(){
        return $this->locations;
    }

    public function getScools(){
        return $this->scools;
    }
}
