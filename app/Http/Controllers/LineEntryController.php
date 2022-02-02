<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\ProductDetail;

class LineEntryController extends Controller
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
        $responseBody = DB::select('SELECT "line".l_id,"line".l_name,"line_assign".assign_id,"line_assign".main_target,"line_assign".s_time,"line_assign".e_time,"line_assign".lunch_s_time,"line_assign".lunch_e_time,"line_assign".assign_date,"time".time_id,"time".time_name,"time".status,"time".div_target,"p_detail".p_detail_id,"p_detail".p_cat_id,"p_detail".p_name,"p_detail".quantity,"users".id,"users".name,"time".actual_target_entry FROM line,line_assign,time,p_detail,users WHERE "line".l_id="line_assign".l_id AND "line_assign".l_id="time".line_id AND "time".line_id="p_detail".l_id AND "line_assign".user_id="users".id GROUP BY "time".time_id ORDER BY "time".time_id ASC');
        $p_detail = ProductDetail::orderBy('p_detail_id', 'asc')->get();
        DB::disconnect('musung');
        if ($responseBody == true) {
            return view('line_management.line_entry', compact('responseBody', 'p_detail'));
        }
    }
}
