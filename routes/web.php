<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['namespace' => 'App\Http\Controllers'], function()
{   
    /**
     * Home Routes
     */
    Route::get('/', 'HomeController@index')->name('home.index');
    Route::get('/about', 'HomeController@about')->name('home.about');


    Route::group(['middleware' => ['guest']], function() {
        /**
         * Register Routes
         */
        Route::get('/register', 'RegisterController@show')->name('register.show');
        Route::post('/register', 'RegisterController@register')->name('register.perform');

        /**
         * Login Routes
         */
        Route::get('/login', 'LoginController@show')->name('login.show');
        Route::post('/login', 'LoginController@login')->name('login.perform');

    });

    Route::group(['middleware' => ['auth']], function() {
        /**
         * Logout Routes
         */
        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
    });


    Route::get('/password/reset', 'Auth\PasswordResetController@showPasswordResetForm')->name('password.reset');
    Route::post('/password/email', 'Auth\PasswordResetController@sendPasswordResetLinkEmail')->name('password.email');

    Route::group(['middleware' => ['auth']], function () {
        Route::get('profile', 'ProfileController@index')->name('profile.index');
        Route::put('profile/update', 'ProfileController@update')->name('profile.update');
    });

    Route::group(['middleware' => ['auth']], function () {
        Route::get('appointments/create', 'AppointmentController@showForm')->name('appointments.create');
        Route::post('appointments/store', 'AppointmentController@store')->name('appointments.store');
        });


});
