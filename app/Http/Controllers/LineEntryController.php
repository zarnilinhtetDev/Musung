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
        $responseBody = DB::select('SELECT "line".l_id,"line".l_name,"line_assign".assign_id,"line_assign".main_target,"line_assign".s_time,"line_assign".e_time,"line_assign".lunch_s_time,"line_assign".lunch_e_time,"line_assign".assign_date,"time".time_id,"time".time_name,"time".status,"time".div_target,"time".actual_target_entry,"users".id,"users".name
        FROM line
        JOIN line_assign ON "line_assign".l_id = "line".l_id
        JOIN time ON "time".line_id = "line_assign".l_id
        JOIN users ON "users".id= "line_assign".user_id
        ORDER BY "time".time_id ASC');
        $p_detail = ProductDetail::select(
            'p_detail_id',
            'assign_id',
            'l_id',
            'p_cat_id',
            'p_name',
            'quantity'
        )->orderBy('p_detail_id', 'asc')->get();
        DB::disconnect('musung');
        if ($responseBody == true) {
            return view('line_management.line_entry', compact('responseBody', 'p_detail'));
        }
    }
}
