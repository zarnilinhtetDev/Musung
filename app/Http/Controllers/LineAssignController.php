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
use App\Models\User;
use App\Models\ProductCategory;

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
        $date_string = date("d.m.Y");

        /// Change line_status to 0 if current date is not equal to assign_date
        $line_assign_status = DB::select('SELECT "line".l_id,"line_assign".assign_date,"line".a_status FROM line_assign
         JOIN line ON "line".l_id = "line_assign".l_id ORDER BY "line_assign".assign_date ASC');
        $line_status = Line::select('l_id', 'a_status')->get();

        $json_decode = json_decode(json_encode($line_assign_status), true);

        for ($i = 0; $i < count($json_decode); $i++) {
            $assign_date = $json_decode[$i]['assign_date'];
            $l_id = $json_decode[$i]['l_id'];

            if ($assign_date != $date_string) {
                Line::where('l_id', $l_id)->update(['a_status' => 0]);
            }
            if ($assign_date == $date_string) {
                Line::where('l_id', $l_id)->update(['a_status' => 1]);
            }
        }
        /// Change line_status to 0 if current date is not equal to assign_date End

        $line_assign = LineAssign::all();
        $overTime = OverTime::all();
        $line_assign_2 = DB::select('SELECT DISTINCT "line_assign".assign_id,"line_assign".user_id,"line_assign".l_id,"line_assign".main_target,"line_assign".s_time,"line_assign".e_time,"line_assign".lunch_s_time,"line".a_status,"line_assign".lunch_e_time,"line_assign".cal_work_min,"line_assign".t_work_hr,"line_assign".created_at,"line_assign".updated_at,"line".l_name,"line".l_pos,"users".id,"users".name,"line_assign".assign_date
        FROM line_assign,line,users,p_detail WHERE "line".a_status=1 AND "line".is_delete=0 AND "line_assign".user_id="users".id
        AND "line_assign".l_id="line".l_id AND "line_assign".l_id="p_detail".l_id AND "line_assign".assign_date= \'' . $date_string . '\'
        ORDER BY "line_assign".assign_id ASC');
        $p_detail = DB::select('SELECT "p_detail".p_detail_id,"p_detail".assign_id,"p_detail".l_id,
        "p_detail".p_cat_id,"p_detail".p_name,"p_detail".quantity FROM p_detail
        JOIN line_assign ON "line_assign".assign_id="p_detail".assign_id AND
        "line_assign".assign_date=\'' . $date_string . '\'
        ORDER BY p_detail_id ASC');

        $p_detail = DB::select('SELECT DISTINCT "p_detail".p_detail_id,"p_detail".assign_id,"p_detail".l_id,
        "p_detail".p_cat_id,"p_detail".p_name,"p_detail".quantity FROM p_detail
        JOIN time ON "time".assign_id="p_detail".assign_id AND "time".line_id="p_detail".l_id
        JOIN line_assign ON "line_assign".assign_id="p_detail".assign_id
        AND "line_assign".assign_date=\'' . $date_string . '\'
        ORDER BY p_detail_id ASC');

        $responseBody = Line::select('l_id', 'l_name', 'l_pos', 'a_status', 'is_delete')->where('is_delete', 0)->orderBy('l_pos', 'asc')->get();
        $responseBody2 = DB::select('SELECT id,NAME,role FROM users WHERE id NOT IN (SELECT user_id FROM line_assign WHERE assign_date=\'' . $date_string . '\')');


        DB::disconnect('musung');

        return view('line_management.setting', compact('responseBody', 'responseBody2', 'line_assign', 'line_assign_2', 'overTime', 'p_detail'));
    }
    public function postLineSetting()
    {
        $l_id = request()->post('l_id');
        $line_manager = request()->post('l_manager');
        $s_time = request()->post('start_time');
        $e_time = request()->post('end_time');
        // $target = request()->post('target');
        $work_hour = request()->post('work_hour');
        $lunch_start = request()->post('lunch_start');
        $lunch_end = request()->post('lunch_end');
        $progress = request()->post('progress');

        $category = request()->post('category');
        $category_target = request()->post('category_target');
        $p_name = request()->post('p_name');
        $number = count($category);

        $t_category_target =  array_sum($category_target);

        $from_time = strtotime($s_time);
        $to_time = strtotime($e_time);
        $lunch_from_time = strtotime($lunch_start);
        $lunch_to_time = strtotime($lunch_end);

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
        $endOfArray = end($timeArr);
        $endOfArray_to_date = date('H:i', strtotime($endOfArray));
        if ($endOfArray_to_date > $end_lunch_from_time) { ///// Pop last item if greater than lunch_start_time
            array_pop($timeArr);
        }
        $num_TimeArray = count($timeArr);

        //// loop for Lunch End Time to End Time
        $total_time = strtotime($endOfArray_to_date) + strtotime($minute) + ($lunch_to_time - $lunch_from_time);
        $lunch_end_time =  date('H:i', $total_time);
        $lunch_end_time_to_period = new DateTime($lunch_end_time);
        // echo $lunch_end_time;

        $cal_end_time = new DatePeriod($lunch_end_time_to_period, $interval, $end_time);

        $endTimeArr[] = $lunch_end_time;
        foreach ($cal_end_time as $cal) {
            $endTimeArr[] = $cal->add($interval)->format('H:i');
        }
        $endOfEndTimeArr = end($endTimeArr);
        $endOfEndTimeArr_to_date = date('H:i', strtotime($endOfEndTimeArr));

        $num_EndTimeArray = count($endTimeArr);

        if ($endOfEndTimeArr > $end_time->format('H:i')) {
            array_pop($endTimeArr);
            -$getMinuteEndTimeArr = (strtotime($endOfEndTimeArr) - $to_time) / 60;
            $diffEndTime = strtotime($endOfEndTimeArr) - strtotime(date("H:i", $getMinuteEndTimeArr * 60));
            $diffEndTime_to_date =  date("H:i", $diffEndTime);
            $endTimeArr[] = $diffEndTime_to_date;
        }
        $totalTimeArr = array_merge($timeArr, $endTimeArr);
        $countTotalTimeArr = count($totalTimeArr);

        // print_r($totalTimeArr);

        $total_division = round(($t_category_target / $countTotalTimeArr), 0);
        $total_division_2 = $total_division;
        $total_division_3 = $total_division;

        $num_1 = 0;
        while ($num_1 < $countTotalTimeArr) {
            $div_target[] = $total_division;
            $total_division += $total_division_2;
            $num_1++;
        }
        $end_div_target = end($div_target);
        if ($end_div_target > $t_category_target) {
            array_pop($div_target);
            $div_target[] = $t_category_target;
        }
        $num_2 = 0;
        while ($num_2 < $countTotalTimeArr) {
            $target_for_line_entry[] = $total_division_3;
            $num_2++;
        }
        $date_string = date("d.m.Y");

        $line = Line::where('l_id', $l_id)->update(['a_status' => 1]); ///// Update status to line_id in line table
        if ($line == true) {
            $line_assign = LineAssign::create(['user_id' => $line_manager, 'l_id' => $l_id, 'main_target' => $t_category_target, 's_time' => $s_time, 'e_time' => $e_time, 'lunch_s_time' => $lunch_start, 'lunch_e_time' => $lunch_end, 'cal_work_min' => $progress, 't_work_hr' => $work_hour, 'assign_date' => $date_string, 'created_at' => NOW()]);

            if ($line_assign == true) {
                $assign_id = LineAssign::select('assign_id')->where('l_id', $l_id)->where('user_id', $line_manager)->orderBy('assign_id', 'desc')->first();  ///// Get assign_id from line_assign table
                if ($assign_id == true) {
                    $assign_id = $assign_id->assign_id;
                    if ($countTotalTimeArr > 0) {
                        for ($j = 0; $j < $countTotalTimeArr; $j++) { ///// Insert data [] to time table
                            Time::create([
                                'time_name' => $totalTimeArr[$j],
                                'line_id' => $l_id,
                                'assign_id' => $assign_id,
                                'div_target' => $div_target[$j],
                                'actual_target_entry' => $target_for_line_entry[$j],
                                'assign_date' => $date_string,
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
    public function createCategory()
    {
        $cat_name = request()->post('cat_name');
        ProductCategory::create(['p_cat_name' => $cat_name]);
    }
}
