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
Route::view('/operator', 'acc_management.operator')->middleware('auth');
Route::view('/line_manager', 'acc_management.line_manager')->middleware('auth');

Route::view('/line_entry', 'line_management.line_entry')->middleware('auth');
Route::view('/line_detail', 'line_management.detail')->middleware('auth');
Route::view('/line_manager_detail', 'line_management.manager_detail')->middleware('auth');
Route::view('/line_setting', 'line_management.setting')->middleware('auth');

Route::view('/live_dash', 'target_line.live_dash')->middleware('auth');
Route::view('/line_history', 'target_line.line_history')->middleware('auth');
