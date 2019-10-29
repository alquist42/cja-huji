<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Image extends Classifiable
{
    /**
     * DB Table name
     *
     * @var string
     */
    protected $table = 'images';

    protected $fillable = [
        'id',
        'item_id',

        'name',
        'description',
        'category',

        'agenda',
        'remarks',
        'visual_regions',

        'original',
        'big',
        'medium',
        'small',

        'publish_state',
        'publish_state_reason',

        'nli_pickname',


        'copyright_id',
        'photographer_id',

        'review',
        'negative_number',

        'order',
    ];

    /**
     * @return MorphTo
     */
    public function items()
    {
        return $this->morphTo(Item::class, 'entity');
    }

    /**
     * @return MorphTo
     */
    public function sets()
    {
        return $this->morphTo(Set::class, 'entity');
    }

    /**
     * @return HasOne
     */
    public function copyright()
    {
        return $this->hasOne(Copyright::class, 'id', 'copyright_id');
    }

    /**
     * @return BelongsToMany
     */
    public function photographers()
    {
        return $this->morphToMany(Photographer::class, 'entity', 'taxonomy', 'entity_id', 'taxonomy_id')
            ->wherePivot('taxonomy_type', '=', 'photographer');
    }

    /**
     * @return string
     */
    public function url()
    {
        return $this->def ? $this->def : $this->batch_url;
    }
}
