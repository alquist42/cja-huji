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

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('logout', 'Auth\LoginController@logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
//Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
//Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
//Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
//Route::post('password/reset', 'Auth\ResetPasswordController@reset');

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

Route::get('mhs/{page?}', 'MHSController')->where('page', 'acknowledgments|approach|contact|links|map');

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

