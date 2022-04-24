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
        $line_assign_status = DB::select('SELECT "line_assign".assign_id,"line".l_id,"line_assign".assign_date,"line".a_status FROM line_assign
        JOIN line ON "line".l_id = "line_assign".l_id ORDER BY "line_assign".assign_id ASC');
        $line_status = Line::select('l_id', 'a_status')->get();

        $line_assign_detail = DB::select('SELECT "line_assign".assign_id,"line".l_id,"line".l_name,"line_assign".assign_date,"line".a_status,"line_assign".user_id,"users".name,"line_assign".main_target,"line_assign".s_time,
        "line_assign".e_time,"line_assign".lunch_s_time,"line_assign".lunch_e_time,"line_assign".t_work_hr
        FROM line_assign
                JOIN line ON "line".l_id = "line_assign".l_id AND "line_assign".assign_date=\'' . $date_string . '\'
                JOIN users ON "line_assign".user_id="users".id
                ORDER BY "line".l_pos ASC');

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

        $p_detail = DB::select('SELECT DISTINCT "p_detail".p_detail_id,"p_detail".assign_id,"p_detail".l_id,
        "p_detail".p_cat_id,"p_detail".p_name,"p_detail".quantity,"p_category".p_cat_name
		FROM p_detail
        JOIN time ON "time".assign_id="p_detail".assign_id AND "time".line_id="p_detail".l_id
        JOIN line_assign ON "line_assign".assign_id="p_detail".assign_id
		JOIN p_category ON "p_category".p_cat_id="p_detail".p_cat_id
        AND "line_assign".assign_date=\'' . $date_string . '\'
        ORDER BY p_detail_id ASC');

        $l_manager_list = DB::select('SELECT "line_assign".user_id,"users".name,"line".l_id,"line_assign".assign_id FROM line_assign
        JOIN users ON "users".id="line_assign".user_id
        JOIN line ON "line".l_id="line_assign".l_id AND "line".a_status=1
        WHERE "line_assign".assign_date=\'' . $date_string . '\'
        ORDER BY "line".l_pos ASC');

        $p_detail_2 = ProductCategory::all();

        $responseBody = Line::select('l_id', 'l_name', 'l_pos', 'a_status', 'is_delete')->where('is_delete', 0)->orderBy('l_pos', 'asc')->get();
        $responseBody2 = DB::select('SELECT id,NAME,role FROM users WHERE id NOT IN (SELECT user_id FROM line_assign WHERE assign_date=\'' . $date_string . '\')');


        DB::disconnect('musung');

        return view('line_management.setting', compact('responseBody', 'responseBody2', 'line_assign', 'line_assign_2', 'overTime', 'p_detail', 'p_detail_2', 'line_assign_detail', 'l_manager_list'));
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


        // $category = request()->post('category');
        // $category_target = request()->post('category_target');
        // $p_name = request()->post('p_name');
        // $number = count($category);


        // $category_1 = request()->post('category_1');
        // $p_name_1 = request()->post('p_name_1');
        // $category_target_1 = request()->post('category_target_1');

        $category = [];
        $style_no = [];
        $p_name = [];
        $category_target = [];
        $sub = json_decode(request()->post('sub'), true);
        for ($x = 0; $x < count($sub); $x++) {
            $category[] = $sub[$x]['category_select'];
            $style_no[] = $sub[$x]['style_no'];
            $p_name[] = $sub[$x]['p_name'];
            $category_target[] = $sub[$x]['category_target'];
        }
        // print_r($category) . "<br/>";
        // print_r($p_name) . "<br/>";
        // print_r($category_target) . "<br/>";
        // print_r($style_no);

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
            $getMinuteEndTimeArr = (strtotime($endOfEndTimeArr) - $to_time) / 60;
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
                        //// For temp in time_table
                        Time::create([
                            'time_name' => 'temp',
                            'line_id' => $l_id,
                            'assign_id' => $assign_id,
                            'div_target' => 0,
                            'actual_target_entry' => 0,
                            'assign_date' => $date_string,
                        ]);
                    }


                    if ($number > 0) {
                        for ($i = 0; $i < $number; $i++) {  ///// Insert data [] to p_detail table
                            if (trim($category[$i] != '')) {
                                $category_id = $category[$i];
                                $category_target_name = $category_target[$i];
                                $style_no_1 = $style_no[$i];
                                $product_name = $p_name[$i];

                                $time_count = DB::select("SELECT assign_id,time_name FROM time WHERE assign_id=" . $assign_id . " ORDER BY time_name DESC OFFSET 1");
                                $time_count_decode = json_decode(json_encode($time_count), true);
                                $count_time = count($time_count_decode);
                                $div_target_quantity = round(($category_target[$i] / $count_time), 0);

                                $category_assign = ProductDetail::create(['assign_id' => $assign_id, 'l_id' => $l_id, 'p_cat_id' => $category_id, 'p_name' => $product_name, 'style_no' => $style_no_1, 'quantity' => $category_target_name, 'div_quantity' => $div_target_quantity, 'created_at' => NOW()]);
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
        $date_string = date("d.m.Y");

        $category = [];
        $style_no = [];
        $p_name = [];
        $category_target = [];
        $line_id = [];

        $sub = json_decode(request()->post('sub'), true);
        for ($x = 0; $x < count($sub); $x++) {
            if ($sub[$x]['category_select'] != '' && $sub[$x]['style_no'] != '' && $sub[$x]['p_name'] != '' && $sub[$x]['category_target'] != '' && $sub[$x]['l_id'] != '') {
                $category[] = $sub[$x]['category_select'];
                $style_no[] = $sub[$x]['style_no'];
                $p_name[] = $sub[$x]['p_name'];
                $category_target[] = $sub[$x]['category_target'];
                $line_id[] = $sub[$x]['l_id'];
            }
        }

        $assign_id = DB::select('SELECT "line_assign".assign_id,"line_assign".user_id,"line_assign".l_id,"line_assign".main_target,"line_assign".s_time,"line_assign".e_time,"line_assign".lunch_s_time,
        "line_assign".lunch_e_time,"line_assign".cal_work_min,"line_assign".t_work_hr,"line_assign".assign_date
        FROM line_assign WHERE "line_assign".l_id=' . $l_id . ' AND "line_assign".assign_date=\'' . $date_string . '\'  ORDER BY "line_assign".assign_id ASC');


        DB::disconnect('musung');

        $assign_id_decode = json_decode(json_encode($assign_id), true);
        $a_id = $assign_id_decode[0]['assign_id'];
        $user_id = $assign_id_decode[0]['user_id'];
        $l_id = $assign_id_decode[0]['l_id'];
        $main_target = $assign_id_decode[0]['main_target'];
        $s_time = $assign_id_decode[0]['s_time'];
        $e_time = $assign_id_decode[0]['e_time'];
        $lunch_s_time = $assign_id_decode[0]['lunch_s_time'];
        $lunch_e_time = $assign_id_decode[0]['lunch_e_time'];
        $cal_work_min = $assign_id_decode[0]['cal_work_min'];
        $t_work_hr = $assign_id_decode[0]['t_work_hr'];
        $assign_date = $assign_id_decode[0]['assign_date'];

        $div_over_time = $over_time_minute / $cal_work_min;

        $min_arr = [];
        $num = 1;
        for ($m = 0; $m < $div_over_time; $m++) {

            $time = ($over_time_minute - $cal_work_min) * $num;
            // echo $time;
            if ($time == 0) {
                $min_arr[] = $over_time_minute;
            } elseif ($time < 0) {
                $min_arr[] = abs($over_time_minute);
            } else {
                $min_arr[] = $time;
            }
            $num++;
        }

        // print_r($min_arr);

        $time_arr = [];
        for ($i = 0; $i < count($min_arr); $i++) {
            $total_over_time = strtotime($e_time) + ($min_arr[$i] * 60);
            $format_over_time = date('H:i', $total_over_time);

            $time_arr[] = $format_over_time;
        }

        $countTotalTimeArr = count($time_arr);

        $total_division = round(($over_time_target / $countTotalTimeArr), 0);
        $total_division_2 = $total_division;
        $total_division_3 = $total_division;

        $num_1 = 0;
        while ($num_1 < $countTotalTimeArr) {
            $div_target[] = $total_division;
            $total_division += $total_division_2;
            $num_1++;
        }
        $end_div_target = end($div_target);
        if ($end_div_target > $over_time_target) {
            array_pop($div_target);
            $div_target[] = $over_time_target;
        }
        $num_2 = 0;
        while ($num_2 < $countTotalTimeArr) {
            $target_for_line_entry[] = $total_division_3;
            $num_2++;
        }
        $number = count($category);

        $over_time_assign = OverTime::create(['l_id' => $l_id, 'ot_min' => $over_time_minute, 'ot_target' => $over_time_target, 'assign_date' => $date_string, 'created_at' => NOW()]);

        if ($over_time_assign) {
            $line_assign = LineAssign::create(['user_id' => $user_id, 'l_id' => $l_id, 'main_target' => $over_time_target, 's_time' => $s_time, 'e_time' => $e_time, 'lunch_s_time' => $lunch_s_time, 'lunch_e_time' => $lunch_e_time, 'cal_work_min' => $cal_work_min, 't_work_hr' => $t_work_hr, 'assign_date' => $date_string, 'created_at' => NOW()]);


            if ($line_assign == true) {
                $assign_id_query = LineAssign::select('assign_id')->where('l_id', $l_id)->where('user_id', $user_id)->orderBy('assign_id', 'desc')->first();  ///// Get assign_id from line_assign table
                if ($assign_id_query == true) {
                    $a_id_2 = $assign_id_query->assign_id;

                    if ($countTotalTimeArr > 0) {
                        for ($j = 0; $j < $countTotalTimeArr; $j++) { ///// Insert data [] to time table
                            Time::create([
                                'time_name' => $time_arr[$j],
                                'line_id' => $l_id,
                                'assign_id' => $a_id_2,
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
                                $style_no_1 = $style_no[$i];
                                $product_name = $p_name[$i];

                                $time_count = DB::select("SELECT assign_id,time_name FROM time WHERE assign_id=" . $a_id_2 . " ORDER BY time_name DESC OFFSET 1");
                                $time_count_decode = json_decode(json_encode($time_count), true);
                                $count_time = count($time_count_decode);
                                $div_target_quantity = round(($category_target[$i] / $count_time), 0);

                                $category_assign = ProductDetail::create(['assign_id' => $a_id_2, 'l_id' => $l_id, 'p_cat_id' => $category_id, 'p_name' => $product_name, 'style_no' => $style_no_1, 'quantity' => $category_target_name, 'div_quantity' => $div_target_quantity, 'created_at' => NOW()]);
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
    public function createCategory()
    {
        $cat_name = request()->post('cat_name');
        ProductCategory::create(['p_cat_name' => $cat_name]);
    }

    public function deleteAssignLine($a_id, $l_id)
    {
        $del_line_assign = LineAssign::where('assign_id', $a_id)->where('l_id', $l_id)->delete();
        $del_p_detail = ProductDetail::where('assign_id', $a_id)->where('l_id', $l_id)->delete();
        $del_time = Time::where('assign_id', $a_id)->where('line_id', $l_id)->delete();
        $l_status = Line::where('l_id', $l_id)->update(['a_status' => 0]);
        if ($del_line_assign == true && $del_p_detail == true && $del_time == true && $l_status == true) {
            return redirect('/line_setting?status=delete_ok');
        }
    }

    public function postSetting()
    {
        $user_id = request()->user_id;

        $date_string = date("d.m.Y");

        $responseBody = DB::select('SELECT "line".l_id,"line".l_name,"line_assign".assign_id,"line_assign".main_target,"line_assign".s_time,"line_assign".e_time,"line_assign".lunch_s_time,"line_assign".lunch_e_time,"line_assign".assign_date,"time".time_id,"time".time_name,"time".status,"time".div_target,"time".actual_target_entry,"users".id,"users".name,"time".div_actual_target,"time".div_actual_percent
        FROM line
        JOIN line_assign ON "line_assign".l_id = "line".l_id AND "line_assign".assign_date=\'' . $date_string . '\'
        JOIN time ON "time".line_id = "line_assign".l_id AND "time".assign_id="line_assign".assign_id
        JOIN users ON "users".id= "line_assign".user_id
        WHERE "users".id=' . $user_id . '
        ORDER BY "time".time_id DESC OFFSET 1');

        $p_detail = DB::select('SELECT "p_detail".p_detail_id,"p_detail".assign_id,"p_detail".l_id,
        "p_detail".p_cat_id,"p_detail".p_name,"p_detail".quantity,"time".time_id,"p_detail".style_no
        FROM p_detail
        JOIN time ON "time".assign_id="p_detail".assign_id AND "time".line_id="p_detail".l_id
        JOIN line_assign ON "line_assign".assign_id="p_detail".assign_id
        AND "line_assign".assign_date=\'' . $date_string . '\'
        ORDER BY p_detail_id ASC');

        $p_detail_2 = DB::select('SELECT "p_detail".assign_id,"p_detail".p_detail_id,"p_detail".div_quantity FROM p_detail');

        $decode = json_decode(json_encode($responseBody), true);
        $decode_2 = json_decode(json_encode($p_detail), true);
        $decode_3 = json_decode(json_encode($p_detail_2), true); ?>
        <div class="container-fluid p-0">
            <div id="tabmenu" class="container-fluid my-3 p-0">
                <div id="tab-content">
                    <div id="tab1" class="div_1">
                        <div class="row container-fluid p-0 m-0">
                            <div class="col-12 col-md-6 m-auto p-0">
                                <div style="overflow: auto;max-width:100%;max-height:550px;">
                                    <table class="table table-striped my-2 tableFixHead results p-0">
                                        <thead>
                                            <tr>
                                                <th>Time</th>
                                                <th>Target</th>
                                                <th>Actual Target</th>
                                                <th>Percentage</th>
                                                <th>Data</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            for ($i = count($decode) - 1; $i >= 0; $i--) {
                                                $line_id = $decode[$i]['l_id'];
                                                $line_name = $decode[$i]['l_name'];
                                                $a_id = $decode[$i]['assign_id'];
                                                $main_target = $decode[$i]['main_target'];
                                                $s_time = $decode[$i]['s_time'];
                                                $e_time = $decode[$i]['e_time'];
                                                $lunch_s_time = $decode[$i]['lunch_s_time'];
                                                $lunch_e_time = $decode[$i]['lunch_e_time'];
                                                $time_id = $decode[$i]['time_id'];
                                                $time_name = $decode[$i]['time_name'];
                                                $line_status = $decode[$i]['status'];
                                                $div_target = $decode[$i]['div_target'];
                                                $actual_target = $decode[$i]['actual_target_entry'];
                                                $user_id = $decode[$i]['id'];
                                                $user_name = $decode[$i]['name'];
                                                $assign_date = $decode[$i]['assign_date'];
                                                $div_actual_target = $decode[$i]['div_actual_target'];
                                                $div_actual_percent = $decode[$i]['div_actual_percent'];
                                                $actual_target_entry = $decode[$i]['actual_target_entry']; ?>

                                                <tr>
                                                    <td><?php echo $time_name; ?></td>
                                                    <td><span id="div_target_{{ $time_id }}"><?php echo $actual_target_entry; ?></span>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if ($div_actual_target != '') {
                                                            echo $div_actual_target;
                                                        } elseif ($div_actual_target == '') {
                                                        ?> <span id="actual_target_<?php echo $time_id; ?>"></span>
                                                        <?php
                                                        } ?>

                                                    </td>
                                                    <td>
                                                        <?php if ($div_actual_percent != '') {
                                                            echo $div_actual_percent . '%';
                                                        } elseif ($div_actual_percent == '') {
                                                        ?><span id="actual_percentage_<?php echo $time_id; ?>"></span>
                                                        <?php
                                                        } ?>
                                                    </td>
                                                    <td> <button type="button" class="btn btn-primary w-75" data-bs-toggle="modal" data-bs-target="#LineEntryModal<?php echo $time_id; ?>" data-bs-time-id="<?php echo $time_id; ?>" data-bs-time-name="<?php echo $time_name; ?>" id="toggle_btn_<?php echo $time_id; ?>">
                                                            Fill
                                                        </button>
                                                    </td>
                                                </tr>
                                                <!-- Modal -->
                                                <div class="modal fade" id="LineEntryModal<?php echo $time_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form action="line_entry_post" method="POST" id="post_form">
                                                                <div class="modal-header">
                                                                    <h1 class="fw-bold heading-text"><?php echo $time_name; ?></h1>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="container-fluid">
                                                                        <div class="row">
                                                                            <?php
                                                                            for ($j = 0; $j < count($decode_2); $j++) {
                                                                                $p_detail_id = $decode_2[$j]['p_detail_id'];
                                                                                $p_detail_assign_id = $decode_2[$j]['assign_id'];
                                                                                $p_detail_l_id = $decode_2[$j]['l_id'];
                                                                                $p_detail_p_cat_id = $decode_2[$j]['p_cat_id'];
                                                                                $p_detail_p_name = $decode_2[$j]['p_name'];
                                                                                $p_detail_qty = $decode_2[$j]['quantity'];
                                                                                $p_detail_time_id = $decode_2[$j]['time_id'];
                                                                                $p_detail_style_no = $decode_2[$j]['style_no'];
                                                                                if ($time_id == $p_detail_time_id) {
                                                                            ?>
                                                                                    <div class="col-12 my-2">
                                                                                        <div class="row container-fluid">
                                                                                            <div class="col-12 col-md-4 m-auto">
                                                                                                <h5 class="fw-bold heading-text">#<?php echo $p_detail_style_no . $p_detail_p_name; ?></h5>
                                                                                            </div>
                                                                                            <div class="col-12 col-md-4">
                                                                                                <label>Target</label>
                                                                                                <input type="number" class="form-control" name="target" value="<?php
                                                                                                                                                                for ($k = 0; $k < count($decode_3); $k++) {
                                                                                                                                                                    $p_2_detail_id = $decode_3[$k]['p_detail_id'];
                                                                                                                                                                    $div_quantity = $decode_3[$k]['div_quantity'];

                                                                                                                                                                    if ($p_2_detail_id == $p_detail_id) {
                                                                                                                                                                        echo $div_quantity;
                                                                                                                                                                    }
                                                                                                                                                                }
                                                                                                                                                                ?>" readonly />
                                                                                            </div>
                                                                                            <div class="col-12 col-md-4">
                                                                                                <label>Actual</label>
                                                                                                <input type="number" class="form-control" name="p_detail_actual_target[]" id="p_detail_actual_target_<?php echo $time_id; ?>" placeholder="0" required />
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <input type="hidden" name="assign_date" value="<?php echo $date_string; ?>" />
                                                                                    <input type="hidden" name="line_id" value="<?php echo $p_detail_l_id; ?>" />
                                                                                    <input type="hidden" name="p_detail_id[]" value="<?php echo $p_detail_id; ?>" />
                                                                                <?php
                                                                                } ?>


                                                                                <input type="hidden" name="time_id" value="<?php echo $time_id; ?>" />
                                                                                <input type="hidden" name="div_actual_target_input_<?php echo $time_id; ?>" id="div_actual_target_input_<?php echo $time_id; ?>" />
                                                                                <input type="hidden" name="div_actual_percent_input_<?php echo $time_id; ?>" id="div_actual_percent_input_<?php echo $time_id; ?>" />
                                                                            <?php
                                                                            } ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary" onclick="form_submit()">Save
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <script>
                                                        $("#toggle_btn_<?php echo $time_id; ?>").click(function() {
                                                            var p_detail_number = "<?php echo $time_id; ?>";
                                                            (p_detail_number);
                                                            calculateSum();
                                                            $(".modal-content #p_detail_actual_target_" + p_detail_number).on(
                                                                "keydown keyup",
                                                                function() {
                                                                    calculateSum();
                                                                }
                                                            );

                                                            function calculateSum() {
                                                                var sum = 0;
                                                                var p_detail_number = "<?php echo $time_id; ?>";
                                                                var div_target = parseInt($("#div_target_" + p_detail_number).text());

                                                                //iterate through each textboxes and add the values
                                                                $(".modal-content #p_detail_actual_target_" + p_detail_number).each(function() {
                                                                    //add only if the value is number
                                                                    if (!isNaN(this.value) && this.value.length != 0) {
                                                                        sum += parseFloat(this.value);
                                                                        $(this).css("background-color", "#FEFFB0");
                                                                    } else if (this.value.length != 0) {
                                                                        $(this).css("background-color", "red");
                                                                    }
                                                                });
                                                                var cal_percent = ((sum / "<?php echo $actual_target_entry; ?>") * 100).toFixed(0) + "%";

                                                                $("#actual_target_" + p_detail_number).html(sum.toFixed(0));
                                                                $("#actual_percentage_" + p_detail_number).text(cal_percent);

                                                                $("#div_actual_target_input_" + p_detail_number).val($("#actual_target_" + p_detail_number).text());
                                                                $("#div_actual_percent_input_" + p_detail_number).val($("#actual_percentage_" + p_detail_number).text());
                                                            }
                                                        });
                                                    </script>
                                                </div>
                                            <?php

                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            function form_submit() {
                document.getElementById("post_form").submit();
            }
        </script>
<?php
    }
}
