<?php

namespace App\Http\Controllers;

// namespace App\Http\Livewire;

use Livewire\Component;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\Line;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class OnepaperController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');

    //     $this->middleware(function ($request, $next) {
    //         $this->user = Auth::user(); // here the user should exist from the session
    //         return $next($request);
    //     });
    // }
    public function __construct()
    {
    ini_set('max_execution_time', 300);
    }

    public function index($id)
    // public function index($id, $assign_id, $date)
    {
        $line_id = $id;
        // $line_date = $date;
        // $date_string = $date;
        // $line_assign_id = $assign_id;

        // $date_string = date($date);

        $date_string = date("d.m.Y");

        // $u_id = Auth::user()->id;

        $time = DB::select('SELECT time_name FROM time
        JOIN line_assign ON "time".assign_id="line_assign".assign_id AND
        "line_assign".assign_date=\'' . $date_string . '\' GROUP BY time_name ORDER BY time_name DESC OFFSET 1');

        $time_2 = DB::select('SELECT  "time".time_id,"time".time_name,"time".line_id,"time".assign_id,"time".status,"time".div_target,"time".div_actual_target,"time".div_actual_percent,"time".actual_target_entry FROM time,line_assign WHERE "time".assign_id="line_assign".assign_id AND "line_assign".assign_date=\'' . $date_string . '\'
        ORDER BY "time".time_id ASC');

        $target_total = DB::select('SELECT "time".line_id,"time".assign_id,SUM("time".actual_target_entry) AS total
        FROM time,line_assign WHERE "time".assign_id="line_assign".assign_id
        AND "line_assign".assign_date=\'' . $date_string . '\' GROUP BY "time".assign_id,"time".line_id');

        $actual_target_total = DB::select('SELECT "time".line_id,"time".assign_id,SUM("time".actual_target_entry) AS total_div_target,SUM("time".div_actual_target) AS total_actual_target
        FROM time,line_assign WHERE "time".assign_id="line_assign".assign_id AND "line_assign".assign_date=\'' . $date_string . '\' AND "time".div_actual_target IS NOT NULL
        GROUP BY "time".line_id,"time".assign_id');

        $getLine = DB::select('SELECT "line".l_id,"line".l_name,"line_assign".assign_id,"line_assign".main_target,"line_assign".ot_main_target,"line_assign".m_power,"line_assign".actual_m_power,
        "line_assign".hp,"line_assign".actual_hp,"line_assign".s_time,"line_assign".e_time,"line_assign".lunch_s_time,"line_assign".lunch_e_time,
        "line_assign".assign_date,"users".id,"users".name
                FROM line
                JOIN line_assign ON "line_assign".l_id = "line".l_id
                JOIN users ON "users".id= "line_assign".user_id
                JOIN time ON "time".line_id="line".l_id
                WHERE "line".a_status=1 AND "line_assign".assign_date=\'' . $date_string . '\'
                AND "time".assign_date=\'' . $date_string . '\'
                GROUP BY "line".l_id,"line_assign".assign_id,"users".id
                ORDER BY "line".l_pos ASC');


        $total_inline = DB::select('SELECT "p_detail".l_id,SUM("p_detail".inline) AS total_inline
        FROM p_detail
        JOIN line_assign ON "line_assign".assign_id="p_detail".assign_id AND "line_assign".l_id="p_detail".l_id
        AND "line_assign".assign_date=\'' . $date_string . '\'
        GROUP BY "p_detail".l_id');

        $p_detail_2 = DB::select('SELECT "p_detail".p_detail_id,"p_detail".l_id,"p_detail".p_name,"p_detail".style_no
        FROM p_detail
        JOIN line_assign ON "line_assign".assign_id="p_detail".assign_id AND "p_detail".l_id="line_assign".l_id AND "line_assign".assign_date=\'' . $date_string . '\'
        ORDER BY "p_detail".p_detail_id ASC');

        $p_detail_3 = DB::select('SELECT DISTINCT "p_detail".l_id,"p_detail".p_name
        FROM p_detail
        JOIN line_assign ON "line_assign".assign_id="p_detail".assign_id AND "p_detail".l_id="line_assign".l_id AND "line_assign".assign_date=\'' . $date_string . '\'
        ');

        $total_main_target = DB::select('SELECT SUM("line_assign".main_target) AS t_main_target, SUM("line_assign".ot_main_target) AS ot_main_target FROM line_assign WHERE "line_assign".assign_date=\'' . $date_string . '\'');

        $total_div_target = DB::select('SELECT ROW_NUMBER() OVER(ORDER BY "time".time_name ASC) AS row_num_1,SUM("time".actual_target_entry) AS t_div_target,"time".time_name FROM time WHERE "time".assign_date=\'' . $date_string . '\' AND NOT "time".time_name=\'temp\'
        GROUP BY "time".time_name ORDER BY "time".time_name ASC');

        $total_div_actual_target = DB::select('SELECT ROW_NUMBER() OVER(ORDER BY "time".time_name ASC) AS row_num,SUM("time".div_actual_target) AS t_div_actual_target_1,"time".time_name FROM time WHERE "time".assign_date=\'' . $date_string . '\'
        GROUP BY "time".time_name ORDER BY "time".time_name ASC');

        $total_overall_target = DB::select('SELECT SUM("time".actual_target_entry) AS t_overall_target
        FROM time WHERE "time".assign_date=\'' . $date_string . '\' AND "time".div_actual_target IS NOT NULL');

        $total_overall_actual_target = DB::select('SELECT SUM("time".div_actual_target) AS t_overall_actual_target
        FROM time WHERE "time".assign_date=\'' . $date_string . '\'');

        //// Total Percent Accumulation
        $total_percent_accumulation = DB::select('SELECT DISTINCT "time".time_name,
        SUM("time".actual_target_entry) over (ORDER BY "time".time_name) AS t_div_target,
        SUM("time".div_actual_target) over (ORDER BY "time".time_name) AS t_div_actual_target
        FROM time WHERE "time".assign_date=\'' . $date_string . '\' AND NOT "time".time_name=\'temp\' AND "time".div_actual_target IS NOT NULL
        GROUP BY "time".time_name,"time".actual_target_entry,"time".div_actual_target,"time".assign_date ORDER BY "time".time_name ASC');
        //// Total Percent Accumulation End

        $top_line = DB::select('SELECT line.l_id,line.l_name,line_assign.main_target AS main_target,SUM(time.div_actual_target) AS total_actual,
        ROUND((SUM(time.div_actual_target)*100/line_assign.main_target),0) AS diff_target_percent,
        ROW_NUMBER() OVER(ORDER BY  ROUND((SUM(time.div_actual_target)*100/line_assign.main_target),0) DESC) AS row_num
        FROM line
        INNER JOIN line_assign ON line_assign.l_id=line.l_id AND "line_assign".assign_date=\'' . $date_string . '\'
        Inner JOIN time ON time.line_id=line_assign.l_id AND time.assign_date=\'' . $date_string . '\'
        WHERE "time".div_actual_target IS NOT NULL
        GROUP BY line.l_id,line.l_name,line_assign.main_target
        ORDER BY diff_target_percent DESC');

        $time_name_list = DB::select('SELECT DISTINCT time_name FROM time WHERE "time".assign_date=\'' . $date_string . '\' AND NOT "time".time_name=\'temp\' ORDER BY time_name ASC');

        DB::disconnect('musung');

        return view('onepaper', compact(
            'line_id',
            // 'line_assign_id',
            // 'line_date',

            'getLine',
            'time',
            'time_2',
            'total_main_target',
            'total_div_target',
            'total_div_actual_target',
            'target_total',
            'actual_target_total',
            'total_overall_target',
            'total_overall_actual_target',
            'total_inline',
            'p_detail_2',
            'time_name_list',
            'p_detail_3',
            'total_percent_accumulation',
            'top_line'
        ));
    }
}
