<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', 'WelcomeController@index')->name('welcome');

Auth::routes();




Route::get('/{id}/index', 'ConditionController@conditions')->name('index');
Route::get('/{id}/myPage', 'ConditionController@myPage')->name('myPage');
Route::get('/{id}/closeAccount', 'CloseAccountController@account')->name('closeAccount');
Route::post('/{id}/closeAccount', 'CloseAccountController@delete');
Route::get('/{id}/todaysCondition', 'ConditionController@showTodaysCondition')->name('todaysCondition');
Route::post('/{id}/todaysCondition', 'ConditionController@record');
Route::get('/{id}/calendar', 'CalendarController@show')->name('calendar');
Route::get('/{id}/index/{condition_id}/edit', 'ConditionController@showEdit')->name('edit');
Route::post('/{id}/index/{condition_id}/edit', 'ConditionController@edit');
Route::delete('/{id}/index/{condition_id}/delete', 'ConditionController@delete')->name('delete');