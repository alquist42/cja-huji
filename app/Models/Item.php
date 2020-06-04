<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Relations\BelongsTo;
use Kalnoy\Nestedset\NodeTrait;

class Item extends Classifiable
{
    use NodeTrait;

    /**
     * DB Table name
     *
     * @var string
     */
    protected $table = 'items';

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

        'images',
        'images.photographer',
        'images.copyright',

        'set',
        'set.items',
        'set.items.images'
    ];

    /**
     * @return BelongsTo
     */
    public function set()
    {
        return $this->belongsTo(Set::class);
    }

    /**
     * @return string
     */
    public function name() {
        return $this->ntl;
    }

    public function url(){
        return request()->project . "/images/" . $this->id;
    }

    public function image_url(){
        return  "/images/i-" . $this->id ;
    }

    public function getObjects(){
        if(count($this->objects)){
            return $this->objects;
        }
        else {
            $set = $this->set;
            return $set->getObjects();
        }

    }

    public function getMakers(){
        if(count($this->makers)){
            return $this->makers;
        }
        else {
            $set = $this->set;
            return $set->getMakers();
        }

    }

    public function getSubjects(){
        if(count($this->subjects)){
            return $this->subjects;
        }
        else {
            $set = $this->set;
            return $set->getSubjects();
        }
    }

    public function getOrigins(){
        if(count($this->origins)){
            return $this->origins;
        }
        else {
            $set = $this->set;
            return $set->getOrigins();
        }
    }

    public function getCollections(){
        if(count($this->collections)){
            return $this->collections;
        }
        else {
            $set = $this->set;
            return $set->getCollections();
        }
    }

    public function getCommunities(){
        if(count($this->communities)){
            return $this->communities;
        }
        else {
            $set = $this->set;
            return $set->getCommunities();
        }
    }

    public function getLocations(){
        if(count($this->locations)){
            return $this->locations;
        }
        else {
            $set = $this->set;
            return $set->getLocations();
        }
    }

    public function getScools(){
        if(count($this->scools)){
            return $this->scools;
        }
        else {
            $set = $this->set;
            return $set->getScools();
        }
    }
}
