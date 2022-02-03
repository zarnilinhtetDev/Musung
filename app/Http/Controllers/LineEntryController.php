<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\ProductDetail;
use App\Models\Data;
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
        $u_id = Auth::user()->id;
        $responseBody = DB::select('SELECT line.l_id,line.l_name,line_assign.assign_id,line_assign.main_target,line_assign.s_time,line_assign.e_time,line_assign.lunch_s_time,line_assign.lunch_e_time,line_assign.assign_date,time.time_id,time.time_name,time.status,time.div_target,time.actual_target_entry,users.id,users.name
        FROM line
        JOIN line_assign ON line_assign.l_id = line.l_id
        JOIN time ON time.line_id = line_assign.l_id
        JOIN users ON users.id= line_assign.user_id
        WHERE users.id=' . $u_id . '
        ORDER BY time.time_id ASC');
        $p_detail = ProductDetail::select(
            'p_detail_id',
            'assign_id',
            'l_id',
            'p_cat_id',
            'p_name',
            'quantity'
        )->orderBy('p_detail_id', 'asc')->get();
        $data_detail = DB::select("SELECT data.data_id, data.time_id,data.div_actual_target,data.div_actual_percent FROM data JOIN time ON data.time_id=time.time_id");
        DB::disconnect('musung');

        return view('line_management.line_entry', compact('responseBody', 'p_detail', 'data_detail'));
    }
    public function postData()
    {
        $p_detail_id_arr = request()->post('p_detail_id');
        $time_id = request()->post('time_id');
        $div_actual_target = request()->post('div_actual_target_input_' . $time_id);
        $div_actual_percent = request()->post('div_actual_percent_input_' . $time_id);
        $p_detail_actual_target_arr = request()->post('p_detail_actual_target');
        $number = count($p_detail_id_arr);

        if ($number > 0) {
            for ($i = 0; $i < $number; $i++) { ///// Insert data [] to data table
                $data = Data::create([
                    'p_detail_id' => $p_detail_id_arr[$i],
                    'time_id' => $time_id,
                    'div_actual_target' => $div_actual_target,
                    'div_actual_percent' => $div_actual_percent,
                ]);
                if ($data == true) {
                    $product_detail = ProductDetail::where('p_detail_id', $p_detail_id_arr[$i])->update(['p_actual_target' => $p_detail_actual_target_arr[$i]]);
                    if ($product_detail == true) {
                        Time::where('time_id', $time_id)->update(['status' => 1]);
                    }
                }
            }
            return redirect('/line_entry?status=create_ok');
        }
    }
}
