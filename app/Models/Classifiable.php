<?php

namespace App\Models;

use App\Models\Taxonomy\Collection;
use App\Models\Taxonomy\Community;
use App\Models\Taxonomy\Congregation;
use App\Models\Taxonomy\HistoricOrigin;
use App\Models\Taxonomy\Location;
use App\Models\Taxonomy\Maker;
use App\Models\Taxonomy\Object  as TaxonomyObject;
use App\Models\Taxonomy\Origin;
use App\Models\Taxonomy\Period;
use App\Models\Taxonomy\School;
use App\Models\Taxonomy\Site;
use App\Models\Taxonomy\Subject;

use App\Models\Taxonomy\Details;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Classifiable extends Model
{

    /**
     * @return BelongsToMany
     */
    public function origins()
    {
        return $this->morphToMany(Origin::class, 'entity', 'taxonomy', 'entity_id', 'taxonomy_id')
            ->wherePivot('taxonomy_type', '=', 'origin');
    }

    /**
     * @return BelongsToMany
     */
    public function subjects()
    {
        return $this->morphToMany(Subject::class, 'entity', 'taxonomy', 'entity_id', 'taxonomy_id')
            ->wherePivot('taxonomy_type', '=', 'subject');
    }

    /**
     * @return BelongsToMany
     */
    public function objects()
    {
        return $this->morphToMany(TaxonomyObject::class, 'entity', 'taxonomy', 'entity_id', 'taxonomy_id')
            ->wherePivot('taxonomy_type', '=', 'object');
    }

    /**
     * @return BelongsToMany
     */
    public function locations()
    {
        return $this->morphToMany(Location::class, 'entity', 'taxonomy', 'entity_id', 'taxonomy_id')
            ->wherePivot('taxonomy_type', '=', 'location');
    }

    /**
     * @return BelongsToMany
     */
    public function collections()
    {
        return $this->morphToMany(Collection::class, 'entity', 'taxonomy', 'entity_id', 'taxonomy_id')
            ->wherePivot('taxonomy_type', '=', 'collection');
    }

    /**
     * @return BelongsToMany
     */
    public function communities()
    {
        return $this->morphToMany(Community::class, 'entity', 'taxonomy', 'entity_id', 'taxonomy_id')
            ->wherePivot('taxonomy_type', '=', 'community');
    }

    /**
     * @return BelongsToMany
     */
    public function congregations()
    {
        return $this->morphToMany(Congregation::class, 'entity', 'taxonomy', 'entity_id', 'taxonomy_id')
            ->wherePivot('taxonomy_type', '=', 'congregation');
    }

    /**
     * @return BelongsToMany
     */
    public function historic_origins()
    {
        return $this->morphToMany(HistoricOrigin::class, 'entity', 'taxonomy', 'entity_id', 'taxonomy_id')
            ->wherePivot('taxonomy_type', '=', 'historical_origin');
    }

    /**
     * @return BelongsToMany
     */
    public function periods()
    {
        return $this->morphToMany(Period::class, 'entity', 'taxonomy', 'entity_id', 'taxonomy_id')
            ->wherePivot('taxonomy_type', '=', 'period');
    }

    /**
     * @return BelongsToMany
     */
    public function schools()
    {
        return $this->morphToMany(School::class, 'entity', 'taxonomy', 'entity_id', 'taxonomy_id')
            ->wherePivot('taxonomy_type', '=', 'school');
    }

    /**
     * @return BelongsToMany
     */
    public function sites()
    {
        return $this->morphToMany(Site::class, 'entity', 'taxonomy', 'entity_id', 'taxonomy_id')
            ->wherePivot('taxonomy_type', '=', 'site');
    }
    /**
     * @return BelongsToMany
     */
    public function makers()
    {
        return $this->morphToMany(Maker::class, 'entity', 'taxonomy', 'entity_id', 'taxonomy_id')
            ->wherePivot('taxonomy_type', '=', 'maker');
    }

    public function makersHasProfession(){
        foreach ($this->getMakers() as $maker){
            if($maker->profession->id != -1){
                return true;
            }
        }
        return false;
    }

    /**
     * @return BelongsToMany
     */
    public function images()
    {
        return $this->morphToMany(Image::class, 'entity', 'entity_images');
    }

    /**
     * @return HasOne
     */
    public function copyright()
    {
        return $this->hasOne(Copyright::class, 'id', 'copyright_id');
    }

    /**
     * @return HasOne
     */
    public function creation_date()
    {
        return $this->hasOne(Date::class, 'id', 'date');
    }

    /**
     * @return HasOne
     */
    public function category_object()
    {
        return $this->hasOne(Category::class, 'slug', 'category');
    }

    /**
     * @return BelongsToMany
     */
    public function properties()
    {
        return $this->morphToMany(Property::class, 'entity', 'entity_properties')->withPivot('value', 'prop_flags');
    }

    /* DETAILS */
    /**
     * @return BelongsToMany
     */
    public function location_details()
    {
        return $this->morphMany(Details::class, 'entity', null, 'entity_id')
            ->where('taxonomy_type', '=', 'location');
    }

    public function location_detail()
    {
        $details = $this->location_details;
        foreach ($details as $detail){
            return $detail->details;
        }
    }

    /**
     * @return BelongsToMany
     */
    public function origin_details()
    {
        return $this->morphMany(Details::class, 'entity', null, 'entity_id')
            ->where('taxonomy_type', '=', 'origin');
    }

    public function origin_detail()
    {
        $details = $this->origin_details;
        foreach ($details as $detail){
            return $detail->details;
        }
    }

    /**
     * @return BelongsToMany
     */
    public function object_details()
    {
        return $this->morphMany(Details::class, 'entity', null, 'entity_id')
            ->where('taxonomy_type', '=', 'object');
    }

    public function object_detail()
    {
        $details = $this->object_details;
        foreach ($details as $detail){
            return $detail->details;
        }
    }

    /**
     * @return BelongsToMany
     */
    public function collection_details()
    {
        return $this->morphMany(Details::class, 'entity', null, 'entity_id')
            ->where('taxonomy_type', '=', 'collection');
    }

    public function collection_detail()
    {
        $details = $this->collection_details;
        foreach ($details as $detail){
            return $detail->details;
        }
    }

    /**
     * @return BelongsToMany
     */
    public function community_details()
    {
        return $this->morphMany(Details::class, 'entity', null, 'entity_id')
            ->where('taxonomy_type', '=', 'community');
    }

    public function community_detail()
    {
        $details = $this->community_details;
        foreach ($details as $detail){
            return $detail->details;
        }
    }

    /**
     * @return BelongsToMany
     */
    public function maker_details()
    {
        return $this->morphMany(Details::class, 'entity', null, 'entity_id')
            ->where('taxonomy_type', '=', 'maker');
    }

    public function maker_detail()
    {
        $details = $this->maker_details;
        foreach ($details as $detail){
            return $detail->details;
        }
    }

    /**
     * @return BelongsToMany
     */
    public function period_details()
    {
        return $this->morphMany(Details::class, 'entity', null, 'entity_id')
            ->where('taxonomy_type', '=', 'period');
    }

    public function period_detail()
    {
        $details = $this->period_details;
        foreach ($details as $detail){
            return $detail->details;
        }
    }

    /**
     * @return BelongsToMany
     */
    public function school_details()
    {
        return $this->morphMany(Details::class, 'entity', null, 'entity_id')
            ->where('taxonomy_type', '=', 'school');
    }

    public function school_detail()
    {
        $details = $this->school_details;
        foreach ($details as $detail){
            return $detail->details;
        }
    }

    /**
     * @return BelongsToMany
     */
    public function subject_details()
    {
        return $this->morphMany(Details::class, 'entity', null, 'entity_id')
            ->where('taxonomy_type', '=', 'subject');
    }

    public function subject_detail()
    {
        $details = $this->subject_details;
        foreach ($details as $detail){
            return $detail->details;
        }
    }

    public function getObjects()
    {
        if(count($this->objects)){
            return $this->objects;
        }
        else {
            $parent = $this->parent;
            if(!empty($parent)){
                return $parent->getObjects();
            }
            return null;

        }
    }

    public function getMakers()
    {
        if(count($this->makers)){
            return $this->makers;
        }
        else {
            $parent = $this->parent;
            if(!empty($parent)){
                return $parent->getMakers();
            }
            return null;

        }
    }

    public function getSubjects(){
        if(count($this->subjects)){
            return $this->subjects;
        }
        else {
            $parent = $this->parent;
            if(!empty($parent)){
                return $parent->getSubjects();
            }
            return null;

        }
    }

    public function getOrigins(){
        if(count($this->origins)){
            return $this->origins;
        }
        else {
            $parent = $this->parent;
            if(!empty($parent)){
                return $parent->getOrigins();
            }
            return null;

        }
    }


    public function getCollections(){
        if(count($this->collections)){
            return $this->collections;
        }
        else {
            $parent = $this->parent;
            if(!empty($parent)){
                return $parent->getCollections();
            }
            return null;

        }
    }

    public function getCommunities(){
        if(count($this->communities)){
            return $this->communities;
        }
        else {
            $parent = $this->parent;
            if(!empty($parent)){
                return $parent->getCommunities();
            }
            return null;

        }
    }

    public function getLocations(){
        if(count($this->locations)){
            return $this->locations;
        }
        else {
            $parent = $this->parent;
            if(!empty($parent)){
                return $parent->getLocations();
            }
            return null;

        }
    }

    public function getScools(){
        if(count($this->schools)){
            return $this->schools;
        }
        else {
            $parent = $this->parent;
            if(!empty($parent)){
                return $parent->getScools();
            }
            return null;

        }
    }

    /**
     * Scope a query to only include popular users.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeProject($query, $model)
    {
        return $query
            ->leftJoin('projects', "{$model}s.id", '=', 'projects.taggable_id')
            ->where('projects.taggable_type', $model)
            ->where('projects.tag_slug', app()->make(Tenant::class)->slug());




    }

    public function published(){
        if($this->publish_state > 0){
            return true;
        }
        return false;
    }

    public function scopePublished($query)
    {
        return $query->where('publish_state', '>', 0);
    }
}
