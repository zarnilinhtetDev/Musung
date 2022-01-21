<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;

if (App::environment('production')) {
    URL::forceScheme('https');
}
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

Route::view('/', 'auth.login');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::view('/member', 'acc_management.member')->middleware('auth');

Route::get('/line_entry', 'DataController@index');
Route::post('/line_entry', 'DataController@postData')->name('line_entry_post');

Route::view('/line_detail', 'line_management.detail')->middleware('auth');
Route::view('/line_manager_detail', 'line_management.manager_detail')->middleware('auth');
Route::view('/line_setting', 'line_management.setting')->middleware('auth');

Route::view('/live_dash', 'target_line.live_dash')->middleware('auth');
Route::view('/line_history', 'target_line.line_history')->middleware('auth');


//// API Routes /////
Route::get('/api/data', 'DataApiController@getData');
Route::get('/api/data_status_zero', 'DataApiController@getDataStatusZero');
Route::post('/api/data', 'DataApiController@postData');
Route::put('/api/data', 'DataApiController@putData');


Route::get('/api/time', 'TimeApiController@getTime');
Route::post('/api/time', 'TimeApiController@postTime');
Route::put('/api/time', 'TimeApiController@putTime');
