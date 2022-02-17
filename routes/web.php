<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use App\Http\Livewire\LiveDash;

Route::view('/', 'auth.login')->name('login_1');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::get('/member', 'UserController@index');
Route::get('/member_post', 'UserController@postUser')->middleware('auth');
Route::get('/member_put', 'UserController@putUser')->middleware('auth');
Route::get('/member_delete/{id}', 'UserController@deleteUser')->middleware('auth');
Route::get('/member_undo/{id}', 'UserController@undoUser')->middleware('auth');

Route::get('/line_entry', 'LineEntryController@index');
Route::post('/line_entry_post', 'LineEntryController@postData');

Route::get('/line_detail', 'LineController@index')->middleware('auth');
Route::post('/line_detail_post', 'LineController@postLine')->middleware('auth');
Route::post('/line_detail_put', 'LineController@putLine')->middleware('auth');
Route::get('/line_detail_delete', 'LineController@softDelete')->middleware('auth');
Route::get('/line_detail_undo', 'LineController@undoLine')->middleware('auth');

Route::get('/line_setting', 'LineAssignController@index')->middleware('auth');

Route::post('/line_assign_post', 'LineAssignController@postLineSetting')->middleware('auth');
Route::post('/line_assign_overtime_post', 'LineAssignController@postLineOverTimeSetting')->middleware('auth');
Route::post('/create_category', 'LineAssignController@createCategory')->middleware('auth');

Route::get('/live_dash', 'LiveDashController@index')->middleware('auth');
Route::view('/line_history', 'target_line.line_history')->middleware('auth');

Route::get('/report', 'ReportDashController@index')->middleware('auth');


/// Theme Setting
Route::view('/theme_setting', 'theme_setting.theme_setting')->middleware('auth');

//// LiveWire /////
Route::get('/live_dash_1', [LiveDash::class, 'render'])->middleware('auth');

/// History
Route::post('/history', 'LineHistoryController@index')->middleware('cors');

//// API Routes /////

//// Line Entry ////
Route::get('/api/data', 'DataApiController@getData');
Route::get('/api/data_status_zero', 'DataApiController@getDataStatusZero');
Route::post('/api/data', 'DataApiController@postData');
Route::put('/api/data', 'DataApiController@putData');

/// Time ////
Route::get('/api/time', 'TimeApiController@getTime');
Route::post('/api/time', 'TimeApiController@postTime');
Route::put('/api/time', 'TimeApiController@putTime');

//// User ////
Route::get('/api/user', 'UserApiController@getUser');
Route::post('/api/user', 'UserApiController@postUser');
Route::put('/api/user', 'UserApiController@putUser');
Route::put('/api/user_delete', 'UserApiController@deleteUser');
Route::put('/api/user_undo', 'UserApiController@undoUser');

//// Line Detail ////
Route::get('/api/line', 'LineApiController@getLine');
Route::post('/api/line', 'LineApiController@postLine');
Route::put('/api/line', 'LineApiController@putLine');
Route::put('/api/line_delete', 'LineApiController@softDelete');
