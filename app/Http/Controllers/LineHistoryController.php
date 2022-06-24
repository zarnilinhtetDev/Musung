<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\LineAssign;
use App\Models\Line;

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
        $date_string_for_export_pdf = date("Y_m_d", strtotime($getDate));

        $time = DB::select('SELECT time_name FROM time
        JOIN line_assign ON "time".assign_id="line_assign".assign_id AND
        "line_assign".assign_date=\'' . $date_string . '\' GROUP BY time_name ORDER BY time_name DESC OFFSET 1');

        $time_2 = DB::select('SELECT "time".time_id,"time".time_name,"time".line_id,"time".assign_id,"time".status,"time".div_target,"time".div_actual_target,"time".div_actual_percent,"time".actual_target_entry FROM time,line_assign WHERE "time".assign_id="line_assign".assign_id AND "line_assign".assign_date=\'' . $date_string . '\' ORDER BY "time".time_id ASC');

        $target_total = DB::select('SELECT "time".line_id,"time".assign_id,SUM("time".actual_target_entry) AS total
        FROM time,line_assign WHERE "time".assign_id="line_assign".assign_id
        AND "line_assign".assign_date=\'' . $date_string . '\'
               GROUP BY "time".assign_id,"time".line_id');

        $actual_target_total = DB::select('SELECT "time".line_id,"time".assign_id,SUM("time".div_actual_target) AS total_actual_target
        FROM time,line_assign WHERE "time".assign_id="line_assign".assign_id AND "line_assign".assign_date=\'' . $date_string . '\'
        GROUP BY "time".line_id,"time".assign_id');

        $getLine = DB::select('SELECT "line".l_id,"line".l_name,"line_assign".assign_id,"line_assign".main_target,"line_assign".ot_main_target,"line_assign".m_power,"line_assign".actual_m_power,
        "line_assign".hp,"line_assign".actual_hp,"line_assign".s_time,"line_assign".e_time,"line_assign".lunch_s_time,"line_assign".lunch_e_time,
        "line_assign".assign_date,"users".id,"users".name
                FROM line
                JOIN line_assign ON "line_assign".l_id = "line".l_id
                JOIN users ON "users".id= "line_assign".user_id
                JOIN time ON "time".line_id="line".l_id
                WHERE "line_assign".assign_date=\'' . $date_string . '\'
                AND "time".assign_date=\'' . $date_string . '\'
                GROUP BY "line".l_id,"line_assign".assign_id,"users".id
                ORDER BY "line".l_pos ASC');


        $top_line = DB::select('SELECT line.l_id,line.l_name,line_assign.main_target AS main_target,SUM(time.div_actual_target) AS total_actual,
        ROUND((SUM(time.div_actual_target)*100/line_assign.main_target),0) AS diff_target_percent,
        ROW_NUMBER() OVER(ORDER BY  ROUND((SUM(time.div_actual_target)*100/line_assign.main_target),0) DESC) AS row_num
        FROM line
        INNER JOIN line_assign ON line_assign.l_id=line.l_id AND "line_assign".assign_date=\'' . $date_string . '\'
        Inner JOIN time ON time.line_id=line_assign.l_id AND time.assign_date=\'' . $date_string . '\'
        WHERE "time".div_actual_target IS NOT NULL
        GROUP BY line.l_id,line.l_name,line_assign.main_target
        ORDER BY diff_target_percent DESC');

        /// For Larapex Chart
        $top_line_2 = DB::select('SELECT line.l_id,line.l_name,line_assign.main_target AS main_target,SUM(time.div_actual_target) AS total_actual,
        ROUND((SUM(time.div_actual_target)*100/line_assign.main_target),0) AS diff_target_percent,
        ROW_NUMBER() OVER(ORDER BY  ROUND((SUM(time.div_actual_target)*100/line_assign.main_target),0) DESC) AS row_num
        FROM line
        INNER JOIN line_assign ON line_assign.l_id=line.l_id AND "line_assign".assign_date=\'' . $date_string . '\'
        Inner JOIN time ON time.line_id=line_assign.l_id AND time.assign_date=\'' . $date_string . '\'
        GROUP BY line.l_id,line.l_name,line_assign.main_target
        ORDER BY "line".l_pos ASC');
        /// For Larapex Chart End

        $total_inline = DB::select('SELECT "p_detail".l_id,SUM("p_detail".inline) AS total_inline
        FROM p_detail
        JOIN line_assign ON "line_assign".assign_id="p_detail".assign_id AND "line_assign".l_id="p_detail".l_id
        AND "line_assign".assign_date=\'' . $date_string . '\'
        GROUP BY "p_detail".l_id');

        $p_detail_2 = DB::select('SELECT "p_detail".p_detail_id,"p_detail".l_id,"p_detail".p_name,"p_detail".style_no
        FROM p_detail
        JOIN line_assign ON "line_assign".assign_id="p_detail".assign_id AND "p_detail".l_id="line_assign".l_id AND "line_assign".assign_date=\'' . $date_string . '\'
        ORDER BY "p_detail".p_detail_id ASC');

        $p_detail_3 = DB::select('SELECT DISTINCT "p_detail".l_id,"p_detail".p_name
        FROM p_detail
        JOIN line_assign ON "line_assign".assign_id="p_detail".assign_id AND "p_detail".l_id="line_assign".l_id AND "line_assign".assign_date=\'' . $date_string . '\'
        ');

        $total_main_target = DB::select('SELECT SUM("line_assign".main_target) AS t_main_target, SUM("line_assign".ot_main_target) AS ot_main_target FROM line_assign WHERE "line_assign".assign_date=\'' . $date_string . '\'');

        $total_div_target = DB::select('SELECT ROW_NUMBER() OVER(ORDER BY "time".time_name ASC) AS row_num_1,SUM("time".actual_target_entry) AS t_div_target,"time".time_name FROM time WHERE "time".assign_date=\'' . $date_string . '\'
        GROUP BY "time".time_name ORDER BY "time".time_name DESC OFFSET 1');

        $total_div_actual_target = DB::select('SELECT ROW_NUMBER() OVER(ORDER BY "time".time_name ASC) AS row_num,SUM("time".div_actual_target) AS t_div_actual_target_1,"time".time_name FROM time WHERE "time".assign_date=\'' . $date_string . '\'
        GROUP BY "time".time_name ORDER BY "time".time_name DESC OFFSET 1');

        $total_overall_target = DB::select('SELECT SUM("time".actual_target_entry) AS t_overall_target
        FROM time WHERE "time".assign_date=\'' . $date_string . '\'');

        $total_overall_actual_target = DB::select('SELECT SUM("time".div_actual_target) AS t_overall_actual_target
        FROM time WHERE "time".assign_date=\'' . $date_string . '\'');

        $line_assign_apex_chart = LineAssign::select('main_target')->orderBy('l_id', 'asc')->where('assign_date', $date_string)->get();

        $line_apex_chart = DB::select('SELECT "line".l_id,"line".l_name FROM line,line_assign WHERE "line".is_delete=0 AND "line".l_id="line_assign".l_id AND "line_assign".assign_date=\'' . $date_string . '\' ORDER BY "line".l_pos ASC');

        $time_apex_chart = DB::select('SELECT SUM("time".div_actual_target) AS total_actual_target FROM time
        JOIN line_assign ON "line_assign".l_id = "time".line_id AND "line_assign".assign_date="time".assign_date AND
        "line_assign".assign_date=\'' . $date_string . '\'
        GROUP BY "time".line_id ORDER BY "time".line_id ASC');

        $arr_decode = json_decode(json_encode($time_apex_chart), true);

        $line_assign_apex_chart_decode = json_decode(json_encode($line_assign_apex_chart), true);
        $line_apex_chart_decode = json_decode(json_encode($line_apex_chart), true);
        $total_main_target_decode = json_decode(json_encode($total_main_target), true);
        $total_div_target_decode = json_decode(json_encode($total_div_target), true);
        $total_div_actual_target_decode = json_decode(json_encode($total_div_actual_target), true);
        $top_line_decode = json_decode(json_encode($top_line), true);
        $top_line_decode_2 = json_decode(json_encode($top_line_2), true);
        $total_overall_target_decode = json_decode(json_encode($total_overall_target), true);
        $total_overall_actual_target_decode = json_decode(json_encode($total_overall_actual_target), true);
        $target_total_decode = json_decode(json_encode($target_total), true);
        $actual_total_decode = json_decode(json_encode($actual_target_total), true);

        DB::disconnect('musung');

        if ($time == true && $time_2 == true && $getLine == true && $top_line == true && $line_assign_apex_chart == true && $line_apex_chart == true && $time_apex_chart == true) {
            echo '<div class="container-fluid">
        <ul class="horizontal-slide" style="" id="tabs">
            <li class="span2 bg-transparent">
                <input class="icon-btn-one btn my-2" type="submit" value="Date - ' . $getDate . '" />
            </li>
            <li class="span2 bg-transparent">';
?>
            <a id="dlink" style="display:none;"></a>
            <div id="name" style="display:none;"><?php echo $date_string_for_export_pdf . "_live_dash"; ?></div>
            <button id="btn" class="icon-btn-one icon-btn-one-2 btn my-2">Export to Excel</button>
            <!-- <button onclick="tablesToExcel(['history_dash_1','history_dash_2','history_dash_3'], ['Table1','Table2','Table3'], '<?php echo $getDate; ?>.xls', 'Excel')" class="icon-btn-one icon-btn-one-2 btn my-2">Export to Excel</button> -->
            </li>
            <li class="span2 bg-transparent">
                <button type="button" id="exportPDF" class="icon-btn-one icon-btn-one-2 btn my-2">Export to PDF</button>
            </li>
            </ul>
            </div>

            <?php echo '<div id="history_div"><div class="row container-fluid p-0 my-3 mx-auto">

                <div class="col-12 col-md-8 p-sm-0 p-md-auto my-sm-2 my-md-0 top-3">
                    <div class="panel-body" id="history_dash_1">
                    <h2 class="fw-bold text-center report-title" style="display:none;">Musung Garment Co.,Ltd.</h2>
                        <table class="table table-hover table-striped table-bordered text-center table-dash" >
                            <thead>
                                <tr class="tr-2 tr-3">
                                    <th scope="col" style="vertical-align: middle;">Line</th>
                                    <th scope="col" style="vertical-align: middle;" class="p-0">
                                    <table class="w-100 text-center table m-0 text-white table-bordered">
                                        <tr class="">
                                            <th colspan="2">Manpower</th>
                                        </tr>
                                        <tr>
                                            <td>OP</td>
                                            <td>HP</td>
                                        </tr>
                                    </table>
                                </th>
                                <th scope="col" style="vertical-align: middle;">Item</th>
                    <th scope="col" style="vertical-align: middle;">Inline Stock</th>
                                    <th scope="col" style="vertical-align: middle;">Target</th>';

            foreach (array_reverse($time) as $t) {
                echo '<th scope="col" style="vertical-align: middle;">' . date('g:i A', strtotime($t->time_name)) . '</th>';
            }
            echo '<th style="vertical-align: middle;">Total</th>
            <th style="vertical-align: middle;">Rank</th>
            <th style="vertical-align: middle;">%</th>';
            echo '</tr>
                            </thead>
                            <tbody>';
            foreach ($getLine as $g_line) {
                $g_line_id = $g_line->l_id;
                $g_line_name = $g_line->l_name;
                $g_main_target = $g_line->main_target;
                $g_ot_main_target = $g_line->ot_main_target;
                $g_m_power = $g_line->m_power;
                $g_actual_m_power = $g_line->actual_m_power;
                $g_hp = $g_line->hp;
                $g_actual_hp = $g_line->actual_hp;
                $g_m_power = $g_line->m_power;
                $g_actual_m_power = $g_line->actual_m_power;
                $g_hp = $g_line->hp;
                $g_actual_hp = $g_line->actual_hp;

                echo '<tr>
                                    <td style="vertical-align: middle;">' . $g_line_name . '</td>
                                    <td>
                                    <table class="w-100 text-center table m-0 table-bordered">
                                    <tr>
                                        <td>' . $g_m_power . '</td>
                                        <td>' . $g_hp . '</td>
                                    </tr>
                                    <tr>
                                        <td>' . $g_actual_m_power . '</td>
                                        <td>' . $g_actual_hp . '</td>
                                    </tr>
                                </table>
                                </td>
                               <td>
                               <table class="m-auto text-start table table-bordered">
                        <tbody>';

                foreach ($p_detail_3 as $p_3) {
                    if ($p_3->l_id == $g_line_id) {
                        echo '<tr style="border-bottom: 1px solid #848484;">
                            <td>
                                <div class="text-center">
                                    ' . $p_3->p_name . '
                                </div>
                            </td>
                        </tr>';
                    }
                }
                echo '</tbody>
                </table>
                </td>
                <td style="vertical-align: middle;">';
                foreach ($total_inline as $t_inline) {
                    if ($t_inline->l_id == $g_line_id) {
                        echo $t_inline->total_inline;
                    }
                }
                echo '</td>
                <td style="vertical-align: middle;"><span id="g_main_target_' . $g_line_id . '">';

                if ($g_ot_main_target != '') {
                    echo number_format($g_main_target + $g_ot_main_target);
                } else {
                    echo number_format($g_main_target);
                }

                echo '</span></td>';

                foreach ($time_2 as $t_2) {
                    if ($g_line_id == $t_2->line_id && $t_2->time_name != 'temp') {
                        $current_target = $t_2->time_id;
                        $prev_target = ((int)$current_target) - 1;

                        echo '<td>
                    <table class="w-100 text-center table table-bordered m-0">
                        <tr>
                            <td><span id="new_div_target_' . $t_2->time_id . '">';

                        if ($t_2->actual_target_entry <= 0) {
                            echo '';
                        } else {
                            echo number_format($t_2->actual_target_entry);
                        }
                        echo '</span></td>
                        </tr>
                        <tr class="text-white">
                            <td id="td_div_actual_target_' . $t_2->time_id . '">
                                <span id="div_actual_target_' . $t_2->time_id . '" class="div_actual_target_' . $g_line_id . '">';
                        if ($t_2->div_actual_target != '') {
                            echo number_format($t_2->div_actual_target);
                        }
                        echo '</span>
                            </td>
                        </tr>
                        <tr class="text-white">
                            <td id="td_div_actual_target_percent_' . $t_2->time_id . '"><span id="div_actual_target_percent_' . $t_2->time_id . '"></span>
                            </td>
                        </tr>
                    </table>

                    <script>
                        var prev_target = parseInt($("#div_actual_target_' . $prev_target . '").text());
                        var current_target = parseInt($("#div_actual_target_' . $current_target . '").text());

                        var total = prev_target + current_target;
                        var current_target_total = $("#div_actual_target_total_' . $current_target . '");

                        if (Number.isNaN(total)) {
                            current_target_total.text("");
                        }
                        if (!Number.isNaN(total)) {
                            current_target_total.text(total);
                        }

                        var new_div_actual_target_total_prev = $("#div_actual_target_total_' . $prev_target . '").text();
                        var new_div_actual_target_total_current = $("#div_actual_target_total_' . $current_target . '");
                        var new_div_actual_target_prev = $("#div_actual_target_' . $prev_target . '").text();
                        var new_div_actual_target_current = $("#div_actual_target_' . $current_target . '").text();

                        if (new_div_actual_target_total_prev != "") {
                            var new_total = parseInt(new_div_actual_target_total_prev) + parseInt(new_div_actual_target_current);
                            if (Number.isNaN(new_total)) {
                                new_div_actual_target_total_current.text("");
                            }
                            if (!Number.isNaN(new_total)) {
                                new_div_actual_target_total_current.text(new_total);
                            }
                        }


                        var new_div_target = $("#new_div_target_' . $current_target . '").text();
                        var div_actual_target = parseInt($("#div_actual_target_' . $current_target . '").text());

                        var percentage = (div_actual_target / new_div_target) * 100;
                        var div_actual_target_percent = $("#div_actual_target_percent_' . $current_target . '");

                        if (Number.isNaN(div_actual_target)) {
                            if (div_actual_target != "") {
                                var new_percent = (div_actual_target / new_div_target) * 100;
                                if (Number.isNaN(new_percent)) {
                                    div_actual_target_percent.text("");
                                }
                                if (!Number.isNaN(new_percent)) {
                                    div_actual_target_percent.text(parseInt(new_percent));
                                    if (parseInt(div_actual_target_percent.text()) >= 100) {
                                        $("#td_div_actual_target_percent_' . $current_target . '").css("background-color", "green");
                                    }
                                    if (parseInt(div_actual_target_percent.text()) < 100) {
                                        $("#td_div_actual_target_percent_' . $current_target . '").css("background-color", "red");
                                    }

                                    div_actual_target_percent.append("%");
                                }
                            }
                        }
                        if (!Number.isNaN(div_actual_target)) {
                            if (Number.isNaN(percentage)) {
                                div_actual_target_percent.text("");
                            }
                            if (!Number.isNaN(percentage)) {
                                div_actual_target_percent.text(parseInt(percentage));
                                if (parseInt(div_actual_target_percent.text()) >= 100) {
                                    $("#td_div_actual_target_percent_' . $current_target . '").css("background-color", "green");
                                }
                                if (parseInt(div_actual_target_percent.text()) < 100) {
                                    $("#td_div_actual_target_percent_' . $current_target . '").css("background-color", "red");
                                }


if(parseInt(div_actual_target_percent.text()) <= 80){
    $("#td_div_actual_target_percent_' . $current_target . '").css("background-color","rgba(255,0,0,0.8)");
    $("#td_div_actual_target_' . $current_target . '").css("background-color","rgba(255,0,0,0.8)");
 }if(parseInt(div_actual_target_percent.text()) > 80){
    $("#td_div_actual_target_percent_' . $current_target . '").css({"background-color":"#FF8000","color":"#fff"});
    $("#td_div_actual_target_' . $current_target . '").css({"background-color":"#FF8000","color":"#fff"});
 }
 if(parseInt(div_actual_target_percent.text()) >= 100){
    $("#td_div_actual_target_percent_' . $current_target . '").css({"background-color":"rgba(30,113,0,1)","color":"#fff"});
    $("#td_div_actual_target_' . $current_target . '").css({"background-color":"rgba(30,113,0,1)","color":"#fff"});
 }


                                div_actual_target_percent.append("%");
                            }
                        }


                        // if (parseInt(new_div_target) > parseInt(div_actual_target)) {
                        //     $("#td_div_actual_target_' . $current_target . '").css("background-color", "red");
                        // }
                        // if (parseInt(new_div_target) <= parseInt(div_actual_target)) {
                        //     $("#td_div_actual_target_' . $current_target . '").css("background-color", "green");
                        // }
                    </script>
                </td>
                ';
                    }
                }
            ?>
                <?php
                for ($c = 0; $c < count($target_total_decode); $c++) {
                    $target_line_id = $target_total_decode[$c]['line_id'];
                    $t_total = $target_total_decode[$c]['total'];
                    if ($g_line_id == $target_total_decode[$c]['line_id'] && $target_total_decode[$c]['total'] != 0) {
                ?>
                        <td>
                            <table class="w-100 text-center table m-0">
                                <?php
                                for ($d = 0; $d < count($actual_total_decode); $d++) {
                                    $actual_target_line_id = $actual_total_decode[$d]['line_id'];
                                    $a_total = $actual_total_decode[$d]['total_actual_target'];
                                    if ($g_line_id == $actual_target_line_id) { ?>
                                        <tr>
                                            <td><span class="t_2_total_<?php echo $target_line_id; ?>"></span>
                                            </td>
                                            <script>
                                                var main_target_total = $("#g_main_target_<?php echo $g_line_id; ?>").text();
                                                var t_2_total = $(".t_2_total_<?php echo $target_line_id; ?>");
                                                t_2_total.text(main_target_total);
                                            </script>
                                        </tr>
                                        <tr class="text-white">
                                            <td class="td_a_total_<?php echo $target_line_id; ?>">
                                                <span class="a_total_<?php echo $target_line_id; ?>"><?php echo $a_total; ?></span>
                                            </td>
                                        </tr>
                                        <tr class="text-white">
                                            <td class="td_t_percent_<?php echo $target_line_id; ?>">
                                                <span class="t_percent_<?php echo $target_line_id; ?>"></span>
                                            </td>
                                        </tr>
                                        <script>
                                            var t_2_total = parseInt($('.t_2_total_<?php echo $target_line_id; ?>').text().replace(/,/g, ''));
                                            var a_total = parseInt($('.a_total_<?php echo $target_line_id; ?>').text().replace(/,/g, ''));
                                            var t_percent_span = $('.t_percent_<?php echo $target_line_id; ?>');
                                            var td_t_percent = $('.td_a_total_<?php echo $target_line_id; ?>');
                                            var td_a_percent = $('.td_t_percent_<?php echo $target_line_id; ?>');


                                            if (parseInt(t_2_total) > parseInt(a_total)) {
                                                td_a_percent.css('background-color', 'red');
                                            }
                                            if (parseInt(t_2_total) <= parseInt(a_total)) {
                                                td_a_percent.css('background-color', 'green');
                                            }

                                            if (Number.isNaN(t_2_total)) {
                                                t_percent_span.text("");
                                            }
                                            if (!Number.isNaN(t_2_total)) {
                                                var t_percent = (a_total / t_2_total) * 100;
                                                if (Number.isNaN(t_percent)) {
                                                    t_percent_span.text("");
                                                }
                                                if (!Number.isNaN(t_percent)) {
                                                    t_percent_span.text(parseInt(t_percent));

                                                    if (parseInt(t_percent_span.text()) <= 80) {
                                                        td_t_percent.css("background-color", "rgba(255,0,0,0.8)");
                                                        td_a_percent.css("background-color", "rgba(255,0,0,0.8)");
                                                    }
                                                    if (parseInt(t_percent_span.text()) > 80) {
                                                        td_t_percent.css({
                                                            "background-color": "#FF8000",
                                                            "color": "#fff"
                                                        });
                                                        td_a_percent.css({
                                                            "background-color": "#FF8000",
                                                            "color": "#fff"
                                                        });
                                                    }
                                                    if (parseInt(t_percent_span.text()) >= 100) {
                                                        td_t_percent.css({
                                                            "background-color": "rgba(30,113,0,1)",
                                                            "color": "#fff"
                                                        });
                                                        td_a_percent.css({
                                                            "background-color": "rgba(30,113,0,1)",
                                                            "color": "#fff"
                                                        });
                                                    }
                                                    t_percent_span.append('%');
                                                }
                                            }
                                        </script>
                                <?php
                                    }
                                } ?>
                            </table>
                        </td>
                <?php
                    }
                }
                ?>
                <?php for ($g = 0; $g < count($top_line_decode); $g++) {
                    $row_num = $top_line_decode[$g]['row_num'];
                    if ($g_line_id == $top_line_decode[$g]['l_id']) { ?>
                        <td style="vertical-align: middle;" class="t_line_<?php echo $row_num; ?> t_line_count">
                            <?php echo $row_num; ?>
                        </td>
                <?php
                    }
                } ?>

                <?php for ($h = 0; $h < count($top_line_decode); $h++) {
                    $row_num = $top_line_decode[$h]['row_num'];
                    $diff_target_percent = $top_line_decode[$h]['diff_target_percent'];
                    if ($g_line_id == $top_line_decode[$h]['l_id']) { ?>
                        <td style="vertical-align: middle;" class="t_line_<?php echo $row_num; ?> t_line_count">
                            <span class="input_row_num_<?php echo $row_num; ?> input_row_num" style="display:none;">
                                <?php echo $row_num; ?>
                            </span>
                            <?php echo $diff_target_percent; ?>%
                        </td>
                <?php                    }
                }
                ?>
                <script>
                    var t_line_count = $('.input_row_num').text();
                    var val_arr = [];

                    for (var i = 0; i < t_line_count.length; i++) {
                        if (t_line_count[i] != ' ' && t_line_count[i] != '\n') {
                            val_arr.push(parseInt(t_line_count[i]));
                        }
                    }

                    var lowestToHighest = val_arr.sort((a, b) => a - b);

                    var top_1 = lowestToHighest[0];
                    var top_2 = lowestToHighest[1];
                    var top_3 = lowestToHighest[2];

                    if (top_1 != '') {
                        $('.t_line_' + top_1).css({
                            'background-color': 'green',
                            'color': '#fff'
                        });
                    }
                    if (top_2 != '') {
                        $('.t_line_' + top_2).css({
                            'background-color': 'green',
                            'color': '#fff'
                        });
                    }
                    if (top_3 != '') {
                        $('.t_line_' + top_3).css({
                            'background-color': 'green',
                            'color': '#fff'
                        });
                    }

                    //// Do not delete (get last rank data)
                    var max_num = Math.max(...val_arr);
                    $(".t_line_" + 10).css({
                        'background-color': 'red',
                        'color': '#fff'
                    });
                    //// Do not delete (get last rank data)
                </script>

            <?php
                echo '</tr>';
            }

            echo '<tr>
            <td style="vertical-align: middle;">Total</td>';
            ?>

            <td></td>
            <td></td>
            <td></td>
            <?php
            for ($k = 0; $k < count($total_main_target_decode); $k++) {
                echo '<td style="vertical-align: middle;"><span id="t_main_target">' . number_format($total_main_target_decode[$k]["t_main_target"] + $total_main_target_decode[$k]["ot_main_target"]) . '</span></td>';
            }
            for ($l = count($total_div_target_decode) - 1; $l >= 0; $l--) {
                $total_time_name = $total_div_target_decode[$l]["time_name"];
                echo '<td id="' . $total_div_target_decode[$l]['time_name'] . '">
                <table class="w-100 text-center table table-bordered m-0">
                    <tr>
                        <td><span id="new_t_div_target_num_' . $total_div_target_decode[$l]['row_num_1'] . '">' . number_format($total_div_target_decode[$l]['t_div_target']) . '</span></td>
                    </tr>';

                for ($m = 0; $m < count($total_div_actual_target_decode); $m++) {
                    if ($total_time_name == $total_div_actual_target_decode[$m]['time_name']) {
                        $prev_row_num = $total_div_actual_target_decode[$m]['row_num'] - 1;

                        echo '<tr class="text-white">
                        <input type="hidden"
                            id="new_t_div_actual_target_num_' . $total_div_actual_target_decode[$m]['row_num'] . '"
                            value="' . $total_div_actual_target_decode[$m]['t_div_actual_target_1'] . '" />
                        <td id="td_tmp_num_' . $total_div_actual_target_decode[$m]['row_num'] . '">
                            <span id="tmp_num_' . $total_div_actual_target_decode[$m]['row_num'] . '" class="">';
                        if ($total_div_actual_target_decode[$m]['t_div_actual_target_1'] != '') {
                            echo number_format($total_div_actual_target_decode[$m]['t_div_actual_target_1']);
                        }
                        echo '</span>
                        </td>
                    </tr>
                    <tr class="text-white">
                        <td id="total_percent_' . $total_div_actual_target_decode[$m]['row_num'] . '">
                        </td>
                    </tr>';
            ?>
                        <script>
                            var curr_target_num_val = $("#new_t_div_actual_target_num_<?php echo $total_div_actual_target_decode[$m]['row_num']; ?>");
                            var prev_target_num_val = parseInt($("#new_t_div_actual_target_num_<?php echo $prev_row_num; ?>").val());
                            var curr_target_val = parseInt("<?php echo $total_div_actual_target_decode[$m]['t_div_actual_target_1']; ?>");
                            var tmp_num_val = $("#tmp_num_<?php echo $total_div_actual_target_decode[$m]['row_num']; ?>");

                            var total_row_num_val = prev_target_num_val + curr_target_val;
                            var new_t_div_target_num = parseInt($("#new_t_div_target_num_<?php echo $total_div_actual_target_decode[$m]['row_num']; ?>").text());
                            var new_t_div_actual_target_num = parseInt($("#new_t_div_actual_target_num_<?php echo $total_div_actual_target_decode[$m]['row_num']; ?>").val());
                            var total_percentage = (new_t_div_actual_target_num / new_t_div_target_num) * 100;
                            var new_total_percent = $("#total_percent_<?php echo $total_div_actual_target_decode[$m]['row_num']; ?>");
                            var tmp_num = $("#tmp_num_<?php echo  $total_div_actual_target_decode[$m]['row_num']; ?>").text();
                            new_total_percent.text(parseInt(total_percentage));

                            if (parseInt(new_t_div_target_num) > parseInt(tmp_num)) {
                                $("#td_tmp_num_<?php echo $total_div_actual_target_decode[$m]['row_num']; ?>").css("background-color", "red");
                            }
                            if (parseInt(new_t_div_target_num) <= parseInt(tmp_num)) {
                                $("#td_tmp_num_<?php echo $total_div_actual_target_decode[$m]['row_num']; ?>").css("background-color", "green");
                            }

                            if (Number.isNaN(total_percentage)) {
                                new_total_percent.text("");
                            }
                            if (!Number.isNaN(total_percentage)) {
                                new_total_percent.text(parseInt(total_percentage));

                                if (parseInt(total_percentage) <= 80) {
                                    $("#total_percent_<?php echo $total_div_actual_target_decode[$m]['row_num']; ?>").css('background-color', 'rgba(255,0,0,0.8)');
                                    $("#td_tmp_num_<?php echo $total_div_actual_target_decode[$m]['row_num']; ?>").css('background-color', 'rgba(255,0,0,0.8)');
                                }
                                if (parseInt(total_percentage) > 80) {
                                    $("#total_percent_<?php echo $total_div_actual_target_decode[$m]['row_num']; ?>").css({
                                        'background-color': '#FF8000',
                                        'color': '#fff'
                                    });
                                    $("#td_tmp_num_<?php echo $total_div_actual_target_decode[$m]['row_num']; ?>").css({
                                        'background-color': '#FF8000',
                                        'color': '#fff'
                                    });
                                }
                                if (parseInt(total_percentage) >= 100) {
                                    $("#total_percent_<?php echo $total_div_actual_target_decode[$m]['row_num']; ?>").css({
                                        'background-color': '#085820',
                                        'color': '#fff'
                                    });
                                    $("#td_tmp_num_<?php echo $total_div_actual_target_decode[$m]['row_num']; ?>").css({
                                        'background-color': '#085820',
                                        'color': '#fff'
                                    });
                                }
                                new_total_percent.append(" % ");
                            }
                        </script>
                <?php
                    }
                }
                ?>
                </table>
                </td>

            <?php
            }
            ?>
            <td>
                <table class="w-100 text-center table table-bordered m-0">
                    <tr>
                        <?php for ($e = 0; $e < count($total_overall_target_decode); $e++) { ?>
                            <td id="t_overall_target">

                            </td>
                            <script>
                                var t_main_target = $("#t_main_target").text();
                                var t_overall_target = $("#t_overall_target");
                                t_overall_target.text(t_main_target);
                            </script>
                        <?php } ?>

                    </tr>
                    <tr class="text-white">
                        <?php for ($f = 0; $f < count($total_overall_actual_target_decode); $f++) { ?>
                            <td id="t_overall_actual_target">
                                <?php echo $total_overall_actual_target_decode[$f]['t_overall_actual_target']; ?>
                            </td>
                        <?php }
                        ?>
                    </tr>
                    <tr class="text-white">
                        <td id="t_overall_percent"></td>
                    </tr>
                </table>
                <script>
                    var t_overall_target = parseInt($("#t_overall_target").text().replace(/,/g, ''));
                    var t_overall_actual_target = parseInt($("#t_overall_actual_target").text().replace(/,/g, ''));
                    var t_overall_percent = $("#t_overall_percent");

                    if (parseInt(t_overall_target) > parseInt(t_overall_actual_target)) {
                        $("#t_overall_actual_target").css('background-color', 'red');
                    }
                    if (parseInt(t_overall_target) <= parseInt(t_overall_actual_target)) {
                        $("#t_overall_actual_target").css('background-color', 'green');
                    }

                    var t_percent_cal = (t_overall_actual_target / t_overall_target) * 100;


                    if (Number.isNaN(t_percent_cal)) {
                        t_overall_percent.text("");
                    }
                    if (!Number.isNaN(t_percent_cal)) {
                        t_overall_percent.text(parseInt(t_percent_cal));

                        if (parseInt(t_percent_cal) <= 80) {
                            $("#t_overall_actual_target").css('background-color', 'rgba(255,0,0,0.8)');
                            t_overall_percent.css('background-color', 'rgba(255,0,0,0.8)');
                        }
                        if (parseInt(t_percent_cal) > 80) {
                            $("#t_overall_actual_target").css({
                                'background-color': '#FF8000',
                                'color': '#fff'
                            });
                            t_overall_percent.css({
                                'background-color': '#FF8000',
                                'color': '#fff'
                            });
                        }
                        if (parseInt(t_percent_cal) >= 100) {
                            $("#t_overall_actual_target").css({
                                'background-color': '#085820',
                                'color': '#fff'
                            });
                            t_overall_percent.css({
                                'background-color': '#085820',
                                'color': '#fff'
                            });
                        }
                        t_overall_percent.append('%');
                    }
                </script>
            </td>
            <td style="vertical-align:middle;" class="fw-bolder">-</td>
            <td style="vertical-align:middle;" class="fw-bolder">-</td>
            <?php
            echo '<tr/>';
            echo '</tr></tbody>
                        </table>
                    </div>
                </div>
                <div class="col-12 col-md-4 p-sm-0 p-md-2 my-sm-2 my-md-0 top-3">
                    <h1 class="fw-bold heading-text fs-3 p-0">Target and Output Chart</h1>
                    <div id="history_chart"></div>
                </div>';

            ?>
            <script>
                var getTheme = localStorage.getItem("style");
                if (getTheme == 'light') {
                    var options = {
                        chart: {
                            animations: {
                                enabled: false,
                            },
                            type: "bar",
                            height: 550,
                            style: {
                                colors: '#263238',
                                fontSize: '12px',
                                fontFamily: 'Helvetica, Arial, sans-serif',
                                fontWeight: 400,
                                cssClass: 'apexcharts-xaxis-label',
                            },
                        },
                        plotOptions: {
                            bar: {
                                horizontal: true,
                            },
                        },
                        dataLabels: {
                            enabled: true,
                        },
                        stroke: {
                            show: true,
                            width: 2,
                            colors: ["transparent"]
                        },
                        legend: {
                            show: true,
                            labels: {
                                colors: '#263238',
                                useSeriesColors: false,
                            },
                        },
                        yaxis: {
                            labels: {
                                show: true,
                                style: {
                                    colors: '#263238',
                                },
                            },
                        },
                        fill: {
                            opacity: 1
                        },
                        series: [{
                            name: "Output",
                            data: [<?php foreach ($top_line_2 as $top) {
                                        $diff_target_percent = $top->diff_target_percent;
                                        if ($diff_target_percent == '') {
                                            $diff_target_percent = 0;
                                        }
                                        echo $diff_target_percent . ',';
                                    } ?>],
                        }, ],
                        xaxis: {
                            categories: [<?php
                                            for ($z = 0; $z < count($line_apex_chart_decode); $z++) {
                                                echo '"' . $line_apex_chart_decode[$z]['l_name'] . '"' . ',';
                                            } ?>],
                            title: {
                                text: "Target and Output",
                                style: {
                                    fontSize: '14px',
                                    fontWeight: 'bold',
                                    color: '#263238'
                                },
                            },
                            labels: {
                                show: true,
                                style: {
                                    colors: '#263238',
                                    fontSize: '12px',
                                    fontFamily: 'Helvetica, Arial, sans-serif',
                                    fontWeight: 400,
                                    cssClass: 'apexcharts-xaxis-label',
                                },
                            },
                        },
                    };
                    var chart = new ApexCharts(document.querySelector("#history_chart"), options);
                    chart.render();
                }
            </script>
        <?php
            echo '</div>

        </div>
    </div>
</div>
</div>';
        } else {
            echo "<span class='text-danger fw-bold'>No Result Found</span>";
        }

        ?>


        <script>
            $("#exportPDF").click(function() {

                $(".report-title").css("display", 'block');
                $("[id=total_m_power]").css("display", "none");
                $("[id=total_actual_m_power]").css("display", "none");

                html2canvas($('#history_dash_1')[0], {
                    onrendered: function(canvas) {
                        var data = canvas.toDataURL();
                        var docDefinition = {
                            content: [{
                                image: data,
                                width: 800
                            }],
                            pageSize: 'A4',
                            pageOrientation: 'landscape',
                            pageMargins: [20, 20, 20, 20],
                        };
                        pdfMake.createPdf(docDefinition).download("<?php echo $date_string_for_export_pdf . '_dash'; ?>.pdf");
                    }
                });
            });
        </script>


        <script>
            var tableToExcel = (function() {
                var uri = 'data:application/vnd.ms-excel;base64,',
                    template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="https://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table border="1" style="text-align:center;">{table}</table></body></html>',
                    base64 = function(s) {
                        return window.btoa(unescape(encodeURIComponent(s)))
                    },
                    format = function(s, c) {
                        return s.replace(/{(\w+)}/g, function(m, p) {
                            return c[p];
                        })
                    }
                return function(table, name, filename) {
                    if (!table.nodeType) table = document.getElementById(table)
                    var ctx = {
                        worksheet: name || 'Worksheet',
                        table: table.innerHTML
                    }

                    document.getElementById("dlink").href = uri + base64(format(template, ctx));
                    document.getElementById("dlink").download = filename;
                    document.getElementById("dlink").target = "_blank";
                    document.getElementById("dlink").click();

                }
            })();

            function download() {
                $(document).find('tfoot').remove();
                var name = document.getElementById("name").innerHTML;
                tableToExcel('history_dash_1', 'Sheet 1', name + '.xls')
                //setTimeout("window.location.reload()",0.0000001);

            }
            var btn = document.getElementById("btn");
            btn.addEventListener("click", download);
        </script>
<?php
    }
}
