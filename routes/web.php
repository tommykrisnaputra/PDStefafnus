<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\EventsController;

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

Route::group(['namespace' => 'App\Http\Controllers'], function () {
    /**
     * Home Routes
     */
    Route::get('/', 'HomeController@index')->name('index');
    Route::get('/success', 'HomeController@success')->name('success');

    /**
     * Register Routes
     */
    Route::get('/register', 'RegisterController@show')->name('register.show');
    Route::post('/register', 'RegisterController@register')->name('register.perform');

    Route::group(['middleware' => ['guest']], function () {
        /**
         * Login Routes
         */
        Route::get('/login', 'LoginController@show')->name('login.show');
        Route::post('/login', 'LoginController@login')->name('login.perform');
    });

    Route::group(['middleware' => ['auth']], function () {
        /**
         * Logout Routes
         */
        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
    });

    Route::group(['middleware' => ['isAdmin', 'NullToBlank']], function () {
        /**
         * Users Routes
         */
        Route::get('/users', [UsersController::class, 'index'])->name('users.show');
        Route::get('/users/edit/{id}', [UsersController::class, 'edit']);
        Route::post('/users/update/{id}', [UsersController::class, 'update']);
        Route::post('/users/search', [UsersController::class, 'search'])->name('users.search');

        /**
         * Events Routes
         */
        Route::get('/events', [EventsController::class, 'index'])->name('events.show');
        Route::get('/events/add', [EventsController::class, 'add'])->name('events.add');
        Route::post('/events/create', [EventsController::class, 'create'])->name('events.create');
        Route::get('/events/edit/{id}', [EventsController::class, 'edit'])->name('events.edit');
        Route::post('/events/update/{id}', [EventsController::class, 'update'])->name('events.update');
        Route::post('/events/search', [EventsController::class, 'search'])->name('events.search');
    });

    /**
     * 404 Routes
     */
    Route::any('{query}', function () {
        return redirect('/');
    })->where('query', '.*');
});
