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
        return  request()->project . "/images/" . $this->id ;
    }

    public function image_url(){
        return  "/images/i-" . $this->id ;
    }
}
