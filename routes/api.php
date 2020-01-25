<?php

Route::post('/auth/token', 'Api\AuthController@getAccessToken');
Route::post('/auth/reset-password', 'Api\AuthController@passwordResetRequest');
Route::post('/auth/change-password', 'Api\AuthController@changePassword');

Route::group(['namespace' => 'Api'], function () {
	Route::group(['middleware' => 'project'], function () {
		Route::get('/items', 'ItemsController@index');
		Route::get('/items/{item}', 'ItemsController@show');

		//   Route::get('/images', 'ImagesController@index');
		//  Route::get('/images/{image}', 'ImagesController@show');

		Route::get('/taxonomy/{type}', 'TaxonomyController@index');
		Route::get('/taxonomy/{type}/{id}', 'TaxonomyController@show');
		Route::get('/autocomplete', 'TaxonomyController@search');
	});

	Route::group(['namespace' => 'MHS', 'prefix' => 'mhs'], function () {
		Route::group(['prefix' => 'map'], function () {
			Route::get('options', 'MapController@options');
			Route::post('markers', 'MapController@markers');
		});
	});
});
