<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => 'customer'
], function(){    
    Route::middleware('auth:api')->post('register','Api\UserController@new');
    Route::middleware('auth:api')->put('edit','Api\UserController@update');
    Route::middleware('auth:api')->get('info','Api\UserController@index');
    Route::middleware('auth:api')->get('remove','Api\UserController@delete');
});

Route::group([
    'prefix' => 'products'
], function(){    
    Route::middleware('auth:api')->get('all','Api\ProductController@index');
    Route::middleware('auth:api')->get('info/{id}','Api\ProductController@info');
});

Route::group([
    'prefix' => 'manufacturer'
], function(){    
    Route::middleware('auth:api')->get('list','Api\Manufacturer\InfoController@list');
    Route::middleware('auth:api')->get('info/{id}','Api\Manufacturer\InfoController@info');
    Route::middleware('auth:api')->post('register','Api\Manufacturer\RegisterController@create');
    Route::middleware('auth:api')->put('edit/{id}','Api\Manufacturer\EditController@update');
    Route::middleware('auth:api')->delete('remove/{id}','Api\Manufacturer\RemoveController@delete');
});