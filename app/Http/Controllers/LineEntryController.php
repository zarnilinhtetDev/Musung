<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\ProductDetail;
use App\Models\Time;

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
        $date_string = date("d.m.Y");
        $u_id = Auth::user()->id;
        $responseBody = DB::select('SELECT "line".l_id,"line".l_name,"line_assign".assign_id,"line_assign".main_target,"line_assign".s_time,"line_assign".e_time,"line_assign".lunch_s_time,"line_assign".lunch_e_time,"line_assign".assign_date,"time".time_id,"time".time_name,"time".status,"time".div_target,"time".actual_target_entry,"users".id,"users".name,"time".div_actual_target,"time".div_actual_percent
        FROM line
        JOIN line_assign ON "line_assign".l_id = "line".l_id AND "line_assign".assign_date=\'' . $date_string . '\'
        JOIN time ON "time".line_id = "line_assign".l_id AND "time".assign_id="line_assign".assign_id
        JOIN users ON "users".id= "line_assign".user_id
        WHERE "users".id=' . $u_id . '
        ORDER BY "time".time_id DESC OFFSET 1');

        $p_detail = DB::select('SELECT "p_detail".p_detail_id,"p_detail".assign_id,"p_detail".l_id,
        "p_detail".p_cat_id,"p_detail".p_name,"p_detail".quantity,"time".time_id,"p_detail".style_no
        FROM p_detail
        JOIN time ON "time".assign_id="p_detail".assign_id AND "time".line_id="p_detail".l_id
        JOIN line_assign ON "line_assign".assign_id="p_detail".assign_id
        AND "line_assign".assign_date=\'' . $date_string . '\'
        ORDER BY p_detail_id ASC');

        $p_detail_2 = DB::select('SELECT "p_detail".assign_id,"p_detail".p_detail_id,"p_detail".div_quantity FROM p_detail');
        DB::disconnect('musung');

        return view('line_management.line_entry', compact('responseBody', 'p_detail', 'p_detail_2'));
    }
    public function postData()
    {
        $p_detail_id_arr = request()->post('p_detail_id');
        $time_id = request()->post('time_id');
        $div_actual_target = request()->post('div_actual_target_input_' . $time_id);
        $div_actual_percent = request()->post('div_actual_percent_input_' . $time_id);
        $p_detail_actual_target_arr = request()->post('p_detail_actual_target');
        $line_id = request()->post('line_id');
        $assign_date = request()->post('assign_date');

        // echo $p_detail_id_arr;
        $number = count($p_detail_id_arr);

        $explode_percent = explode("%", $div_actual_percent);

        if ($number > 0) {
            for ($i = 0; $i < $number; $i++) { ///// Insert data [] to p_detail & time table
                $product_detail_select = ProductDetail::where('p_detail_id', $p_detail_id_arr[$i])->first();
                if ($product_detail_select->cat_actual_target == '') {
                    ProductDetail::where('p_detail_id', $p_detail_id_arr[$i])->update(['cat_actual_target' => $p_detail_actual_target_arr[$i]]);
                } else {
                    $total = $product_detail_select->cat_actual_target + $p_detail_actual_target_arr[$i];
                    ProductDetail::where('p_detail_id', $p_detail_id_arr[$i])->update(['cat_actual_target' => $total]);
                }

                $product_detail = ProductDetail::where('p_detail_id', $p_detail_id_arr[$i])->update(['p_actual_target' => $p_detail_actual_target_arr[$i]]);
                if ($product_detail == true) {
                    Time::where('time_id', $time_id)->update(['status' => 1, 'div_actual_target' => $div_actual_target, 'div_actual_percent' => $explode_percent[0]]);
                }
            }
            return redirect('/line_entry?status=create_ok');
        }
    }
}
