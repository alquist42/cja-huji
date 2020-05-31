<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIjaRatingTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ija_rating', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->integer('parent_id');
			$table->integer('left');
			$table->integer('right');
			$table->string('name', 120);
			$table->text('guess', 65535);
			$table->text('description', 65535)->nullable();
			$table->integer('ordering')->nullable();
			$table->integer('set_count')->nullable()->default(0);
			$table->integer('obj_count')->nullable()->default(0);
			$table->integer('cashe_time')->nullable()->default(0);
			$table->string('subproject_tags', 200)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ija_rating');
	}

}
