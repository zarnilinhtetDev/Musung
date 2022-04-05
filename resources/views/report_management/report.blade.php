@extends('layouts.app')

@section('content')

@section('content_2')

<?php
$date_string = date("d.m.Y");
?>

@admin

<div class="container-fluid">
    <div class="col-12 col-md-4 my-3 p-0">
        <ul class="horizontal-slide" id="tabs">
            <li class="span2">
                <p>Date - {{ $date_string }} </p>
            </li>
        </ul>
    </div>

    <?php
    $daily_report_decode = json_decode(json_encode($daily_report),true);
    $daily_report_product_decode = json_decode(json_encode($daily_report_product),true);
    ?>

    <?php
@$edit_status = $_GET['edit'];
?>

    @if(!$edit_status)
    <a class='btn custom-btn-theme custom-btn-theme-edit text-white' href="{{ url('/report')}}?edit=1">Edit</a>
    @endif

    <form method="POST" id="cmp_put">
        @if($edit_status)
        <input class="icon-btn-one btn my-2" type="submit" value="Update" name="submit" />
        <a href="{{ url('/report') }}" class="btn-secondary btn my-2">Cancel</a>
        @endif
        <div style="overflow-x:auto;max-width:100%;">
            <table class="table table-striped my-4 tableFixHead results p-0 text-center table-bordered">
                <thead>
                    <tr class="tr-2">
                        <th scope="col">Line</th>
                        <th scope="col">Buyer</th>
                        <th scope="col">Style No.#</th>
                        <th scope="col">Item</th>
                        <th scope="col">Target</th>
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
                    @for($i=0;$i<count($daily_report_decode);$i++) @php
                        $l_id=$daily_report_decode[$i]['l_id'];$l_name=$daily_report_decode[$i]['l_name'];$main_target=$daily_report_decode[$i]['main_target'];$actual_target=$daily_report_decode[$i]['total_div_actual_target'];
                        $m_power=$daily_report_decode[$i]['m_power'];$actual_m_power=$daily_report_decode[$i]['actual_m_power'];$hp=$daily_report_decode[$i]['hp'];$actual_hp=$daily_report_decode[$i]['actual_hp'];
                        @endphp <tr>
                        <td>{{ $l_name }}</td>

                        {{-- Buyer --}}
                        <td>
                            <table class="m-auto text-center table table-bordered custom-table-border-color">
                                <tbody>
                                    <tr>
                                        <td>-</td>
                                    </tr>
                                    @for($j=0;$j<count($daily_report_product_decode);$j++) @php
                                        $l_id_2=$daily_report_product_decode[$j]['l_id'];
                                        $p_cat_name=$daily_report_product_decode[$j]['p_cat_name'] @endphp
                                        @if($l_id_2==$l_id) <tr>
                                        @if($p_cat_name == '')
                                        <td> - </td>
                                        @endif
                                        @if($p_cat_name != '')
                                        <td>{{ $p_cat_name }}</td>
                                        @endif
                                        </tr>
                                        @endif

                                        @endfor

                                </tbody>
                            </table>
                        </td>
                        {{-- Style No. --}}
                        <td>
                            <table class="m-auto text-center table table-bordered custom-table-border-color">
                                <tbody>
                                    <tr>
                                        <td>-</td>
                                    </tr>
                                    @for($j=0;$j<count($daily_report_product_decode);$j++) @php
                                        $l_id_2=$daily_report_product_decode[$j]['l_id'];
                                        $style_no_2=$daily_report_product_decode[$j]['style_no'] @endphp
                                        @if($l_id_2==$l_id) <tr>
                                        @if($style_no_2 == '')
                                        <td> - </td>
                                        @endif
                                        @if($style_no_2 != '')
                                        <td>{{ $style_no_2 }}</td>
                                        @endif
                                        </tr>
                                        @endif

                                        @endfor

                                </tbody>
                            </table>
                        </td>
                        <td>
                            <table class="m-auto text-start table table-bordered custom-table-border-color">
                                <tbody>
                                    <tr class="bg-warning text-white">
                                        <td><span>Overall Target</span></td>
                                    </tr>
                                    @for($j=0;$j<count($daily_report_product_decode);$j++) @php
                                        $l_id_2=$daily_report_product_decode[$j]['l_id'];
                                        $p_name=$daily_report_product_decode[$j]['p_name'] @endphp @if($l_id_2==$l_id)
                                        <tr>
                                        <td>{{ $p_name }}</td>
                                        </tr>
                                        @endif

                                        @endfor
                                </tbody>
                            </table>
                        </td>
                        <td class="main_target_{{ $l_id }}">{{ $main_target }}</td>
                        <td class="actual_target_{{ $l_id }}">{{ $actual_target }}</td>
                        <td class="percent_{{ $l_id }}">percent</td>

                        <script>
                            var main_target = $('.main_target_{{ $l_id }}').text();
                            var actual_target = $('.actual_target_{{ $l_id }}').text();
                            var percent = (actual_target / main_target) * 100;
                            $('.percent_{{ $l_id }}').text(percent.toFixed(0) + "%");
                        </script>
                        <td class="text-danger"></td>

                        <!-- Sewing Input --->
                        <td>
                            <table class="m-auto text-center table table-bordered custom-table-border-color">
                                <tbody>
                                    <tr>
                                        <td>-</td>
                                    </tr>
                                    @for($j=0;$j<count($daily_report_product_decode);$j++) @php
                                        $l_id_2=$daily_report_product_decode[$j]['l_id'];
                                        $sewing_input=$daily_report_product_decode[$j]['sewing_input'] @endphp
                                        @if($l_id_2==$l_id) <tr>
                                        @if($sewing_input == '')
                                        <td> - </td>
                                        @endif
                                        @if($sewing_input != '')
                                        <td>{{ $sewing_input }}</td>
                                        @endif
                                        </tr>
                                        @endif

                                        @endfor

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
                                    @for($j=0;$j<count($daily_report_product_decode);$j++) @php
                                        $l_id_2=$daily_report_product_decode[$j]['l_id'];
                                        $sewing_input=$daily_report_product_decode[$j]['sewing_input'] @endphp
                                        @if($l_id_2==$l_id) <tr>
                                        @if($sewing_input == '')
                                        <td> - </td>
                                        @endif
                                        @if($sewing_input != '')
                                        <td>{{ $sewing_input }}</td>
                                        @endif
                                        </tr>
                                        @endif

                                        @endfor

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
                                    @for($j=0;$j<count($daily_report_product_decode);$j++) @php
                                        $l_id_2=$daily_report_product_decode[$j]['l_id'];
                                        $p_id_2=$daily_report_product_decode[$j]['p_detail_id'];
                                        $cat_actual_target=$daily_report_product_decode[$j]['cat_actual_target'] @endphp
                                        @if($l_id_2==$l_id) <tr>

                                        @if($cat_actual_target == '')
                                        <td> - </td>
                                        @endif
                                        @if($cat_actual_target != '')
                                        <td class="cat_actual_target_{{ $p_id_2 }}">{{ $cat_actual_target }}</td>
                                        @endif

                                        </tr>
                                        @endif

                                        @endfor
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
                                    @for($j=0;$j<count($daily_report_product_decode);$j++) @php
                                        $l_id_2=$daily_report_product_decode[$j]['l_id'];
                                        $cat_actual_target=$daily_report_product_decode[$j]['cat_actual_target'] @endphp
                                        @if($l_id_2==$l_id) <tr>
                                        @if($cat_actual_target == '')
                                        <td> - </td>
                                        @endif
                                        @if($cat_actual_target != '')
                                        <td>{{ $cat_actual_target }}</td>
                                        @endif </tr>
                                        @endif

                                        @endfor

                                </tbody>
                            </table>
                        </td>

                        {{-- CMP($) --}}
                        <td>
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td>-</td>
                                    </tr>
                                    @for($j=0;$j<count($daily_report_product_decode);$j++) @php
                                        $l_id_2=$daily_report_product_decode[$j]['l_id'];
                                        $a_id_2=$daily_report_product_decode[$j]['assign_id'];
                                        $p_id_2=$daily_report_product_decode[$j]['p_detail_id'];
                                        $cmp=$daily_report_product_decode[$j]['cmp']; @endphp @if($l_id_2==$l_id) <tr>

                                        @if($edit_status)
                                        <td class="td_input">
                                            <input type="hidden" id="l_id_input" name="l_id[]"
                                                value="<?php echo $l_id_2; ?>" />
                                            <input type="hidden" id="a_id_input" name="a_id[]"
                                                value="<?php echo $a_id_2; ?>" />
                                            <input type="hidden" id="p_id_input" name="p_id[]"
                                                value="<?php echo $p_id_2; ?>" />
                                            <input type="number" id="cmp_input" class="form-control p-0 text-center"
                                                name="cmp[]" placeholder="0" min="0" step="any"
                                                value="<?php echo $cmp; ?>">
                                        </td>
                                        @else
                                        <td>
                                            @if($cmp != '')
                                            $
                                            <span class="cmp_{{ $p_id_2 }}">
                                                <?php echo $cmp; ?>
                                            </span>
                                            @endif
                                        </td>
                                        @endif
                        </td>
                        </tr>
                        @endif

                        @endfor

                </tbody>
            </table>
            </td>

            {{-- Daily CMP income --}}
            <td>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td colspan="">-</td>
                            <td class="total_cmp_{{ $l_id }}">total_cmp</td>
                        </tr>
                        @for($j=0;$j<count($daily_report_product_decode);$j++) @php
                            $l_id_2=$daily_report_product_decode[$j]['l_id'];
                            $p_id_2=$daily_report_product_decode[$j]['p_detail_id']; @endphp @if($l_id_2==$l_id) <tr>
                            <td class="daily_cmp_{{ $p_id_2 }} cmp_product_{{ $l_id_2 }}">

                            </td>
                            </tr>


                            <script>
                                var clothes_output = parseFloat($(".cat_actual_target_{{ $p_id_2 }}").text());
                                var cmp = parseFloat($('.cmp_{{ $p_id_2 }}').text());
                                var daily_cmp = $('.daily_cmp_{{ $p_id_2 }}');

                                var multiply_cmp = clothes_output * cmp;

                                if(Number.isNaN(multiply_cmp)){
                                    daily_cmp.text('-');
                                }
                                else{
                                daily_cmp.text("$ " + multiply_cmp.toFixed(1));
                                }


            var cmp_product=$(".cmp_product_{{ $l_id_2 }}");
            var total_cmp_class = $(".total_cmp_{{ $l_id_2 }}");
            var total_cmp = 0;

            cmp_product.each(function() {
                var cmp_product_text=$(this).text(); var substring=parseFloat(cmp_product_text.substring(2));

                if(Number.isNaN(substring)){
                    substring = 0;
                }
                else{
                    total_cmp += substring;
                }

    });
        total_cmp_class.text("$ " + total_cmp);

                            </script>

                            @endif

                            @endfor
                    </tbody>
                </table>

            </td>
            <td class="accumulation_{{ $l_id }}">

            </td>

            <script>
                var total_cmp_class = $(".total_cmp_{{ $l_id }}").text();
                var accumulation = $('.accumulation_{{ $l_id }}');

                accumulation.text(total_cmp_class);
            </script>
            <!-- Inline --->
            <td>
                <table class="m-auto text-center table table-bordered custom-table-border-color">
                    <tbody>
                        <tr>
                            <td>-</td>
                        </tr>
                        @for($j=0;$j<count($daily_report_product_decode);$j++) @php
                            $l_id_2=$daily_report_product_decode[$j]['l_id'];
                            $inline_2=$daily_report_product_decode[$j]['inline'] @endphp @if($l_id_2==$l_id) <tr>
                            @if($inline_2 == '')
                            <td> - </td>
                            @endif
                            @if($inline_2 != '')
                            <td>{{ $inline_2 }}</td>
                            @endif
                            </tr>
                            @endif

                            @endfor

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
                        @for($j=0;$j<count($daily_report_product_decode);$j++) @php
                            $l_id_2=$daily_report_product_decode[$j]['l_id'];
                            $h_over_input=$daily_report_product_decode[$j]['h_over_input'] @endphp @if($l_id_2==$l_id)
                            <tr>
                            @if($h_over_input == '')
                            <td> - </td>
                            @endif
                            @if($h_over_input != '')
                            <td>{{ $h_over_input }}</td>
                            @endif
                            </tr>
                            @endif

                            @endfor

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
                        @for($j=0;$j<count($daily_report_product_decode);$j++) @php
                            $l_id_2=$daily_report_product_decode[$j]['l_id'];
                            $h_over_input=$daily_report_product_decode[$j]['h_over_input'] @endphp @if($l_id_2==$l_id)
                            <tr>
                            @if($h_over_input == '')
                            <td> - </td>
                            @endif
                            @if($h_over_input != '')
                            <td>{{ $h_over_input }}</td>
                            @endif
                            </tr>
                            @endif

                            @endfor

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
                        @for($j=0;$j<count($daily_report_product_decode);$j++) @php
                            $l_id_2=$daily_report_product_decode[$j]['l_id'];
                            $h_over_input=$daily_report_product_decode[$j]['h_over_input']; $h_over_bal=$h_over_input -
                            $h_over_input; @endphp @if($l_id_2==$l_id) <tr>
                            <td>{{ $h_over_bal }}</td>
                            </tr>
                            @endif

                            @endfor

                    </tbody>
                </table>
            </td>

            <td>
                <table class="m-auto text-center w-100 table table-bordered custom-table-border-color">
                    <tbody>
                        <tr>
                            <td class="m_power_value_{{ $l_id }}">{{ $m_power }}</td>
                            <td class="hp_value_{{ $l_id }}">{{ $hp }}</td>
                        </tr>
                        <tr>
                            <td class="total_m_power_{{ $l_id }}" colspan="2"></td>
                        </tr>
                        <tr>
                            <td class="actual_m_power_value_{{ $l_id }}">{{ $actual_m_power }}</td>
                            <td class="actual_hp_value_{{ $l_id }}">{{ $actual_hp }}</td>
                        </tr>
                        <tr>
                            <td class="total_actual_m_power_{{ $l_id }}" colspan="2"></td>
                        </tr>
                    </tbody>
                </table>

                <script>
                    var m_power_value = parseInt($('.m_power_value_{{ $l_id }}').text());
                            var hp_value = parseInt($('.hp_value_{{ $l_id }}').text());
                            var actual_m_power = parseInt($('.actual_m_power_value_{{ $l_id }}').text());
                            var actual_hp_value = parseInt($('.actual_hp_value_{{ $l_id }}').text());

                            var total_m_power_value = $('.total_m_power_{{ $l_id }}');
                            var total_actual_m_power_value = $('.total_actual_m_power_{{ $l_id }}');

                            var total_m_power = m_power_value + hp_value;
                            var total_actual_m_power = actual_m_power + actual_hp_value;

                            if(Number.isNaN(total_m_power)){
                            total_m_power_value.text('');
                            total_actual_m_power_value.text('');
                            }
                            else{
                            total_m_power_value.text(total_m_power);
                            total_actual_m_power_value.text(total_actual_m_power);
                            }

                </script>
            </td>


            <!----- Total Time ------>

            @for($k=0;$k<count($daily_report_decode);$k++) @php $l_id_2=$daily_report_decode[$k]['l_id'];
                $total_time=(int)$daily_report_decode[$k]['total_time']; $subtraction=$total_time - 1; @endphp
                @if($l_id_2==$l_id) <td class="total_time_{{ $l_id_2 }}"> {{
                $subtraction }} </td>

                @endif

                @endfor

                <!----- Total Time  End ------>

                <td class="cmp_hr_{{ $l_id }}"></td>
                <td class="cmp_hr_ps_{{ $l_id }}"></td>
                <td>
                    @if($edit_status==1)
                    <input type="hidden" name="l_id_remark[]" value="<?php echo $l_id; ?>" /><textarea
                        class="form-control note" name="note[]" placeholder="Note" id="note" maxlength="150"></textarea>
                    @endif
                </td>
                </tr>

                <script>
                    // For CMP/hr
                    var total_cmp_2 = $('.total_cmp_{{ $l_id }}').text();
                   var substring_2=parseFloat(total_cmp_2.substring(2));
    var total_time_2 = parseInt($('.total_time_{{ $l_id }}').text());

    var cmp_hr = $('.cmp_hr_{{ $l_id }}');

    var div_time = substring_2 / total_time_2;


    cmp_hr.text("$ " + div_time);

    /// For CMP/hr end

    /// For CMP/ HR/ PS
