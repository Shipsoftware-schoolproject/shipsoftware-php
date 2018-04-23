<?php

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

Auth::routes();

Route::get('/', 'ViewsController@index');

Route::get('/ship/{id}', 'ViewsController@ship');

// Admin routes
Route::group(['middleware' => 'role:admin', 'prefix' => 'admin'], function() {
    // List all ships, add / edit ship
    Route::get('/', 'AdminController@ships')->name('ships');
    Route::get('/ships', 'AdminController@ships')->name('ships');

    // List all users, add / edit user
    Route::get('/users', 'AdminController@users')->name('users');
    Route::get('/users/add', 'AdminController@addUserView')->name('users');
    Route::post('/users/add', 'AdminController@addUser');
});
