<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['namespace' => 'App\Http\Controllers'], function() {
    Route::post('/register', 'Api\RegisterController@perform')->name('api.register');
    Route::post('/login', 'Api\LoginController@perform')->name('api.login');

    Route::group(['middleware' => ['auth:api']], function () {

        Route::resource('blog', \App\Http\Controllers\Api\BlogPostController::class);
    });
});

