<?php

namespace App\Models;

use App\Traits\SearchableByName;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Kalnoy\Nestedset\NodeTrait;

class Item extends Classifiable
{
    use NodeTrait, SearchableByName;

    const PUBLISH_STATE_NOT_PUBLISHED = 0;
    const PUBLISH_STATE_PREPARED_FOR_PUBLISHING = 1;
    const PUBLISH_STATE_PUBLISHED = 2;

    public $timestamps = false;

    /**
     * DB Table name
     *
     * @var string
     */
    protected $table = 'sets';
    protected $searchableColumns = ['name'];
    protected $hidden = ['parent_id', '_lft', '_rgt', 'old_id'];

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

        'geo_lat',
        'geo_lng',
        'geo_options',

        'order',

        'publish_state',
        'publish_state_reason',

        'artifact_at_risk',
        'parental_state',

        'ntl',
        'ntl_localname',

        'date',
        'reconstruction_dates',
        'activity_dates',
        'copyright_id',

        'remarks',
    ];

    public static $relationships = [
        'locations',
        'origins',
        'schools',
        'objects',
        'subjects',
        'historical_origins',
        'periods',
        'sites',
//        'congregations',
        'collections',
        'communities',
        'makers',
        'properties',

        'location_details',
        'origin_details',
        'school_details',
        'object_details',
        'subject_details',
//        'historical_origin_details',
        'period_details',
//        'site_details',
//        'congregation_details',
        'collection_details',
        'community_details',
        'maker_details',


        'makers.artist',
        'makers.profession',

        'creation_date',
        'reconstruction_dates_object',
        'activity_dates_object',
        'category_object',
        'copyright',


        'images',
        'images.photographer',
        'images.copyright',

        'children',
        'children.images',
        'children.collections',
//
        'ancestors',
        'descendants'
    ];

    /**
     * @return HasOne
     */
    public function reconstruction_dates_object()
    {
        return $this->hasOne(Date::class, 'id', 'reconstruction_dates');
    }

    /**
     * @return HasOne
     */
    public function activity_dates_object()
    {
        return $this->hasOne(Date::class, 'id', 'activity_dates');
    }

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
        foreach($children as $key => $child){
            if(in_array($child->id,$parents)){
                unset($children[$key]);
            }
        }

       return $children;
    }

    public static function withAllRelations() {
        return static::with(Item::$relationships);
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

    public function getLeafAttribute() {
        return $this->leaf();
    }

    public function leaf() {
        $ancestors = Item::ancestorsAndSelf($this->id);
        foreach ($ancestors as $anc) {
            if (empty($anc->parent_id)) {
                $descendants = $anc->descendantsOf($anc->id);
                break;
            }
        }
        $parents = [];
        foreach ($descendants as $descendant) {
            if (!in_array($descendant->parent_id, $parents)) {
                $parents[] = $descendant->parent_id;
            }
        }

        foreach ($descendants as $key => $descendant) {
            if (!in_array($descendant->id, $parents)) {
                unset($descendants[$key]);
            }
        }

        return $ancestors->merge($descendants)->toTree();
        // return Item::ancestorsAndSelf($this->id)->merge($this->descendants)->toTree();
    }

    public function url(){
        return request()->project . "/items/" . $this->id;
    }

//    public function image_url(){
//        return  "/images/s-" . $this->id ;
//    }
}
