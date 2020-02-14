<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

Route::middleware('auth:api')->post('/user', function (Request $request) {
    return Auth::user();
});

Route::prefix('v1')->group(function(){
 Route::post('login', 'Api\AuthController@login');
 Route::post('register', 'Api\AuthController@register');
 Route::post('create', 'Api\PasswordResetController@create');
 Route::get('find/{token}', 'Api\PasswordResetController@find');
 Route::post('reset', 'Api\PasswordResetController@reset');
 Route::group(['middleware' => 'auth:api'], function(){
 Route::get('getUser', 'Api\AuthController@details');
 Route::post('logout', 'Api\AuthController@logout');
 });
});

// Route::group([
//     'namespace' => 'Auth',
//     'middleware' => 'api',
//     'prefix' => 'password'
// ], function () {
//     Route::post('create', 'Api\PasswordResetController@create');
//     Route::get('find/{token}', 'Api\PasswordResetController@find');
//     Route::post('reset', 'Api\PasswordResetController@reset');
// });
