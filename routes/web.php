<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['namespace' => 'App\Http\Controllers'], function()
{
    /**
     * Home Routes
     */
    Route::get('/', 'Web\HomeController@index')->name('home.index');

    Route::group(['middleware' => ['guest']], function() {
        /**
         * Register Routes
         */
        Route::get('/register', 'Web\RegisterController@show')->name('register.show');
        Route::post('/register', 'Web\RegisterController@register')->name('register.perform');

        /**
         * Login Routes
         */
        Route::get('/login', 'Web\LoginController@show')->name('login.show');
        Route::post('/login', 'Web\LoginController@login')->name('login.perform');

    });

    Route::group(['middleware' => ['auth']], function() {
        /**
         * Logout Routes
         */
        Route::get('/logout', 'Web\LogoutController@perform')->name('logout.perform');

        Route::resource('blog', \App\Http\Controllers\Web\BlogPostController::class);
    });
});
