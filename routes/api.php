<?php


Route::group([
    'middleware' => 'api',
], function () {
    Route::post('login', 'Api\Auth\AuthController@login');
    Route::post('signup', 'Api\Auth\AuthController@signup');
    Route::post('logout', 'Api\Auth\AuthController@logout');
    Route::post('refresh', 'Api\Auth\AuthController@refresh');

    Route::get('auth', 'Api\Users\UsersController@authUser');
    Route::get('user/{id}', 'Api\Users\UsersController@userById');
    Route::get('users', 'Api\Users\UsersController@allUsers');
});