<?php

use Illuminate\Support\Facades\Route;

Route::post('/auth/token', 'Api\AuthController@getAccessToken');
Route::post('/auth/reset-password', 'Api\AuthController@passwordResetRequest');
Route::post('/auth/change-password', 'Api\AuthController@changePassword');

Route::group(['namespace' => 'Api'], function () {
    Route::group(['middleware' => 'project'], function () {
        Route::get('/items', 'ItemsController@index');
        Route::get('/items/browse', 'ItemsController@browse');
        Route::get('/items/search', 'ItemsController@search');
        Route::post('/items', 'ItemsController@store')->middleware('auth:api');
        Route::get('/items/{item}', 'ItemsController@show');
        Route::put('/items/{item}', 'ItemsController@update')->middleware('auth:api');
        Route::delete('/items/{item}', 'ItemsController@destroy')->middleware('auth:api');
        Route::get('/items/{item}/images', 'ItemImagesController@index');
        Route::put('/items/{item}/images', 'ItemImagesController@update')->middleware('auth:api');

        //   Route::get('/images', 'ImagesController@index');
        //  Route::get('/images/{image}', 'ImagesController@show');
        Route::post('/images/metadata', 'ImageMetadataController@store')->middleware('auth:api');

        Route::get('/taxonomy/{type}', 'TaxonomyController@index');
        Route::get('/taxonomy/{type}/{id}', 'TaxonomyController@show');
        Route::get('/autocomplete', 'TaxonomyController@search');

        Route::get('/properties', 'PropertiesController@index');
        Route::get('/categories', 'CategoriesController@index');
        Route::get('/dates', 'DatesController@index');
        Route::get('/copyrights', 'CopyrightsController@index');
        Route::get('/photographers', 'PhotographersController@index');
        Route::get('/projects', 'ProjectsController@index');
        Route::get('/artists', 'ArtistsController@index');
        Route::get('/professions', 'ProfessionsController@index');

        Route::get('/dashboard', 'DashboardController@index');
    });

    Route::group(['namespace' => 'MHS', 'prefix' => 'mhs'], function () {
        Route::group(['prefix' => 'map'], function () {
            Route::get('options', 'MapController@options');
            Route::post('markers', 'MapController@markers');
        });
    });
});
