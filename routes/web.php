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


use App\Models\Tenant;

Route::get('/', 'WelcomeController@index');

Route::group([
    'prefix' => 'staff',
    'as'     => 'staff.',
    'middleware' => 'auth'
], function () {
    Route::get('', 'AdminController@viewLinks');
    Route::get('/items', 'AdminController@items')->name('admin.items');
    Route::get('/items/{item}', 'AdminController@item')->name('admin.item');

    $controller = config('mediaManager.controller', '\ctf0\MediaManager\App\Controllers\MediaController');

    Route::group([
        'prefix' => 'media',
        'as'     => 'media.',
    ], function () use ($controller) {
        Route::get('/', ['uses' => 'AdminController@media', 'as' => 'index']);
        Route::post('upload', ['uses' => "$controller@upload", 'as' => 'upload']);
        Route::post('upload-cropped', ['uses' => "$controller@uploadEditedImage", 'as' => 'uploadCropped']);
        Route::post('upload-link', ['uses' => "$controller@uploadLink", 'as' => 'uploadLink']);

        Route::post('get-files', ['uses' => "$controller@getFiles", 'as' => 'get_files']);
        Route::post('create-new-folder', ['uses' => "$controller@createNewFolder", 'as' => 'new_folder']);
        Route::post('delete-file', ['uses' => "$controller@deleteItem", 'as' => 'delete_file']);
        Route::post('move-file', ['uses' => "$controller@moveItem", 'as' => 'move_file']);
        Route::post('rename-file', ['uses' => "$controller@renameItem", 'as' => 'rename_file']);
        Route::post('change-visibility', ['uses' => "$controller@changeItemVisibility", 'as' => 'change_vis']);
        Route::post('lock-file', ['uses' => "$controller@lockItem", 'as' => 'lock_file']);

        Route::get('global-search', ['uses' => "$controller@globalSearch", 'as' => 'global_search']);
        Route::post('get-locked-list', ['uses' => "$controller@getLockList", 'as' => 'locked_list']);

        Route::post('folder-download', ['uses' => "$controller@downloadFolder", 'as' => 'folder_download']);
        Route::post('files-download', ['uses' => "$controller@downloadFiles", 'as' => 'files_download']);
    });
});

Route::get('/images/{item}-{image}-{size}.png', 'ImagesController@view')->
        where('model', 's|i')->where('id', '[0-9]+')->where('size', 'original|thumb|small|medium');

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('logout', 'Auth\LoginController@logout');

// Registration Routes...
// Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
// Route::post('register', 'Auth\RegisterController@register');

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
Route::group([
    'as' => 'index',
    'prefix' => '{project}',
    'where' => [
        'project' => app()->make(Tenant::class)->allowed()
    ],
    'middleware' => 'project'
], function () {
    Route::get('/', 'HomeController@index');
    Route::get('/items', 'CatalogController@index');
    Route::get('/items/{item}', 'CatalogController@show');
    Route::get('/browse/{any}', 'BrowseController@index')->where('any', '.*');
});

Route::get('/data/analize', 'DataController@analize');
Route::get('/data/search_index', 'DataController@searchIndex');

Auth::routes();
