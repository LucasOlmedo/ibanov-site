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

Route::group(['prefix' => 'post'], function () {
    Route::get('', 'PostController@index')->name('post.index');
    Route::get('create', 'PostController@create')->name('post.create');
    Route::post('store', 'PostController@store')->name('post.store');
    Route::get('get/{id}', 'PostController@show')->name('post.show');
    Route::get('edit/{id}', 'PostController@edit')->name('post.edit');
    Route::match(['put', 'patch', 'post'], 'update/{id}', 'PostController@update')
        ->name('post.update');
    Route::delete('delete/{id}', 'PostController@delete')->name('post.delete');
});

Route::group(['prefix' => 'event'], function () {
    Route::get('', 'EventController@index')->name('event.index');
    Route::get('get-data', 'EventController@getData')->name('event.get-data');
    Route::post('store', 'EventController@store')->name('event.store');
});
