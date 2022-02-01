<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\LineAssign;
use App\Models\Line;
use App\Models\OverTime;
use App\Models\ProductDetail;
use DateTime;
use DateInterval;
use DatePeriod;

class LineAssignController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware(function ($request, $next) {
            $this->user = Auth::user(); // here the user should exist from the session
            return $next($request);
        });
    }

    /////View for Line Setting
    public function index()
    {
        $line_assign = LineAssign::all();
        $overTime = OverTime::all();
        $line_assign_2 = DB::select('SELECT line_assign.assign_id,line_assign.user_id,line_assign.l_id,line_assign.main_target,line_assign.s_time,line_assign.e_time,line_assign.lunch_s_time,line.a_status,line_assign.lunch_e_time,line_assign.cal_work_min,line_assign.t_work_hr,line_assign.created_at,line_assign.updated_at,line.l_name,line.l_pos,users.id,users.name,p_detail.p_detail_id,p_detail.p_cat_id,p_detail.p_name,p_detail.quantity FROM line_assign,line,users,p_detail WHERE line.a_status=1 AND line.is_delete=0 AND line_assign.user_id=users.id AND line_assign.l_id=line.l_id AND line_assign.l_id=p_detail.l_id ORDER BY line_assign.assign_id ASC');

        $request = Request::create('/api/line', 'GET');
        $request2 = Request::create('/api/user', 'GET');
        // $request->headers->set('X-Authorization', 'wAH2k5uRc2Sgsz8gm3rdq0eEUHchz2syWHfLuLoCEWXpyCtkers4a1OeIGL1CST0');

        $response = Route::dispatch($request);
        $response2 = Route::dispatch($request2);

        $responseBody = $response->getContent();
        $responseBody2 = $response2->getContent();

        DB::disconnect('musung');

        return view('line_management.setting', compact('responseBody', 'responseBody2', 'line_assign', 'line_assign_2', 'overTime'));
    }
    public function postLineSetting()
    {
        $l_id = request()->post('l_id');
        $line_manager = request()->post('l_manager');
        $s_time = request()->post('start_time');
        $e_time = request()->post('end_time');
        $target = request()->post('target');
        $work_hour = request()->post('work_hour');
        $lunch_start = request()->post('lunch_start');
        $lunch_end = request()->post('lunch_end');
        $progress = request()->post('progress');

        $category = request()->post('category');
        $category_target = request()->post('category_target');
        $p_name = request()->post('p_name');
        $number = count($category);

        $from_time = strtotime($s_time);
        $to_time = strtotime($e_time);
        $lunch_from_time = strtotime($lunch_start);
        $lunch_to_time = strtotime($lunch_end);
        $hour_diff = round((($to_time - $from_time) - ($lunch_to_time - $lunch_from_time)) / 3600, 1);
        echo $hour_diff . "<br/>";

        $minute = date("H:i", $progress * 60);
        $s_time_minute = date("H:i", $from_time);
        echo $s_time_minute . "<br/>";
        echo $minute . "<br/>";

        $begin_from_time = date('H:i', $from_time);
        $end_lunch_from_time = date('H:i', $lunch_from_time);

        $begin = new DateTime($begin_from_time);
        $end = new DateTime($end_lunch_from_time);
        $interval = DateInterval::createFromDateString($progress . ' min');

        $times    = new DatePeriod($begin, $interval, $end);

        foreach ($times as $time) {
            echo $time->add($interval)->format('H:i'), "\n";
            if ($time > $end) {
                break;
            }
        }

        // for ($k = $from_time; $k < $lunch_from_time; $k++) {
        //     $minute_addition = strtotime($s_time_minute) + strtotime($minute);
        //     $s_time_minute_2 = date("H:i", $minute_addition);
        //     echo $s_time_minute_2 . "<br/>";
        // }
        // if (strtotime($lunch_start) > strtotime($s_time_minute_2)) {
        //     echo "true";
        // } else {
        //     echo "false";
        // }


        // $line = Line::where('l_id', $l_id)->update(['a_status' => 1]);
        // if ($line == true) {
        //     $line_assign = LineAssign::create(['user_id' => $line_manager, 'l_id' => $l_id, 'main_target' => $target, 's_time' => $s_time, 'e_time' => $e_time, 'lunch_s_time' => $lunch_start, 'lunch_e_time' => $lunch_end, 'cal_work_min' => $progress, 't_work_hr' => $work_hour, 'created_at' => NOW()]);

        //     if ($line_assign == true) {
        //         $assign_id = LineAssign::select('assign_id')->where('l_id', $l_id)->where('user_id', $line_manager)->first();
        //         if ($assign_id == true) {
        //             $assign_id = $assign_id->assign_id;
        //             if ($number > 0) {
        //                 for ($i = 0; $i < $number; $i++) {
        //                     if (trim($category[$i] != '')) {
        //                         $category_id = $category[$i];
        //                         $category_target_name = $category_target[$i];
        //                         $product_name = $p_name[$i];
        //                         $category_assign = ProductDetail::create(['assign_id' => $assign_id, 'l_id' => $l_id, 'p_cat_id' => $category_id, 'p_name' => $product_name, 'quantity' => $category_target_name, 'created_at' => NOW()]);
        //                     }
        //                 }
        //                 if ($category_assign == true) {
        //                     return redirect('/line_setting?status=create_ok');
        //                 }
        //             }
        //         }
        //     }
        // }
    }

    public function postLineOverTimeSetting()
    {
        $l_id = request()->post('l_id');
        $over_time_minute = request()->post('over_time_minute');
        $over_time_target = request()->post('over_time_target');

        $overTime = OverTime::create(['l_id' => $l_id, 'ot_min' => $over_time_minute, 'ot_target' => $over_time_target, 'created_at' => NOW()]);
        if ($overTime == true) {
            return redirect('/line_setting?status=overtime_create_ok');
        }
    }
}
