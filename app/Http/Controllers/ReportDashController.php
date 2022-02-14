<?php

namespace App\Http\Controllers;

use App\Charts\ReportDashAreaChart;
use App\Charts\ReportDashCategoryChart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return view('report_management.report', ['chart' => $chart->build(), 'category_chart' => $category_chart->build()]);
    }
}
