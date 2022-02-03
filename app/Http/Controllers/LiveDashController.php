<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\ProductDetail;
use App\Models\Line;
use App\Models\Time;

class LiveDashController extends Controller
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
        $u_id = Auth::user()->id;
        $responseBody = DB::select('SELECT line.l_id,line.l_name,line_assign.assign_id,line_assign.main_target,line_assign.s_time,line_assign.e_time,line_assign.lunch_s_time,line_assign.lunch_e_time,line_assign.assign_date,time.time_id,time.time_name,time.status,time.div_target,time.actual_target_entry,time.div_actual_target,time.div_actual_percent
        FROM line
        JOIN line_assign ON line_assign.l_id = line.l_id
        JOIN time ON time.line_id = line_assign.l_id
               ORDER BY time.time_id ASC');
        $p_detail = ProductDetail::select(
            'p_detail_id',
            'assign_id',
            'l_id',
            'p_cat_id',
            'p_name',
            'quantity'
        )->orderBy('p_detail_id', 'asc')->get();
        $line = Line::where('a_status', 1)->orderBy('l_pos', 'asc')->get();
        $time = Time::select('time_name')->groupBy('time_name')->get();
        $getLine = DB::select('SELECT line.l_id,line.l_name,line_assign.assign_id,line_assign.main_target,line_assign.s_time,line_assign.e_time,line_assign.lunch_s_time,line_assign.lunch_e_time,line_assign.assign_date,users.id,users.name
        FROM line
        JOIN line_assign ON line_assign.l_id = line.l_id
        JOIN users ON users.id= line_assign.user_id
        WHERE line.a_status=1');
        DB::disconnect('musung');

        return view('target_line.live_dash', compact('responseBody', 'p_detail', 'line', 'getLine', 'time'));
    }
}
