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
        $user_id = request()->get('user_id');
        $time = request()->get('time_id');
        $line = request()->get('line_id');
        $target = request()->get('target');
        $actual = request()->get('actual');

        @$data_id = request()->get('data_id');
        $status = request()->get('status');
        if ($status == 1) {
            $sql = DB::update("UPDATE data SET actual_target=?,update_date=? WHERE data_id=?", [$actual, NOW(), $data_id]);
            return redirect('/line_entry?status=updated');
        } else {
            $sql = DB::insert("INSERT INTO data (user_id,time_id,line_id,target,actual_target,create_date) VALUES (?,?,?,?,?,?)", [$user_id, $time, $line, $target, $actual, NOW()]);
            $sql2 = DB::update("UPDATE time SET status=1 WHERE time_id=?", [$time]);
            if ($sql == true) {
                if ($sql2 == true) {
                    return redirect('/line_entry?status=created');
                }
            }
        }
    }
    public function putDataOne(Request $request)
    {
        $user_id = request()->get('user_id');
        $time = request()->get('time');
        $target = request()->get('target');
        $actual = request()->get('actual');

        return $time;

        // $sql = DB::insert("INSERT INTO employees (first_name,last_name,company,department, email,phone,address,created_at) VALUES (?,?,?,?,?,?,?,?)", [$first_name, $last_name, $company, $department, $email, $phone, $address, $date]);
        // DB::disconnect('company');
        // if ($sql == true) {
        //     return redirect('/employee?status=created');
        // }
    }
}
