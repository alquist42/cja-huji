<?php


namespace App\Models\Taxonomy;


use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    /**
     * DB Table name
     *
     * @var string
     */
    protected $table = 'professions';

    public function makers()
    {
        return $this->hasMany(Maker::class,'maker_profession_id');
    }
}
