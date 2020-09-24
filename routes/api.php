<?php


Route::group([
    'middleware' => 'api',
], function () {
    Route::post('login', 'Api\Auth\AuthController@login');
    Route::post('signup', 'Api\Auth\AuthController@signup');
    Route::post('logout', 'Api\Auth\AuthController@logout');
    Route::post('refresh', 'Api\Auth\AuthController@refresh');

    Route::get('auth', 'Api\Users\UsersController@authUser') -> middleware('authenticate_user');
    Route::get('user/{id}', 'Api\Users\UsersController@userById') -> middleware('authenticate_user');
    Route::get('users', 'Api\Users\UsersController@allUsers') -> middleware('authenticate_user');
});