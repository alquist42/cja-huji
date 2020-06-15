<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIjaSearchIndexTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ija_search_index', function (Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->integer('type')->default(1);
            $table->bigInteger('set_id');
            $table->integer('publish_state')->nullable()->default(0)->index('ps');
            $table->integer('parental_status')->nullable()->default(0);
            $table->text('categ', 65535)->index('ft2');
            $table->text('title', 65535)->index('ft3');
            $table->text('subject', 65535)->index('ft4');
            $table->text('object', 65535)->index('ft6');
            $table->text('maker', 65535)->index('ft8');
            $table->text('date', 65535)->index('ft11');
            $table->text('period', 65535)->index('ft14');
            $table->text('origin', 65535)->index('ft16');
            $table->text('historical_origin', 65535)->index('ft18');
            $table->text('school', 65535)->index('ft19');
            $table->text('community', 65535)->index('ft21');
            $table->text('collection', 65535)->index('ft23');
            $table->text('site', 65535)->index('ft26');
            $table->text('location', 65535)->index('ft28');
            $table->text('addenda', 65535)->index('ft37');
            $table->text('subproject_tags', 65535)->nullable()->index('ft40');
            $table->index(['categ','title','subject','object','maker','date','period','origin','historical_origin','school','community','collection','site','location','addenda','subproject_tags'], 'ft1');
            $table->primary(['id','type']);
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ija_search_index');
    }
}
