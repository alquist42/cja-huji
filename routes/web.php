<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/admin/{name?}','AdminController@viewLinks')->name('{name?}');

Route::get('/', 'WelcomeController@index');
Route::get('/{project}', 'HomeController@index')->where('project', 'catalogue|wpc');
Route::get('/{project}/items', 'CatalogController@index')->where('project', 'catalogue|wpc');
Route::get('/{project}/items/{item}', 'CatalogController@show')->where('project', 'catalogue|wpc');

/* Vue.js SPA */
Route::get('/{project}/browse/{any?}/{other?}', function ($project) {
    return view('browse', [ 'project' => $project]);
});




Auth::routes();

