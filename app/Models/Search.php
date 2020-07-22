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
    protected $fillable = ['id', 'set_id', 'type', 'category', 'title', 'publish_state', 'projects', 'text', 'subject', 'object', 'artist', 'period', 'origin',
                            'historical_origin', 'school', 'community', 'collection', 'site', 'location', 'image'];


    public $timestamps = false;
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
