<?php


namespace App\Models\Taxonomy;

class Maker extends Taxonomy
{
    /**
     * DB Table name
     *
     * @var string
     */
    protected $table = 'makers';

    protected $fillable = [
        'maker_name_id',
        'maker_profession_id',
    ];

    public static function bootNodeTrait()
    {
        // Override the trait's method as Maker doesn't use a hierarchy
    }

    public function artist()
    {
        return $this->belongsTo(Artist::class, 'maker_name_id');
    }

    public function profession()
    {
        return $this->belongsTo(Profession::class, 'maker_profession_id');
    }
}
