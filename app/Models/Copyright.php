<?php

namespace App\Models;

use App\Traits\SearchableByName;
use Illuminate\Database\Eloquent\Model;

class Copyright extends Model
{
    use SearchableByName;

    /**
     * DB Table name
     *
     * @var string
     */
    protected $table = 'copyright';

    protected $fillable = ['name'];

    public $timestamps = false;
}
