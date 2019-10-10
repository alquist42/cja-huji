<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Kalnoy\Nestedset\NodeTrait;

class Image extends Model
{
    use NodeTrait;


//    /**
//     * @return BelongsTo
//     */
//    public function parent()
//    {
//        return $this->belongsTo(self::class, 'parent_id');
//    }
//    /**
//     * @return HasMany
//     */
//    public function children()
//    {
//        return $this->hasMany(self::class, 'parent_id');
//    }

//    /**
//     * @return HasMany
//     */
//    public function images()
//    {
//        return $this->hasMany(Image::class, 'item_id');
//    }
}
