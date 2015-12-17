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

Route::post('timelog/$2y$10$RmbwSQUSNhJpotMh9Z0/9ObnAJDnFvaYd9bfQDI8rGz8vDRgngLdq', 'TimelogController@create');
Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('/', 'ProjectController');

    Route::resource('project', 'ProjectController');
    Route::resource('shared-cost', 'SharedCostController');
    Route::resource('staff', 'StaffController');
    Route::resource('staff-rate', 'StaffRateController');
    Route::resource('revenue', 'RevenueController');
    Route::get('project/sync-with-jira/{id?}', 'ProjectController@syncWithJira');
    Route::get('logout', 'Auth\AuthController@getLogout');
    Route::get('report/project', 'ReportController@project');
    Route::get('report/monthly', 'ReportController@monthly');
    Route::get('report/time-sheet', 'ReportController@timesheet');
});

