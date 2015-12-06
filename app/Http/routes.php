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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('project', 'ProjectController');
Route::resource('shared-cost', 'SharedCostController');
Route::resource('staff', 'StaffController');
Route::resource('staff-rate', 'StaffRateController');
Route::resource('revenue', 'RevenueController');
Route::get('project/sync-with-jira/{id}', 'ProjectController@syncWithJira');
