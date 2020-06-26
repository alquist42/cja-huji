<?php


namespace App\Models\Taxonomy;

class Artist extends Taxonomy
{
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
