<?php

namespace App\Models;

class Image extends Classifiable
{
    /**
     * DB Table name
     *
     * @var string
     */
    protected $table = 'images';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'item_id',

        'name',
        'description',
        'category',

        'agenda',
        'remarks',
        'visual_regions',

        'def',
        'original',
        'big',
        'medium',
        'small',

        'publish_state',
        'publish_state_reason',

        'nli_pickname',

        'rights',

        'copyright_id',
        'photographer_id',

        'review',
        'negative_number',

        'order',
    ];


    public static $relationships = [
        'copyright'
    ];

    /**
     * @return MorphTo
     */
    public function sets()
    {
        return $this->morphTo(Item::class, 'entity');
    }

    /**
     * @return HasOne
     */
    public function copyright()
    {
        return $this->hasOne(Copyright::class, 'id', 'copyright_id');
    }

    /*public function copyright_value()
    {
        $copyright = $this->copyright;
        return $copyright->name;

    }*/

    /**
     * @return BelongsToMany
     */
    public function photographer()
    {
        return $this->hasOne(Photographer::class, 'id', 'photographer_id');
    }

    /**
     * @return string
     */
    public function url()
    {
        $url = $this->medium ? $this->medium : $this->def;
        return $url ? $url : $this->batch_url;
    }
}
