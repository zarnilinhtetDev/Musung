<?php

namespace App\Http\Controllers;

use App\Charts\ReportDashAreaChart;
use App\Charts\ReportDashCategoryChart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

        return view('report_management.report', ['chart' => $chart->build(), 'category_chart' => $category_chart->build()], compact('category', 'target', 'time'));
    }
}
