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
}
