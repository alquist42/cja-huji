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

        'items',
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
        'items.images.copyright',


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
        return $this->hasMany(Item::class);
    }

    public static function withAllRelations() {
        return static::with(Set::$relationships);
    }

    /**
     * @return string
     */
    public function name() {
        return $this->ntl ? $this->ntl : $this->name;
    }

    public function leaf() {
        return Set::ancestorsAndSelf($this->id)->merge($this->descendants)->toTree();
    }
}
