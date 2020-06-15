<?php


namespace App\Models\Taxonomy;

use App\Models\Item;
use Illuminate\Database\Eloquent\Model;

//use Kalnoy\Nestedset\NodeTrait;

class Details extends Model
{
    // use NodeTrait;
    public $timestamps = false;
    protected $table = 'taxomony_details';
    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'details',
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
}
