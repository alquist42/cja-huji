<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Kalnoy\Nestedset\NestedSet;

class CreateTaxonomyTables extends Migration
{

    /**
     * All Taxonomy tables
     *
     * @var array
     */
    protected $tables = [
        'subjects',
        'origins',
        'collections',
        'communities',
        'congregations',
        'historic_origins',
        'locations',
        'makers',
        'professions',
        'objects',
        'periods',
        'photographers',
        'schools',
        'sites'
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach ($this->tables as $table_name) {
            Schema::create($table_name, function (Blueprint $table) {
                $table->increments('id');
                $table->string('name', 300);
                $table->text('description')->nullable();
                $table->integer('order');
                NestedSet::columns($table);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach ($this->tables as $table_name) {
            Schema::dropIfExists($table_name);
        }
    }
}
