<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Set;
use Illuminate\Database\Eloquent\Relations\morphToMany;

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
        return $this->morphToMany(Set::class, 'id', 'id')
            ->where('type', '=', 'set');
    }

    public static $relationships = [
        'sets',
        'items'
    ];
}
