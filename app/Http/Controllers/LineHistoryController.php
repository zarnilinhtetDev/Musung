<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LineHistoryController extends Controller
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
        $getDate =  request()->post('date_name');
        $date_string = date("d.m.Y", strtotime($getDate));

        $time = DB::select('SELECT time_name FROM time
        JOIN line_assign ON "time".assign_id="line_assign".assign_id AND
        "line_assign".assign_date=\'' . $date_string . '\' GROUP BY time_name ORDER BY time_name ASC');

        $time_2 = DB::select('SELECT "time".time_id,"time".time_name,"time".line_id,"time".assign_id,"time".status,"time".div_target,"time".div_actual_target,"time".div_actual_percent,"time".actual_target_entry FROM time,line_assign WHERE "time".assign_id="line_assign".assign_id AND "line_assign".assign_date=\'' . $date_string . '\' ORDER BY "time".time_id ASC');

        $getLine = DB::select('SELECT "line".l_id,"line".l_name,"line_assign".assign_id,"line_assign".main_target,"line_assign".s_time,"line_assign".e_time,"line_assign".lunch_s_time,"line_assign".lunch_e_time,"line_assign".assign_date,"users".id,"users".name
        FROM line
        JOIN line_assign ON "line_assign".l_id = "line".l_id
        JOIN users ON "users".id= "line_assign".user_id
        WHERE "line".a_status=1 AND "line_assign".assign_date=\'' . $date_string . '\' ORDER BY "line".l_pos ASC');

        $top_line = DB::select('SELECT "time".line_id,"line".l_name,SUM("time".div_actual_target) AS total_actual FROM time
          JOIN line ON "line".l_id="time".line_id
          JOIN line_assign ON "line_assign".l_id="time".line_id AND "line_assign".assign_date=\'' . $date_string . '\'
          AND "line_assign".assign_date="time".assign_date
          WHERE "time".div_actual_percent IS NOT NULL
          GROUP BY "time".line_id,"line".l_name ORDER BY SUM("time".div_actual_target) DESC LIMIT 3');

        DB::disconnect('musung');

        echo '<div class="container-fluid">
        <ul class="horizontal-slide" style="" id="tabs">
            <li class="span2 bg-transparent">
                <input class="icon-btn-one btn my-2" type="submit" value="Date - ' . $getDate . '" />
            </li>
            <li class="span2 bg-transparent">
                <input class="icon-btn-one icon-btn-one-2 btn my-2" type="submit" value="Export to Excel"
                    name="submit" />
            </li>
        </ul>
    </div>

    <div class="row container-fluid p-0 my-3 mx-auto">

    <div class="col-12 col-md-8 p-sm-0 p-md-auto my-sm-2 my-md-0 top-3">
    <div class="panel-body">
    <table class="table table-hover table-striped table-bordered text-center table-dash" id="live_dash_1">
        <thead>
            <tr class="tr-2 tr-3">
                <th scope="col">Line</th>
                <th scope="col">Target</th>';

        foreach ($time as $t) {
            echo '<th scope="col">' . $t->time_name . '</th>';
        }
        echo '</tr>
        </thead>
        <tbody>';
        foreach ($getLine as $g_line) {
            $g_line_id = $g_line->l_id;
            $g_line_name = $g_line->l_name;
            $g_main_target = $g_line->main_target;

            echo '<tr>
                <td>' . $g_line_name . '</td>
                <td><span id="g_main_target_' . $g_line_id . '">' . $g_main_target . '</span></td>';

            foreach ($time_2 as $t_2) {
                if ($g_line_id == $t_2->line_id) {
                    $current_target = $t_2->time_id;
                    $prev_target = ((int)$current_target) - 1;

                    echo '<td>
                            <table class="w-100 text-center">
                                <tr>
                                    <td><span id="new_div_target_' . $t_2->time_id . '">' . $t_2->actual_target_entry . '</span></td>
                                    <td><span id="div_target_' . $t_2->time_id . '">' . $t_2->div_target . '</span>
                                    </td>
                                </tr>
                                <tr class="text-white">
                                    <td id="td_div_actual_target_' . $t_2->time_id . '">
                                        <span id="div_actual_target_' . $t_2->time_id . '"
                                            class="div_actual_target_' . $g_line_id . '">' . $t_2->div_actual_target . '</span>
                                    </td>
                                    <td id="td_div_actual_target_total_' . $t_2->time_id . '"><span
                                            id="div_actual_target_total_' . $t_2->time_id . '"
                                            class="div_actual_target_total_' . $g_line_id . '"></span></td>
                                </tr>
                                <tr class="text-white">
                                    <td id="td_div_actual_target_percent_' . $t_2->time_id . '" colspan="2"><span
                                            id="div_actual_target_percent_' . $t_2->time_id . '"></span>
                                    </td>
                                </tr>
                            </table>

                            <script>
                                            var prev_target = parseInt($("#div_actual_target_' . $prev_target . '").text());
        var current_target = parseInt($("#div_actual_target_' . $current_target . '").text());

        var total = prev_target+current_target;
        var current_target_total = $("#div_actual_target_total_' . $current_target . '");

        if(Number.isNaN(total)){
        current_target_total.text("");
        }
        if(!Number.isNaN(total)){
        current_target_total.text(total);
        }

        var new_div_actual_target_total_prev = $("#div_actual_target_total_' . $prev_target . '").text();
        var new_div_actual_target_total_current = $("#div_actual_target_total_' . $current_target . '");
        var new_div_actual_target_prev = $("#div_actual_target_' . $prev_target . '").text();
        var new_div_actual_target_current = $("#div_actual_target_' . $current_target . '").text();

        if(new_div_actual_target_total_prev!=""){
        var new_total = parseInt(new_div_actual_target_total_prev) + parseInt(new_div_actual_target_current);
        if(Number.isNaN(new_total)){
        new_div_actual_target_total_current.text("");
        }
        if(!Number.isNaN(new_total)){
            new_div_actual_target_total_current.text(new_total);
        }
        }

        var div_target = parseInt($("#div_target_' . $current_target . '").text());
        var div_actual_target_total = parseInt($("#div_actual_target_total_' . $current_target . '").text());
        var percentage =(div_actual_target_total / div_target) * 100;
        var div_actual_target_percent = $("#div_actual_target_percent_' . $current_target . '");
        var new_div_target = $("#new_div_target_' . $current_target . '").text();
        var div_actual_target = parseInt($("#div_actual_target_' . $current_target . '").text());

        if(Number.isNaN(div_actual_target_total)){
        if(div_actual_target!=""){
            var new_percent = (div_actual_target/div_target) * 100;
            if(Number.isNaN(new_percent)){
                div_actual_target_percent.text("");
            }if(!Number.isNaN(new_percent)){
                div_actual_target_percent.text(new_percent.toFixed(1));
                if(parseInt(div_actual_target_percent.text()) >= 100){
           $("#td_div_actual_target_percent_' . $current_target . '").css("background-color","green");
        } if(parseInt(div_actual_target_percent.text()) < 100){
           $("#td_div_actual_target_percent_' . $current_target . '").css("background-color","red");
        }

        div_actual_target_percent.append("%");
            }
        }
        }
        if(!Number.isNaN(div_actual_target_total)){
        if(Number.isNaN(percentage)){
        div_actual_target_percent.text("");
        }
        if(!Number.isNaN(percentage)){
        div_actual_target_percent.text(percentage.toFixed(1));
        if(parseInt(div_actual_target_percent.text()) >= 100){
           $("#td_div_actual_target_percent_' . $current_target . '").css("background-color","green");
        } if(parseInt(div_actual_target_percent.text()) < 100){
           $("#td_div_actual_target_percent_' . $current_target . '").css("background-color","red");
        }

        div_actual_target_percent.append("%");
        }
        }


        if(parseInt(new_div_target) > parseInt(div_actual_target)){
        $("#td_div_actual_target_' . $current_target . '").css("background-color","red");
        }
        if(parseInt(new_div_target) <= parseInt(div_actual_target)){
        $("#td_div_actual_target_' . $current_target . '").css("background-color","green");
        }

        if(parseInt(div_target) > parseInt(div_actual_target_total)){
        $("#td_div_actual_target_total_' . $current_target . '").css("background-color","red");
        }
        if(parseInt(div_target) <= parseInt(div_actual_target_total)){
        $("#td_div_actual_target_total_' . $current_target . '").css("background-color","green");
        }
                            </script>
                        </td>';
                }
            }
            echo '</tr>';
        }
        echo '</tbody>
    </table>
        </div>
    </div>
    <div class="col">hello</div>
</div>
<div class="container-fluid p-0 my-3">
    <div class="row">
        <div class="col-12 col-md-8">
        <div class="div-bg-1">
        <h1 class="fw-bold heading-text fs-3 p-2">Actual Percentage Data</h1>
        <div class="panel-body">
            <table class="table table-hover table-striped table-bordered text-center">
                <thead>
                    <tr class="tr-2 tr-3">
                        <th scope="col">Line Name</th>';
        foreach ($getLine as $g_line) {
            $g_line_id = $g_line->l_id;
            $g_line_name = $g_line->l_name;
            $g_main_target = $g_line->main_target;
            echo '<th scope="col"><span class="actual_target_div_' . $g_line_id . '">' . $g_line_name . '</span></th>';
        }
        echo '</tr>
                </thead>
                <tbody>
                    <tr>
                        <th>
                            Target
                        </th>';
        foreach ($getLine as $g_line) {
            $g_line_id = $g_line->l_id;
            $g_line_name = $g_line->l_name;
            $g_main_target = $g_line->main_target;
            echo '<td id="td_main_target_actual_chart_' . $g_line_id . '">
                                <span id="main_target_actual_chart_' . $g_line_id . '"
                                    class="actual_target_div_' . $g_line_id . '"></span>
                            </td>
                            <script>
                                var g_main_target = $("#g_main_target_' . $g_line_id . '").text();
                                var main_target_actual_chart = $("#main_target_actual_chart_' . $g_line_id . '");
                                main_target_actual_chart.text(g_main_target);
                            </script>';
        }
        echo '</tr>
                    <tr>
                        <th>
                            Actual
                        </th>';
        foreach ($getLine as $g_line) {
            $g_line_id = $g_line->l_id;
            $g_line_name = $g_line->l_name;
            $g_main_target = $g_line->main_target;

            echo '<td id="td_actual_target_actual_chart_' . $g_line_id . '">
                                <span id="actual_target_actual_chart_' . $g_line_id . '"
                                    class="text-white actual_target_div_' . $g_line_id . '"></span>
                            </td>
                            <script>
                                    var g_main_target = $("#g_main_target_' . $g_line_id . '").text();
                                var main_target_actual_chart = $("#main_target_actual_chart_' . $g_line_id . '");
                                main_target_actual_chart.text(g_main_target);
                                    var div_actual_target = $(".div_actual_target_total_' . $g_line_id . '");
                                if(div_actual_target.text()==""){
                                var front_div_actual_target = $(".div_actual_target_' . $g_line_id . '");
    var actual_target_array = [];
    for(var i = 0; i < front_div_actual_target.length; i++){
    actual_target_array.push($(front_div_actual_target[i]).text());
    }
    var newActualTargetArray = actual_target_array.filter(function(v){return v!==""});
    var lastActualTargetItem = newActualTargetArray[newActualTargetArray.length - 1];

    var actual_target_actual_chart = $("#actual_target_actual_chart_' . $g_line_id . '");
    actual_target_actual_chart.text(lastActualTargetItem);
    if(parseInt(actual_target_actual_chart.text()) >= parseInt(g_main_target)){
    $("#td_actual_target_actual_chart_' . $g_line_id . '").css("background-color","green");
    }
    if(parseInt(actual_target_actual_chart.text()) <= parseInt(g_main_target)){
    $("#td_actual_target_actual_chart_' . $g_line_id . '").css("background-color","red");
    }
                                }
                                if(div_actual_target.text()!=""){
    var actual_target_array = [];
    for(var i = 0; i < div_actual_target.length; i++){
    actual_target_array.push($(div_actual_target[i]).text());
    }
    var newActualTargetArray = actual_target_array.filter(function(v){return v!==""});
    var lastActualTargetItem = newActualTargetArray[newActualTargetArray.length - 1];

    var actual_target_actual_chart = $("#actual_target_actual_chart_' . $g_line_id . '");
    actual_target_actual_chart.text(lastActualTargetItem);
    if(parseInt(actual_target_actual_chart.text()) >= parseInt(g_main_target)){
    $("#td_actual_target_actual_chart_' . $g_line_id . '").css("background-color","green");
    }
    if(parseInt(actual_target_actual_chart.text()) <= parseInt(g_main_target)){
    $("#td_actual_target_actual_chart_' . $g_line_id . '").css("background-color","red");
    }
                                }
                            </script>';
        }
        echo '</tr>
                        <tr>
                            <th>
                                %
                            </th>';
        foreach ($getLine as $g_line) {
            $g_line_id = $g_line->l_id;
            $g_line_name = $g_line->l_name;
            $g_main_target = $g_line->main_target;

            echo '<td id="td_actual_percent_actual_chart_' . $g_line_id . '" class="text-white">
                                <span id="actual_target_percent_actual_chart_' . $g_line_id . '"
                                    class="actual_target_div_' . $g_line_id . '"></span>
                            </td>
                            <script>
                            var main_target_actual_chart_val = parseInt(
                                $("#main_target_actual_chart_' . $g_line_id . '").text()
                            );
                            var actual_target_actual_chart_val = parseInt(
                                $("#actual_target_actual_chart_' . $g_line_id . '").text()
                            );
                            var actual_target_percent_actual_chart = $(
                                "#actual_target_percent_actual_chart_' . $g_line_id . '"
                            );

                            var actual_percent_val = (actual_target_actual_chart_val / main_target_actual_chart_val) * 100;
                            if (Number.isNaN(actual_percent_val)) {
                                actual_target_percent_actual_chart.text("");
                            }
                            if (!Number.isNaN(actual_percent_val)) {
                                actual_percent_val = actual_percent_val;
                                actual_target_percent_actual_chart.text(actual_percent_val.toFixed(1));
                                if (parseInt(actual_target_percent_actual_chart.text()) >= 100) {
                                    $("#td_actual_percent_actual_chart_' . $g_line_id . '").css(
                                        "background-color",
                                        "green"
                                    );
                                }
                                if (parseInt(actual_target_percent_actual_chart.text()) <= 100) {
                                    $("#td_actual_percent_actual_chart_' . $g_line_id . '").css(
                                        "background-color",
                                        "red"
                                    );
                                }
                                actual_target_percent_actual_chart.append("%");
                            }
                                </script>';
        }
        echo '</tr>
                </tbody>
            </table>
        </div>
    </div>
        </div>
        <div class="col-12 col-md-4 p-sm-0 p-md-auto my-sm-2 my-md-0 top-3">
        <div class="div-bg-1">
        <h1 class="fw-bold heading-text fs-3 p-2">Top 3 Lines and Last Line Data</h1>
        <div class="panel-body">
            <table class="table table-hover table-striped table-bordered text-center">
                <tbody>
                    <script>
                        var array_class = [];
                    </script>';
        $list_num = 1;
        foreach ($top_line as $t_data) {
            $g_line_id = $t_data->line_id;
            echo '<tr id="tr_top">
                            <th id="top_name">
                                Top ' . $list_num . '
                            </th>
                            <td>
                                <span id="top_line_name_' . $g_line_id . '">' . $t_data->l_name . '</span>
                            </td>
                            <td>
                                <span id="top_actual_target_' . $g_line_id . '">' . $t_data->total_actual . '</span>
                            </td>
                            <td>
                                <span id="top_actual_percent_' . $g_line_id . '"></span>
                            </td>
                        </tr>';
            $list_num++;
            echo '<script>
                                var top_percent = $("#actual_target_percent_actual_chart_' . $g_line_id . '").text();
                            var top_actual_percent = $("#top_actual_percent_' . $g_line_id . '");
                            top_actual_percent.text(top_percent);
                            $top_1 = $("#tr_top")
                            $top_1_th = $("#top_name");
                            $top_1_td = $("#tr_top td")

                            $top_1.css("background-color","green");
                        </script>';
        }
        echo '</tbody>
            </table>
        </div>
    </div>
        </div>
    </div>
</div>';
    }
}
