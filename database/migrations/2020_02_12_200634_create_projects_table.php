<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProjectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('projects', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('taggable_id')->nullable()->index('taggable_id');
			$table->enum('taggable_type', array('bibliography','historical_origin','collection','community','location','maker_name','maker_profession','object','origin','period','photographer','school','site','subject','set','item'))->nullable()->index('taggable_type');
			$table->string('tag_slug', 20)->nullable()->index('tag_slug');
			$table->unique(['taggable_id','taggable_type','tag_slug'], 'taggable_id_taggable_type_tag_slug');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('projects');
	}

}
