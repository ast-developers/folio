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
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');

Route::get('auth/google', 'Auth\AuthController@googleredirectToProvider');
Route::get('auth/google/callback', 'Auth\AuthController@googlehandleProviderCallback');

Route::group(['middleware' => 'auth'], function () {
    Route::get('sync-with-jira/{id?}', 'ProjectController@syncWithJira');
    Route::get('ems', 'EmsController@index');
    Route::post('filter', 'FilterController@dateFilter');

    Route::post('update-role', 'RoleManagementController@updateRole');
    Route::post('assign', 'ProjectManagementController@assign');

    Route::resource('/', 'ReportController@project');

    Route::resource('project', 'ProjectController');

    Route::match(['get', 'post'], 'shared-cost/copy', ['as' => 'shared-cost.copy', 'uses' =>'SharedCostController@copy']);

    Route::resource('shared-cost', 'SharedCostController');
    Route::resource('staff', 'StaffController');
    Route::resource('staff-rate', 'StaffRateController');
    Route::resource('revenue', 'RevenueController');
    
    Route::get('logout', 'Auth\AuthController@getLogout');
    Route::get('report/project', 'ReportController@projectMonthly');
    Route::get('report/monthly', 'ReportController@monthly');

    Route::get('assign/roles', 'RoleManagementController@getRoles');
    Route::get('assign/project', 'ProjectManagementController@getProject');

    Route::get('report/time-sheet', 'ReportController@timesheet');
});

