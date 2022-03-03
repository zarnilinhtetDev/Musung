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

        $getLine = DB::select('SELECT "line".l_id,"line".l_name,"line_assign".assign_id,"line_assign".main_target,"line_assign".s_time,"line_assign".e_time,"line_assign".lunch_s_time,"line_assign".lunch_e_time,"line_assign".assign_date,"users".id,"users".name
        FROM line
        JOIN line_assign ON "line_assign".l_id = "line".l_id
        JOIN users ON "users".id= "line_assign".user_id
		JOIN time ON "time".line_id="line".l_id
        WHERE "line_assign".assign_date=\'' . $date_string . '\' AND "time".assign_date=\'' . $date_string . '\'
		GROUP BY "line".l_id,"line_assign".assign_id,"users".id
		ORDER BY "line".l_pos ASC');

        $top_line = DB::select('SELECT line.l_id,line.l_name,line_assign.main_target AS main_target,SUM(time.div_actual_target) AS total_actual,
        ROUND((SUM(time.div_actual_target)*100/line_assign.main_target),1) AS diff_target_percent
        FROM line
        INNER JOIN line_assign ON line_assign.l_id=line.l_id AND "line_assign".assign_date=\'' . $date_string . '\'
        Inner JOIN time ON time.line_id=line_assign.l_id AND time.assign_date=\'' . $date_string . '\'
        GROUP BY line.l_id,line.l_name,line_assign.main_target
        ORDER BY diff_target_percent DESC
        LIMIT 3');

        $last_line = DB::select('SELECT line.l_id,line.l_name,line_assign.main_target AS main_target,SUM(time.div_actual_target) AS total_actual,
        ROUND((SUM(time.div_actual_target)*100/line_assign.main_target),1) AS diff_target_percent
        FROM line
        INNER JOIN line_assign ON line_assign.l_id=line.l_id AND "line_assign".assign_date=\'' . $date_string . '\'
        Inner JOIN time ON time.line_id=line_assign.l_id AND time.assign_date=\'' . $date_string . '\'
        GROUP BY line.l_id,line.l_name,line_assign.main_target
        ORDER BY diff_target_percent ASC
        LIMIT 1');

        $total_main_target = DB::select('SELECT SUM("line_assign".main_target) AS t_main_target FROM line_assign WHERE "line_assign".assign_date=\'' . $date_string . '\'');

        $total_div_target = DB::select('SELECT ROW_NUMBER() OVER(ORDER BY "time".time_name ASC) AS row_num_1,SUM("time".div_target) AS t_div_target,"time".time_name FROM time WHERE "time".assign_date=\'' . $date_string . '\'
        GROUP BY "time".time_name ORDER BY "time".time_name DESC OFFSET 1');

        $total_div_actual_target = DB::select('SELECT ROW_NUMBER() OVER(ORDER BY "time".time_name ASC) AS row_num,SUM("time".div_actual_target) AS t_div_actual_target_1,"time".time_name FROM time WHERE "time".assign_date=\'' . $date_string . '\'
        GROUP BY "time".time_name ORDER BY "time".time_name DESC OFFSET 1');

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
        $last_line_decode = json_decode(json_encode($last_line), true);

        DB::disconnect('musung');

        if ($time == true && $time_2 == true && $getLine == true && $top_line == true && $line_assign_apex_chart == true && $line_apex_chart == true && $time_apex_chart == true) {
            echo '<div class="container-fluid">
        <ul class="horizontal-slide" style="" id="tabs">
            <li class="span2 bg-transparent">
                <input class="icon-btn-one btn my-2" type="submit" value="Date - ' . $getDate . '" />
            </li>
            <li class="span2 bg-transparent">';
?>
            <button onclick="tablesToExcel(['history_dash_1','history_dash_2','history_dash_3'], ['Table1','Table2','Table3'], '<?php echo $getDate; ?>.xls', 'Excel')" class="icon-btn-one icon-btn-one-2 btn my-2">Export to Excel</button>
            </li>
            <li class="span2 bg-transparent">
                <button type="button" id="exportPDF" class="icon-btn-one icon-btn-one-2 btn my-2">Export to PDF</button>
            </li>
            </ul>
            </div>

            <?php echo '<div id="history_div"><div class="row container-fluid p-0 my-3 mx-auto">

                <div class="col-12 col-md-8 p-sm-0 p-md-auto my-sm-2 my-md-0 top-3">
                    <div class="panel-body">
                        <table class="table table-hover table-striped table-bordered text-center table-dash" id="history_dash_1">
                            <thead>
                                <tr class="tr-2 tr-3">
                                    <th scope="col">Line</th>
                                    <th scope="col">Target</th>';

            foreach (array_reverse($time) as $t) {
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
                                    <td style="vertical-align: middle;">' . $g_line_name . '</td>
                                    <td style="vertical-align: middle;"><span id="g_main_target_' . $g_line_id . '">' . $g_main_target . '</span></td>';

                foreach ($time_2 as $t_2) {
                    if ($g_line_id == $t_2->line_id && $t_2->time_name != 'temp') {
                        $current_target = $t_2->time_id;
                        $prev_target = ((int)$current_target) - 1;

                        echo '<td>
                                        <table class="w-100 text-center table table-bordered m-0">
                                            <tr>
                                                <td><span id="new_div_target_' . $t_2->time_id . '">' . $t_2->actual_target_entry . '</span></td>
                                                <td><span id="div_target_' . $t_2->time_id . '">' . $t_2->div_target . '</span>
                                                </td>
                                            </tr>
                                            <tr class="text-white">
                                                <td id="td_div_actual_target_' . $t_2->time_id . '">
                                                    <span id="div_actual_target_' . $t_2->time_id . '" class="div_actual_target_' . $g_line_id . '">' . $t_2->div_actual_target . '</span>
                                                </td>
                                                <td id="td_div_actual_target_total_' . $t_2->time_id . '"><span id="div_actual_target_total_' . $t_2->time_id . '" class="div_actual_target_total_' . $g_line_id . '"></span></td>
                                            </tr>
                                            <tr class="text-white">
                                                <td id="td_div_actual_target_percent_' . $t_2->time_id . '" colspan="2"><span id="div_actual_target_percent_' . $t_2->time_id . '"></span>
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

                                            var div_target = parseInt($("#div_target_' . $current_target . '").text());
                                            var div_actual_target_total = parseInt($("#div_actual_target_total_' . $current_target . '").text());
                                            var percentage = (div_actual_target_total / div_target) * 100;
                                            var div_actual_target_percent = $("#div_actual_target_percent_' . $current_target . '");
                                            var new_div_target = $("#new_div_target_' . $current_target . '").text();
                                            var div_actual_target = parseInt($("#div_actual_target_' . $current_target . '").text());

                                            if (Number.isNaN(div_actual_target_total)) {
                                                if (div_actual_target != "") {
                                                    var new_percent = (div_actual_target / div_target) * 100;
                                                    if (Number.isNaN(new_percent)) {
                                                        div_actual_target_percent.text("");
                                                    }
                                                    if (!Number.isNaN(new_percent)) {
                                                        div_actual_target_percent.text(new_percent.toFixed(1));
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
                                            if (!Number.isNaN(div_actual_target_total)) {
                                                if (Number.isNaN(percentage)) {
                                                    div_actual_target_percent.text("");
                                                }
                                                if (!Number.isNaN(percentage)) {
                                                    div_actual_target_percent.text(percentage.toFixed(1));
                                                    if (parseInt(div_actual_target_percent.text()) >= 100) {
                                                        $("#td_div_actual_target_percent_' . $current_target . '").css("background-color", "green");
                                                    }
                                                    if (parseInt(div_actual_target_percent.text()) < 100) {
                                                        $("#td_div_actual_target_percent_' . $current_target . '").css("background-color", "red");
                                                    }

                                                    div_actual_target_percent.append("%");
                                                }
                                            }


                                            if (parseInt(new_div_target) > parseInt(div_actual_target)) {
                                                $("#td_div_actual_target_' . $current_target . '").css("background-color", "red");
                                            }
                                            if (parseInt(new_div_target) <= parseInt(div_actual_target)) {
                                                $("#td_div_actual_target_' . $current_target . '").css("background-color", "green");
                                            }

                                            if (parseInt(div_target) > parseInt(div_actual_target_total)) {
                                                $("#td_div_actual_target_total_' . $current_target . '").css("background-color", "red");
                                            }
                                            if (parseInt(div_target) <= parseInt(div_actual_target_total)) {
                                                $("#td_div_actual_target_total_' . $current_target . '").css("background-color", "green");
                                            }
                                        </script>
                                    </td>
                                ';
                    }
                }
                echo '</tr>';
            }

            echo '<tr>
            <td style="vertical-align: middle;">Total</td>';
            for ($k = 0; $k < count($total_main_target_decode); $k++) {
                echo '<td style="vertical-align: middle;"><span id="">' . $total_main_target_decode[$k]["t_main_target"] . '</span></td>';
            }
            for ($l = count($total_div_target_decode) - 1; $l >= 0; $l--) {
                $total_time_name = $total_div_target_decode[$l]["time_name"];
                echo '<td id="' . $total_div_target_decode[$l]['time_name'] . '">
                <table class="w-100 text-center table table-bordered m-0">
                    <tr>
                        <td><span id="new_t_div_target_num_' . $total_div_target_decode[$l]['row_num_1'] . '">' . $total_div_target_decode[$l]['t_div_target'] . '</span></td>
                    </tr>';

                for ($m = 0; $m < count($total_div_actual_target_decode); $m++) {
                    if ($total_time_name == $total_div_actual_target_decode[$m]['time_name']) {
                        $prev_row_num = $total_div_actual_target_decode[$m]['row_num'] - 1;

                        echo '<tr class="text-white">
                        <input type="hidden"
                            id="new_t_div_actual_target_num_' . $total_div_actual_target_decode[$m]['row_num'] . '"
                            value="' . $total_div_actual_target_decode[$m]['t_div_actual_target_1'] . '" />
                        <td id="td_tmp_num_' . $total_div_actual_target_decode[$m]['row_num'] . '">
                            <span id="tmp_num_' . $total_div_actual_target_decode[$m]['row_num'] . '" class="">' . $total_div_actual_target_decode[$m]['t_div_actual_target_1'] . '</span>
                        </td>
                    </tr>
                    <tr class="text-white">
                        <td id="total_percent_' . $total_div_actual_target_decode[$m]['row_num'] . '" colspan="2">
                        </td>
                    </tr>';
            ?>
                        <script>
                            var curr_target_num_val = $("#new_t_div_actual_target_num_<?php echo $total_div_actual_target_decode[$m]['row_num']; ?>");
                            var prev_target_num_val = parseInt($("#new_t_div_actual_target_num_<?php echo $prev_row_num; ?>").val());
                            var curr_target_val = parseInt("<?php echo $total_div_actual_target_decode[$m]['t_div_actual_target_1']; ?>");
                            var tmp_num_val = $("#tmp_num_<?php echo $total_div_actual_target_decode[$m]['row_num']; ?>");

                            var total_row_num_val = prev_target_num_val + curr_target_val;
                            // console.log(total_row_num_val);

                            var new_t_div_target_num = parseInt($("#new_t_div_target_num_<?php echo $total_div_actual_target_decode[$m]['row_num']; ?>").text());
                            var new_t_div_actual_target_num = parseInt($("#new_t_div_actual_target_num_<?php echo $total_div_actual_target_decode[$m]['row_num']; ?>").val());
                            var total_percentage = (new_t_div_actual_target_num / new_t_div_target_num) * 100;
                            var new_total_percent = $("#total_percent_<?php echo $total_div_actual_target_decode[$m]['row_num']; ?>");
                            var tmp_num = $("#tmp_num_<?php echo  $total_div_actual_target_decode[$m]['row_num']; ?>").text();
                            new_total_percent.text(total_percentage.toFixed(1));

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
                                new_total_percent.text(total_percentage.toFixed(1));
                                if (parseInt(new_t_div_actual_target_num) >= 100) {
                                    $("#total_percent_<?php echo  $total_div_actual_target_decode[$m]['row_num']; ?>").css("background-color", "green");
                                }
                                if (parseInt(new_t_div_actual_target_num) < 100) {
                                    $("#total_percent_<?php echo $total_div_actual_target_decode[$m]['row_num']; ?>").css("background-color", "red");
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

            <?php
            echo '<tr/>';
            echo '</tr></tbody>
                        </table>
                    </div>
                </div>
                <div class="col-12 col-md-4 p-sm-0 p-md-2 my-sm-2 my-md-0 top-3">
                    <h1 class="fw-bold heading-text fs-3 p-0">Target and Actual Target Chart</h1>
                    <div id="history_chart"></div>
                </div>';

            ?>
            <script>
                var getTheme = localStorage.getItem("style");
                if (getTheme == 'light') {
                    var options = {
                        series: [{
                            name: "Actual Target",
                            data: [<?php for ($i = 0; $i < count($arr_decode); $i++) {
                                        $total_actual_target = $arr_decode[$i]['total_actual_target'];
                                        echo $total_actual_target . ',';
                                    } ?>]
                        }, {
                            name: "Target",
                            data: [<?php for ($j = 0; $j < count($line_assign_apex_chart_decode); $j++) {
                                        echo $line_assign_apex_chart_decode[$j]['main_target'] . ',';
                                    } ?>]
                        }, ],
                        chart: {
                            type: "bar",
                            height: 350,
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
                        xaxis: {
                            categories: [<?php
                                            for ($z = 0; $z < count($line_apex_chart_decode); $z++) {
                                                echo '"' . $line_apex_chart_decode[$z]['l_name'] . '"' . ',';
                                            } ?>],
                            title: {
                                text: "Target and Actual Target",
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
                    };

                    var chart = new ApexCharts(document.querySelector("#history_chart"), options);

                    chart.render();
                }
                if (getTheme == 'dark') {
                    var options = {
                        series: [{
                            name: "Actual Target",
                            data: [<?php for ($i = 0; $i < count($arr_decode); $i++) {
                                        $total_actual_target = $arr_decode[$i]['total_actual_target'];
                                        echo $total_actual_target . ',';
                                    } ?>]
                        }, {
                            name: "Target",
                            data: [<?php for ($j = 0; $j < count($line_assign_apex_chart_decode); $j++) {
                                        echo $line_assign_apex_chart_decode[$j]['main_target'] . ',';
                                    } ?>]
                        }, ],
                        chart: {
                            type: "bar",
                            height: 350,
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
                                colors: '#fff',
                                useSeriesColors: false,
                            },
                        },
                        xaxis: {
                            categories: [<?php
                                            for ($z = 0; $z < count($line_apex_chart_decode); $z++) {
                                                echo '"' . $line_apex_chart_decode[$z]['l_name'] . '"' . ',';
                                            } ?>],
                            title: {
                                text: "Target and Actual Target",
                                style: {
                                    fontSize: '14px',
                                    fontWeight: 'bold',
                                    color: '#fff'
                                },
                            },
                            labels: {
                                show: true,
                                style: {
                                    colors: '#fff',
                                    fontSize: '12px',
                                    fontFamily: 'Helvetica, Arial, sans-serif',
                                    fontWeight: 400,
                                    cssClass: 'apexcharts-xaxis-label',
                                },
                            },
                        },
                        yaxis: {
                            labels: {
                                show: true,
                                style: {
                                    colors: '#fff',
                                },
                            },
                        },
                        tooltip: {
                            theme: 'dark'
                        },
                        fill: {
                            opacity: 1
                        },
                    };

                    var chart = new ApexCharts(document.querySelector("#history_chart"), options);

                    chart.render();
                }
                if (getTheme == 'gray') {
                    var options = {
                        series: [{
                            name: "Actual Target",
                            data: [<?php for ($i = 0; $i < count($arr_decode); $i++) {
                                        $total_actual_target = $arr_decode[$i]['total_actual_target'];
                                        echo $total_actual_target . ',';
                                    } ?>]
                        }, {
                            name: "Target",
                            data: [<?php for ($j = 0; $j < count($line_assign_apex_chart_decode); $j++) {
                                        echo $line_assign_apex_chart_decode[$j]['main_target'] . ',';
                                    } ?>]
                        }, ],
                        chart: {
                            type: "bar",
                            height: 350,
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
                                colors: '#fff',
                                useSeriesColors: false,
                            },
                        },
                        xaxis: {
                            categories: [<?php
                                            for ($z = 0; $z < count($line_apex_chart_decode); $z++) {
                                                echo '"' . $line_apex_chart_decode[$z]['l_name'] . '"' . ',';
                                            } ?>],
                            title: {
                                text: "Target and Actual Target",
                                style: {
                                    fontSize: '14px',
                                    fontWeight: 'bold',
                                    color: '#fff'
                                },
                            },
                            labels: {
                                show: true,
                                style: {
                                    colors: '#fff',
                                    fontSize: '12px',
                                    fontFamily: 'Helvetica, Arial, sans-serif',
                                    fontWeight: 400,
                                    cssClass: 'apexcharts-xaxis-label',
                                },
                            },
                        },
                        yaxis: {
                            labels: {
                                show: true,
                                style: {
                                    colors: '#fff',
                                },
                            },
                        },
                        tooltip: {
                            theme: 'dark'
                        },
                        fill: {
                            opacity: 1
                        },
                    };

                    var chart = new ApexCharts(document.querySelector("#history_chart"), options);

                    chart.render();
                }
            </script>
        <?php
            echo '</div>
<div class="container-fluid p-0 my-3">
    <div class="row">
        <div class="col-12 col-md-8">
        <div class="div-bg-1">
        <h1 class="fw-bold heading-text fs-3 p-2">Actual Percentage Data</h1>
        <div class="panel-body">
            <table class="table table-hover table-striped table-bordered text-center" id="history_dash_2">
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
            <table class="table table-hover table-striped table-bordered text-center" id="history_dash_3">
                <tbody>
                    <script>
                        var array_class = [];
                    </script>';
            $list_num = 1;
            for ($c = 0; $c < count($top_line_decode); $c++) {
                $g_line_id = $top_line_decode[$c]['l_id'];
                echo '<tr id="tr_top">
                            <th id="top_name">
                                Top ' . $list_num . '
                            </th>
                            <td>
                                <span id="top_line_name_' . $g_line_id . '">' . $top_line_decode[$c]['l_name'] . '</span>
                            </td>
                            <td>
                                <span id="top_actual_target_' . $g_line_id . '">' . $top_line_decode[$c]['total_actual'] . '</span>
                            </td>
                            <td>
                                <span id="top_actual_percent_' . $g_line_id . '">' . $top_line_decode[$c]['diff_target_percent'] . '%</span>
                            </td>
                        </tr>';
                $list_num++;
                echo '<script>
                            //     var top_percent = $("#actual_target_percent_actual_chart_' . $g_line_id . '").text();
                            // var top_actual_percent = $("#top_actual_percent_' . $g_line_id . '");
                            // top_actual_percent.text(top_percent);
                            $top_1 = $("#tr_top")
                            // $top_1_th = $("#top_name");
                            // $top_1_td = $("#tr_top td")

                            $top_1.css("background-color","green");
                        </script>';
            }
            echo '<tr id="tr-last">
            <th id="last_name">
                Last Line
            </th>';
            for ($d = 0; $d < count($last_line_decode); $d++) {
                echo '<td>
                <span id="">' . $last_line_decode[$d]['l_name'] . '</span>
            </td>
            <td>
                <span id="">' . $last_line_decode[$d]['total_actual'] . '</span>
            </td>
            <td>
                <span id="">' . $last_line_decode[$d]['diff_target_percent'] . '%</span>
            </td>';
            }

            echo '</tr>';
            echo '</tbody>
            </table>
        </div>
    </div>
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
                var date = "<?php echo $date_string_for_export_pdf; ?>" + "_production_dashboard";

                var element = document.getElementById('history_div');
                var opt = {
                    margin: 0.1,
                    filename: date + '.pdf',
                    image: {
                        type: 'jpeg',
                        quality: 1
                    },
                    html2canvas: {
                        scale: 2
                    },
                    jsPDF: {
                        unit: 'in',
                        format: 'a4',
                        orientation: 'landscape'
                    },
                    enableLinks: true,
                };

                // New Promise-based usage:
                html2pdf().set(opt).from(element).save();

                // Old monolithic-style usage:
                html2pdf(element, opt);
            });
        </script>
<?php
    }
}
