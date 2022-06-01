<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\ProductDetail;
use App\Models\Time;
use App\Models\LineEntryHistory;

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
        ORDER BY "time".time_id DESC');

        $p_detail = DB::select('SELECT "p_detail".p_detail_id,"p_detail".assign_id,"p_detail".l_id,
        "p_detail".p_cat_id,"p_detail".p_name,"p_detail".quantity,"time".time_id,"p_detail".style_no,"time".div_actual_target
        FROM p_detail
        JOIN time ON "time".assign_id="p_detail".assign_id AND "time".line_id="p_detail".l_id
        JOIN line_assign ON "line_assign".assign_id="p_detail".assign_id
        AND "line_assign".assign_date=\'' . $date_string . '\'
        ORDER BY p_detail_id ASC');

        $line_entry_history = DB::select('SELECT DISTINCT "line_entry_history".id,"line_entry_history".time_id,"line_entry_history".p_id,"line_entry_history".l_id,"line_entry_history".actual_target,"line_entry_history".assign_date
        ,"line_entry_history".status
                FROM line_entry_history
                JOIN time ON "time".line_id="line_entry_history".l_id
                AND "line_entry_history".assign_date=\'' . $date_string . '\'
                ORDER BY "line_entry_history".id,"line_entry_history".time_id ASC');

        $p_detail_2 = DB::select('SELECT "p_detail".assign_id,"p_detail".p_detail_id,"p_detail".div_quantity FROM p_detail');
        DB::disconnect('musung');

        return view('line_management.line_entry', compact('responseBody', 'p_detail', 'p_detail_2', 'line_entry_history'));
    }
    public function postData()
    {
        $p_detail_id_arr = request()->post('p_detail_id');
        $time_id = request()->post('time_id');
        @$div_actual_target = request()->post('div_actual_target_input_' . $time_id);
        @$div_actual_percent = request()->post('div_actual_percent_input_' . $time_id);
        $p_detail_actual_target_arr = request()->post('p_detail_actual_target');
        $line_id = request()->post('line_id');
        $assign_date = request()->post('assign_date');

        // echo $p_detail_id_arr;
        $number = count($p_detail_id_arr);
        // echo $div_actual_target . $div_actual_percent;

        $explode_percent = explode("%", $div_actual_percent);

        // print_r($p_detail_id_arr);
        // print_r($p_detail_actual_target_arr);
        // echo $assign_date;


        if ($div_actual_target != '' && $div_actual_percent != '') {
            if ($number > 0) {
                for ($i = 0; $i < $number; $i++) { ///// Insert data [] to p_detail & time table

                    LineEntryHistory::create(['time_id' => $time_id, 'l_id' => $line_id, 'p_id' => $p_detail_id_arr[$i], 'actual_target' => $p_detail_actual_target_arr[$i], 'assign_date' => $assign_date, 'status' => 1]);

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
        if ($div_actual_target == '' && $div_actual_percent == '') {
            $div_actual_target =  array_sum($p_detail_actual_target_arr);
            if ($number > 0) {
                for ($i = 0; $i < $number; $i++) { ///// update data []

                    LineEntryHistory::where('time_id', $time_id)->where('l_id', $line_id)->where('p_id', $p_detail_id_arr[$i])->where('assign_date', $assign_date)->update(['actual_target' => $p_detail_actual_target_arr[$i]]);

                    $product_detail_select = ProductDetail::where('p_detail_id', $p_detail_id_arr[$i])->first();


                    // $get_actual_target = LineEntryHistory::where('time_id', $time_id)->where('l_id', $line_id)->where('p_id', $p_detail_id_arr[$i])->where('assign_date', $assign_date)->select('p_id', 'actual_target');

                    $get_actual_target = DB::select('SELECT p_id,SUM(actual_target) AS total_actual_target FROM line_entry_history WHERE p_id=' . $p_detail_id_arr[$i] . ' AND assign_date=\'' . $assign_date . '\' GROUP BY p_id');

                    // echo $get_actual_target->p_id . $get_actual_target->actual_target;
                    // echo $get_actual_target;


                    $get_actual_target_decode = json_decode(json_encode($get_actual_target), true);
                    // print_r($get_actual_target_decode);

                    for ($j = 0; $j < count($get_actual_target_decode); $j++) {
                        $new_p_id = $get_actual_target_decode[$j]['p_id'];
                        $total_actual_target = $get_actual_target_decode[$j]['total_actual_target'];

                        ProductDetail::where('p_detail_id', $new_p_id)->update(['cat_actual_target' => $total_actual_target]);
                    }
                    $product_detail = ProductDetail::where('p_detail_id', $p_detail_id_arr[$i])->update(['p_actual_target' => $p_detail_actual_target_arr[$i]]);
                    if ($product_detail == true) {
                        Time::where('time_id', $time_id)->update(['status' => 1, 'div_actual_target' => $div_actual_target, 'div_actual_percent' => 0]);
                    }
                }
            }
            return redirect('/line_entry?status=create_ok');
        }
    }
}
