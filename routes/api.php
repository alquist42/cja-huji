<?php


Route::post('/auth/token', 'Api\AuthController@getAccessToken');
Route::post('/auth/reset-password', 'Api\AuthController@passwordResetRequest');
Route::post('/auth/change-password', 'Api\AuthController@changePassword');


Route::group(['namespace' => 'Api'], function() {
    Route::get('/items', 'ItemsController@index');
    Route::get('/items/{item}', 'ItemsController@show');

    Route::get('/images', 'ImagesController@index');
    Route::get('/images/{image}', 'ImagesController@show');

    Route::get('/categories', 'CategoryController@index');
    Route::get('/communities', 'CommunityController@index');
    Route::get('/objects', 'ObjectController@index');
    Route::get('/subjects', 'SubjectController@index');
    Route::get('/origins', 'OriginController@index');
    Route::get('/collections', 'CollectionController@index');
    Route::get('/artists', 'ArtistController@index');
    Route::get('/locations', 'LocationController@index');
    Route::get('/schools', 'SchoolController@index');
    Route::get('/dates', 'DatesController@index');
    Route::get('/periods', 'PeriodController@index');

    Route::get('/autocomplete', 'AutocompleteController@autocomplete');
});


Route::group(['middleware' => 'auth:api', 'namespace' => 'Api'], function() {
    Route::get('/tags', 'ListingController@tags');
    Route::get('/categories', 'ListingController@categories');
    Route::get('/users', 'ListingController@users')->middleware('admin');

    Route::resource('/posts', 'PostController', ['only' => ['index', 'show']]);
});
