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

Route::post('login','ApiAuthController@login');
Route::post('register','UserController@register');

Route::middleware('auth:api')->group(function () {
	
	Route::post('upload','PictureController@store');
	Route::post('update','UserController@update');
	Route::get('user','UserController@current');
	Route::post('logout','ApiAuthController@logout');
	Route::get('conversations','ConversationController@index');
	Route::post('conversations','ConversationController@store');
	Route::post('conversations/read','ConversationController@makConversationAsReaded');
	Route::post('messages','MessageController@store');
	Route::post('fcm','UserController@fcmToken');
	
});


