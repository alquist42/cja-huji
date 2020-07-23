<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use App\Services\Search;

trait SearchableByIndex
{
    protected static function bootSearchableByIndex()
    {
        static::saved(function ($model) {
            Search::addToIndex($model->id);
        });
    static::deleted(function ($model) {
        Search::removeFromIndex($model->id);
    });
    }
}
