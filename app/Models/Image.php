<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
     * @return BelongsTo
     */
    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    /**
     * @return HasOne
     */
    public function copyright()
    {
        return $this->hasOne(Copyright::class, 'copyright_id');
    }

    /**
     * @return HasOne
     */
    public function photographer()
    {
        return $this->hasOne(Photographer::class, 'photographer_id');
    }
}
