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

    // List all users, add / edit / delete user
    Route::group(['prefix' => 'users', 'as' => 'users'], function() {
        Route::get('/', 'AdminController@users');
        Route::get('/add', 'AdminController@addUserView');
        Route::post('/add', 'AdminController@addUser');
        Route::get('/edit/{UserID}', 'AdminController@editUserView');
        Route::post('/edit/{UserID}', 'AdminController@editUser');
        Route::get('/delete/{UserID}', 'AdminController@deleteUser');
    });

    // List all companies, add / edit company
    Route::group(['prefix' => 'companies', 'as' => 'companies'], function() {
        Route::get('/', 'AdminController@companies');
        Route::get('/add', 'AdminController@addCompanyView');
        Route::post('/add', 'AdminController@addCompany');
        Route::get('/edit/{ID}', 'AdminController@editCompanyView');
        Route::post('/edit/{ID}', 'AdminController@editCompany');
    });
});
