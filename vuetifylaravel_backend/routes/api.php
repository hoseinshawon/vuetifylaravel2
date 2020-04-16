<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(["middleware" => "auth:api"], function(){
    Route::get('/user', 'Api\UsersController@user')->name('api.user');
    Route::resource('roles', 'Api\RoleController');
});


Route::post('/login', 'Api\AuthController@login')->name('api.login');

Route::post('/register', 'Api\AuthController@register')->name('api.register');

Route::post('/forgot-password', 'Api\ForgotPasswordController@sendResetLinkEmail')->name('api.forgot-password');

Route::post('/reset-password', 'Api\ResetPasswordController@reset')->name('api.reset-password');