var total_actual_m_power_2 = $('.total_actual_m_power_{{ $l_id }}').text();
var cmp_hr_3 = $('.cmp_hr_{{ $l_id }}').text();
var cmp_hr_ps = $('.cmp_hr_ps_{{ $l_id }}');


var substring_3 = parseFloat(cmp_hr_3.substring(2));
var substring_4 = parseFloat(total_actual_m_power_2.substring(2));

var div_cmp_hr_ps = substring_3 / total_actual_m_power_2;

if(Number.isNaN(div_cmp_hr_ps)){
    cmp_hr_ps.text('');
}
                            else{
cmp_hr_ps.text("$ " + div_cmp_hr_ps.toFixed(1));

console.log(div_cmp_hr_ps);

                            }
    /// For CMP/ HR/ PS end

                </script>
                @endfor

                </tbody>
                </table>
        </div>
    </form>
    <script>
        $("#cmp_put").submit(function(e) {
e.preventDefault();

// Get NON-INPUT table cell data
var box = {};
var boxes = [];
$('.td_input').each(function() {
    var l_id_input = $('#l_id_input', this).val();
    var a_id_input = $('#a_id_input', this).val();
    var p_id_input = $('#p_id_input', this).val();
    var cmp_input = $('#cmp_input',this).val();
box = {
l_id_input: l_id_input,
a_id_input: a_id_input,
p_id_input: p_id_input,
cmp_input: cmp_input,
}
boxes.push(box);
});

var note_object = {};
var note_arr = [];
$('.note').each(function(){
    var note_input = $(this).val();
    var l_id_remark = $(this).val();

    note_object = {
        note_input: note_input,
        l_id_remark : l_id_remark
    }

    note_arr.push(note_object);

});

$.ajax({
        type: "POST",
        url: "/cmp_put",
        data: {
            boxes: boxes,
            note_arr: note_arr,
        },
        success: function(data) {
            // console.log(data);
            window.location.href = "/report?update=ok";
        }
    });
});

    </script>
