<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Kalnoy\Nestedset\NodeTrait;

class Item extends Model
{
    use NodeTrait;

    /**
     * @var array
     */
    protected $fillable = [
        'external_id',
        'name',
        'category',
        'description',
        'lat',
        'lon'
    ];


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

    /**
     * @return HasMany
     */
    public function images()
    {
        return $this->hasMany(Image::class, 'item_id');
    }

    public function origins()
    {
        return $this->belongsToMany(Origin::class, 'item_origin');
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'item_subject');
    }
}
