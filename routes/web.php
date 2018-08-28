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

// AUTH ROUTES
Route::get('/', 'Auth\MyLoginController@showLogin');
Route::get('login', 'Auth\MyLoginController@showLogin')->name('login');
Route::post('login', 'Auth\MyLoginController@login');
Route::post('logout', 'Auth\MyLoginController@logout')->name('logout');
Route::get('logout', 'Auth\MyLoginController@showLogin');
Route::get('password/reset', 'Auth\MyForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\MyForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\MyResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\MyResetPasswordController@reset');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin::'], function () {
    Route::get('/', 'HomeController@index')->name('dashboard');
});

//USER ROUTES
Route::group(['prefix' => 'users', 'as' => 'users::'], function(){
    Route::get('/', 'UsersController@index')->name('index');
    Route::get('create', 'UsersController@create')->name('create');
    Route::post('/', 'UsersController@store')->name('store');
    Route::get('{id}/edit', 'UsersController@edit')->name('edit')->where('id', '[0-9]+');
    Route::patch('{id}', 'UsersController@update')->name('update')->where('id', '[0-9]+');
    Route::get('{id}/delete', 'UsersController@delete')->name('delete')->where('id', '[0-9]+');
    Route::delete('{id}', 'UsersController@destroy')->name('destroy')->where('id', '[0-9]+');
});

// SIDEBAR TOGGLE ROUTE
Route::middleware(['auth'])->post('toggleSidebar', function () {
    (session('collapseSidebar')) ? (session(['collapseSidebar' => 0])) : (session(['collapseSidebar' => 1]));
    return 'collapseSidebar = ' . session('collapseSidebar');
})->name('toggleSidebar');