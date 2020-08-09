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

Route::group(['prefix' => 'posts'], function () {
    Route::get('', 'PostController@index')->name('post.index');
    Route::post('store', 'PostController@store')->name('post.store');
    Route::get('get/{id}', 'PostController@show')->name('post.show');
    Route::match(['put', 'patch'], 'update/{id}', 'PostController@update')->name('post.update');
    Route::delete('delete/{id}', 'PostController@delete')->name('post.delete');
});
