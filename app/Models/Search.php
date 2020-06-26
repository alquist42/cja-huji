<?php

namespace App\Models;

use App\Models\Item;
use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
    /**
     * DB Table name
     *
     * @var string
     */
    protected $table = 'search';

    public function sets()
    {
        return $this->morphToMany(Item::class, 'id', 'id');
       //     ->where('type', '=', 'set');
    }

    public static $relationships = [
        'sets',
        'items'
    ];
}
