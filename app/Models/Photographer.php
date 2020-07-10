<?php

namespace App\Models;

use App\Models\Taxonomy\Taxonomy;
use App\Traits\SearchableByName;

class Photographer extends Taxonomy
{
    use SearchableByName;

    /**
     * DB Table name
     *
     * @var string
     */
    protected $table = 'photographers';
}
