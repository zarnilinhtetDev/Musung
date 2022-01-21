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
        $request = Request::create('/api/data', 'GET');
        $request2 = Request::create('/api/data_status_zero', 'GET');


        $response = Route::dispatch($request);
        $response2 = Route::dispatch($request2);

        $responseBody = $response->getContent();
        $responseBody2 = $response2->getContent();

        return view('line_management.line_entry', compact('responseBody', 'responseBody2'));
    }
    public function postData()
    {
        // $user_id = request()->get('user_id');
        // $time = request()->get('time_id');
        // $line = request()->get('line_id');
        // $target = request()->get('target');
        // $actual = request()->get('actual');
        // $status = request()->get('status');
        // $data_id = request()->get('data_id');

        // $status_one = request()->get('status_one');
        // $data_id_one = request()->get('data_id_one');
        // $target_one = request()->get('target_one');
        // $actual_one = request()->get('actual_one');
        // $time_id_one = request()->get('time_id_one');

        return redirect('www.google.com');
        // if ($status_one == 1) {
        //     $sql = DB::update("UPDATE data SET actual_target=?,update_date=? WHERE data_id=?", [$actual_one, NOW(), $data_id_one]);
        // }

        // if ($status_one == 2) {
        //     $sql_2 = DB::insert("INSERT INTO data (user_id,time_id,line_id,target,actual_target,create_date) VALUES (?,?,?,?,?,?)", [$user_id, $time, $line, $target, $actual, NOW()]);
        //     if ($sql_2 == false) {
        //         return redirect('/line_entry?status=error');
        //     }
        //     if ($sql_2 == true) {
        //         // $sql_2 = DB::update("UPDATE time SET time.status=0 WHERE time.time_id=$time_id_one");
        //         // if ($sql_2 == true) {
        //         //     $sql_3 = DB::update("UPDATE time SET time.status=1 WHERE time.time_id=$time");
        //         //     if ($sql_3 == true) {
        //         //         return redirect('/line_entry?status=created');
        //         //     }
        //         // }
        //     }
        // }

        // return "User ID = " . $user_id . "<br/>" . "Time = " . $time . "<br/>" . "Line ID = " . $line . "<br/>" . "Target = " . $target . "<br/>" . "Actual = " . $actual . "<br/>" . "Status_one = " . $status_one . "<br/>" . "Data_one" . $data_id_one . "<br/>" . "Target_one = " . $target_one . "<br/>" . "Actual_one = " . $actual_one . "<br/>" . "Time_id_one = " . $time_id_one . "<br/>";

        //
        // $sql2 = DB::update("UPDATE time SET status=1 WHERE time_id=?", [$time]);
        // if ($sql == true) {
        //     if ($sql2 == true) {
        //         return redirect('/line_entry?status=created');
        //     }
        // }
        // @$data_id = request()->get('data_id');
        // $status = request()->get('status');
        // if ($status == 1) {
        //     $sql = DB::update("UPDATE data SET actual_target=?,update_date=? WHERE data_id=?", [$actual, NOW(), $data_id]);
        //     return redirect('/line_entry?status=updated');
        // } else {

        // }
    }
}