</div>
<div class="row container-fluid">
    <div class="col-12 col-md-6 my-4 rounded shadow" id="production_chart">
    </div>
    <div class="col-12 col-md-6 my-auto" id="product_chart">
    </div>
</div>
<script>
    let getTheme = localStorage.getItem("style");
</script>

<script>
    if(getTheme=='light'){
        var options = {
    series: [{
    name: 'Target',
    data: [
    @foreach($target as $t)
    @php
    $t_main_target = $t->t_main_target;
    echo $t_main_target . ',';
    @endphp
    @endforeach]
    }, {
    name: 'Actual Target',
    data: [@foreach($time as $t)
@php
$t_div_actual_target = $t->t_actual_target;
echo $t_div_actual_target . ',';
@endphp
@endforeach]
    }],
    title: {
    text: 'Production Report of last 30 days',
    align: 'left',
    margin: 10,
    offsetX: 0,
    offsetY: 0,
    floating: false,
    style: {
      fontSize:  '14px',
      fontWeight:  'bold',
      fontFamily:  'Arial',
      color:  '#263238'
    },
},
    chart: {
    height: 350,
    type: 'area',
    toolbar: {
    show: true
},
    },
legend: {
      labels: {
          colors: ['#263238'],
          useSeriesColors: false
      },
    },
    dataLabels: {
    enabled: true,
    },
    stroke: {
    curve: 'smooth'
    },
    xaxis: {
    categories: [
    @foreach($target as $t_2)
    @php
    $assign_date = $t_2->assign_date;
    $month = date('m', strtotime($assign_date)); // Create date object to store the DateTime format
    $day = date('d', strtotime($assign_date));
    $dateObj = DateTime::createFromFormat('!m', $month);

    // Store the month name to variable
    $monthName = $dateObj->format('F');
    $full_format = $day . ' ' . $monthName;

    echo '"' . $full_format . '"' . ',';;
    @endphp
    @endforeach],
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
    yaxis:{
    labels: {
          show: true,
          style:{
              colors:'#263238',
          },
    },
    },
    tooltip: {
    theme: 'dark'
  },
    };

    var chart = new ApexCharts(document.querySelector("#production_chart"), options);
    chart.render();
    }

    if(getTheme=='dark'){
        var options = {
    series: [{
    name: 'Target',
    data: [
    @foreach($target as $t)
    @php
    $t_main_target = $t->t_main_target;
    echo $t_main_target . ',';
    @endphp
    @endforeach]
    }, {
    name: 'Actual Target',
    data: [@foreach($time as $t)
@php
$t_div_actual_target = $t->t_actual_target;
echo $t_div_actual_target . ',';
@endphp
@endforeach]
    }],
    title: {
    text: 'Production Report of last 30 days',
    align: 'left',
    margin: 10,
    offsetX: 0,
    offsetY: 0,
    floating: false,
    style: {
      fontSize:  '14px',
      fontWeight:  'bold',
      fontFamily:  'Arial',
      color:  '#fff'
    },
},
    chart: {
    height: 350,
    type: 'area',
    toolbar: {
    show: true
},
    },
legend: {
      labels: {
          colors: ['#fff'],
          useSeriesColors: false
      },
    },
    dataLabels: {
    enabled: true,
    },
    stroke: {
    curve: 'smooth'
    },
    xaxis: {
    categories: [
    @foreach($target as $t_2)
    @php
    $assign_date = $t_2->assign_date;
    $month = date('m', strtotime($assign_date)); // Create date object to store the DateTime format
    $day = date('d', strtotime($assign_date));
    $dateObj = DateTime::createFromFormat('!m', $month);

    // Store the month name to variable
    $monthName = $dateObj->format('F');
    $full_format = $day . ' ' . $monthName;

    echo '"' . $full_format . '"' . ',';;
    @endphp
    @endforeach],
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
    yaxis:{
    labels: {
          show: true,
          style:{
              colors:'#fff',
          },
    },
    },
    tooltip: {
    theme: 'dark'
  },
    };

    var chart = new ApexCharts(document.querySelector("#production_chart"), options);
    chart.render();
    }

    if(getTheme=='gray'){
        var options = {
    series: [{
    name: 'Target',
    data: [
    @foreach($target as $t)
    @php
    $t_main_target = $t->t_main_target;
    echo $t_main_target . ',';
    @endphp
    @endforeach]
    }, {
    name: 'Actual Target',
    data: [@foreach($time as $t)
@php
$t_div_actual_target = $t->t_actual_target;
echo $t_div_actual_target . ',';
@endphp
@endforeach]
    }],
    title: {
    text: 'Production Report of last 30 days',
    align: 'left',
    margin: 10,
    offsetX: 0,
    offsetY: 0,
    floating: false,
    style: {
      fontSize:  '14px',
      fontWeight:  'bold',
      fontFamily:  'Arial',
      color:  '#fff'
    },
},
    chart: {
    height: 350,
    type: 'area',
    toolbar: {
    show: true
},
    },
legend: {
      labels: {
          colors: ['#fff'],
          useSeriesColors: false
      },
    },
    dataLabels: {
    enabled: true,
    },
    stroke: {
    curve: 'smooth'
    },
    xaxis: {
    categories: [
    @foreach($target as $t_2)
    @php
    $assign_date = $t_2->assign_date;
    $month = date('m', strtotime($assign_date)); // Create date object to store the DateTime format
    $day = date('d', strtotime($assign_date));
    $dateObj = DateTime::createFromFormat('!m', $month);

    // Store the month name to variable
    $monthName = $dateObj->format('F');
    $full_format = $day . ' ' . $monthName;

    echo '"' . $full_format . '"' . ',';;
    @endphp
    @endforeach],
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
    yaxis:{
    labels: {
          show: true,
          style:{
              colors:'#fff',
          },
    },
    },
    tooltip: {
    theme: 'dark'
  },
    };

    var chart = new ApexCharts(document.querySelector("#production_chart"), options);
    chart.render();
    }
</script>

<script>
    if(getTheme=='dark'){
        var options = {
  series: [@foreach($category as $c)
@php
$cat_actual = $c->t_cat_actual;
if($cat_actual == ''){
$cat_actual = 0;
}
if($cat_actual!=''){
$cat_actual = $cat_actual;
}
echo $cat_actual . ',';
@endphp
@endforeach],
  chart: {
      width:'100%',
      height:'80%',
      type: 'pie',
      toolbar: {
    show: true,
},
},title: {
    text: 'Production Report of Items for 30 days',
    align: 'left',
    margin: 10,
    offsetX: 0,
    offsetY: 0,
    floating: false,
    style: {
      fontSize:  '14px',
      fontWeight:  'bold',
      fontFamily:  'Arial',
      color:  '#fff'
    },
},
legend: {
      position: 'right',
      labels: {
          colors: ['#fff'],
          useSeriesColors: false
      },
    },
labels: [
@foreach($category as $c)
@php
$p_name = $c->p_name;
echo '"' . $p_name . '"' . ',';
@endphp
@endforeach],
responsive: [{
  breakpoint: 480,
  options: {
    chart: {
    //   width: 200
    },
    legend: {
      position: 'bottom'
    },
  }
}]
};

var chart = new ApexCharts(document.querySelector("#product_chart"), options);
chart.render();
    }

    if(getTheme=='light'){
        var options = {
  series: [@foreach($category as $c)
@php
$cat_actual = $c->t_cat_actual;
if($cat_actual == ''){
$cat_actual = 0;
}
if($cat_actual!=''){
$cat_actual = $cat_actual;
}
echo $cat_actual . ',';
@endphp
@endforeach],
  chart: {
      width:'100%',
      height:'80%',
    //   background: '#fff',
      type: 'pie',
      toolbar: {
    show: true,
},
},title: {
    text: 'Production Report of Items for 30 days',
    align: 'left',
    margin: 10,
    offsetX: 0,
    offsetY: 0,
    floating: false,
    style: {
      fontSize:  '14px',
      fontWeight:  'bold',
      fontFamily:  'Arial',
      color: '#263238'
    },
},
legend: {
      position: 'right',
    //   labels: {
    //       colors: ['#fff'],
    //       useSeriesColors: false
    //   },
    },
labels: [
@foreach($category as $c)
@php
$p_name = $c->p_name;
echo '"' . $p_name . '"' . ',';
@endphp
@endforeach],
responsive: [{
  breakpoint: 480,
  options: {
    chart: {
    //   width: 200
    },
    legend: {
      position: 'bottom'
    },
  }
}]
};

var chart = new ApexCharts(document.querySelector("#product_chart"), options);
chart.render();
    }

    if(getTheme=='gray'){
        var options = {
  series: [@foreach($category as $c)
@php
$cat_actual = $c->t_cat_actual;
if($cat_actual == ''){
$cat_actual = 0;
}
if($cat_actual!=''){
$cat_actual = $cat_actual;
}
echo $cat_actual . ',';
@endphp
@endforeach],
  chart: {
      width:'100%',
      height:'80%',
      type: 'pie',
      toolbar: {
    show: true,
},
},title: {
    text: 'Production Report of Items for 30 days',
    align: 'left',
    margin: 10,
    offsetX: 0,
    offsetY: 0,
    floating: false,
    style: {
      fontSize:  '14px',
      fontWeight:  'bold',
      fontFamily:  'Arial',
      color:  '#fff'
    },
},
legend: {
      position: 'right',
      labels: {
          colors: ['#fff'],
          useSeriesColors: false
      },
    },
labels: [
@foreach($category as $c)
@php
$p_name = $c->p_name;
echo '"' . $p_name . '"' . ',';
@endphp
@endforeach],
responsive: [{
  breakpoint: 480,
  options: {
    chart: {
    //   width: 200
    },
    legend: {
      position: 'bottom'
    },tooltip: {
    theme: 'dark'
  },
  }
}]
};

var chart = new ApexCharts(document.querySelector("#product_chart"), options);
chart.render();
    }

</script>

@endadmin

@operator

<div class="container-fluid">
    <div class="col-12 col-md-4 my-3 p-0">
        <ul class="horizontal-slide" id="tabs">
            <li class="span2">
                <p>Date - {{ $date_string }} </p>
            </li>
        </ul>
    </div>

    <?php
    $daily_report_decode = json_decode(json_encode($daily_report),true);
    $daily_report_product_decode = json_decode(json_encode($daily_report_product),true);
    ?>

    <form method="POST" id="cmp_put">
        <div style="overflow-x:auto;max-width:100%;">
            <table class="table table-striped my-4 tableFixHead results p-0 text-center table-bordered">
                <thead>
                    <tr class="tr-2">
                        <th scope="col">Line</th>
                        <th scope="col">Buyer</th>
                        <th scope="col">Style No.#</th>
                        <th scope="col">Item</th>
                        <th scope="col">Target</th>
                        <th scope="col">Output</th>
                        <th scope="col">%</th>
                        <th scope="col">Q'ty</th>
                        <th scope="col">Input</th>
                        <th scope="col">Total</th>
                        <th scope="col">Output</th>
                        <th scope="col">Total</th>
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
                    </tr>
                </thead>
                <tbody id="myTable">
                    @for($i=0;$i<count($daily_report_decode);$i++) @php
                        $l_id=$daily_report_decode[$i]['l_id'];$l_name=$daily_report_decode[$i]['l_name'];$main_target=$daily_report_decode[$i]['main_target'];$actual_target=$daily_report_decode[$i]['total_div_actual_target'];
                        $m_power=$daily_report_decode[$i]['m_power'];$actual_m_power=$daily_report_decode[$i]['actual_m_power'];$hp=$daily_report_decode[$i]['hp'];$actual_hp=$daily_report_decode[$i]['actual_hp'];
                        @endphp <tr>
                        <td>{{ $l_name }}</td>

                        {{-- Buyer --}}
                        <td>
                            <table class="m-auto text-center table table-bordered custom-table-border-color">
                                <tbody>
                                    <tr>
                                        <td>-</td>
                                    </tr>
                                    @for($j=0;$j<count($daily_report_product_decode);$j++) @php
                                        $l_id_2=$daily_report_product_decode[$j]['l_id'];
                                        $p_cat_name=$daily_report_product_decode[$j]['p_cat_name'] @endphp
                                        @if($l_id_2==$l_id) <tr>
                                        @if($p_cat_name == '')
                                        <td> - </td>
                                        @endif
                                        @if($p_cat_name != '')
                                        <td>{{ $p_cat_name }}</td>
                                        @endif
                                        </tr>
                                        @endif

                                        @endfor

                                </tbody>
                            </table>
                        </td>
                        {{-- Style No. --}}
                        <td>
                            <table class="m-auto text-center table table-bordered custom-table-border-color">
                                <tbody>
                                    <tr>
                                        <td>-</td>
                                    </tr>
                                    @for($j=0;$j<count($daily_report_product_decode);$j++) @php
                                        $l_id_2=$daily_report_product_decode[$j]['l_id'];
                                        $style_no_2=$daily_report_product_decode[$j]['style_no'] @endphp
                                        @if($l_id_2==$l_id) <tr>
                                        @if($style_no_2 == '')
                                        <td> - </td>
                                        @endif
                                        @if($style_no_2 != '')
                                        <td>{{ $style_no_2 }}</td>
                                        @endif
                                        </tr>
                                        @endif

                                        @endfor

                                </tbody>
                            </table>
                        </td>
                        <td>
                            <table class="m-auto text-start table table-bordered custom-table-border-color">
                                <tbody>
                                    <tr class="bg-warning text-white">
                                        <td><span>Overall Target</span></td>
                                    </tr>
                                    @for($j=0;$j<count($daily_report_product_decode);$j++) @php
                                        $l_id_2=$daily_report_product_decode[$j]['l_id'];
                                        $p_name=$daily_report_product_decode[$j]['p_name'] @endphp @if($l_id_2==$l_id)
                                        <tr>
                                        <td>{{ $p_name }}</td>
                                        </tr>
                                        @endif

                                        @endfor
                                </tbody>
                            </table>
                        </td>
                        <td class="main_target_{{ $l_id }}">{{ $main_target }}</td>
                        <td class="actual_target_{{ $l_id }}">{{ $actual_target }}</td>
                        <td class="percent_{{ $l_id }}">percent</td>

                        <script>
                            var main_target = $('.main_target_{{ $l_id }}').text();
                            var actual_target = $('.actual_target_{{ $l_id }}').text();
                            var percent = (actual_target / main_target) * 100;
                            $('.percent_{{ $l_id }}').text(percent.toFixed(0) + "%");
                        </script>
                        <td class="text-danger"></td>

                        <!-- Sewing Input --->
                        <td>
                            <table class="m-auto text-center table table-bordered custom-table-border-color">
                                <tbody>
                                    <tr>
                                        <td>-</td>
                                    </tr>
                                    @for($j=0;$j<count($daily_report_product_decode);$j++) @php
                                        $l_id_2=$daily_report_product_decode[$j]['l_id'];
                                        $sewing_input=$daily_report_product_decode[$j]['sewing_input'] @endphp
                                        @if($l_id_2==$l_id) <tr>
                                        @if($sewing_input == '')
                                        <td> - </td>
                                        @endif
                                        @if($sewing_input != '')
                                        <td>{{ $sewing_input }}</td>
                                        @endif
                                        </tr>
                                        @endif

                                        @endfor

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
                                    @for($j=0;$j<count($daily_report_product_decode);$j++) @php
                                        $l_id_2=$daily_report_product_decode[$j]['l_id'];
                                        $sewing_input=$daily_report_product_decode[$j]['sewing_input'] @endphp
                                        @if($l_id_2==$l_id) <tr>
                                        @if($sewing_input == '')
                                        <td> - </td>
                                        @endif
                                        @if($sewing_input != '')
                                        <td>{{ $sewing_input }}</td>
                                        @endif
                                        </tr>
                                        @endif

                                        @endfor

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
                                    @for($j=0;$j<count($daily_report_product_decode);$j++) @php
                                        $l_id_2=$daily_report_product_decode[$j]['l_id'];
                                        $p_id_2=$daily_report_product_decode[$j]['p_detail_id'];
                                        $cat_actual_target=$daily_report_product_decode[$j]['cat_actual_target'] @endphp
                                        @if($l_id_2==$l_id) <tr>

                                        @if($cat_actual_target == '')
                                        <td> - </td>
                                        @endif
                                        @if($cat_actual_target != '')
                                        <td class="cat_actual_target_{{ $p_id_2 }}">{{ $cat_actual_target }}</td>
                                        @endif

                                        </tr>
                                        @endif

                                        @endfor
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
                                    @for($j=0;$j<count($daily_report_product_decode);$j++) @php
                                        $l_id_2=$daily_report_product_decode[$j]['l_id'];
                                        $cat_actual_target=$daily_report_product_decode[$j]['cat_actual_target'] @endphp
                                        @if($l_id_2==$l_id) <tr>
                                        @if($cat_actual_target == '')
                                        <td> - </td>
                                        @endif
                                        @if($cat_actual_target != '')
                                        <td>{{ $cat_actual_target }}</td>
                                        @endif </tr>
                                        @endif

                                        @endfor

                                </tbody>
                            </table>
                        </td>

                        </td>


                        <!-- Inline --->
                        <td>
                            <table class="m-auto text-center table table-bordered custom-table-border-color">
                                <tbody>
                                    <tr>
                                        <td>-</td>
                                    </tr>
                                    @for($j=0;$j<count($daily_report_product_decode);$j++) @php
                                        $l_id_2=$daily_report_product_decode[$j]['l_id'];
                                        $inline_2=$daily_report_product_decode[$j]['inline'] @endphp @if($l_id_2==$l_id)
                                        <tr>
                                        @if($inline_2 == '')
                                        <td> - </td>
                                        @endif
                                        @if($inline_2 != '')
                                        <td>{{ $inline_2 }}</td>
                                        @endif
                                        </tr>
                                        @endif

                                        @endfor

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
                                    @for($j=0;$j<count($daily_report_product_decode);$j++) @php
                                        $l_id_2=$daily_report_product_decode[$j]['l_id'];
                                        $h_over_input=$daily_report_product_decode[$j]['h_over_input'] @endphp
                                        @if($l_id_2==$l_id) <tr>
                                        @if($h_over_input == '')
                                        <td> - </td>
                                        @endif
                                        @if($h_over_input != '')
                                        <td>{{ $h_over_input }}</td>
                                        @endif
                                        </tr>
                                        @endif

                                        @endfor

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
                                    @for($j=0;$j<count($daily_report_product_decode);$j++) @php
                                        $l_id_2=$daily_report_product_decode[$j]['l_id'];
                                        $h_over_input=$daily_report_product_decode[$j]['h_over_input'] @endphp
                                        @if($l_id_2==$l_id) <tr>
                                        @if($h_over_input == '')
                                        <td> - </td>
                                        @endif
                                        @if($h_over_input != '')
                                        <td>{{ $h_over_input }}</td>
                                        @endif
                                        </tr>
                                        @endif

                                        @endfor

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
                                    @for($j=0;$j<count($daily_report_product_decode);$j++) @php
                                        $l_id_2=$daily_report_product_decode[$j]['l_id'];
                                        $h_over_input=$daily_report_product_decode[$j]['h_over_input'];
                                        $h_over_bal=$h_over_input - $h_over_input; @endphp @if($l_id_2==$l_id) <tr>
                                        <td>{{ $h_over_bal }}</td>
                                        </tr>
                                        @endif

                                        @endfor

                                </tbody>
                            </table>
                        </td>

                        <td>
                            <table class="m-auto text-center w-100 table table-bordered custom-table-border-color">
                                <tbody>
                                    <tr>
                                        <td class="m_power_value_{{ $l_id }}">{{ $m_power }}</td>
                                        <td class="hp_value_{{ $l_id }}">{{ $hp }}</td>
                                    </tr>
                                    <tr>
                                        <td class="total_m_power_{{ $l_id }}" colspan="2"></td>
                                    </tr>
                                    <tr>
                                        <td class="actual_m_power_value_{{ $l_id }}">{{ $actual_m_power }}</td>
                                        <td class="actual_hp_value_{{ $l_id }}">{{ $actual_hp }}</td>
                                    </tr>
                                    <tr>
                                        <td class="total_actual_m_power_{{ $l_id }}" colspan="2"></td>
                                    </tr>
                                </tbody>
                            </table>

                            <script>
                                var m_power_value = parseInt($('.m_power_value_{{ $l_id }}').text());
                            var hp_value = parseInt($('.hp_value_{{ $l_id }}').text());
                            var actual_m_power = parseInt($('.actual_m_power_value_{{ $l_id }}').text());
                            var actual_hp_value = parseInt($('.actual_hp_value_{{ $l_id }}').text());

                            var total_m_power_value = $('.total_m_power_{{ $l_id }}');
                            var total_actual_m_power_value = $('.total_actual_m_power_{{ $l_id }}');

                            var total_m_power = m_power_value + hp_value;
                            var total_actual_m_power = actual_m_power + actual_hp_value;

                            if(Number.isNaN(total_m_power)){
                            total_m_power_value.text('');
                            total_actual_m_power_value.text('');
                            }
                            else{
                            total_m_power_value.text(total_m_power);
                            total_actual_m_power_value.text(total_actual_m_power);
                            }

                            </script>
                        </td>

                        </tr>

                        @endfor

                </tbody>
            </table>
        </div>
    </form>
</div>
<div class="row container-fluid">
    <div class="col-12 col-md-6 my-4 rounded shadow" id="production_chart">
    </div>
    <div class="col-12 col-md-6 my-auto" id="product_chart">
    </div>
</div>
<script>
    let getTheme = localStorage.getItem("style");
</script>

<script>
    if(getTheme=='light'){
        var options = {
    series: [{
    name: 'Target',
    data: [
    @foreach($target as $t)
    @php
    $t_main_target = $t->t_main_target;
    echo $t_main_target . ',';
    @endphp
    @endforeach]
    }, {
    name: 'Actual Target',
    data: [@foreach($time as $t)
@php
$t_div_actual_target = $t->t_actual_target;
echo $t_div_actual_target . ',';
@endphp
@endforeach]
    }],
    title: {
    text: 'Production Report of last 30 days',
    align: 'left',
    margin: 10,
    offsetX: 0,
    offsetY: 0,
    floating: false,
    style: {
      fontSize:  '14px',
      fontWeight:  'bold',
      fontFamily:  'Arial',
      color:  '#263238'
    },
},
    chart: {
    height: 350,
    type: 'area',
    toolbar: {
    show: true
},
    },
legend: {
      labels: {
          colors: ['#263238'],
          useSeriesColors: false
      },
    },
    dataLabels: {
    enabled: true,
    },
    stroke: {
    curve: 'smooth'
    },
    xaxis: {
    categories: [
    @foreach($target as $t_2)
    @php
    $assign_date = $t_2->assign_date;
    $month = date('m', strtotime($assign_date)); // Create date object to store the DateTime format
    $day = date('d', strtotime($assign_date));
    $dateObj = DateTime::createFromFormat('!m', $month);

    // Store the month name to variable
    $monthName = $dateObj->format('F');
    $full_format = $day . ' ' . $monthName;

    echo '"' . $full_format . '"' . ',';;
    @endphp
    @endforeach],
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
    yaxis:{
    labels: {
          show: true,
          style:{
              colors:'#263238',
          },
    },
    },
    tooltip: {
    theme: 'dark'
  },
    };

    var chart = new ApexCharts(document.querySelector("#production_chart"), options);
    chart.render();
    }

    if(getTheme=='dark'){
        var options = {
    series: [{
    name: 'Target',
    data: [
    @foreach($target as $t)
    @php
    $t_main_target = $t->t_main_target;
    echo $t_main_target . ',';
    @endphp
    @endforeach]
    }, {
    name: 'Actual Target',
    data: [@foreach($time as $t)
@php
$t_div_actual_target = $t->t_actual_target;
echo $t_div_actual_target . ',';
@endphp
@endforeach]
    }],
    title: {
    text: 'Production Report of last 30 days',
    align: 'left',
    margin: 10,
    offsetX: 0,
    offsetY: 0,
    floating: false,
    style: {
      fontSize:  '14px',
      fontWeight:  'bold',
      fontFamily:  'Arial',
      color:  '#fff'
    },
},
    chart: {
    height: 350,
    type: 'area',
    toolbar: {
    show: true
},
    },
legend: {
      labels: {
          colors: ['#fff'],
          useSeriesColors: false
      },
    },
    dataLabels: {
    enabled: true,
    },
    stroke: {
    curve: 'smooth'
    },
    xaxis: {
    categories: [
    @foreach($target as $t_2)
    @php
    $assign_date = $t_2->assign_date;
    $month = date('m', strtotime($assign_date)); // Create date object to store the DateTime format
    $day = date('d', strtotime($assign_date));
    $dateObj = DateTime::createFromFormat('!m', $month);

    // Store the month name to variable
    $monthName = $dateObj->format('F');
    $full_format = $day . ' ' . $monthName;

    echo '"' . $full_format . '"' . ',';;
    @endphp
    @endforeach],
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
    yaxis:{
    labels: {
          show: true,
          style:{
              colors:'#fff',
          },
    },
    },
    tooltip: {
    theme: 'dark'
  },
    };

    var chart = new ApexCharts(document.querySelector("#production_chart"), options);
    chart.render();
    }

    if(getTheme=='gray'){
        var options = {
    series: [{
    name: 'Target',
    data: [
    @foreach($target as $t)
    @php
    $t_main_target = $t->t_main_target;
    echo $t_main_target . ',';
    @endphp
    @endforeach]
    }, {
    name: 'Actual Target',
    data: [@foreach($time as $t)
@php
$t_div_actual_target = $t->t_actual_target;
echo $t_div_actual_target . ',';
@endphp
@endforeach]
    }],
    title: {
    text: 'Production Report of last 30 days',
    align: 'left',
    margin: 10,
    offsetX: 0,
    offsetY: 0,
    floating: false,
    style: {
      fontSize:  '14px',
      fontWeight:  'bold',
      fontFamily:  'Arial',
      color:  '#fff'
    },
},
    chart: {
    height: 350,
    type: 'area',
    toolbar: {
    show: true
},
    },
legend: {
      labels: {
          colors: ['#fff'],
          useSeriesColors: false
      },
    },
    dataLabels: {
    enabled: true,
    },
    stroke: {
    curve: 'smooth'
    },
    xaxis: {
    categories: [
    @foreach($target as $t_2)
    @php
    $assign_date = $t_2->assign_date;
    $month = date('m', strtotime($assign_date)); // Create date object to store the DateTime format
    $day = date('d', strtotime($assign_date));
    $dateObj = DateTime::createFromFormat('!m', $month);

    // Store the month name to variable
    $monthName = $dateObj->format('F');
    $full_format = $day . ' ' . $monthName;

    echo '"' . $full_format . '"' . ',';;
    @endphp
    @endforeach],
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
    yaxis:{
    labels: {
          show: true,
          style:{
              colors:'#fff',
          },
    },
    },
    tooltip: {
    theme: 'dark'
  },
    };

    var chart = new ApexCharts(document.querySelector("#production_chart"), options);
    chart.render();
    }
</script>

<script>
    if(getTheme=='dark'){
        var options = {
  series: [@foreach($category as $c)
@php
$cat_actual = $c->t_cat_actual;
if($cat_actual == ''){
$cat_actual = 0;
}
if($cat_actual!=''){
$cat_actual = $cat_actual;
}
echo $cat_actual . ',';
@endphp
@endforeach],
  chart: {
      width:'100%',
      height:'80%',
      type: 'pie',
      toolbar: {
    show: true,
},
},title: {
    text: 'Production Report of Items for 30 days',
    align: 'left',
    margin: 10,
    offsetX: 0,
    offsetY: 0,
    floating: false,
    style: {
      fontSize:  '14px',
      fontWeight:  'bold',
      fontFamily:  'Arial',
      color:  '#fff'
    },
},
legend: {
      position: 'right',
      labels: {
          colors: ['#fff'],
          useSeriesColors: false
      },
    },
labels: [
@foreach($category as $c)
@php
$p_name = $c->p_name;
echo '"' . $p_name . '"' . ',';
@endphp
@endforeach],
responsive: [{
  breakpoint: 480,
  options: {
    chart: {
    //   width: 200
    },
    legend: {
      position: 'bottom'
    },
  }
}]
};

var chart = new ApexCharts(document.querySelector("#product_chart"), options);
chart.render();
    }

    if(getTheme=='light'){
        var options = {
  series: [@foreach($category as $c)
@php
$cat_actual = $c->t_cat_actual;
if($cat_actual == ''){
$cat_actual = 0;
}
if($cat_actual!=''){
$cat_actual = $cat_actual;
}
echo $cat_actual . ',';
@endphp
@endforeach],
  chart: {
      width:'100%',
      height:'80%',
    //   background: '#fff',
      type: 'pie',
      toolbar: {
    show: true,
},
},title: {
    text: 'Production Report of Items for 30 days',
    align: 'left',
    margin: 10,
    offsetX: 0,
    offsetY: 0,
    floating: false,
    style: {
      fontSize:  '14px',
      fontWeight:  'bold',
      fontFamily:  'Arial',
      color: '#263238'
    },
},
legend: {
      position: 'right',
    //   labels: {
    //       colors: ['#fff'],
    //       useSeriesColors: false
    //   },
    },
labels: [
@foreach($category as $c)
@php
$p_name = $c->p_name;
echo '"' . $p_name . '"' . ',';
@endphp
@endforeach],
responsive: [{
  breakpoint: 480,
  options: {
    chart: {
    //   width: 200
    },
    legend: {
      position: 'bottom'
    },
  }
}]
};

var chart = new ApexCharts(document.querySelector("#product_chart"), options);
chart.render();
    }

    if(getTheme=='gray'){
        var options = {
  series: [@foreach($category as $c)
@php
$cat_actual = $c->t_cat_actual;
if($cat_actual == ''){
$cat_actual = 0;
}
if($cat_actual!=''){
$cat_actual = $cat_actual;
}
echo $cat_actual . ',';
@endphp
@endforeach],
  chart: {
      width:'100%',
      height:'80%',
      type: 'pie',
      toolbar: {
    show: true,
},
},title: {
    text: 'Production Report of Items for 30 days',
    align: 'left',
    margin: 10,
    offsetX: 0,
    offsetY: 0,
    floating: false,
    style: {
      fontSize:  '14px',
      fontWeight:  'bold',
      fontFamily:  'Arial',
      color:  '#fff'
    },
},
legend: {
      position: 'right',
      labels: {
          colors: ['#fff'],
          useSeriesColors: false
      },
    },
labels: [
@foreach($category as $c)
@php
$p_name = $c->p_name;
echo '"' . $p_name . '"' . ',';
@endphp
@endforeach],
responsive: [{
  breakpoint: 480,
  options: {
    chart: {
    //   width: 200
    },
    legend: {
      position: 'bottom'
    },tooltip: {
    theme: 'dark'
  },
  }
}]
};

var chart = new ApexCharts(document.querySelector("#product_chart"), options);
chart.render();
    }

</script>
@endoperator

@line_manager
<script type="text/javascript">
    window.location = "{{url('line_entry')}}";
</script>
@endline_manager
@endsection

@endsection
