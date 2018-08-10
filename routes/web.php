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
   
Route::get('/', 'FreightController@index');

Route::get('/remove_sidebar', 'FreightController@remove_sidebar');

Route::get('/update_delivered', 'FreightController@update_delivered');

Route::get('/test', 'FreightController@test');