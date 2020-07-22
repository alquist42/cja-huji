<?php

namespace App\Models;

use App\Models\Taxonomy\Collection;
use App\Models\Taxonomy\Community;
use App\Models\Taxonomy\Congregation;
use App\Models\Taxonomy\Details;
use App\Models\Taxonomy\HistoricalOrigin;
use App\Models\Taxonomy\Location;
use App\Models\Taxonomy\Maker;
use App\Models\Taxonomy\Object  as TaxonomyObject;
use App\Models\Taxonomy\Origin;
use App\Models\Taxonomy\Period;
use App\Models\Taxonomy\School;
use App\Models\Taxonomy\Site;
use App\Models\Taxonomy\Bibliography;
use App\Models\Taxonomy\Subject;
use App\Models\Project;
use Illuminate\Database\Eloquent\Model;

class Classifiable extends Model
{

    /**
     * @return BelongsToMany
     */
    public function origins()
    {
        return $this->morphedByMany(Origin::class, 'taxonomy','taxonomy','entity_id', 'taxonomy_id');
    }

    /**
     * @return BelongsToMany
     */
    public function subjects()
    {
        return $this->morphedByMany(Subject::class, 'taxonomy','taxonomy','entity_id', 'taxonomy_id');

    }

    /**
     * @return BelongsToMany
     */
    public function objects()
    {
        return $this->morphedByMany(TaxonomyObject::class, 'taxonomy','taxonomy','entity_id', 'taxonomy_id');
    }

    /**
     * @return BelongsToMany
     */
    public function locations()
    {
        return $this->morphedByMany(Location::class, 'taxonomy','taxonomy','entity_id', 'taxonomy_id');
    }

    /**
     * @return BelongsToMany
     */
    public function collections()
    {
        return $this->morphedByMany(Collection::class, 'taxonomy','taxonomy','entity_id', 'taxonomy_id');
    }

    /**
     * @return BelongsToMany
     */
    public function communities()
    {
        return $this->morphedByMany(Community::class, 'taxonomy','taxonomy','entity_id', 'taxonomy_id');
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
    public function historical_origins()
    {
        return $this->morphedByMany(HistoricalOrigin::class, 'taxonomy','taxonomy','entity_id', 'taxonomy_id');
    }

    /**
     * @return BelongsToMany
     */
    public function periods()
    {
        return $this->morphedByMany(Period::class, 'taxonomy','taxonomy','entity_id', 'taxonomy_id');

    }

    /**
     * @return BelongsToMany
     */
    public function schools()
    {
        return $this->morphedByMany(School::class, 'taxonomy','taxonomy','entity_id', 'taxonomy_id');
    }

    /**
     * @return BelongsToMany
     */
    public function sites()
    {
        return $this->morphedByMany(Site::class, 'taxonomy','taxonomy','entity_id', 'taxonomy_id');

    }

    /**
     * @return BelongsToMany
     */
    public function bibliography()
    {
        return $this->morphedByMany(Bibliography::class, 'taxonomy','taxonomy','entity_id', 'taxonomy_id');

    }
    /**
     * @return BelongsToMany
     */
    public function makers()
    {
        return $this->morphedByMany(Maker::class, 'taxonomy','taxonomy','entity_id', 'taxonomy_id');
    }


    /**
     * @return BelongsToMany
     */
    public function images()
    {
        return $this->belongsToMany(Image::class,'entity_images','entity_id', 'image_id');
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
        return $this->belongsToMany(Property::class,'entity_properties','entity_id', 'property_id')->withPivot('value', 'prop_flags');
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


    /**
     * @return BelongsToMany
     */
    public function origin_details()
    {
        return $this->morphMany(Details::class, 'entity', null, 'entity_id')
            ->where('taxonomy_type', '=', 'origin');
    }

    /**
     * @return BelongsToMany
     */
    public function object_details()
    {
        return $this->morphMany(Details::class, 'entity', null, 'entity_id')
            ->where('taxonomy_type', '=', 'object');
    }

    /**
     * @return BelongsToMany
     */
    public function collection_details()
    {
        return $this->morphMany(Details::class, 'entity', null, 'entity_id')
            ->where('taxonomy_type', '=', 'collection');
    }


    /**
     * @return BelongsToMany
     */
    public function community_details()
    {
        return $this->morphMany(Details::class, 'entity', null, 'entity_id')
            ->where('taxonomy_type', '=', 'community');
    }


    /**
     * @return BelongsToMany
     */
    public function maker_details()
    {
        return $this->morphMany(Details::class, 'entity', null, 'entity_id')
            ->where('taxonomy_type', '=', 'maker');
    }


    /**
     * @return BelongsToMany
     */
    public function period_details()
    {
        return $this->morphMany(Details::class, 'entity', null, 'entity_id')
            ->where('taxonomy_type', '=', 'period');
    }


    /**
     * @return BelongsToMany
     */
    public function school_details()
    {
        return $this->morphMany(Details::class, 'entity', null, 'entity_id')
            ->where('taxonomy_type', '=', 'school');
    }


    /**
     * @return BelongsToMany
     */
    public function subject_details()
    {
        return $this->morphMany(Details::class, 'entity', null, 'entity_id')
            ->where('taxonomy_type', '=', 'subject');
    }

    /**
     * @return BelongsToMany
     */
    public function site_details()
    {
        return $this->morphMany(Details::class, 'entity', null, 'entity_id')
            ->where('taxonomy_type', '=', 'site');
    }

    /**
     * @return BelongsToMany
     */
    public function projects()
    {
        return $this->morphMany(Project::class, 'taggable', null, 'taggable_id');
    }


    public function getTaxonomy($taxonomy, $details = null){
        $taxonomy_singular_name = str_singular($taxonomy);
        if(is_null($details)){
            $details = $taxonomy_singular_name . "_details";
            if(method_exists($this, $details)){
                $details = $this->{$details}()->get();
            } else {
                $details=[];
            }

        }

        if(count($this->{$taxonomy}) == 1 && $this->{$taxonomy}->first()->id == -1 && !count($details)){
            return [];
        }
        if(!count($this->{$taxonomy})){
            $parent = $this->parent;
            if(!empty($parent)){
                return $parent->getTaxonomy($taxonomy, (count($details) ? $details : null) );
            }
            if(!count($details)){
                return [];
            }
        }

        foreach ($details as $detail) {
            $taxonomy_obj = null;
            if ($this->{$taxonomy}->contains('id', $detail->taxonomy_id)){ // return taxonomy with the same id
                $taxonomy_obj = $this->{$taxonomy}->first(function ($obj) use ($detail) {
                    return $obj->id == $detail->taxonomy_id;
                });
            } else { // create undefined taxonomy to link details
                $model = '\\App\\Models\\Taxonomy\\' . ucfirst($taxonomy_singular_name);
                $taxonomy_obj = new $model(['id'=>-1,'name'=>'undefined',
                    'maker_name_id'=>-1,
                    'maker_profession_id'=>-1,
                    'pivot_taxonomy_id'=>-1]);
                $this->{$taxonomy}->push($taxonomy_obj);
            }

            $taxonomy_obj->details = $detail->details;
        }

        return $this->{$taxonomy};
    }



    public function addenda(){
        if(!empty($this->addenda)){
            parse_str ($this->addenda, $out);
            if(count($out) == 1){
                return $this->addenda;
            }
        }

        return null;
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

    public function published()
    {
        if ($this->publish_state > 0) {
            return true;
        }
        return false;
    }

    public function scopePublished($query)
    {
        return $query->where('publish_state', '>', 0);
    }
}
