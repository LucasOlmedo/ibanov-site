<?php

use Illuminate\Support\Facades\Route;

Route::get('', 'AdminController@index')->name('index');

/**
 * Users route
 */

Route::group(['prefix' => 'user'], function () {
    Route::get('', 'UserController@index')->name('user.index');
    Route::post('store', 'UserController@store')->name('user.store');
    Route::get('get/{id}', 'UserController@show')->name('user.show');
    Route::match(['put', 'patch'], 'update/{id}', 'UserController@update')->name('user.update');
    Route::delete('delete/{id}', 'UserController@delete')->name('user.delete');
});
