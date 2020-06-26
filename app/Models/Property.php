<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    /**
     * DB Table name
     *
     * @var string
     */
    protected $table = 'properties';

    /**
     * @return MorphTo
     */
    public function sets()
    {
        return $this->belongsToMany(Item::class, 'entity_properties', 'property_id','entity_id');
    }
}
