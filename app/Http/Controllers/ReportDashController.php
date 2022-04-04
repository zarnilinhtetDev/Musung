<?php

namespace App\Http\Controllers;

use App\Charts\ReportDashAreaChart;
use App\Charts\ReportDashCategoryChart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\ProductDetail;

class ReportDashController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware(function ($request, $next) {
            $this->user = Auth::user(); // here the user should exist from the session
            return $next($request);
        });
    }
    public function index(ReportDashAreaChart $chart, ReportDashCategoryChart $category_chart)
    {
        $date_string = date("d.m.Y");

        $daily_report = DB::select('SELECT "line".l_id,"line".l_name,"line_assign".main_target,"line_assign".m_power,"line_assign".actual_m_power,"line_assign".man_target,"line_assign".man_actual_target,
        "line_assign".hp,"line_assign".actual_hp,SUM("time".div_actual_target) as total_div_actual_target,COUNT("time".assign_id) AS total_time
        FROM line
        JOIN line_assign ON "line_assign".l_id="line".l_id AND
        "line_assign".assign_date=\'' . $date_string . '\'
        JOIN time ON "time".line_id="line".l_id AND "time".assign_date=\'' . $date_string . '\' AND "time".assign_id="line_assign".assign_id
        GROUP BY "line".l_id,"line_assign".main_target,"line_assign".m_power,"line_assign".actual_m_power,"line_assign".man_target,"line_assign".man_actual_target,
        "line_assign".hp,"line_assign".actual_hp
        ORDER BY "line".l_pos ASC');

        $daily_report_product = DB::select('SELECT "p_detail".p_detail_id,"p_detail".l_id,"p_detail".p_name,"p_detail".quantity,"p_detail".div_quantity,"p_detail".sewing_input,"p_detail".assign_id,
        "p_detail".h_over_input,"p_detail".p_actual_target,"p_detail".cat_actual_target,"p_detail".inline,"p_detail".cmp
        FROM p_detail
        JOIN line_assign ON "line_assign".assign_id="p_detail".assign_id AND "line_assign".assign_date=\'' . $date_string . '\'
		ORDER BY "p_detail".p_detail_id ASC');

        $category = DB::select('SELECT p_cat_id,SUM(cat_actual_target) AS t_cat_actual,p_name FROM p_detail
        WHERE DATE(created_at) >= DATE(NOW()) - INTERVAL \'30\' DAY
		GROUP BY p_cat_id,p_name');

        $target = DB::select('SELECT "line_assign".assign_date,SUM("line_assign".main_target) AS t_main_target FROM line_assign
        WHERE DATE("line_assign".created_at) >= DATE(NOW()) - INTERVAL \'30\' DAY
        GROUP BY "line_assign".assign_date ORDER BY "line_assign".assign_date ASC');

        $time = DB::select('SELECT SUM("time".div_actual_target) AS t_actual_target FROM time
        WHERE DATE("time".created_at) >= DATE(NOW()) - INTERVAL \'30\' DAY
        GROUP BY "time".assign_date ORDER BY "time".assign_date ASC');

        DB::disconnect('musung');

        return view('report_management.report', ['chart' => $chart->build(), 'category_chart' => $category_chart->build()], compact('category', 'target', 'time', 'daily_report', 'daily_report_product'));
    }

    public function cmpPut()
    {
        $boxes = request()->post('boxes');

        // print_r($boxes);

        for ($i = 0; $i < count($boxes); $i++) {

            $l_id_input = $boxes[$i]['l_id_input'];
            $p_id_input = $boxes[$i]['p_id_input'];
            $a_id_input = $boxes[$i]['a_id_input'];
            $cmp_input = $boxes[$i]['cmp_input'];

            $p_detail_query = ProductDetail::where('p_detail_id', $p_id_input)->where('assign_id', $a_id_input)->where('l_id', $l_id_input)->update(['cmp' => $cmp_input]);
        }
    }
}
