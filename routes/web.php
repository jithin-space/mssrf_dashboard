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


Route::resource('/','HomeController');
Route::get('/datapoints/count', 'DataPointController@countItems');
Route::get('/crops/count', 'CropController@countItems');
Route::get('/crops/itemsCount', 'CropController@itemsCount');
Route::get('/varieties/{id}/heat', 'VarietyController@heat')->name('varieties.heat');
Route::get('/varieties/{id}/grid', 'VarietyController@grid')->name('varieties.grid');
Route::get('/crops/{id}/units','CropController@getUnits')->name('crops.units');
Route::get('/varieties/{id}/units', 'VarietyController@unitByVariety')->name('varieties.unit');
Route::resource('/datapoints','DataPointController',['only'=>['index','show']]);
Route::resource('/crops','CropController',['only'=>['index','show']]);
Route::resource('/varieties','VarietyController',['only'=>['index','show']]);
Route::resource('/panchayaths','PanchayathController',['only'=>['index']]);

Route::resource('/units','UnitController',['only'=>['index','show']]);
