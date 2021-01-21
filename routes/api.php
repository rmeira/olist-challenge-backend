<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', '/swagger', 301);

Route::namespace('v1')->prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('login', 'LoginController@login')->name('auth.login');
        Route::middleware('auth:api')->group(function () {
            Route::post('logout', 'LoginController@logout')->name('auth.logout');
        });
    });

    Route::middleware('auth:api')->group(function () {
        Route::get('profile', 'ProfileController@index')->name('profile.index');
        Route::put('profile', 'ProfileController@update')->name('profile.update');

        Route::apiResource('users', 'UserController');
        Route::apiResource('products', 'ProductController');
        Route::apiResource('types', 'TypeController');
    });
});
