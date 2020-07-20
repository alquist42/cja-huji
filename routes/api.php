<?php

use Illuminate\Support\Facades\Route;

Route::post('/auth/token', 'Api\AuthController@getAccessToken');
Route::post('/auth/reset-password', 'Api\AuthController@passwordResetRequest');
Route::post('/auth/change-password', 'Api\AuthController@changePassword');

Route::group(['namespace' => 'Api'], function () {
    Route::group(['middleware' => 'project'], function () {
        Route::get('/items', 'ItemsController@index');
        Route::get('/items/search', 'ItemsController@search');
        Route::post('/items', 'ItemsController@store');
        Route::get('/items/{item}', 'ItemsController@show');
        Route::put('/items/{item}', 'ItemsController@update');
        Route::delete('/items/{item}', 'ItemsController@destroy');
        Route::put('/items/{item}/images', 'ItemImagesController@update');

        //   Route::get('/images', 'ImagesController@index');
        //  Route::get('/images/{image}', 'ImagesController@show');
        Route::post('/images/metadata', 'ImageMetadataController@store');

        Route::get('/taxonomy/{type}', 'TaxonomyController@index');
        Route::get('/taxonomy/{type}/{id}', 'TaxonomyController@show');
        Route::get('/autocomplete', 'TaxonomyController@search');

        Route::get('/properties', 'PropertiesController@index');
        Route::get('/categories', 'CategoriesController@index');
        Route::get('/dates', 'DatesController@index');
        Route::get('/copyrights', 'CopyrightsController@index');
        Route::get('/photographers', 'PhotographersController@index');
        Route::get('/projects', 'ProjectsController@index');
    });

    Route::group(['namespace' => 'MHS', 'prefix' => 'mhs'], function () {
        Route::group(['prefix' => 'map'], function () {
            Route::get('options', 'MapController@options');
            Route::post('markers', 'MapController@markers');
        });
    });
});
