<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Line;
use App\Models\LineAssign;
use App\Models\ProductDetail;


class DailyProductionController extends Controller
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
        $line = DB::select('SELECT DISTINCT "line".l_id,"line".l_name,"line".is_delete,"line".a_status,"line".l_pos FROM "line"
JOIN line_assign ON "line_assign".l_id="line".l_id AND "line_assign".assign_date=\'' . $date_string . '\'
WHERE "line".is_delete=0
ORDER BY "line".l_pos ASC');

        DB::disconnect('musung');

        return view('daily_production_detail.daily_prod_detail', compact('line'));
    }

    public function postLineId()
    {
        $line_id = request()->post('line_id');
        $date_string = date("d.m.Y");

        $line = Line::select('line.l_id', 'line.l_name', 'line.is_delete', 'line.a_status', 'line.l_pos')
            ->join('line_assign', 'line_assign.l_id', '=', 'line.l_id')
            ->where('line_assign.assign_date', $date_string)
            ->where('line.l_id', $line_id)
            ->where('line.is_delete', 0)
            ->orderBy('line.l_pos', 'asc')
            ->get();
        $p_detail = DB::select('SELECT DISTINCT "p_detail".p_detail_id,"p_detail".assign_id,"p_detail".l_id,
            "p_detail".p_cat_id,"p_detail".p_name,"p_detail".quantity FROM p_detail
            JOIN time ON "time".assign_id="p_detail".assign_id AND "time".line_id="p_detail".l_id
            JOIN line_assign ON "line_assign".assign_id="p_detail".assign_id
            AND "line_assign".assign_date=\'' . $date_string . '\'
            ORDER BY p_detail_id ASC');

        $line_detail = DB::select('SELECT "time".assign_id,"time".line_id,SUM("time".actual_target_entry) AS total_div_target,
        SUM("time".div_actual_target) AS total_div_actual_target,"line_assign".man_target,"line_assign".man_actual_target,"line_assign".m_power,
		"line_assign".actual_m_power,"line_assign".hp,"line_assign".actual_hp
		FROM time
		JOIN line_assign ON "line_assign".assign_id="time".assign_id AND "line_assign".l_id="time".line_id
		WHERE "time".assign_date=\'' . $date_string . '\'
        GROUP BY "time".assign_id,"time".line_id,"line_assign".man_target,"line_assign".man_actual_target,"line_assign".m_power,"line_assign".actual_m_power,
		"line_assign".hp,"line_assign".actual_hp');

        DB::disconnect('musung');

        $line_decode = json_decode(json_encode($line), true);
        $p_detail_decode = json_decode(json_encode($p_detail), true);
        $line_detail_decode = json_decode(json_encode($line_detail), true);

        for ($i = 0; $i < count($line_decode); $i++) {
            $l_id = $line_decode[$i]['l_id'];
            $l_name = $line_decode[$i]['l_name'];
?>
            <h1 class="fw-bold heading-text fs-2"><?php echo $l_name; ?></h1>

            <?php for ($i = 0; $i < count($line_detail_decode); $i++) {
                $assign_id = $line_detail_decode[$i]['assign_id'];
                $line_id = $line_detail_decode[$i]['line_id'];
                $total_div_target = $line_detail_decode[$i]['total_div_target'];
                $total_div_actual_target = $line_detail_decode[$i]['total_div_actual_target'];
                $l_man_target = $line_detail_decode[$i]['man_target'];
                $l_man_actual_target = $line_detail_decode[$i]['man_actual_target'];
                $m_power = $line_detail_decode[$i]['m_power'];
                $actual_m_power = $line_detail_decode[$i]['actual_m_power'];
                $hp = $line_detail_decode[$i]['hp'];
                $actual_hp = $line_detail_decode[$i]['actual_hp'];

                if ($line_id == $l_id) {
            ?>
                    <form method="POST" id="daily_production_submit">
                        <input type="hidden" value="<?php echo $line_id; ?>" name="line_id" />
                        <input type="hidden" value="<?php echo $assign_id; ?>" name="assign_id" />
                        <div style="overflow: auto;max-width:100%;max-height:600px;">
                            <table>
                                <tr class="tr-daily">
                                    <td><span>Target : </span></td>
                                    <td>
                                        <div class="input-wrapper">
                                            <input class="form-control daily-prod-input" type="number" id="today_target" name="today_target" value="<?php echo $total_div_target; ?>" readonly />
                                            <label for="user">Today Target</label>
                                        </div>
                                        <div class="input-wrapper">
                                            <input class="form-control daily-prod-input" type="number" id="man_target" name="man_target" min="0" oninput="validity.valid||(value='');" step="any" value="<?php echo $l_man_target; ?>" />
                                            <label for="user">Man-Power Target</label>
                                        </div>
                                        <div class="input-wrapper">
                                            <input class="form-control daily-prod-input" type="number" id="t_target" name="t_target" value="<?php echo $total_div_target; ?>" readonly />
                                            <label for="user">Total Target</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="tr-daily">
                                    <td> <span>Actual Target : </span></td>
                                    <td>
                                        <div class="input-wrapper">
                                            <input class="form-control daily-prod-input" type="number" id="today_actual_target" name="today_actual_target" value="<?php echo $total_div_actual_target; ?>" readonly />
                                            <label for="user">Today Actual Target</label>
                                        </div>
                                        <div class="input-wrapper">
                                            <input class="form-control daily-prod-input" type="number" id="man_actual_target" name="man_actual_target" min="0" oninput="validity.valid||(value='');" step="any" value="<?php echo $l_man_actual_target; ?>" />
                                            <label for="user">Man-Power Actual Target</label>
                                        </div>
                                        <div class="input-wrapper">
                                            <input class="form-control daily-prod-input" type="number" id="t_actual_target" name="t_actual_target" value="<?php echo $total_div_actual_target; ?>" readonly />
                                            <label for="user">Total Actual Target</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="tr-daily">
                                    <td> <span>ManPower Target : </span>
                                    </td>
                                    <td>
                                        <div class="input-wrapper">
                                            <input class="form-control daily-prod-input" type="number" id="man_power_input" name="man_power_input" min="0" value="<?php echo $m_power; ?>" />
                                            <label for="user">S,L,Adm,Op Input</label>
                                        </div>
                                        <div class="input-wrapper">
                                            <input class="form-control daily-prod-input" type="number" id="hp_input" name="hp_input" min="0" value="<?php echo $hp; ?>" />
                                            <label for="user">HP</label>
                                        </div>
                                        <div class="input-wrapper">
                                            <input class="form-control daily-prod-input" type="number" id="total_man_power" name="total_man_power" readonly />
                                            <label for="user">Total ManPower</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="tr-daily">
                                    <td>
                                        <span>ManPower Actual Target : </span>
                                    </td>
                                    <td>
                                        <div class="input-wrapper">
                                            <input class="form-control daily-prod-input" type="number" id="man_power_actual_input" name="man_power_actual_input" min="0" value="<?php echo $actual_m_power; ?>" />
                                            <label for="user">S,L,Adm,Op Actual Input</label>
                                        </div>
                                        <div class="input-wrapper">
                                            <input class="form-control daily-prod-input" type="number" id="hp_actual_input" name="hp_actual_input" min="0" value="<?php echo $actual_hp; ?>" />
                                            <label for="user">Actual HP</label>
                                        </div>
                                        <div class="input-wrapper">
                                            <input class="form-control daily-prod-input" type="number" id="total_actual_man_power" name="total_actual_man_power" readonly />
                                            <label for="user">Total Actual ManPower</label>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <input class="icon-btn-one btn my-2" type="submit" value="Submit" name="submit" />
                    </form>
                    <hr class="hr-daily" />
                    <ul class="horizontal-slide my-4" style="width:100%;overflow-x:scroll;" id="nav">
                        <?php
                        for ($j = 0; $j < count($p_detail_decode); $j++) {
                            $p_id = $p_detail_decode[$j]['p_detail_id'];
                            $a_id = $p_detail_decode[$j]['assign_id'];
                            $l_id_2 = $p_detail_decode[$j]['l_id'];
                            $p_cat_id = $p_detail_decode[$j]['p_cat_id'];
                            $p_name = $p_detail_decode[$j]['p_name'];
                            $qty = $p_detail_decode[$j]['quantity'];
                        ?>
                            <?php
                            if ($l_id_2 == $line_id) { ?>
                                <li class="list-group-item span2 open2 vertical_<?php echo $p_id; ?>" data-cat-id="<?php echo $p_cat_id; ?>" data-p-id="<?php echo $p_id; ?>" data-a-id="<?php echo $a_id; ?>" data-l-id="<?php echo $l_id_2; ?>">
                                    <?php
                                    echo $p_name;
                                    ?>
                                </li>
                        <?php }
                        }
                        ?>
                    </ul>
                    <div id="ajax_load_div_2" class="my-2">
                    </div>

            <?php
                }
            } ?>


            <script>
                var man_power_input_1 = $(man_power_input).val();
                var hp_input_1 = $("#hp_input").val();
                var total_man_power_1 = $("#total_man_power");
                var man_power_actual_input_1 = $("#man_power_actual_input").val();
                var hp_actual_input_1 = $("#hp_actual_input").val();
                var total_actual_man_power_1 = $("#total_actual_man_power");

                if (man_power_input_1 != '' && hp_input_1 != '') {

                    var addition_1 = parseInt(man_power_input_1) + parseInt(hp_input_1);
                    total_man_power_1.val(addition_1);
                }

                if (man_power_actual_input_1 != '' && hp_actual_input_1 != '') {
                    var addition_2 = parseInt(man_power_actual_input_1) + parseInt(hp_actual_input_1);
                    total_actual_man_power_1.val(addition_2);
                }

                $("#man_power_input").keyup(function() {
                    var man_power_input = $(this).val();
                    var hp_input = $("#hp_input").val();
                    var total_man_power = $("#total_man_power");

                    if (hp_input == '') {
                        hp_input = 0;
                    }

                    var addition = parseInt(man_power_input) + parseInt(hp_input);
                    total_man_power.val(addition);
                });
                $("#hp_input").keyup(function() {
                    var man_power_input = $("#man_power_input").val();
                    var hp_input = $(this).val();
                    var total_man_power = $("#total_man_power");

                    if (man_power_input == '') {
                        man_power_input = 0;
                    }

                    var addition = parseInt(man_power_input) + parseInt(hp_input);
                    total_man_power.val(addition);
                });


                $("#man_power_actual_input").keyup(function() {
                    var man_power_actual_input = $(this).val();
                    var hp_actual_input = $("#hp_actual_input").val();
                    var total_actual_man_power = $("#total_actual_man_power");

                    if (hp_actual_input == '') {
                        hp_actual_input = 0;
                    }

                    var addition2 = parseInt(man_power_actual_input) + parseInt(hp_actual_input);
                    total_actual_man_power.val(addition2);
                });
                $("#hp_actual_input").keyup(function() {
                    var man_power_actual_input = $("#man_power_actual_input").val();
                    var hp_actual_input = $(this).val();
                    var total_actual_man_power = $("#total_actual_man_power");

                    if (man_power_actual_input == '') {
                        man_power_actual_input = 0;
                    }

                    var addition2 = parseInt(man_power_actual_input) + parseInt(hp_actual_input);
                    total_actual_man_power.val(addition2);
                });
                $("#daily_production_submit").submit(function(e) {
                    e.preventDefault();

                    // Get all INPUT form data and organize as array
                    var formData = $(this).serializeArray();

                    console.log(formData);
                    // Submit with AJAX
                    $.ajax({
                        type: "POST",
                        url: "/daily_production_post",
                        data: formData,
                        type: 'post',
                        success: function(data) {
                            console.log(data);
                            alert('Successfully Submitted');
                            // location.reload();
                        }
                    });
                });
            </script>
        <?php

        }
        ?>
        <script>
            $(function() {
                $(".open2").on('click', function(e) {
                    e.preventDefault(); // in chase you change to a link or button
                    var cat_id = $(this).data('cat-id');
                    var p_id = $(this).data('p-id');
                    var a_id = $(this).data('a-id');
                    var l_id = $(this).data('l-id');


                    $(".open2").removeClass('changeClass');
                    $(".vertical_" + p_id).toggleClass("changeClass");

                    // console.log(cat_id);
                    $.ajax({
                        type: "POST",
                        url: "/daily_prod_item",
                        data: {
                            cat_id: cat_id,
                            p_id: p_id,
                            a_id: a_id,
                            l_id: l_id,
                        },
                        cache: false,
                        success: function(result2) {
                            // console.log(result2);
                            $("#ajax_load_div_2").html(result2);
                        },
                        error: function(result2) {
                            console.log(result2);
                            alert('error');
                        }
                    });
                });
            });
        </script>
    <?php
    }

    public function postItemId()
    {
        $cat_id = request()->post('cat_id');
        $p_id = request()->post('p_id');
        $a_id = request()->post('a_id');
        $l_id = request()->post('l_id');

        $date_string = date("d.m.Y");

        $p_detail = DB::select('SELECT "p_detail".p_detail_id,"p_detail".assign_id,"p_detail".l_id,"p_detail".p_cat_id,"p_detail".p_name,"p_detail".cat_actual_target,"p_detail".sewing_input,"p_detail".h_over_input,"p_detail".inline
        FROM p_detail JOIN line_assign ON "line_assign".assign_id="p_detail".assign_id
        AND "line_assign".assign_date=\'' . $date_string . '\'
        WHERE "p_detail".p_cat_id=' . $cat_id . ' AND "p_detail".p_detail_id=' . $p_id . ' AND "p_detail".assign_id=' . $a_id . ' AND "p_detail".l_id=' . $l_id . '');

        DB::disconnect('musung');

        $p_detail_decode = json_decode(json_encode($p_detail), true);

        // print_r($p_detail_decode);
    ?>
        <?php for ($k = 0; $k < count($p_detail_decode); $k++) {
            $p_id_2 = $p_detail_decode[$k]['p_detail_id'];
            $p_a_id_2 = $p_detail_decode[$k]['assign_id'];
            $p_l_id_2 = $p_detail_decode[$k]['l_id'];
            $p_cat_id_2 = $p_detail_decode[$k]['p_cat_id'];
            $p_name_2 = $p_detail_decode[$k]['p_name'];
            $p_cat_actual_target_2 = $p_detail_decode[$k]['cat_actual_target'];
            $p_sewing_input_2 = $p_detail_decode[$k]['sewing_input'];
            $p_h_over_input_2 = $p_detail_decode[$k]['h_over_input'];
            $inline_input_2 = $p_detail_decode[$k]['inline'];
        ?>
            <h1 class="fw-bold heading-text fs-3"><?php echo $p_name_2; ?></h1>
        <?php
        } ?>

        <form id='daily_production_submit_2'>
            <input type="hidden" name="p_id" value="<?php echo $p_id_2; ?>">
            <input type="hidden" name="a_id" value="<?php echo $p_a_id_2; ?>">
            <input type="hidden" name="l_id" value="<?php echo $p_l_id_2; ?>">
            <input type="hidden" name="cat_id" value="<?php echo $p_cat_id_2; ?>">
            <div style="overflow: auto;max-width:100%;max-height:600px;">
                <table>
                    <tr class="tr-daily">
                        <td>
                            <span>Quantity : </span>
                        </td>
                        <td>
                            <div class="input-wrapper">
                                <input class="form-control daily-prod-input" type="number" id="overall_quantity" name="overall_quantity" min="0" oninput="validity.valid||(value='');" />
                                <label for="user">Quantity</label>
                            </div>
                        </td>
                    </tr>
                    <tr class="tr-daily">
                        <td>
                            <span>Sewing Input : </span>
                        </td>
                        <td>
                            <div class="input-wrapper">
                                <input class="form-control daily-prod-input" type="number" id="sewing_input" name="sewing_input" min="0" oninput="validity.valid||(value='');" value="<?php echo $p_sewing_input_2; ?>" />
                                <label for=" user">Sewing Input</label>
                            </div>
                            <div class="input-wrapper">
                                <input class="form-control daily-prod-input" type="number" id="sewing_total" name="sewing_total" value="<?php echo $p_sewing_input_2; ?>" readonly />
                                <label for="user">Sewing Total</label>
                            </div>
                        </td>
                    </tr>
                    <tr class="tr-daily">
                        <td>
                            <span>Clothes Input : </span>
                        </td>
                        <td>
                            <div class="input-wrapper">
                                <input class="form-control daily-prod-input" type="number" id="clothes_input" name="clothes_input" min="0" oninput="validity.valid||(value='');" value="<?php echo $p_cat_actual_target_2; ?>" readonly />
                                <label for="user">Clothes Input</label>
                            </div>
                            <div class="input-wrapper">
                                <input class="form-control daily-prod-input" type="number" id="clothes_total" name="clothes_total" value="<?php echo $p_cat_actual_target_2; ?>" readonly />
                                <label for="user">Clothes Total</label>
                            </div>
                        </td>
                    </tr>
                    <tr class="tr-daily">
                        <td>
                            <span>HandOver : </span>
                        </td>
                        <td>
                            <div class="input-wrapper">
                                <input class="form-control daily-prod-input h_over_input_<?php echo $p_id_2; ?>" type="number" id="handover_input" name="handover_input" min="0" oninput="validity.valid||(value='');" value="<?php echo $p_h_over_input_2; ?>" />
                                <label for="user">HandOver Input</label>
                            </div>
                            <div class="input-wrapper">
                                <input class="form-control daily-prod-input h_over_total_<?php echo $p_id_2; ?>" type="number" id="handover_total" name="handover_total" value="<?php echo $p_h_over_input_2; ?>" readonly />
                                <label for="user">HandOver Total</label>
                            </div>
                            <div class="input-wrapper">
                                <input class="form-control daily-prod-input h_over_bal_<?php echo $p_id_2; ?>" type="number" id="handover_bal" name="handover_bal" readonly />
                                <label for="user">HandOver Balance</label>
                            </div>
                        </td>

                        <script>
                            var h_over_input = $('.h_over_input_<?php echo $p_id_2; ?>').val();
                            var h_over_total = $('.h_over_total_<?php echo $p_id_2; ?>').val();
                            var h_over_bal = $('.h_over_bal_<?php echo $p_id_2; ?>');

                            if (h_over_input == '') {
                                h_over_input = 0;
                            }
                            if (h_over_total == '') {
                                h_over_total = 0;
                            }

                            var h_over_result = parseInt(h_over_total) - parseInt(h_over_input);
                            h_over_bal.val(h_over_result);
                        </script>
                    </tr>
                    <tr class="tr-daily">
                        <td>
                            <span>Inline : </span>
                        </td>
                        <td>
                            <div class="input-wrapper">
                                <input class="form-control daily-prod-input" type="number" id="inline_input" name="inline_input" min="0" value="<?php echo $inline_input_2; ?>" />
                                <label for="user">Inline Input</label>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <input class="icon-btn-one btn my-2" type="submit" value="Submit" name="submit" />
        </form>
        <script>
            $("#daily_production_submit_2").submit(function(e) {
                e.preventDefault();

                // Get all INPUT form data and organize as array
                var formData_2 = $(this).serializeArray();

                // Submit with AJAX
                $.ajax({
                    type: "POST",
                    url: "/daily_production_post_2",
                    data: formData_2,
                    type: 'post',
                    success: function(data) {
                        // console.log(data);
                        alert('Successfully Submitted');
                        // location.reload();
                    }
                });
            });
        </script>
<?php
    }

    public function postDailyProductionData()
    {
        $assign_id = request()->post('assign_id');
        $line_id = request()->post('line_id');
        $o_qty = request()->post('overall_quantity');
        $today_target = request()->post('today_target');
        $man_target = request()->post('man_target');
        $t_target = request()->post('t_target');
        $today_actual_target = request()->post('today_actual_target');
        $man_actual_target = request()->post('man_actual_target');
        $t_actual_target = request()->post('t_actual_target');
        $man_power_input = request()->post('man_power_input');
        $hp_input = request()->post('hp_input');
        $total_man_power = request()->post('total_man_power');
        $man_power_actual_input = request()->post('man_power_actual_input');
        $hp_actual_input = request()->post('hp_actual_input');
        $total_actual_man_power = request()->post('total_actual_man_power');

        LineAssign::where('assign_id', $assign_id)->where('l_id', $line_id)->update(['m_power' => $man_power_input, 'actual_m_power' => $man_power_actual_input, 'hp' => $hp_input, 'actual_hp' => $hp_actual_input, 'man_target' => $man_target, 'man_actual_target' => $man_actual_target]);
    }

    public function postDailyProductionData2()
    {
        $p_id = request()->post('p_id');
        $assign_id = request()->post('a_id');
        $line_id = request()->post('l_id');
        $cat_id = request()->post('cat_id');

        $sewing_input = request()->post('sewing_input');
        $clothes_input = request()->post('clothes_input');
        $clothes_total = request()->post('clothes_total');
        $handover_input = request()->post('handover_input');
        $handover_total = request()->post('handover_total');
        $handover_bal = request()->post('handover_bal');
        $inline_input = request()->post('inline_input');


        ProductDetail::where('p_detail_id', $p_id)->where('assign_id', $assign_id)->where('l_id', $line_id)->where('p_cat_id', $cat_id)->update(['sewing_input' => $sewing_input, 'h_over_input' => $handover_input, 'inline' => $inline_input]);
    }
}
