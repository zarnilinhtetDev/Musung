<?php

namespace App\Http\Controllers;

use App\Charts\ReportDashAreaChart;
use App\Charts\ReportDashCategoryChart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\ProductDetail;
use App\Models\LineAssign;

class ReportDashController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware(function ($request, $next) {
            $this->user = Auth::user(); // here the user should exist from the session
            return $next($request);
        });
    }
    public function index(ReportDashAreaChart $chart, ReportDashCategoryChart $category_chart)
    {
        $date_string = date("d.m.Y");

        @$date_history = $_GET['date'];
        @$format_date_string = date("d.m.Y", strtotime($date_history));

        if ($date_history) {
            $daily_report = DB::select('SELECT "line".l_id,"line".l_name,"line_assign".main_target,"line_assign".ot_main_target,"line_assign".m_power,"line_assign".assign_id,"line_assign".m_power,"line_assign".actual_m_power,"line_assign".man_target,"line_assign".man_actual_target,
            "line_assign".hp,"line_assign".actual_hp,SUM("time".div_actual_target) as total_div_actual_target,COUNT("time".assign_id) AS total_time,"line_assign".assign_date,"line_assign".remark
            FROM line
            JOIN line_assign ON "line_assign".l_id="line".l_id AND
            "line_assign".assign_date=\'' . $format_date_string . '\'
            JOIN time ON "time".line_id="line".l_id AND "time".assign_date=\'' . $format_date_string . '\' AND "time".assign_id="line_assign".assign_id WHERE ("time".ot_status IS NULL OR "time".ot_status=1) AND NOT "time".time_name=\'temp\'
            GROUP BY "line".l_id,"line_assign".main_target,"line_assign".m_power,"line_assign".actual_m_power,"line_assign".man_target,"line_assign".man_actual_target,
            "line_assign".hp,"line_assign".actual_hp,"line_assign".assign_date,"line_assign".remark,"line_assign".assign_id
            ORDER BY "line".l_pos ASC');

            $daily_report_product = DB::select('SELECT "p_detail".p_detail_id,"p_detail".l_id,"p_detail".p_name,"p_detail".quantity,"p_detail".div_quantity,"p_detail".sewing_input,"p_detail".assign_id,
            "p_detail".h_over_input,"p_detail".p_actual_target,"p_detail".cat_actual_target,"p_detail".inline,"p_detail".cmp,"buyer".buyer_name,
			"p_detail".style_no,
			"line_assign".assign_date,"line_assign".man_target,"line_assign".man_actual_target,"line_assign".remark,"p_detail".order_quantity,
			"p_detail".h_balance
            FROM p_detail
            JOIN line_assign ON "line_assign".assign_id="p_detail".assign_id AND "line_assign".assign_date=\'' . $date_string . '\'
            JOIN buyer ON "buyer".buyer_id="p_detail".p_cat_id
            ORDER BY "p_detail".p_detail_id ASC');

            $daily_report_product_2 = DB::select('SELECT DISTINCT "p_detail".l_id,"p_detail".assign_id,"line_assign".assign_date,"line_assign".man_target,"line_assign".man_actual_target
            FROM p_detail
            JOIN line_assign ON "line_assign".assign_id="p_detail".assign_id AND "line_assign".assign_date=\'' . $date_string . '\'
            JOIN p_category ON "p_category".p_cat_id="p_detail".p_cat_id
           ');
        } else {
            $daily_report = DB::select('SELECT "line".l_id,"line".l_name,"line_assign".main_target,"line_assign".ot_main_target,"line_assign".m_power,"line_assign".assign_id,"line_assign".m_power,"line_assign".actual_m_power,"line_assign".man_target,"line_assign".man_actual_target,
            "line_assign".hp,"line_assign".actual_hp,SUM("time".div_actual_target) as total_div_actual_target,COUNT("time".assign_id) AS total_time,"line_assign".assign_date,"line_assign".remark
            FROM line
            JOIN line_assign ON "line_assign".l_id="line".l_id AND
            "line_assign".assign_date=\'' . $date_string . '\'
            JOIN time ON "time".line_id="line".l_id AND "time".assign_date=\'' . $date_string . '\' AND "time".assign_id="line_assign".assign_id WHERE ("time".ot_status IS NULL OR "time".ot_status=1) AND NOT "time".time_name=\'temp\'
            GROUP BY "line".l_id,"line_assign".main_target,"line_assign".m_power,"line_assign".actual_m_power,"line_assign".man_target,"line_assign".man_actual_target,
            "line_assign".hp,"line_assign".actual_hp,"line_assign".assign_date,"line_assign".remark,"line_assign".assign_id
            ORDER BY "line".l_pos ASC');

            $daily_report_product = DB::select('SELECT "p_detail".p_detail_id,"p_detail".l_id,"p_detail".p_name,"p_detail".quantity,"p_detail".div_quantity,"p_detail".sewing_input,"p_detail".assign_id,
            "p_detail".h_over_input,"p_detail".p_actual_target,"p_detail".cat_actual_target,"p_detail".inline,"p_detail".cmp,"buyer".buyer_name,
			"p_detail".style_no,
			"line_assign".assign_date,"line_assign".man_target,"line_assign".man_actual_target,"line_assign".remark,"p_detail".order_quantity,
			"p_detail".h_balance
            FROM p_detail
            JOIN line_assign ON "line_assign".assign_id="p_detail".assign_id AND "line_assign".assign_date=\'' . $date_string . '\'
            JOIN buyer ON "buyer".buyer_id="p_detail".p_cat_id
            ORDER BY "p_detail".p_detail_id ASC');

            $daily_report_product_2 = DB::select('SELECT DISTINCT "p_detail".l_id,"p_detail".assign_id,"line_assign".assign_date,"line_assign".man_target,"line_assign".man_actual_target
            FROM p_detail
            JOIN line_assign ON "line_assign".assign_id="p_detail".assign_id AND "line_assign".assign_date=\'' . $date_string . '\'
            JOIN p_category ON "p_category".p_cat_id="p_detail".p_cat_id
           ');
        }

        $category = DB::select('SELECT p_cat_id,SUM(cat_actual_target) AS t_cat_actual,p_name FROM p_detail
        WHERE DATE(created_at) >= DATE(NOW()) - INTERVAL \'30\' DAY
		GROUP BY p_cat_id,p_name');

        $target = DB::select('SELECT "line_assign".assign_date,SUM("line_assign".main_target) AS t_main_target FROM line_assign
        WHERE DATE("line_assign".created_at) >= DATE(NOW()) - INTERVAL \'30\' DAY
        GROUP BY "line_assign".assign_date ORDER BY "line_assign".assign_date ASC');

        $time = DB::select('SELECT SUM("time".div_actual_target) AS t_actual_target FROM time
        WHERE DATE("time".created_at) >= DATE(NOW()) - INTERVAL \'30\' DAY
        GROUP BY "time".assign_date ORDER BY "time".assign_date ASC');

        DB::disconnect('musung');

        return view('report_management.report', ['chart' => $chart->build(), 'category_chart' => $category_chart->build()], compact('category', 'target', 'time', 'daily_report', 'daily_report_product', 'daily_report_product_2'));
    }

    public function cmpPut()
    {
        $boxes = request()->post('boxes');
        $man_power_post = request()->post('man_power');
        $inline_post = request()->post('inline');
        $handover_post = request()->post('handover');
        $sewing_post = request()->post('sewing');
        $m_power_2_post = request()->post('m_power_2');
        $note_post = request()->post('note');
        $order_post = request()->post('order_qty');
        $h_bal = request()->post('h_bal');

        for ($i = 0; $i < count($boxes); $i++) {
            $l_id_input = $boxes[$i]['l_id_input'];
            @$p_id_input = $boxes[$i]['p_id_input'];
            @$a_id_input = $boxes[$i]['a_id_input'];
            @$cmp_input = $boxes[$i]['cmp_input'];
            @$note = $boxes[$i]['note'];
            @$role = $boxes[$i]['role'];

            $date = $boxes[$i]['date_input'];

            $date_string = date("d.m.Y", strtotime($date));

            if ($date_string != '') {
                $query = DB::select('SELECT "p_detail".p_detail_id
                FROM p_detail
                JOIN line_assign ON "p_detail".assign_id="line_assign".assign_id AND "p_detail".l_id="line_assign".l_id
                AND "line_assign".assign_date=\'' . $date_string . '\'');

                $decode = json_decode(json_encode($query), true);

                for ($j = 0; $j < count($decode); $j++) {
                    $p_detail_id = $decode[$j]['p_detail_id'];
                    if ($p_id_input == $p_detail_id) {
                        DB::table('p_detail')
                            ->where('p_detail_id', $p_detail_id)
                            ->update(['cmp' => $cmp_input]);
                    }
                }
            }
            if ($date == '') {
                $date_string = date("d.m.Y");
                if ($role == 1) {   ///Operator
                    $p_detail_query = LineAssign::where('assign_date', $date_string)->where('l_id', $l_id_input)->update(['remark' => $note]);
                } elseif ($role == 99 || $role == "") {   ///SuperAdmin
                    $p_detail_query = ProductDetail::where('p_detail_id', $p_id_input)->where('assign_id', $a_id_input)->where('l_id', $l_id_input)->update(['cmp' => $cmp_input]);
                }
                // $p_detail_query = ProductDetail::where('p_detail_id', $p_id_input)->where('assign_id', $a_id_input)->where('l_id', $l_id_input)->update(['cmp' => $cmp_input]);
            }
        }


        //// Man-Power Post
        for ($j = 0; $j < count($man_power_post); $j++) {
            $l_id_input = $man_power_post[$j]['man_target_l_id'];
            $a_id_input = $man_power_post[$j]['man_target_a_id_input'];
            $date_input = $man_power_post[$j]['man_target_date_input'];
            $man_target = $man_power_post[$j]['man_target'];
            $man_actual_target = $man_power_post[$j]['man_actual_target'];

            $date_string = date("d.m.Y", strtotime($date_input));

            if ($date_string != '') {
                $line_assign_query = LineAssign::where('l_id', $l_id_input)
                    ->where('assign_id', $a_id_input)
                    ->where('assign_date', $date_string)
                    ->update(['man_target' => $man_target, 'man_actual_target' => $man_actual_target]);
            }
            if ($date_input == '') {
                $date_string = date("d.m.Y");

                $line_assign_query = LineAssign::where('l_id', $l_id_input)
                    ->where('assign_id', $a_id_input)
                    ->where('assign_date', $date_string)
                    ->update(['man_target' => $man_target, 'man_actual_target' => $man_actual_target]);
            }
        }

        /// Inline Post
        for ($j = 0; $j < count($inline_post); $j++) {
            $inline_l_id = $inline_post[$j]['inline_l_id'];
            $inline_a_id = $inline_post[$j]['inline_a_id'];
            $inline_date = $inline_post[$j]['inline_date'];
            $inline_p_id = $inline_post[$j]['inline_p_id'];
            $inline_val_input = $inline_post[$j]['inline_val_input'];


            $date_string = date("d.m.Y", strtotime($inline_date));

            if ($date_string != '') {
                $p_detail_query = ProductDetail::where('p_detail_id', $inline_p_id)
                    ->where('l_id', $inline_l_id)
                    ->where('assign_id', $inline_a_id)
                    ->update(['inline' => $inline_val_input]);
            }

            if ($inline_date == '') {
                $date_string = date("d.m.Y");

                $p_detail_query = ProductDetail::where('p_detail_id', $inline_p_id)
                    ->where('l_id', $inline_l_id)
                    ->where('assign_id', $inline_a_id)
                    ->update(['inline' => $inline_val_input]);
            }
        }

        //// HandOver Post
        for ($j = 0; $j < count($h_bal); $j++) {
            $h_bal_l_id = $h_bal[$j]['h_bal_l_id'];
            $h_bal_a_id = $h_bal[$j]['h_bal_a_id'];
            $h_bal_date = $h_bal[$j]['h_bal_date'];
            $h_bal_p_id = $h_bal[$j]['h_bal_p_id'];
            $h_bal_val_input = $h_bal[$j]['h_bal_val_input'];


            $date_string = date("d.m.Y", strtotime($h_bal_date));

            if ($date_string != '') {
                $p_detail_query = ProductDetail::where('p_detail_id', $h_bal_p_id)
                    ->where('l_id', $h_bal_l_id)
                    ->where('assign_id', $h_bal_a_id)
                    ->update(['h_balance' => $h_bal_val_input]);
            }

            if ($h_bal_date == '') {
                $date_string = date("d.m.Y");

                $p_detail_query = ProductDetail::where('p_detail_id', $h_bal_p_id)
                    ->where('l_id', $h_bal_l_id)
                    ->where('assign_id', $h_bal_a_id)
                    ->update(['h_balance' => $h_bal_val_input]);
            }
        }


        /// Order Post

        for ($j = 0; $j < count($order_post); $j++) {
            $order_l_id = $order_post[$j]['order_l_id'];
            $order_a_id = $order_post[$j]['order_a_id'];
            $order_date = $order_post[$j]['order_date'];
            $order_p_id = $order_post[$j]['order_p_id'];
            $order_val_input = $order_post[$j]['order_val_input'];


            $date_string = date("d.m.Y", strtotime($order_date));

            if ($date_string != '') {
                $p_detail_query = ProductDetail::where('p_detail_id', $order_p_id)
                    ->where('l_id', $order_l_id)
                    ->where('assign_id', $order_a_id)
                    ->update(['order_quantity' => $order_val_input]);
            }

            if ($order_date == '') {
                $date_string = date("d.m.Y");

                $p_detail_query = ProductDetail::where('p_detail_id', $order_p_id)
                    ->where('l_id', $order_l_id)
                    ->where('assign_id', $order_a_id)
                    ->update(['order_quantity' => $order_val_input]);
            }
        }


        /// Handover Post
        for ($j = 0; $j < count($handover_post); $j++) {
            $handover_l_id = $handover_post[$j]['handover_l_id'];
            $handover_a_id = $handover_post[$j]['handover_a_id'];
            $handover_p_id = $handover_post[$j]['handover_p_id'];
            $handover_date = $handover_post[$j]['handover_date'];
            $handover_val_input = $handover_post[$j]['handover_val_input'];

            echo $handover_val_input;

            $date_string = date("d.m.Y", strtotime($handover_date));

            if ($date_string != '') {
                $p_detail_query = ProductDetail::where('p_detail_id', $handover_p_id)
                    ->where('l_id', $handover_l_id)
                    ->where('assign_id', $handover_a_id)
                    ->update(['h_over_input' => $handover_val_input]);
            }

            if ($handover_date == '') {
                $date_string = date("d.m.Y");

                $p_detail_query = ProductDetail::where('p_detail_id', $handover_p_id)
                    ->where('l_id', $handover_l_id)
                    ->where('assign_id', $handover_a_id)
                    ->update(['h_over_input' => $handover_val_input]);
            }
        }


        /// Sewing Post (Input)
        for ($j = 0; $j < count($sewing_post); $j++) {
            $sewing_l_id = $sewing_post[$j]['sewing_l_id'];
            $sewing_a_id = $sewing_post[$j]['sewing_a_id'];
            $sewing_p_id = $sewing_post[$j]['sewing_p_id'];
            $sewing_date = $sewing_post[$j]['sewing_date'];
            $sewing_val_input = $sewing_post[$j]['sewing_val_input'];

            $date_string = date("d.m.Y", strtotime($sewing_date));

            if ($date_string != '') {
                $p_detail_query = ProductDetail::where('p_detail_id', $sewing_p_id)
                    ->where('l_id', $sewing_l_id)
                    ->where('assign_id', $sewing_a_id)
                    ->update(['sewing_input' => $sewing_val_input]);
            }

            if ($sewing_date == '') {
                $date_string = date("d.m.Y");

                $p_detail_query = ProductDetail::where('p_detail_id', $sewing_p_id)
                    ->where('l_id', $sewing_l_id)
                    ->where('assign_id', $sewing_a_id)
                    ->update(['sewing_input' => $sewing_val_input]);
            }
        }

        //// S,L,ADM OP post
        for ($j = 0; $j < count($m_power_2_post); $j++) {
            $m_power_l_id_2 = $m_power_2_post[$j]['m_power_l_id_2'];
            $m_power_a_id_2 = $m_power_2_post[$j]['m_power_a_id_2'];
            $m_power_date_2 = $m_power_2_post[$j]['m_power_date_2'];
            $m_power_value_2 = $m_power_2_post[$j]['m_power_value_2'];
            $hp_value_2 = $m_power_2_post[$j]['hp_value_2'];
            $actual_m_power_value_2 = $m_power_2_post[$j]['actual_m_power_value_2'];
            $actual_hp_value_2 = $m_power_2_post[$j]['actual_hp_value_2'];

            $date_string = date("d.m.Y", strtotime($m_power_date_2));

            if ($date_string != '') {
                $line_assign_query = LineAssign::where('l_id', $m_power_l_id_2)
                    ->where('assign_id', $m_power_a_id_2)
                    ->where('assign_date', $date_string)
                    ->update(['m_power' => $m_power_value_2, 'actual_m_power' => $actual_m_power_value_2, 'hp' => $hp_value_2, 'actual_hp' => $actual_hp_value_2]);
            }

            if ($m_power_date_2 == '') {
                $date_string = date("d.m.Y");

                $line_assign_query = LineAssign::where('l_id', $m_power_l_id_2)
                    ->where('assign_id', $m_power_a_id_2)
                    ->where('assign_date', $date_string)
                    ->update(['m_power' => $m_power_value_2, 'actual_m_power' => $actual_m_power_value_2, 'hp' => $hp_value_2, 'actual_hp' => $actual_hp_value_2]);
            }
        }

        //// Note Post
        for ($j = 0; $j < count($note_post); $j++) {
            $note_l_id = $note_post[$j]['note_l_id'];
            $note_a_id = $note_post[$j]['note_a_id'];
            $note_date = $note_post[$j]['note_date'];
            $note_val_input = $note_post[$j]['note_val_input'];

            $date_string = date("d.m.Y", strtotime($note_date));

            if ($date_string != '') {
                $line_assign_query = LineAssign::where('l_id', $note_l_id)
                    ->where('assign_id', $note_a_id)
                    ->where('assign_date', $date_string)
                    ->update(['remark' => $note_val_input]);
            }

            if ($note_date == '') {
                $date_string = date("d.m.Y");

                $line_assign_query = LineAssign::where('l_id', $note_l_id)
                    ->where('assign_id', $note_a_id)
                    ->where('assign_date', $date_string)
                    ->update(['remark' => $note_val_input]);
            }
        }
    }

    public function report_history()
    {
        $date_history = request()->post('date_name');
        $date_string = date("d.m.Y", strtotime($date_history));
        $date_string_for_export_pdf = date("Y_m_d", strtotime($date_history));

        $date_2 = date("d.m.Y");


        $daily_report_history = DB::select('SELECT "line".l_id,"line".l_name,"line_assign".main_target,"line_assign".ot_main_target,"line_assign".m_power,"line_assign".assign_id,"line_assign".m_power,"line_assign".actual_m_power,"line_assign".man_target,"line_assign".man_actual_target,
        "line_assign".hp,"line_assign".actual_hp,SUM("time".div_actual_target) as total_div_actual_target,COUNT("time".assign_id) AS total_time,"line_assign".assign_date,"line_assign".remark
        FROM line
        JOIN line_assign ON "line_assign".l_id="line".l_id AND
        "line_assign".assign_date=\'' . $date_string . '\'
        JOIN time ON "time".line_id="line".l_id AND "time".assign_date=\'' . $date_string . '\' AND "time".assign_id="line_assign".assign_id WHERE ("time".ot_status IS NULL OR "time".ot_status=1) AND NOT "time".time_name=\'temp\'
        GROUP BY "line".l_id,"line_assign".main_target,"line_assign".m_power,"line_assign".actual_m_power,"line_assign".man_target,"line_assign".man_actual_target,
        "line_assign".hp,"line_assign".actual_hp,"line_assign".assign_date,"line_assign".remark,"line_assign".assign_id
        ORDER BY "line".l_pos ASC');

        $daily_report_product_history = DB::select('SELECT "p_detail".p_detail_id,"p_detail".l_id,"p_detail".p_name,"p_detail".quantity,"p_detail".div_quantity,"p_detail".sewing_input,"p_detail".assign_id,
        "p_detail".h_over_input,"p_detail".p_actual_target,"p_detail".cat_actual_target,"p_detail".inline,"p_detail".cmp,"buyer".buyer_name,
        "p_detail".style_no,
        "line_assign".assign_date,"line_assign".man_target,"line_assign".man_actual_target,"line_assign".remark,"p_detail".order_quantity,
        "p_detail".h_balance
        FROM p_detail
        JOIN line_assign ON "line_assign".assign_id="p_detail".assign_id AND "line_assign".assign_date=\'' . $date_string . '\'
        JOIN buyer ON "buyer".buyer_id="p_detail".p_cat_id
        ORDER BY "p_detail".p_detail_id ASC');

        $daily_report_product_history_2 = DB::select('SELECT DISTINCT "p_detail".l_id,"p_detail".assign_id,"line_assign".assign_date,"line_assign".man_target,"line_assign".man_actual_target
        FROM p_detail
        JOIN line_assign ON "line_assign".assign_id="p_detail".assign_id AND "line_assign".assign_date=\'' . $date_string . '\'
        JOIN p_category ON "p_category".p_cat_id="p_detail".p_cat_id
       ');

        $category_history = DB::select('SELECT p_cat_id,SUM(cat_actual_target) AS t_cat_actual,p_name FROM p_detail
        WHERE DATE(created_at) >= DATE(NOW()) - INTERVAL \'30\' DAY
		GROUP BY p_cat_id,p_name');

        $target_history = DB::select('SELECT "line_assign".assign_date,SUM("line_assign".main_target) AS t_main_target FROM line_assign
        WHERE DATE("line_assign".created_at) >= DATE(NOW()) - INTERVAL \'30\' DAY
        GROUP BY "line_assign".assign_date ORDER BY "line_assign".assign_date ASC');

        $time_history = DB::select('SELECT SUM("time".div_actual_target) AS t_actual_target FROM time
        WHERE DATE("time".created_at) >= DATE(NOW()) - INTERVAL \'30\' DAY
        GROUP BY "time".assign_date ORDER BY "time".assign_date ASC');

        DB::disconnect('musung');

        $daily_report_history_decode = json_decode(json_encode($daily_report_history), true);
        $daily_report_product_history_decode = json_decode(json_encode($daily_report_product_history), true);
        $daily_report_product_history_2_decode = json_decode(json_encode($daily_report_product_history_2), true);
        $category_history_decode = json_decode(json_encode($category_history), true);
        $target_history = json_decode(json_encode($target_history), true);
        $time_history = json_decode(json_encode($time_history), true);
?>
        <div class="col-12 col-md-4 my-3 p-0">
            <ul class="horizontal-slide" id="tabs">
                <li class="span2">
                    <p>Date - <?php echo $date_string; ?></p>
                </li>
                <li class="span2 bg-transparent">
                    <a id="dlink" style="display:none;"></a>
                    <div id="name" style="display:none;"><?php echo $date_string_for_export_pdf . "_report_dash"; ?></div>
                    <button id="btn" class="icon-btn-one icon-btn-one-2 btn my-2">Export to Excel</button>
                    <!-- <button onclick="tablesToExcel(['history_dash_1','history_dash_2','history_dash_3'], ['Table1','Table2','Table3'], '<?php //echo $getDate;
                                                                                                                                                ?>.xls', 'Excel')" class="icon-btn-one icon-btn-one-2 btn my-2">Export to Excel</button> -->
                </li>
                <li class="span2 bg-transparent">
                    <button type="button" id="exportPDF" class="icon-btn-one icon-btn-one-2 btn my-2">Export to PDF</button>
                </li>
            </ul>
        </div>

        <a class='btn custom-btn-theme custom-btn-theme-edit text-white' href="/report?edit=1&date=<?php echo $date_history; ?>">Edit</a>

        <form method="POST" id="cmp_put">
            <div style="overflow-x:auto;max-width:100%;">
                <table class="table table-striped my-4 tableFixHead results p-0 text-center table-bordered" id="report_history_table">
                    <thead>
                        <tr class="tr-2">
                            <th scope="col">Line</th>
                            <th scope="col">Buyer</th>
                            <th scope="col">Style No.#</th>
                            <th scope="col">Item</th>
                            <th scope="col">Target</th>
                            <th scope="col">Manpower</th>
                            <th scope="col">Output</th>
                            <th scope="col">%</th>
                            <th scope="col">Q'ty</th>
                            <th scope="col">Input</th>
                            <th scope="col">Total</th>
                            <th scope="col">Output</th>
                            <th scope="col">Total</th>
                            <th scope="col">CMP($)</th>
                            <th scope="col">Daily CMP income</th>
                            <th scope="col">Accumulation</th>
                            <th scope="col">Inline</th>
                            <th scope="col">H/over</th>
                            <th scope="col">Total</th>
                            <th scope="col">H/over balance</th>
                            <th scope="col">
                                <table class="table table-bordered text-white m-0">
                                    <thead>
                                        <th scope="col">S,L,Adm Op</th>
                                        <th scope="col">Hp</th>
                                    </thead>
                                </table>
                            </th>
                            <th scope="col">Time</th>
                            <th scope="col">CMP / hr</th>
                            <th scope="col">CMP / hr / PS</th>
                            <th scope="col">
                                Remark
                            </th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        <?php
                        for ($i = 0; $i < count($daily_report_history_decode); $i++) {
                            $l_id = $daily_report_history_decode[$i]['l_id'];
                            $l_name = $daily_report_history_decode[$i]['l_name'];
                            $main_target = $daily_report_history_decode[$i]['main_target'];
                            $ot_main_target = $daily_report_history_decode[$i]['ot_main_target'];
                            $actual_target = $daily_report_history_decode[$i]['total_div_actual_target'];
                            $m_power = $daily_report_history_decode[$i]['m_power'];
                            $actual_m_power = $daily_report_history_decode[$i]['actual_m_power'];
                            $hp = $daily_report_history_decode[$i]['hp'];
                            $actual_hp = $daily_report_history_decode[$i]['actual_hp'];
                            $man_target = $daily_report_history_decode[$i]['man_target'];
                            $man_actual_target = $daily_report_history_decode[$i]['man_actual_target'];
                            $assign_id_2 = $daily_report_history_decode[$i]['assign_id'];
                            $remark = $daily_report_history_decode[$i]['remark'];
                        ?>
                            <tr>
                                <td><?php echo $l_name; ?></td>

                                <!-- Buyer --->
                                <td>
                                    <table class="m-auto text-center table table-bordered custom-table-border-color">
                                        <tbody>
                                            <tr>
                                                <td>-</td>
                                            </tr>
                                            <?php
                                            for ($j = 0; $j < count($daily_report_product_history_decode); $j++) {
                                                $l_id_2 = $daily_report_product_history_decode[$j]['l_id'];
                                                $p_cat_name = $daily_report_product_history_decode[$j]['buyer_name'];

                                                if ($l_id_2 == $l_id) {
                                                    echo '<tr>';
                                                    if ($p_cat_name == '') {
                                                        echo '<td>-</td>';
                                                    }

                                                    if ($p_cat_name != '') {
                                                        echo '<td>' . $p_cat_name . '</td>';
                                                    }
                                                }
                                            }
                                            ?>
                            </tr>
                    </tbody>
                </table>
                </td>
                <!-- Style No. -->
                <td>
                    <table class="m-auto text-center table table-bordered custom-table-border-color">
                        <tbody>
                            <tr>
                                <td>-</td>
                            </tr>
                            <?php
                            for ($j = 0; $j < count($daily_report_product_history_decode); $j++) {
                                $l_id_2 = $daily_report_product_history_decode[$j]['l_id'];
                                $style_no_2 = $daily_report_product_history_decode[$j]['style_no'];

                                if ($l_id_2 == $l_id) {
                                    echo '<tr>';
                                    if ($style_no_2 == '') {
                                        echo '<td>-</td>';
                                    }
                                    if ($style_no_2 != '') {
                                        echo '<td>' . $style_no_2 . '</td>';
                                    }
                                    echo '</tr>';
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </td>
                <td>
                    <table class="m-auto text-start table table-bordered custom-table-border-color">
                        <tbody>
                            <tr class="bg-warning text-white">
                                <td><span>Overall Target</span></td>
                            </tr>
                            <?php for ($j = 0; $j < count($daily_report_product_history_decode); $j++) {
                                $l_id_2 = $daily_report_product_history_decode[$j]['l_id'];
                                $p_name = $daily_report_product_history_decode[$j]['p_name'];
                                if ($l_id_2 == $l_id) {
                                    echo '<tr>
                                    <td>' . $p_name . '</td>
                                    </tr>';
                                }
                            ?>

                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </td>

                <!-- Main Target --->
                <td class="main_target_history<?php echo $l_id; ?>"><?php echo number_format($main_target + $ot_main_target); ?></td>

                <td>
                    <table class="m-auto text-start table table-bordered custom-table-border-color">
                        <tbody>
                            <td><?php echo $man_target; ?></td>
                            <td><?php echo $man_actual_target; ?></td>
                        </tbody>
                    </table>
                </td>
                <td class="actual_target_history<?php echo $l_id; ?>"><?php if ($actual_target != '') {
                                                                            echo number_format($actual_target);
                                                                        }
                                                                        ?></td>
                <td class="percent_history<?php echo $l_id; ?>"></td>
                <script>
                    var main_target = parseInt($('.main_target_history<?php echo $l_id; ?>').text().replace(/,/g, ''));
                    var actual_target = parseInt($('.actual_target_history<?php echo $l_id; ?>').text().replace(/,/g, ''));
                    var percent_class = $(".percent_history<?php echo $l_id; ?>");

                    if (Number.isNaN(actual_target)) {
                        actual_target = 0;
                    }
                    var percent = (actual_target / main_target) * 100;

                    if (Number.isNaN(percent)) {
                        $('.percent_<?php echo $l_id; ?>').text("");
                    } else {
                        $('.percent_<?php echo $l_id; ?>').text(percent.toFixed(0) + "%");
                    }
                    percent_class.text(percent.toFixed(0) + "%");
                </script>
                <td class="text-danger"></td>

                <!-- Sewing Input --->
                <td>
                    <table class="m-auto text-center table table-bordered custom-table-border-color">
                        <tbody>
                            <tr>
                                <td>-</td>
                            </tr>
                            <?php
                            for ($j = 0; $j < count($daily_report_product_history_decode); $j++) {
                                $l_id_2 = $daily_report_product_history_decode[$j]['l_id'];
                                $sewing_input = $daily_report_product_history_decode[$j]['sewing_input'];
                                if ($l_id_2 == $l_id) {
                                    echo '<tr>';
                                    if ($sewing_input == '') {
                                        echo '<td>-</td>';
                                    }
                                    if ($sewing_input != '') {
                                        echo '<td>' . number_format($sewing_input) . '</td>';
                                    }
                                    echo '</tr>';
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </td>
                <!-- Sewing Total --->
                <td>
                    <table class="m-auto text-center table table-bordered custom-table-border-color">
                        <tbody>
                            <tr>
                                <td>-</td>
                            </tr>
                            <?php
                            for ($j = 0; $j < count($daily_report_product_history_decode); $j++) {
                                $l_id_2 = $daily_report_product_history_decode[$j]['l_id'];
                                $sewing_input = $daily_report_product_history_decode[$j]['sewing_input'];
                                if ($l_id_2 == $l_id) {
                                    echo '<tr>';
                                    if ($sewing_input == '') {
                                        echo '<td>-</td>';
                                    }
                                    if ($sewing_input != '') {
                                        echo '<td>' . number_format($sewing_input) . '</td>';
                                    }
                                    echo '</tr>';
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </td>
                <!-- Clothes Input --->
                <td>
                    <table class="m-auto text-center table table-bordered custom-table-border-color">
                        <tbody>
                            <tr>
                                <td>-</td>
                            </tr>
                            <?php for ($j = 0; $j < count($daily_report_product_history_decode); $j++) {
                                $l_id_2 = $daily_report_product_history_decode[$j]['l_id'];
                                $p_id_2 = $daily_report_product_history_decode[$j]['p_detail_id'];
                                $cat_actual_target = $daily_report_product_history_decode[$j]['cat_actual_target'];
                                if ($l_id_2 == $l_id) {
                                    echo '<tr>';

                                    if ($cat_actual_target == '') {
                                        echo '<td>-</td>';
                                    }
                                    if ($cat_actual_target != '') {
                                        echo '<td class="cat_actual_target_history_' . $p_id_2 . '">' . number_format($cat_actual_target) . '</td>';
                                    }
                                    echo '</tr>';
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </td>
                <!-- Clothes Total --->
                <td>
                    <table class="m-auto text-center table table-bordered custom-table-border-color">
                        <tbody>
                            <tr>
                                <td>-</td>
                            </tr>
                            <?php
                            for ($j = 0; $j < count($daily_report_product_history_decode); $j++) {
                                $l_id_2 = $daily_report_product_history_decode[$j]['l_id'];
                                $cat_actual_target = $daily_report_product_history_decode[$j]['cat_actual_target'];
                                if ($l_id_2 == $l_id) {
                                    echo '<tr>';
                                    if ($cat_actual_target == '') {
                                        echo '<td>-</td>';
                                    }
                                    if ($cat_actual_target != '') {
                                        echo '<td>' . number_format($cat_actual_target) . '</td>';
                                    }
                                    echo '</tr>';
                                }
                            }
                            ?>

                        </tbody>
                    </table>
                </td>
                <!-- CMP($) -->
                <td>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td>-</td>
                            </tr>
                            <?php for ($j = 0; $j < count($daily_report_product_history_decode); $j++) {
                                $l_id_2 = $daily_report_product_history_decode[$j]['l_id'];
                                $a_id_2 = $daily_report_product_history_decode[$j]['assign_id'];
                                $p_id_2 = $daily_report_product_history_decode[$j]['p_detail_id'];
                                $cmp = $daily_report_product_history_decode[$j]['cmp'];

                                if ($l_id_2 == $l_id) {
                                    echo '<tr>';
                                    if ($cmp == '') {
                                        echo '<td>-</td>';
                                    }
                                    if ($cmp != '') {
                                        echo '<td class="cmp_value_history_' . $p_id_2 . '" id="cmp_value_history">' . '$ ' . $cmp . '</td>';
                                    }
                                    echo '</tr>';
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </td>
                <!-- Daily CMP income -->
                <td>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td colspan="">-</td>
                                <td class="total_cmp_history_<?php echo $l_id; ?>">total_cmp</td>
                            </tr>
                            <?php
                            for ($j = 0; $j < count($daily_report_product_history_decode); $j++) {
                                $l_id_2 = $daily_report_product_history_decode[$j]['l_id'];
                                $p_id_2 = $daily_report_product_history_decode[$j]['p_detail_id'];
                                if ($l_id_2 == $l_id) {
                                    echo '<tr>
                                <td class="daily_cmp_history_' . $p_id_2 . ' cmp_product_history_' . $l_id_2 . '">

                                </td>
                                </tr>';
                            ?>

                                    <script>
                                        var clothes_output = parseFloat($(".cat_actual_target_history_<?php echo $p_id_2; ?>").text());
                                        var cmp = $('.cmp_value_history_<?php echo $p_id_2; ?>').text();
                                        var cmp_substring = parseFloat(cmp.substring(2));
                                        var daily_cmp = $('.daily_cmp_history_<?php echo $p_id_2; ?>');

                                        var multiply_cmp = clothes_output * cmp_substring;

                                        if (Number.isNaN(multiply_cmp)) {
                                            daily_cmp.text('-');
                                        } else {
                                            daily_cmp.text("$ " + multiply_cmp.toFixed(1));
                                        }


                                        var cmp_product = $(".cmp_product_history_<?php echo $l_id_2; ?>");
                                        var total_cmp_class = $(".total_cmp_history_<?php echo $l_id_2; ?>");
                                        var total_cmp = 0;

                                        cmp_product.each(function() {
                                            var cmp_product_text = $(this).text();
                                            var substring = parseFloat(cmp_product_text.substring(2));

                                            if (Number.isNaN(substring)) {
                                                substring = 0;
                                            } else {
                                                total_cmp += substring;
                                            }
                                        });
                                        total_cmp_class.text("$ " + total_cmp.toFixed(1));
                                    </script>

                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>

                </td>
                <td class="accumulation_history_<?php echo $l_id; ?>">

                </td>

                <script>
                    var total_cmp_class = $(".total_cmp_history_<?php echo $l_id; ?>").text();
                    var accumulation = $('.accumulation_history_<?php echo $l_id; ?>');

                    accumulation.text(total_cmp_class);
                </script>

                <!-- Inline --->
                <td>
                    <table class="m-auto text-center table table-bordered custom-table-border-color">
                        <tbody>
                            <tr>
                                <td>-</td>
                            </tr>
                            <?php for ($j = 0; $j < count($daily_report_product_history_decode); $j++) {
                                $l_id_2 = $daily_report_product_history_decode[$j]['l_id'];
                                $inline_2 = $daily_report_product_history_decode[$j]['inline'];
                                if ($l_id_2 == $l_id) {
                                    echo '<tr>';
                                    if ($inline_2 == '') {
                                        echo '<td>-</td>';
                                    }
                                    if ($inline_2 != '') {
                                        echo '<td>' . number_format($inline_2) . '</td>';
                                    }
                                    echo '</tr>';
                                }
                            }

                            ?>
                        </tbody>
                    </table>
                </td>
                <!-- H/over Input --->
                <td>
                    <table class="m-auto text-center table table-bordered custom-table-border-color">
                        <tbody>
                            <tr>
                                <td>-</td>
                            </tr>
                            <?php
                            for ($j = 0; $j < count($daily_report_product_history_decode); $j++) {
                                $l_id_2 = $daily_report_product_history_decode[$j]['l_id'];
                                $h_over_input = $daily_report_product_history_decode[$j]['h_over_input'];
                                if ($l_id_2 == $l_id) {
                                    echo '<tr>';
                                    if ($h_over_input == '') {
                                        echo '<td>-</td>';
                                    }
                                    if ($h_over_input != '') {
                                        echo '<td>' . number_format($h_over_input) . '</td>';
                                    }
                                    echo '</tr>';
                                }
                            }
                            ?>

                        </tbody>
                    </table>
                </td>

                <!-- H/over Total --->
                <td>
                    <table class="m-auto text-center table table-bordered custom-table-border-color">
                        <tbody>
                            <tr>
                                <td>-</td>
                            </tr>
                            <?php for ($j = 0; $j < count($daily_report_product_history_decode); $j++) {
                                $l_id_2 = $daily_report_product_history_decode[$j]['l_id'];
                                $h_over_input = $daily_report_product_history_decode[$j]['h_over_input'];
                                if ($l_id_2 == $l_id) {
                                    echo '<tr>';
                                    if ($h_over_input == '') {
                                        echo '<td>-</td>';
                                    }
                                    if ($h_over_input != '') {
                                        echo '<td>' . number_format($h_over_input) . '</td>';
                                    }
                                    echo '</tr>';
                                }
                            }

                            ?>
                        </tbody>
                    </table>
                </td>
                <!-- H/over Balance --->
                <td>
                    <table class="m-auto text-center table table-bordered custom-table-border-color">
                        <tbody>
                            <tr>
                                <td>-</td>
                            </tr>
                            <?php
                            for ($j = 0; $j < count($daily_report_product_history_decode); $j++) {
                                $l_id_2 = $daily_report_product_history_decode[$j]['l_id'];
                                $h_over_input = $daily_report_product_history_decode[$j]['h_over_input'];
                                $h_over_bal = $h_over_input - $h_over_input;
                                if ($l_id_2 == $l_id) {
                                    echo '<tr>
                                <td>' . number_format($h_over_bal) . '</td>
                                </tr>';
                                }
                            }
                            ?>

                        </tbody>
                    </table>
                </td>

                <td>
                    <table class="m-auto text-center w-100 table table-bordered custom-table-border-color">
                        <tbody>
                            <tr>
                                <td class="m_power_value_history_<?php echo $l_id; ?>"><?php if ($m_power != '') {
                                                                                            echo number_format($m_power);
                                                                                        } ?></td>
                                <td class="hp_value_history_<?php echo $l_id; ?>"><?php if ($hp != '') {
                                                                                        echo $hp;
                                                                                    } ?></td>
                            </tr>
                            <tr>
                                <td class="total_m_power_history_<?php echo $l_id; ?>" colspan="2"></td>
                            </tr>
                            <tr>
                                <td class="actual_m_power_value_history_<?php echo $l_id; ?>"><?php if ($actual_m_power != '') {
                                                                                                    echo $actual_m_power;
                                                                                                } ?></td>
                                <td class="actual_hp_value_history_<?php echo $l_id; ?>"><?php if ($actual_hp != '') {
                                                                                                echo $actual_hp;
                                                                                            } ?></td>
                            </tr>
                            <tr>
                                <td class="total_actual_m_power_history_<?php echo $l_id; ?>" colspan="2"></td>
                            </tr>
                        </tbody>
                    </table>

                    <script>
                        var m_power_value_history = parseInt($('.m_power_value_history_<?php echo $l_id; ?>').text());
                        var hp_value = parseInt($('.hp_value_history_<?php echo $l_id; ?>').text());
                        var actual_m_power = parseInt($('.actual_m_power_value_history_<?php echo $l_id; ?>').text());
                        var actual_hp_value = parseInt($('.actual_hp_value_history_<?php echo $l_id; ?>').text());


                        var total_m_power_value = $('.total_m_power_history_<?php echo $l_id; ?>');
                        var total_actual_m_power_value = $('.total_actual_m_power_history_<?php echo $l_id; ?>');

                        var total_m_power = m_power_value_history + hp_value;
                        var total_actual_m_power = actual_m_power + actual_hp_value;

                        if (Number.isNaN(total_m_power)) {
                            total_m_power_value.text('');
                            total_actual_m_power_value.text('');
                        } else {
                            total_m_power_value.text(total_m_power);
                            total_actual_m_power_value.text(total_actual_m_power);
                        }
                    </script>
                </td>

                <!----- Total Time ------>
                <?php
                            for ($k = 0; $k < count($daily_report_history_decode); $k++) {
                                $l_id_2 = $daily_report_history_decode[$k]['l_id'];
                                $total_time = (int)$daily_report_history_decode[$k]['total_time'];
                                $subtraction = $total_time - 1;
                                if ($l_id_2 == $l_id) {
                                    echo '<td class="total_time_history_' . $l_id_2 . '">' . $subtraction . '</td>';
                                }
                            }
                ?>
                <!----- Total Time  End ------>

                <td class="cmp_hr_history_<?php echo $l_id; ?>"></td>
                <td class="cmp_hr_ps_history_<?php echo $l_id; ?>"></td>
                <td>
                    <?php echo $remark; ?>
                </td>
                </tr>

                <script>
                    // For CMP/hr
                    var total_cmp_2 = $('.total_cmp_history_<?php echo $l_id; ?>').text();
                    var substring_2 = parseFloat(total_cmp_2.substring(2));
                    var total_time_2 = parseInt($('.total_time_history_<?php echo $l_id; ?>').text());

                    var cmp_hr = $('.cmp_hr_history_<?php echo $l_id; ?>');

                    var div_time = substring_2 / total_time_2;


                    cmp_hr.text("$ " + div_time.toFixed(1));

                    /// For CMP/hr end

                    /// For CMP/ HR/ PS
                    var total_actual_m_power_2 = $('.total_actual_m_power_history_<?php echo $l_id; ?>').text();
                    var cmp_hr_3 = $('.cmp_hr_history_<?php echo $l_id; ?>').text();
                    var cmp_hr_ps = $('.cmp_hr_ps_history_<?php echo $l_id; ?>');


                    var substring_3 = parseFloat(cmp_hr_3.substring(2));
                    var substring_4 = parseFloat(total_actual_m_power_2.substring(2));

                    var div_cmp_hr_ps = substring_3 / total_actual_m_power_2;

                    if (total_actual_m_power_2 != '') {
                        if (Number.isNaN(div_cmp_hr_ps)) {
                            cmp_hr_ps.text('');
                        } else {
                            cmp_hr_ps.text("$ " + div_cmp_hr_ps.toFixed(1));

                            // console.log(div_cmp_hr_ps);

                        }
                    }

                    /// For CMP/ HR/ PS end
                </script>

            <?php
                        }
            ?>

            </tbody>
            </table>
            </div>
        </form>
        <script>
            $("#exportPDF").click(function() {

                html2canvas($('#report_history_table')[0], {
                    onrendered: function(canvas) {
                        var data = canvas.toDataURL();
                        var docDefinition = {
                            content: [{
                                image: data,
                                width: 500
                            }]
                        };
                        pdfMake.createPdf(docDefinition).download("<?php echo $date_string_for_export_pdf . '_report'; ?>.pdf");
                    }
                });
            });
        </script>

        <script>
            var tableToExcel = (function() {
                var uri = 'data:application/vnd.ms-excel;base64,',
                    template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="https://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table border="1">{table}</table></body></html>',
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
                tableToExcel('report_history_table', 'Sheet 1', name.replace(/\s+/g, ' ') + '.xls')
                //setTimeout("window.location.reload()",0.0000001);

            }
            var btn = document.getElementById("btn");
            btn.addEventListener("click", download);
        </script>
<?php

    }
}
