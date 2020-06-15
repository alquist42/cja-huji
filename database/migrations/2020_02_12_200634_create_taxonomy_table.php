<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTaxonomyTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taxonomy', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('taxonomy_id')->default(0)->index('taxonomy_id');
            $table->enum('taxonomy_type', array('bibliography','historical_origin','collection','community','location','maker','object','origin','period','photographer','school','site','subject','set','item'))->index('taxonomy_type');
            $table->integer('entity_id')->default(0)->index('entity_id');
            $table->enum('entity_type', array('set','item','image'))->nullable()->index('entity_type');
            $table->unique(['taxonomy_id','taxonomy_type','entity_id','entity_type'], 'taxonomy_id_taxonomy_type_entity_id_entity_type');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('taxonomy');
    }
}
