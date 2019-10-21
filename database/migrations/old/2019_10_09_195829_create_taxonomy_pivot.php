<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaxonomyPivot extends Migration
{
    /**
     * All Taxonomy tables
     *
     * @var array
     */
    protected $taxonomy = [
        'subject',
        'origin',
        'collection',
        'community',
        'congregation',
        'historic_origin',
        'location',
        'maker',
        'profession',
        'object',
        'period',
        'photographer',
        'school',
        'site'
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taxonomy', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('entity_id')->unsigned();
            $table->enum('entity_type', ['item', 'image']);

            $table->integer('taxonomy_id')->unsigned();
            $table->enum('taxonomy_type', $this->taxonomy);

            $table->string('details', 300);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('taxonomy');
    }
}
