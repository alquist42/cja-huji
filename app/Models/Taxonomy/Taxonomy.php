<?php


namespace App\Models\Taxonomy;

use App\Models\Image;
use App\Models\Item;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Taxonomy extends Model
{
    use NodeTrait;
    public $timestamps = false;
    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
      //  'description',
        'parent_id',
        'order'
    ];

    /**
     * @var array
     */
    protected $hidden = [
        '_lft',
        '_rgt',
        'created_at',
        'updated_at',
    ];

    /**
     * @return BelongsToMany
     */
    public function sets()
    {
        return $this->morphToMany(Item::class, 'taxonomy', 'taxonomy', 'taxonomy_id', 'entity_id')
         //   ->wherePivot('entity_type', 'set')
            ->published()
            ->project('set');
    }

    /**
     * @return BelongsToMany
     */
    public function images()
    {
        return $this->belongsToMany(Image::class);
    }
}
