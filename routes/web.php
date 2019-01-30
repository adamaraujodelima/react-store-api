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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::group([
    'prefix' => 'admin'
], function(){
    Route::middleware('verified')->get('/', 'Admin\HomeController@index')->name('home');
    Route::middleware('verified')->get('/settings', 'SettingsController@index')->name('settings');

    Route::group([
        'prefix' => 'posts'
    ], function(){
        Route::middleware('verified')->get('/list', 'Admin\PostController@index')->name('admin-posts-list');
        Route::middleware('verified')->any('/new', 'Admin\PostController@new')->name('admin-posts-new');
        Route::middleware('verified')->any('/edit/{id}', 'Admin\PostController@update')->name('admin-posts-edit');
        Route::middleware('verified')->any('/remove/{id}', 'Admin\PostController@delete')->name('admin-posts-remove');    
    });

    Route::group([
        'prefix' => 'users'
    ], function(){
        Route::middleware('verified')->get('/list', 'Admin\UserController@index')->name('admin-users-list');
        Route::middleware('verified')->any('/new', 'Admin\UserController@new')->name('admin-users-new');
        Route::middleware('verified')->any('/edit/{id}', 'Admin\UserController@update')->name('admin-users-edit');
        Route::middleware('verified')->any('/remove/{id}', 'Admin\UserController@delete')->name('admin-users-remove');
    });

});

Route::group([
    'prefix' => 'user'
], function(){

    Route::group([
        'prefix' => 'posts'
    ], function(){
        Route::middleware('verified')->get('/list', 'User\PostController@index')->name('user-posts-list');
        Route::middleware('verified')->any('/new', 'User\PostController@new')->name('user-posts-new');
        Route::middleware('verified')->any('/edit/{id}', 'User\PostController@update')->name('user-posts-edit');
        Route::middleware('verified')->any('/remove/{id}', 'User\PostController@delete')->name('user-posts-remove');    
    });

    Route::group([
        'prefix' => 'users'
    ], function(){        
        Route::middleware('verified')->any('/profile', 'User\ProfileController@index')->name('user-profile');        
    });

});

Route::group([
    'prefix' => 'client'
], function(){
    Route::middleware('verified')->get('/authorize', 'Passport\CallbackController@authorizationCode')->name('authorize');
    Route::middleware('verified')->get('/callback', 'Passport\CallbackController@index')->name('callback');
    Route::middleware('verified')->post('/token-info', 'Passport\CallbackController@getToken')->name('getToken');
});

Route::get('/', 'HomeController@index')->name('home');
Route::get('/post/info/{id}', 'PostController@index')->name('post-info');

Auth::routes(['verify' => true]);