<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

class DataController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware(function ($request, $next) {
            $this->user = Auth::user(); // here the user should exist from the session
            return $next($request);
        });
    }
    public function index()
    {
        $request = Request::create('https://musung-production.herokuapp.com/api/data', 'GET');
        $request2 = Request::create('https://musung-production.herokuapp.com/api/data_status_zero', 'GET');


        $response = Route::dispatch($request);
        $response2 = Route::dispatch($request2);

        $responseBody = $response->getContent();
        $responseBody2 = $response2->getContent();

        return view('line_management.line_entry', compact('responseBody', 'responseBody2'));
    }
    public function postData()
    {
        $user_id = request()->get('user_id');
        $time = request()->get('time_id');
        $line = request()->get('line_id');
        $target = request()->get('target');
        $actual = request()->get('actual');
        $status = request()->get('status');
        $data_id = request()->get('data_id');

        $status_one = request()->get('status_one');
        $data_id_one = request()->get('data_id_one');
        $target_one = request()->get('target_one');
        $actual_one = request()->get('actual_one');
        $time_id_one = request()->get('time_id_one');

        $add_time = request()->get('add_time');


        if ($actual != "") {
            $sql_time = DB::insert('INSERT INTO time (time_name,status) VALUES(?,2)', [$add_time]);

            if ($sql_time == true) {
                $sql = DB::selectOne("SELECT time_id FROM time WHERE time_name='$add_time' AND status=2");
                $time_id = $sql->time_id;
                if ($status_one == 1) {
                    $sql_5 = DB::update("UPDATE data SET actual_target=?,update_date=? WHERE data_id=?", [$actual_one, NOW(), $data_id_one]);
                }
                if ($status == 2) {
                    $sql_2 = DB::insert("INSERT INTO data (user_id,time_id,line_id,target,actual_target,create_date) VALUES (?,?,?,?,?,?)", [$user_id, $time_id, $line, $target, $actual, NOW()]);
                    if ($sql_2 == true) {

                        $sql_temp = DB::update("UPDATE data SET actual_target=? WHERE data_id=?", [$actual, $data_id]);

                        $sql_3 = DB::update("UPDATE time SET time.status=0 WHERE time.time_id=$time_id_one");
                        if ($sql_3 == true) {
                            $sql_4 = DB::update("UPDATE time SET time.status=1 WHERE time.time_id=$time");
                            if ($sql_4 == true) {
                                return redirect('/line_entry?status=created');
                            }
                        }
                    }
                }
            }
        }
        if ($actual == "") {
            $sql_5 = DB::update("UPDATE data SET actual_target=?,update_date=? WHERE data_id=?", [$actual_one, NOW(), $data_id_one]);
            return redirect('/line_entry?status=updated');
        }
    }
}
