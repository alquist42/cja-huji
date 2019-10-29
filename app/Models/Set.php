<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Kalnoy\Nestedset\NodeTrait;

class Set extends Classifiable
{
    use NodeTrait;

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

        'remarks',
    ];

    /**
     * @return HasMany
     */
    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
