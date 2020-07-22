<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /**
     * DB Table name
     *
     * @var string
     */
    protected $table = 'projects';

    public $timestamps = false;

    protected $fillable = ['taggable_id', 'taggable_type', 'tag_slug'];

}
