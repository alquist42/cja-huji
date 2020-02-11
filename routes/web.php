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
Route::get('/', 'WelcomeController@index');
Route::get('/staff/{name?}','AdminController@viewLinks');

Route::get('/images/{model}-{id}-{size}.png', 'ImagesController@view')->
        where('model', 's|i')->where('id', '[0-9]+')->where('size', 'original|thumb|small|medium');


// Single pages
Route::get('activities', function () {
	return view('activities', ['header' => ['title' => 'Activities', 'index_page' => true]]);
});
Route::get('publications', function () {
	return view('publications', ['header' => ['title' => 'Publications', 'index_page' => true]]);
});
Route::get('about', function () {
	return view('about', ['header' => ['title' => 'About', 'index_page' => true]]);
});

// MHS
Route::get('/mhs/{page?}', 'MHSController@index');
// Other projects

Route::group(['middleware' => 'project'], function () {
    Route::get('/{project}', 'HomeController@index');
    Route::get('/{project}/items', 'CatalogController@index');
    Route::get('/{project}/items/{item}', 'CatalogController@show');
    Route::get('/{project}/images/{item}', 'CatalogController@showItem');
	Route::get('/{project}/browse/{any}', 'BrowseController@index')->where('any', '.*');
});

Route::get('/data/analize','DataController@analize');
Route::get('/data/search_index','DataController@searchIndex');

Auth::routes();

