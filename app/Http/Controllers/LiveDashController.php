<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Charts\LiveDashPercentChart;

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
    public function index(LiveDashPercentChart $percent_chart)
    {
        $date_string = date("d.m.Y");
        $u_id = Auth::user()->id;

        $responseBody = DB::select('SELECT "line".l_id,"line".l_name,"line_assign".assign_id,"line_assign".main_target,
        "line_assign".s_time,"line_assign".e_time,"line_assign".lunch_s_time,"line_assign".lunch_e_time,
        "line_assign".assign_date,"time".time_id,"time".time_name,"time".status,"time".div_target,
        "time".actual_target_entry,"time".div_actual_target,"time".div_actual_percent
                FROM line
                JOIN line_assign ON "line_assign".l_id = "line".l_id AND "line_assign".assign_date=\'' . $date_string . '\'
                JOIN time ON "time".line_id = "line_assign".l_id WHERE "line".is_delete = 0 ORDER BY "time".time_id ASC');

        $p_detail = DB::select('SELECT "p_detail".p_detail_id,"p_detail".assign_id,"p_detail".l_id,"p_detail".p_cat_id,"p_detail".p_name,"p_detail".quantity FROM p_detail,line_assign WHERE "p_detail".assign_id="line_assign".assign_id AND "line_assign".assign_date=\'' . $date_string . '\' ORDER BY "p_detail".p_detail_id ASC');

        $line = DB::select('SELECT "line".l_id,"line".l_name FROM line,line_assign WHERE "line".a_status=1 AND "line".is_delete=0 AND "line".l_id="line_assign".l_id AND "line_assign".assign_date=\'' . $date_string . '\' ORDER BY "line".l_pos ASC');

        $time = DB::select('SELECT time_name FROM time
        JOIN line_assign ON "time".assign_id="line_assign".assign_id AND
        "line_assign".assign_date=\'' . $date_string . '\' GROUP BY time_name ORDER BY time_name ASC');

        $time_2 = DB::select('SELECT "time".time_id,"time".time_name,"time".line_id,"time".assign_id,"time".status,"time".div_target,"time".div_actual_target,"time".div_actual_percent,"time".actual_target_entry FROM time,line_assign WHERE "time".assign_id="line_assign".assign_id AND "line_assign".assign_date=\'' . $date_string . '\' ORDER BY "time".time_id ASC');

        $getLine = DB::select('SELECT "line".l_id,"line".l_name,"line_assign".assign_id,"line_assign".main_target,"line_assign".s_time,"line_assign".e_time,"line_assign".lunch_s_time,"line_assign".lunch_e_time,"line_assign".assign_date,"users".id,"users".name
        FROM line
        JOIN line_assign ON "line_assign".l_id = "line".l_id
        JOIN users ON "users".id= "line_assign".user_id
        WHERE "line".a_status=1 AND "line_assign".assign_date=\'' . $date_string . '\' ORDER BY "line".l_pos ASC');

        $top_line = DB::select('SELECT line.l_name,line_assign.main_target AS main_target,SUM(time.div_actual_target) AS total_actual,
        concat((SUM(time.div_actual_target)*100/line_assign.main_target), \'%\') AS diff_target_percent
        FROM line
        INNER JOIN line_assign ON line_assign.l_id=line.l_id AND "line_assign".assign_date=\'' . $date_string . '\'
        Inner JOIN time ON time.line_id=line_assign.l_id
        GROUP BY line.l_name,line_assign.main_target
        ORDER BY diff_target_percent DESC
        LIMIT 3');

        DB::disconnect('musung');

        return view(
            'target_line.live_dash',
            compact('responseBody', 'p_detail', 'line', 'getLine', 'time', 'time_2', 'top_line'),
            ['percent_chart' => $percent_chart->build()]
        );
    }
}
