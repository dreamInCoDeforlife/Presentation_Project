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

Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');
Route::get('/services', 'PagesController@services');
Route::post('/dashboard','DashboardController@updateAvatar');
Route::resource('posts', 'PostsController');
Route::resource('dashboard', 'DashboardController');
Route::get('/spiral', 'SpiralController@index');
Auth::routes();
Route::get('/candle', 'HomeController@index');
Route::get('/dashboard', 'DashboardController@index');
Route::get('tests', 'MessageController@tests');
Route::get('message/{id}', 'MessageController@chatHistory')->name('message.read');
Route::group(['prefix'=>'ajax', 'as'=>'ajax::'], function() {
   Route::post('message/send', 'MessageController@ajaxSendMessage')->name('message.new');
   Route::delete('message/delete/{id}', 'MessageController@ajaxDeleteMessage')->name('message.delete');
});


/**
 *  Authentication routes
 */
