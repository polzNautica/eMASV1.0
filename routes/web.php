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

    Route::get('/password/reset', 'Auth\PasswordResetController@showPasswordResetForm')->name('password.reset');
    Route::post('/password/email', 'Auth\PasswordResetController@sendPasswordResetLinkEmail')->name('password.email');
    Route::get('/password/reset/{token}/{email}', 'Auth\PasswordResetController@showResetForm')->name('password.reset.token');
    Route::post('/password/reset', 'Auth\PasswordResetController@reset')->name('password.update');
    
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
        
    Route::group(['middleware' => ['auth']], function () {
        Route::get('profile', 'ProfileController@index')->name('profile.index');
        Route::put('profile/update', 'ProfileController@update')->name('profile.update');
    });

    Route::group(['middleware' => ['auth']], function () {
        Route::get('appointments/index', 'AppointmentController@index')->name('appointments.index');
        Route::get('appointments/create/{id}', 'AppointmentController@showForm')->name('appointments.create');
        Route::post('appointments/store/{id}', 'AppointmentController@store')->name('appointments.store');
        Route::get('appointments/sickness/{form_id}', 'AppointmentController@sicknessForm')->name('appointments.sicknessForm');
        Route::post('appointments/sicknessStore/{form_id}', 'AppointmentController@sicknessStore')->name('appointments.sicknessStore');
        Route::get('appointments/slot/{form_id}', 'AppointmentController@slotForm')->name('appointments.slotForm');
        Route::post('appointments/slotStore/{form_id}', 'AppointmentController@slotStore')->name('appointments.slotStore');
        Route::delete('/appointments/cancel-slot/{id}', 'AppointmentController@cancelSlot')->name('appointments.cancelSlot');
        Route::delete('/appointments/edit-slot/{id}', 'AppointmentController@editSlot')->name('appointments.editSlot');
        });


});
