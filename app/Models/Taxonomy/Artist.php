<?php


namespace App\Models\Taxonomy;

use App\Traits\SearchableByName;

class Artist extends Taxonomy
{
    use SearchableByName;

    /**
     * DB Table name
     *
     * @var string
     */
    protected $table = 'artists';

    public function makers()
    {
        return $this->hasMany(Maker::class, 'maker_name_id');
    }
}
