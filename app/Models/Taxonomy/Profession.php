<?php


namespace App\Models\Taxonomy;

use App\Traits\SearchableByName;
use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    use SearchableByName;

    /**
     * DB Table name
     *
     * @var string
     */
    protected $table = 'professions';

    public function makers()
    {
        return $this->hasMany(Maker::class, 'maker_profession_id');
    }
}
