<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Line;


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

        DB::disconnect('musung');

        $line_decode = json_decode(json_encode($line), true);
        $p_detail_decode = json_decode(json_encode($p_detail), true);

        for ($i = 0; $i < count($line_decode); $i++) {
            $l_id = $line_decode[$i]['l_id'];
            $l_name = $line_decode[$i]['l_name'];
?>
            <h1 class="fw-bold heading-text fs-3"><?php echo $l_name; ?></h1>

            <div class="div-daily">
                <span>Quantity : </span>
                <div class="input-wrapper">
                    <input class="form-control daily-prod-input" type="number" id="overall_quantity" name="overall_quantity" min="0" oninput="validity.valid||(value='');" required />
                    <label for="user">Quantity</label>
                </div>

            </div>

            <div class="div-daily">
                <span>Target : </span>
                <div class="input-wrapper">
                    <input class="form-control daily-prod-input" type="number" id="today_target" name="today_target" min="0" oninput="validity.valid||(value='');" required />
                    <label for="user">Today Target</label>
                </div>
                <div class="input-wrapper">
                    <input class="form-control daily-prod-input" type="number" id="man_target" name="man_target" min="0" oninput="validity.valid||(value='');" step="any" required />
                    <label for="user">Man-Power Target</label>
                </div>
                <div class="input-wrapper">
                    <input class="form-control daily-prod-input" type="number" id="t_target" name="t_target" min="0" oninput="validity.valid||(value='');" required />
                    <label for="user">Total Target</label>
                </div>
            </div>
            <div class="div-daily">
                <span>Actual Target : </span>
                <div class="input-wrapper">
                    <input class="form-control daily-prod-input" type="number" id="today_target" name="today_target" min="0" oninput="validity.valid||(value='');" required />
                    <label for="user">Today Actual Target</label>
                </div>
                <div class="input-wrapper">
                    <input class="form-control daily-prod-input" type="number" id="man_target" name="man_target" min="0" oninput="validity.valid||(value='');" step="any" required />
                    <label for="user">Man-Power Actual Target</label>
                </div>
                <div class="input-wrapper">
                    <input class="form-control daily-prod-input" type="number" id="t_target" name="t_target" min="0" oninput="validity.valid||(value='');" required />
                    <label for="user">Total Actual Target</label>
                </div>
            </div>
            <div class="div-daily">
                <span>ManPower Target : </span>
                <div class="input-wrapper">
                    <input class="form-control daily-prod-input" type="number" id="man_power_input" name="man_power_input" min="0" oninput="validity.valid||(value='');" required />
                    <label for="user">S,L,Adm,Op Input</label>
                </div>
                <div class="input-wrapper">
                    <input class="form-control daily-prod-input" type="number" id="hp_input" name="hp_input" min="0" oninput="validity.valid||(value='');" required />
                    <label for="user">HP</label>
                </div>
                <div class="input-wrapper">
                    <input class="form-control daily-prod-input" type="number" id="t_target" name="t_target" min="0" oninput="validity.valid||(value='');" required />
                    <label for="user">Total ManPower</label>
                </div>
            </div>
            <div class="div-daily">
                <span>ManPower Actual Target : </span>
                <div class="input-wrapper">
                    <input class="form-control daily-prod-input" type="number" id="man_power_actual_input" name="man_power_actual_input" min="0" oninput="validity.valid||(value='');" required />
                    <label for="user">S,L,Adm,Op Actual Input</label>
                </div>
                <div class="input-wrapper">
                    <input class="form-control daily-prod-input" type="number" id="hp_actual_input" name="hp_actual_input" min="0" oninput="validity.valid||(value='');" required />
                    <label for="user">Actual HP</label>
                </div>
                <div class="input-wrapper">
                    <input class="form-control daily-prod-input" type="number" id="t_target" name="t_target" min="0" oninput="validity.valid||(value='');" required />
                    <label for="user">Total Actual ManPower</label>
                </div>
            </div>
        <?php
        }
        ?>
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
                    <li class="list-group-item span2 open2" data-cat-id="<?php echo $p_cat_id; ?>" data-p-id="<?php echo $p_id; ?>" data-a-id="<?php echo $a_id; ?>" data-l-id="<?php echo $l_id_2; ?>">
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
        <script>
            $(function() {
                $(".open2").on('click', function(e) {
                    e.preventDefault(); // in chase you change to a link or button
                    var cat_id = $(this).data('cat-id');
                    var p_id = $(this).data('p-id');
                    var a_id = $(this).data('a-id');
                    var l_id = $(this).data('l-id');

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

        $p_detail = DB::select('SELECT "p_detail".p_detail_id,"p_detail".assign_id,"p_detail".l_id,"p_detail".p_cat_id,"p_detail".p_name
        FROM p_detail JOIN line_assign ON "line_assign".assign_id="p_detail".assign_id
        AND "line_assign".assign_date=\'' . $date_string . '\'
        WHERE "p_detail".p_cat_id=' . $cat_id . ' AND "p_detail".p_detail_id=' . $p_id . ' AND "p_detail".assign_id=' . $a_id . ' AND "p_detail".l_id=' . $l_id . '');

        DB::disconnect('musung');

        $p_detail_decode = json_decode(json_encode($p_detail), true);

    ?>
        <?php for ($k = 0; $k < count($p_detail_decode); $k++) {
            $p_name_2 = $p_detail_decode[$k]['p_name'];
        ?>
            <h1 class="fw-bold heading-text fs-3"><?php echo $p_name_2; ?></h1>
        <?php
        } ?>
        <div class="div-daily">
            <span>Sewing Input : </span>
            <div class="input-wrapper">
                <input class="form-control daily-prod-input" type="number" id="sewing_input" name="sewing_input" min="0" oninput="validity.valid||(value='');" required />
                <label for="user">Sewing Input</label>
            </div>
            <div class="input-wrapper">
                <input class="form-control daily-prod-input" type="number" id="sewing_total" name="sewing_total" min="0" oninput="validity.valid||(value='');" required />
                <label for="user">Sewing Total</label>
            </div>
        </div>

        <div class="div-daily">
            <span>Clothes Input : </span>
            <div class="input-wrapper">
                <input class="form-control daily-prod-input" type="number" id="clothes_input" name="clothes_input" min="0" oninput="validity.valid||(value='');" required />
                <label for="user">Clothes Input</label>
            </div>
            <div class="input-wrapper">
                <input class="form-control daily-prod-input" type="number" id="clothes_total" name="clothes_total" min="0" oninput="validity.valid||(value='');" required />
                <label for="user">Clothes Total</label>
            </div>
        </div>

        <div class="div-daily">
            <span>HandOver : </span>
            <div class="input-wrapper">
                <input class="form-control daily-prod-input" type="number" id="handover_input" name="handover_input" min="0" oninput="validity.valid||(value='');" required />
                <label for="user">HandOver Input</label>
            </div>
            <div class="input-wrapper">
                <input class="form-control daily-prod-input" type="number" id="handover_total" name="handover_total" min="0" oninput="validity.valid||(value='');" required />
                <label for="user">HandOver Total</label>
            </div>
            <div class="input-wrapper">
                <input class="form-control daily-prod-input" type="number" id="handover_bal" name="handover_bal" min="0" oninput="validity.valid||(value='');" required />
                <label for="user">HandOver Balance</label>
            </div>
        </div>
<?php
    }
}
