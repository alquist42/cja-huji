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
Route::get('/images/{image}', 'ImagesController@index');

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('logout', 'Auth\LoginController@logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::group(['middleware' => ['project']], function () {
    Route::get('/{project}', 'HomeController@index');
    Route::get('/{project}/items', 'CatalogController@index');
    Route::get('/{project}/items/{item}', 'CatalogController@show');
    Route::get('/{project}/images/{item}', 'CatalogController@showItem');
});


/* Vue.js SPA */
Route::get('/{project}/browse/{any?}/{other?}', function ($project) {
    return view('browse', [ 'project' => $project]);
});
Route::get('/data/analize','DataController@analize');
Route::get('/data/search_index','DataController@searchIndex');




Auth::routes();

