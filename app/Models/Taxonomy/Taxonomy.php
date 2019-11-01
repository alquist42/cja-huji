<?php


namespace App\Models\Taxonomy;


use App\Models\Item;
use App\Models\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
        'description',
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
    public function items()
    {
        return $this->morphedByMany(Item::class, 'taxonomy', 'taxonomy');
    }

    /**
     * @return BelongsToMany
     */
    public function images()
    {
        return $this->belongsToMany(Image::class);
    }
}
