<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait SearchableByName
{
    /**
     * Scope for searching by name.
     *
     * @param Builder $query
     * @param $search
     *
     * @return Builder
     */
    public function scopeSearchByName(Builder $query, $search)
    {
        return $query->when($search, function ($q, $search) {
            return $q->where('name', 'LIKE', "%$search%");
        });
    }
}
