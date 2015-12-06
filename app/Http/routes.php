<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::post('timelog/$2y$10$RmbwSQUSNhJpotMh9Z0/9ObnAJDnFvaYd9bfQDI8rGz8vDRgngLdq', 'TimelogController@create');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function() {
        return view('welcome');
    });
    Route::resource('project', 'ProjectController');
    Route::resource('shared-cost', 'SharedCostController');
    Route::resource('staff', 'StaffController');
    Route::resource('staff-rate', 'StaffRateController');
    Route::resource('revenue', 'RevenueController');
    Route::get('project/sync-with-jira/{id}', 'ProjectController@syncWithJira');
    Route::get('auth/logout', 'Auth\AuthController@getLogout');
});
