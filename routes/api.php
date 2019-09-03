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

Route::post('login', 'AuthController@login');
Route::post('register', 'AuthController@register');

Route::middleware(['auth:api','localization:api'])->group( function () {
Route::apiResource('tweets', 'TweetController');
Route::post('followuser', 'FollowUser@followUser');
Route::get('timeline', 'UserTimeline@index');
Route::get('/user', function (Request $request) {
    return $request->user();
});
});

