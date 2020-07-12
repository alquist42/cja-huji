<?php

namespace App\Models;

use App\Traits\SearchableByName;
use Illuminate\Database\Eloquent\Model;

class Date extends Model
{
    use SearchableByName;

    /**
     * DB Table name
     *
     * @var string
     */
    protected $table = 'dates';

    protected $fillable = ['name'];

    public $timestamps = false;
}
