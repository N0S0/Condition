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


Route::get('/', function () {
  return view('welcome');
});

Auth::routes();


// Route::get('/home', 'ConditionController@conditions');

Route::get('/{id}/index', function(){
  return view('conditions/index')->name('index');
});

Route::get('/{id}/myPage', function(){
  return view('conditions/myPage')->name('myPage');
});

Route::get('/{id}/index', 'ConditionController@conditions')->name('index');
Route::get('/{id}/myPage','ConditionController@myPage')->name('myPage');
Route::get('/{id}/todaysCondition','ConditionController@todaysCondition')->name('todaysCondition');
Route::post('/{id}/todaysCondition','ConditionController@record');
Route::get('/{id}/todaysCondition/edit','ConditionController@conditions')->name('todaysCondition.edit');

