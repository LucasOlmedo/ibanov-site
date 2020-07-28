<?php

use Illuminate\Support\Facades\Route;

Route::get('', 'AdminController@index')->name('index');

/**
 * Users route
 */

Route::group(['prefix' => 'user'], function () {
    Route::get('', 'UserController@index')->name('user.index');
});
