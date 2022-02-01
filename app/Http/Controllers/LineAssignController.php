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
use App\Models\Time;
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
        $line_assign_2 = DB::select('SELECT "line_assign".assign_id,"line_assign".user_id,"line_assign".l_id,"line_assign".main_target,"line_assign".s_time,"line_assign".e_time,"line_assign".lunch_s_time,"line".a_status,"line_assign".lunch_e_time,"line_assign".cal_work_min,"line_assign".t_work_hr,"line_assign".created_at,"line_assign".updated_at,"line".l_name,"line".l_pos,"users".id,"users".name,"p_detail".p_detail_id,"p_detail".p_cat_id,"p_detail".p_name,"p_detail".quantity FROM line_assign,line,users,p_detail WHERE "line".a_status=1 AND "line".is_delete=0 AND "line_assign".user_id="users".id AND "line_assign".l_id="line".l_id AND "line_assign".l_id="p_detail".l_id ORDER BY "line_assign".assign_id ASC');

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
        // $hour_diff = round((($to_time - $from_time) - ($lunch_to_time - $lunch_from_time)) / 3600, 1);
        // echo $hour_diff;
        $minute = date("H:i", $progress * 60);

        $begin_from_time = date('H:i', $from_time);
        $end_lunch_from_time = date('H:i', $lunch_from_time);
        $end_to_time = date('H:i', $to_time);

        $begin = new DateTime($begin_from_time);
        $lunch_begin = new DateTime($end_lunch_from_time);
        $end_time = new DateTime($end_to_time);
        $interval = DateInterval::createFromDateString($progress . ' min');

        $times = new DatePeriod($begin, $interval, $lunch_begin);  //// Add progress min to start_time until lunch_start_time

        foreach ($times as $time) {
            $timeArr[] = $time->add($interval)->format('H:i');
        }
        print_r($timeArr) . '<br>';
        $endOfArray = end($timeArr);
        $endOfArray_to_date = date('H:i', strtotime($endOfArray));
        if ($endOfArray_to_date > $end_lunch_from_time) { ///// Pop last item if greater than lunch_start_time
            array_pop($timeArr);
        }
        $num_TimeArray = count($timeArr);
        $target_division_1 = round(($target / $num_TimeArray), 0);

        //// loop for Lunch End Time to End Time
        $total_time = strtotime($endOfArray_to_date) + strtotime($minute) + ($lunch_to_time - $lunch_from_time);
        $lunch_end_time =  date('H:i', $total_time);
        $lunch_end_time_to_period = new DateTime($lunch_end_time);
        echo $lunch_end_time;

        $cal_end_time = new DatePeriod($lunch_end_time_to_period, $interval, $end_time);
        foreach ($cal_end_time as $cal) {
            $endTimeArr[] = $cal->add($interval)->format('H:i');
        }
        $endOfEndTimeArr = end($endTimeArr);
        $endOfEndTimeArr_to_date = date('H:i', strtotime($endOfEndTimeArr));
        if ($endOfEndTimeArr_to_date > $end_time) { ///// Pop last item if greater than lunch_start_time
            array_pop($endTimeArr);
        }
        $num_EndTimeArray = count($endTimeArr);
        $target_division_2 = round(($target / $num_EndTimeArray), 0);

        $total_division = ($target_division_1 + $target_division_2) - $target;


        // echo $endOfArray . "<br/>" . $minute;

        $line = Line::where('l_id', $l_id)->update(['a_status' => 1]); ///// Update status to line_id in line table
        if ($line == true) {
            $line_assign = LineAssign::create(['user_id' => $line_manager, 'l_id' => $l_id, 'main_target' => $target, 's_time' => $s_time, 'e_time' => $e_time, 'lunch_s_time' => $lunch_start, 'lunch_e_time' => $lunch_end, 'cal_work_min' => $progress, 't_work_hr' => $work_hour, 'created_at' => NOW()]);

            if ($line_assign == true) {
                $assign_id = LineAssign::select('assign_id')->where('l_id', $l_id)->where('user_id', $line_manager)->first();  ///// Get assign_id from line_assign table
                if ($assign_id == true) {
                    $assign_id = $assign_id->assign_id;
                    if ($num_TimeArray > 0) {
                        for ($j = 0; $j < $num_TimeArray; $j++) { ///// Insert data [] to time table
                            Time::create([
                                'time_name' => $timeArr[$j], 'line_id' => $l_id,
                                'assign_id' => $assign_id,
                                'div_target' => $total_division,
                            ]);
                        }
                    }
                    if ($num_EndTimeArray > 0) {
                        for ($k = 0; $k < $num_EndTimeArray; $k++) { ///// Insert data [] to time table
                            Time::create([
                                'time_name' => $endTimeArr[$k], 'line_id' => $l_id,
                                'assign_id' => $assign_id,
                                'div_target' => $total_division,
                            ]);
                        }
                    }
                    if ($number > 0) {
                        for ($i = 0; $i < $number; $i++) {  ///// Insert data [] to p_detail table
                            if (trim($category[$i] != '')) {
                                $category_id = $category[$i];
                                $category_target_name = $category_target[$i];
                                $product_name = $p_name[$i];
                                $category_assign = ProductDetail::create(['assign_id' => $assign_id, 'l_id' => $l_id, 'p_cat_id' => $category_id, 'p_name' => $product_name, 'quantity' => $category_target_name, 'created_at' => NOW()]);
                            }
                        }
                        if ($category_assign == true) {
                            return redirect('/line_setting?status=create_ok');
                        }
                    }
                }
            }
        }
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
