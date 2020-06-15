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

Auth::routes();

Route::get('/', 'MainController@index')->name('main');
Route::get('/search', 'MainController@search')->name('main');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/realtyCharacteristics', 'CharacteristicsController@realtyCharacteristics')->name('realtyCharacteristics');
Route::get('/getRealtyCharacteristicsFromApi', 'CharacteristicsController@getRealtyCharacteristicsFromApi')->name('getRealtyCharacteristicsFromApi');
Route::get('/getCategories', 'CategoryController@getCategories')->name('getCategories');
Route::get('/getRealtyTypes', 'RealtyTypesController@getRealtyTypes')->name('getRealtyTypes');
Route::get('/getOperationTypes', 'OperationTypesController@getOperationTypes')->name('getOperationTypes');

Route::get('/getRegionsFromApi', 'RegionsController@getRegionsFromApi')->name('getRegionsFromApi');


Route::get('/testCron', 'MainController@testCron')->name('testCron');
Route::get('/testCron2', 'MainController@testCron2')->name('testCron2');
Route::get('/testCron3', 'MainController@testCron3')->name('testCron3');
Route::get('/testEcho', 'MainController@testEcho')->name('testEcho');

Route::get('/testBot', 'SubscribeController@index')->name('testBot');
Route::get('/sendMessage', 'SubscribeController@sendMessage')->name('sendMessage');
Route::get('/getSubscribeLink', 'SubscribeController@getSubscribeLink')->name('getSubscribeLink');


Route::get('orders/{page?}', 'OrdersController@ordersList')->name('orders')->where(['page' => '[0-9]+']);
