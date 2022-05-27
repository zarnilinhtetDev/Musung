@extends('layouts.app')

@section('content')

@section('content_2')

<?php
$date_string = date("d.m.Y");
@$edit_status = $_GET['edit'];
@$date = $_GET['date'];

@$format_date = date("d.m.Y", strtotime($date));
$date_string_for_export_pdf = date("Y_m_d", strtotime($date_string));
?>
@superadmin

<div class="container-fluid">

    <h1 class="fw-bold heading-text">Report</h1>
    <div class="row g-3">
        <div class="col-12 col-md-4">
            <label for="date">Select Date</label>
            <input type="date" class="form-control" id="date" />
            <input class="icon-btn-one btn my-2" type="button" value="Search" name="btn_history_submit"
                id="btn_history_submit" />
        </div>
    </div>
    <div id="ajax_load_div" style=""></div>

    <div class="col-12 col-md-4 my-3 p-0">
        <ul class="horizontal-slide" id="tabs">
            <li class="span2">
                <p>Date -
                    <?php if(!$edit_status && !$date){
                                echo $date_string;
                            }else{
                                echo $date_string;
                            }
                            ?>
                </p>
            </li>
            <li class="span2 bg-transparent">
                <a id="dlink" style="display:none;"></a>
                <div id="name" style="display:none;">
                    <?php echo $date_string_for_export_pdf . "_report_dash"; ?>
                </div>
                <button id="btn" class="icon-btn-one icon-btn-one-2 btn my-2">Export to Excel</button>
                <!-- <button onclick="tablesToExcel(['history_dash_1','history_dash_2','history_dash_3'], ['Table1','Table2','Table3'], '<?php //echo $getDate;
                                                                                                                                            ?>.xls', 'Excel')" class="icon-btn-one icon-btn-one-2 btn my-2">Export to Excel</button> -->
            </li>
            <li class="span2 bg-transparent">
                <button type="button" id="exportPDF" class="icon-btn-one icon-btn-one-2 btn my-2">Export to PDF</button>
            </li>
        </ul>
    </div>

    <?php
    $daily_report_decode = json_decode(json_encode($daily_report),true);
    $daily_report_product_decode = json_decode(json_encode($daily_report_product),true);
    $daily_report_product_2_decode = json_decode(json_encode($daily_report_product_2),true);
    ?>


    <div id="today_report">
        @if(!$edit_status)
        <a class='btn custom-btn-theme custom-btn-theme-edit text-white' href="{{ url('/report')}}?edit=1">Edit</a>
        @endif

        <form method="POST" id="cmp_put">
            @if($edit_status)
            <input class="icon-btn-one btn my-2" type="submit" value="Update" name="submit" />
            <a href="{{ url('/report') }}" class="btn-secondary btn my-2">Cancel</a>
            @endif
            <div style="overflow-x:auto;max-width:100%;">
                <table class="table table-striped my-4 tableFixHead results p-0 text-center table-bordered"
                    id="report_table">
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
                    <tbody id="myTable" class="report_tbl_2">
                        @for($i=0;$i<count($daily_report_decode);$i++) @php
                            $l_id=$daily_report_decode[$i]['l_id'];$l_name=$daily_report_decode[$i]['l_name'];$main_target=$daily_report_decode[$i]['main_target'];$ot_main_target=$daily_report_decode[$i]['ot_main_target'];$actual_target=$daily_report_decode[$i]['total_div_actual_target'];
                            $m_power=$daily_report_decode[$i]['m_power'];$actual_m_power=$daily_report_decode[$i]['actual_m_power'];$hp=$daily_report_decode[$i]['hp'];$actual_hp=$daily_report_decode[$i]['actual_hp'];
                            $assign_date=$daily_report_decode[$i]['assign_date'];
                            $man_target=$daily_report_product_decode[$i]['man_target'];
                            $man_actual_target=$daily_report_product_decode[$i]['man_actual_target'];
                            $assign_id_2=$daily_report_decode[$i]['assign_id'];
                            $remark=$daily_report_decode[$i]['remark']; @endphp <tr>
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
                                            $p_cat_name=$daily_report_product_decode[$j]['buyer_name'] @endphp
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
                                        <tr>
                                            <td>-</td>
                                        </tr>
                                        @for($j=0;$j<count($daily_report_product_decode);$j++) @php
                                            $l_id_2=$daily_report_product_decode[$j]['l_id'];
                                            $p_name=$daily_report_product_decode[$j]['p_name'] @endphp
                                            @if($l_id_2==$l_id) <tr>
                                            <td>{{ $p_name }}</td>
                                            </tr>
                                            @endif

                                            @endfor
                                    </tbody>
                                </table>
                            </td>
                            <td class="main_target_{{ $l_id }}">{{ number_format($main_target + $ot_main_target) }}
                            </td>


                            <!-- Man Target -->
                            <td>
                                <table class="m-auto text-start table table-bordered custom-table-border-color">
                                    @if($edit_status)
                                    <tbody class="man_power_input">
                                        <input type="hidden" id="man_target_l_id_input" name="man_target_l_id[]"
                                            value="<?php echo $l_id; ?>" />
                                        <input type="hidden" id="man_target_a_id_input" name="man_target_a_id[]"
                                            value="<?php echo $assign_id_2; ?>" />
                                        <input type="hidden" id="man_target_date_input" name="date_input[]"
                                            value="<?php echo $date; ?>" />
                                        @for($j=0;$j<count($daily_report_product_2_decode);$j++) @php
                                            $l_id_2=$daily_report_product_2_decode[$j]['l_id'];
                                            $man_target_2=$daily_report_product_2_decode[$j]['man_target'];
                                            $man_actual_target_2=$daily_report_product_2_decode[$j]['man_actual_target'];
                                            @endphp @if($l_id_2==$l_id) <tr>
                                            <td>
                                                <input type="number" id="man_target"
                                                    class="form-control p-0 text-center" name="man_target[]"
                                                    placeholder="0" min="0" step="any"
                                                    value="<?php echo $man_target_2; ?>">
                                            </td>
                                            <td>
                                                <input type="number" id="man_actual_target"
                                                    class="form-control p-0 text-center" name="man_actual_target[]"
                                                    placeholder="0" min="0" step="any"
                                                    value="<?php echo $man_actual_target_2; ?>">
                                            </td>
                                            </tr>
                                            @endif

                                            @endfor
                                    </tbody>
                                    @else
                                    <tbody>
                                        @for($j=0;$j<count($daily_report_product_2_decode);$j++) @php
                                            $l_id_2=$daily_report_product_2_decode[$j]['l_id'];
                                            $man_target_2=$daily_report_product_2_decode[$j]['man_target'];
                                            $man_actual_target_2=$daily_report_product_2_decode[$j]['man_actual_target'];
                                            @endphp @if($l_id_2==$l_id) <tr>
                                            <td>{{ $man_target_2 }}</td>
                                            <td>{{ $man_actual_target_2 }}</td>
                                            </tr>
                                            @endif

                                            @endfor
                                            {{-- <tr>
                                                <td>{{ $man_target }}</td>
                                                <td>{{ $man_actual_target }}</td>
                                            </tr> --}}
                                    </tbody>
                                    @endif
                                </table>
                            </td>

                            <td class="actual_target_{{ $l_id }}">@if($actual_target != ''){{
                                number_format($actual_target) }} @endif</td>
                            <td class="percent_{{ $l_id }}"></td>

                            <script>
                                var main_target = parseInt($('.main_target_{{ $l_id }}').text().replace(/,/g, ''));
                            var actual_target = parseInt($('.actual_target_{{ $l_id }}').text().replace(/,/g, ''));
                            var percent = (actual_target / main_target) * 100;

                            // console.log(percent);
                            if(Number.isNaN(percent)){
                                $('.percent_{{ $l_id }}').text("");
                                }
                                else{
                                    $('.percent_{{ $l_id }}').text(percent.toFixed(0) + "%");
                                }
                            </script>
                            <td>
                                <table class="m-auto text-center table table-bordered custom-table-border-color">
                                    @if($edit_status)
                                    <tbody>
                                        <tr>
                                            <td>-</td>
                                        </tr>

                                        @for($j=0;$j<count($daily_report_product_decode);$j++) @php
                                            $l_id_2=$daily_report_product_decode[$j]['l_id'];
                                            $order_qty=$daily_report_product_decode[$j]['order_quantity'];
                                            $p_id_2=$daily_report_product_decode[$j]['p_detail_id']; @endphp
                                            @if($l_id_2==$l_id) <tr>
                                            <td class="order_quantity_input">
                                                <input type="hidden" id="order_l_id_input" name="l_id[]"
                                                    value="<?php echo $l_id; ?>" />
                                                <input type="hidden" id="order_a_id_input" name="a_id[]"
                                                    value="<?php echo $assign_id_2; ?>" />
                                                <input type="hidden" id="order_date_input" name="date_input[]"
                                                    value="<?php echo $date; ?>" />
                                                <input type="number" id="order_val_input"
                                                    class="form-control p-0 text-center" name="order_val_input[]"
                                                    placeholder="0" min="0" step="any"
                                                    value="<?php echo $order_qty; ?>">
                                                <input type="hidden" id="order_p_id_input" name="p_id_input[]"
                                                    value="<?php echo $p_id_2; ?>" />
                                            </td>
                                            </tr>
                                            @endif

                                            @endfor
                                    </tbody>
                                    @else
                                    <tbody>
                                        <tr>
                                            <td>-</td>
                                        </tr>
                                        @for($j=0;$j<count($daily_report_product_decode);$j++) @php
                                            $l_id_2=$daily_report_product_decode[$j]['l_id'];
                                            $order_qty=$daily_report_product_decode[$j]['order_quantity'];@endphp
                                            @if($l_id_2==$l_id) <tr>
                                            @if($order_qty == '')
                                            <td> - </td>
                                            @endif
                                            @if($order_qty != '')
                                            <td>{{ number_format($order_qty) }}</td>
                                            @endif
                                            </tr>
                                            @endif

                                            @endfor

                                    </tbody>
                                    @endif

                                </table>
                            </td>

                            <!-- Sewing Input --->
                            <td>
                                <table class="m-auto text-center table table-bordered custom-table-border-color">
                                    @if($edit_status)
                                    <tbody>
                                        <tr>
                                            <td>-</td>
                                        </tr>

                                        @for($j=0;$j<count($daily_report_product_decode);$j++) @php
                                            $l_id_2=$daily_report_product_decode[$j]['l_id'];
                                            $sewing_input=$daily_report_product_decode[$j]['sewing_input'];
                                            $p_id_2=$daily_report_product_decode[$j]['p_detail_id']; @endphp
                                            @if($l_id_2==$l_id) <tr>
                                            <td class="sewing_input">
                                                <input type="hidden" id="sewing_l_id_input" name="l_id[]"
                                                    value="<?php echo $l_id; ?>" />
                                                <input type="hidden" id="sewing_a_id_input" name="a_id[]"
                                                    value="<?php echo $assign_id_2; ?>" />
                                                <input type="hidden" id="sewing_date_input" name="date_input[]"
                                                    value="<?php echo $date; ?>" />
                                                <input type="number" id="sewing_val_input"
                                                    class="form-control p-0 text-center" name="sewing_input[]"
                                                    placeholder="0" min="0" step="any"
                                                    value="<?php echo $sewing_input; ?>">
                                                <input type="hidden" id="sewing_p_id_input" name="p_id_input[]"
                                                    value="<?php echo $p_id_2; ?>" />
                                            </td>
                                            </tr>
                                            @endif

                                            @endfor
                                    </tbody>
                                    @else
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
                                            <td>{{ number_format($sewing_input) }}</td>
                                            @endif
                                            </tr>
                                            @endif

                                            @endfor

                                    </tbody>
                                    @endif

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
                                            $sewing_input=$daily_report_product_decode[$j]['sewing_input']; @endphp
                                            @if($l_id_2==$l_id) <tr>
                                            @if($sewing_input == '')
                                            <td> - </td>
                                            @endif
                                            @if($sewing_input != '')
                                            <td>{{ number_format($sewing_input) }}</td>
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
                                            $cat_actual_target=$daily_report_product_decode[$j]['cat_actual_target']
                                            @endphp @if($l_id_2==$l_id) <tr>

                                            @if($cat_actual_target == '')
                                            <td> - </td>
                                            @endif
                                            @if($cat_actual_target != '')
                                            <td class="cat_actual_target_{{ $p_id_2 }}">{{
                                                number_format($cat_actual_target) }}</td>
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
                                            $cat_actual_target=$daily_report_product_decode[$j]['cat_actual_target']
                                            @endphp @if($l_id_2==$l_id) <tr>
                                            @if($cat_actual_target == '')
                                            <td> - </td>
                                            @endif
                                            @if($cat_actual_target != '')
                                            <td>{{ number_format($cat_actual_target) }}</td>
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
                                            $cmp=$daily_report_product_decode[$j]['cmp']; @endphp @if($l_id_2==$l_id)
                                            <tr>

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
                                                    value="<?php echo $cmp; ?>" />
                                                <input type="hidden" id="date_input" name="date_input[]"
                                                    value="<?php echo $date; ?>" />
                                                <input type="hidden" id="user_role" name="user_role"
                                                    value="<?php echo Auth::user()->role; ?>" />
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
                                $p_id_2=$daily_report_product_decode[$j]['p_detail_id']; @endphp @if($l_id_2==$l_id)
                                <tr>
                                <td class="daily_cmp_{{ $p_id_2 }} cmp_product_{{ $l_id_2 }}">

                                </td>
                                </tr>


                                <script>
                                    var clothes_output = parseFloat($(".cat_actual_target_{{ $p_id_2 }}").text());
                                var cmp = parseFloat($('.cmp_{{ $p_id_2 }}').text());
                                var daily_cmp = $('.daily_cmp_{{ $p_id_2 }}');

                                // console.log(cmp);

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
                var cmp_product_text=$(this).text();
                var substring=parseFloat(cmp_product_text.substring(2));

                if(Number.isNaN(substring)){
                    substring = 0;
                }
                else{
                    total_cmp += substring;
                }

    });
        total_cmp_class.text("$ " + total_cmp.toFixed(1));

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
                        @if($edit_status)
                        <tbody>
                            <tr>
                                <td>-</td>
                            </tr>
                            @for($j=0;$j<count($daily_report_product_decode);$j++) @php
                                $l_id_2=$daily_report_product_decode[$j]['l_id'];
                                $inline_2=$daily_report_product_decode[$j]['inline'];
                                $p_id_2=$daily_report_product_decode[$j]['p_detail_id']; @endphp @if($l_id_2==$l_id)
                                <tr>
                                <td class="inline_input">
                                    <input type="hidden" id="inline_l_id_input" name="inline_l_id[]"
                                        value="<?php echo $l_id; ?>" />
                                    <input type="hidden" id="inline_a_id_input" name="inline_a_id[]"
                                        value="<?php echo $assign_id_2; ?>" />
                                    <input type="hidden" id="inline_date_input" name="date_input[]"
                                        value="<?php echo $date; ?>" />
                                    <input type="number" id="inline_val_input" class="form-control p-0 text-center"
                                        name="inline_val_input[]" value="<?php echo $inline_2; ?>">
                                    <input type="hidden" id="inline_p_id_input" name="inline_p_id_input[]"
                                        value="<?php echo $p_id_2; ?>" />

                                </td>
                                </tr>
                                @endif

                                @endfor
                        </tbody>
                        @else
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
                                <td>{{ number_format($inline_2) }}</td>
                                @endif
                                </tr>
                                @endif

                                @endfor

                        </tbody>
                        @endif

                    </table>
                </td>

                <!-- H/over Input --->
                <td>
                    <table class="m-auto text-center table table-bordered custom-table-border-color">
                        @if($edit_status)
                        <tbody>
                            <tr>
                                <td>-</td>
                            </tr>

                            @for($j=0;$j<count($daily_report_product_decode);$j++) @php
                                $l_id_2=$daily_report_product_decode[$j]['l_id'];
                                $sewing_input=$daily_report_product_decode[$j]['sewing_input'];
                                $p_id_2=$daily_report_product_decode[$j]['p_detail_id'];$h_over_input=$daily_report_product_decode[$j]['h_over_input'];
                                @endphp @if($l_id_2==$l_id) <tr>
                                <td class="h_over_input">
                                    <input type="hidden" id="handover_l_id_input" name="l_id[]"
                                        value="<?php echo $l_id; ?>" />
                                    <input type="hidden" id="handover_a_id_input" name="a_id[]"
                                        value="<?php echo $assign_id_2; ?>" />
                                    <input type="hidden" id="handover_date_input" name="date_input[]"
                                        value="<?php echo $date; ?>" />
                                    <input type="number" id="handover_val_input" class="form-control p-0 text-center"
                                        name="handover_val_input[]" placeholder="0" min="0" step="any"
                                        value="<?php echo $h_over_input; ?>">
                                    <input type="hidden" id="handover_p_id_input" name="p_id_input[]"
                                        value="<?php echo $p_id_2; ?>" />
                                </td>
                                </tr>
                                @endif

                                @endfor
                        </tbody>
                        @else
                        <tbody>
                            <tr>
                                <td>-</td>
                            </tr>
                            @for($j=0;$j<count($daily_report_product_decode);$j++) @php
                                $l_id_2=$daily_report_product_decode[$j]['l_id'];
                                $h_over_input=$daily_report_product_decode[$j]['h_over_input']; @endphp
                                @if($l_id_2==$l_id) <tr>
                                @if($h_over_input == '')
                                <td> - </td>
                                @endif
                                @if($h_over_input != '')
                                <td>{{ number_format($h_over_input) }}</td>
                                @endif
                                </tr>
                                @endif

                                @endfor

                        </tbody>
                        @endif
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
                                <td>{{ number_format($h_over_input) }}</td>
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
                        @if($edit_status)
                        <tbody>
                            <tr>
                                <td>-</td>
                            </tr>

                            @for($j=0;$j<count($daily_report_product_decode);$j++) @php
                                $l_id_2=$daily_report_product_decode[$j]['l_id'];
                                $h_balance=$daily_report_product_decode[$j]['h_balance'];
                                $p_id_2=$daily_report_product_decode[$j]['p_detail_id']; @endphp @if($l_id_2==$l_id)
                                <tr>
                                <td class="h_bal_input">
                                    <input type="hidden" id="h_bal_l_id_input" name="l_id[]"
                                        value="<?php echo $l_id; ?>" />
                                    <input type="hidden" id="h_bal_a_id_input" name="a_id[]"
                                        value="<?php echo $assign_id_2; ?>" />
                                    <input type="hidden" id="h_bal_date_input" name="date_input[]"
                                        value="<?php echo $date; ?>" />
                                    <input type="number" id="h_bal_val_input" class="form-control p-0 text-center"
                                        name="h_balance_val_input[]" placeholder="0" min="0" step="any"
                                        value="<?php echo $h_balance; ?>">
                                    <input type="hidden" id="h_bal_p_id_input" name="p_id_input[]"
                                        value="<?php echo $p_id_2; ?>" />
                                </td>
                                </tr>
                                @endif

                                @endfor
                        </tbody>
                        @else
                        <tbody>
                            <tr>
                                <td>-</td>
                            </tr>
                            @for($j=0;$j<count($daily_report_product_decode);$j++) @php
                                $l_id_2=$daily_report_product_decode[$j]['l_id'];
                                $h_balance=$daily_report_product_decode[$j]['h_balance']; @endphp @if($l_id_2==$l_id)
                                <tr>
                                @if($h_balance == '')
                                <td> - </td>
                                @endif
                                @if($h_balance != '')
                                <td>{{ number_format($h_balance) }}</td>
                                @endif
                                </tr>
                                @endif

                                @endfor

                        </tbody>
                        @endif

                    </table>
                </td>

                <!-- S,L,ADM OP --->
                <td>
                    <table class="m-auto text-center w-100 table table-bordered custom-table-border-color">
                        @if($edit_status)
                        <tbody class="m_power_input_2">
                            <input type="hidden" id="m_power_l_id_input_2" name="l_id[]" value="<?php echo $l_id; ?>" />
                            <input type="hidden" id="m_power_a_id_input_2" name="a_id[]"
                                value="<?php echo $assign_id_2; ?>" />
                            <input type="hidden" id="m_power_date_input_2" name="date_input[]"
                                value="<?php echo $date; ?>" />
                            <tr>
                                <td>
                                    <input type="number" id="m_power_value_2" class="form-control p-0 text-center"
                                        name="m_power_value_2[]" placeholder="0" min="0" step="any"
                                        value="<?php echo $m_power; ?>">
                                </td>
                                <td>
                                    <input type="number" id="hp_value_2" class="form-control p-0 text-center"
                                        name="hp_value_2[]" placeholder="0" min="0" step="any"
                                        value="<?php echo $hp; ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="number" id="actual_m_power_value_2"
                                        class="form-control p-0 text-center" name="actual_m_power_value[]"
                                        placeholder="0" min="0" step="any" value="<?php echo $actual_m_power; ?>">
                                </td>
                                <td>
                                    <input type="number" id="actual_hp_value_2" class="form-control p-0 text-center"
                                        name="actual_hp_value_2[]" placeholder="0" min="0" step="any"
                                        value="<?php echo $actual_hp; ?>">
                                </td>
                            </tr>
                        </tbody>
                        @else
                        <tbody>
                            <tr>
                                <td class="m_power_value_{{ $l_id }}">@if($m_power != ''){{ number_format($m_power) }}
                                    @endif</td>
                                <td class="hp_value_{{ $l_id }}">@if($hp != ''){{ number_format($hp) }} @endif</td>
                            </tr>
                            <tr>
                                <td class="total_m_power_{{ $l_id }}" colspan="2"></td>
                            </tr>
                            <tr>
                                <td class="actual_m_power_value_{{ $l_id }}">@if($actual_m_power != ''){{
                                    number_format($actual_m_power) }} @endif</td>
                                <td class="actual_hp_value_{{ $l_id }}">@if($actual_hp != ''){{
                                    number_format($actual_hp)
                                    }}@endif</td>
                            </tr>
                            <tr>
                                <td class="total_actual_m_power_{{ $l_id }}" colspan="2"></td>
                            </tr>
                        </tbody>
                        @endif

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
                    $total_time=(int)$daily_report_decode[$k]['total_time']; @endphp @if($l_id_2==$l_id) <td
                    class="total_time_{{ $l_id_2 }}"> {{
                    $total_time }} </td>

                    @endif

                    @endfor

                    <!----- Total Time  End ------>

                    <td class="cmp_hr_{{ $l_id }}"></td>
                    <td class="cmp_hr_ps_{{ $l_id }}"></td>
                    <td class="note_input">
                        @if($edit_status)
                        <input type="hidden" id="note_l_id_input" name="l_id[]" value="<?php echo $l_id; ?>" />
                        <input type="hidden" id="note_a_id_input" name="a_id[]" value="<?php echo $assign_id_2; ?>" />
                        <input type="hidden" id="note_date_input" name="date_input[]" value="<?php echo $date; ?>" />
                        <textarea class="form-control note" name="note[]" placeholder="Note" id="note_val_input"
                            maxlength="150"><?php echo $remark; ?></textarea>
                        @else
                        {{ $remark }}
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


    cmp_hr.text("$ " + div_time.toFixed(1));

    /// For CMP/hr end

    /// For CMP/ HR/ PS
var total_actual_m_power_2 = $('.total_actual_m_power_{{ $l_id }}').text();
var cmp_hr_3 = $('.cmp_hr_{{ $l_id }}').text();
var cmp_hr_ps = $('.cmp_hr_ps_{{ $l_id }}');


var substring_3 = parseFloat(cmp_hr_3.substring(2));
var substring_4 = parseFloat(total_actual_m_power_2.substring(2));

// console.log(substring_3);
// console.log(total_actual_m_power_2);

var div_cmp_hr_ps = substring_3 / total_actual_m_power_2;

if(total_actual_m_power_2 != ''){

    if(Number.isNaN(div_cmp_hr_ps)){
    cmp_hr_ps.text('');
}
                            else{
cmp_hr_ps.text("$ " + div_cmp_hr_ps.toFixed(1));


                            }
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
var man_power_obj = {};
var man_power_arr = [];

$('.man_power_input').each(function(){
    var man_power_l_id = $("#man_target_l_id_input", this).val();
    var man_power_a_id_input = $("#man_target_a_id_input", this).val();
    var man_power_date_input = $("#man_target_date_input", this).val();
    var man_target = $("#man_target", this).val();
    var man_actual_target = $("#man_actual_target", this).val();

    man_power_obj = {
        man_target_l_id : man_power_l_id,
        man_target_a_id_input : man_power_a_id_input,
        man_target_date_input : man_power_date_input,
        man_target : man_target,
        man_actual_target : man_actual_target,
    }

    man_power_arr.push(man_power_obj);
});


var inline_obj = {};
var inline_arr = [];


$(".inline_input").each(function(){
    var inline_l_id = $("#inline_l_id_input",this).val();
    var inline_a_id = $("#inline_a_id_input",this).val();
    var inline_date = $("#inline_date_input",this).val();
    var inline_p_id = $("#inline_p_id_input",this).val();
    var inline_val_input = $("#inline_val_input",this).val();

    inline_obj = {
        inline_l_id : inline_l_id,
        inline_a_id : inline_a_id,
        inline_date : inline_date,
        inline_p_id : inline_p_id,
        inline_val_input : inline_val_input,
    }

    inline_arr.push(inline_obj);
});

var handover_obj = {};
var handover_arr = [];

$(".h_over_input").each(function(){
    var handover_l_id = $("#handover_l_id_input",this).val();
    var handover_a_id = $("#handover_a_id_input",this).val();
    var handover_date = $("#handover_date_input",this).val();
    var handover_p_id = $("#handover_p_id_input",this).val();
    var handover_val_input = $("#handover_val_input",this).val();

    handover_obj = {
        handover_l_id : handover_l_id,
        handover_a_id : handover_a_id,
        handover_date : handover_date,
        handover_p_id : handover_p_id,
        handover_val_input : handover_val_input,
    }

    handover_arr.push(handover_obj);
})

var box = {};
var boxes = [];
$('.td_input').each(function() {
    var l_id_input = $('#l_id_input', this).val();
    var a_id_input = $('#a_id_input', this).val();
    var p_id_input = $('#p_id_input', this).val();
    var cmp_input = $('#cmp_input',this).val();
    var date_input = $('#date_input',this).val();
box = {
l_id_input: l_id_input,
a_id_input: a_id_input,
p_id_input: p_id_input,
cmp_input: cmp_input,
date_input: date_input,
}
boxes.push(box);
});


var sewing_obj = {};
var sewing_arr = [];
$(".sewing_input").each(function(){
    var sewing_l_id = $("#sewing_l_id_input",this).val();
    var sewing_a_id = $("#sewing_a_id_input",this).val();
    var sewing_date = $("#sewing_date_input",this).val();
    var sewing_p_id = $("#sewing_p_id_input",this).val();
    var sewing_val_input = $("#sewing_val_input",this).val();

    sewing_obj = {
        sewing_l_id : sewing_l_id,
        sewing_a_id : sewing_a_id,
        sewing_date : sewing_date,
        sewing_p_id : sewing_p_id,
        sewing_val_input : sewing_val_input,
    }

    sewing_arr.push(sewing_obj);
});

//// ManPower Input (S,L,ADM OP, HP)
var m_power_obj_2 = {};
var m_power_arr_2 = [];

$(".m_power_input_2").each(function(){
    var m_power_l_id_2 = $("#m_power_l_id_input_2", this).val();
    var m_power_a_id_2 = $("#m_power_a_id_input_2", this).val();
    var m_power_date_2 = $("#m_power_date_input_2", this).val();
    var m_power_value_2 = $("#m_power_value_2",this).val();
    var hp_value_2 = $("#hp_value_2",this).val();
    var actual_m_power_value_2 = $("#actual_m_power_value_2",this).val();
    var actual_hp_value_2 = $("#actual_hp_value_2",this).val();

    m_power_obj_2 = {
        m_power_l_id_2 : m_power_l_id_2,
        m_power_a_id_2 : m_power_a_id_2,
        m_power_date_2 : m_power_date_2,
        m_power_value_2 : m_power_value_2,
        hp_value_2 : hp_value_2,
        actual_m_power_value_2 : actual_m_power_value_2,
        actual_hp_value_2 : actual_hp_value_2,
    }

    m_power_arr_2.push(m_power_obj_2);
});

//// Note
var note_obj = {};
var note_arr = [];

$(".note_input").each(function(){
    var note_l_id = $("#note_l_id_input",this).val();
    var note_a_id = $("#note_a_id_input",this).val();
    var note_date = $("#note_date_input",this).val();
    var note_val_input = $("#note_val_input",this).val();

    note_obj = {
        note_l_id : note_l_id,
        note_a_id : note_a_id,
        note_date : note_date,
        note_val_input : note_val_input,
    }

    note_arr.push(note_obj);
});

/// Order Qty
var order_qty = {};
var order_arr = [];

$(".order_quantity_input").each(function(){
    var order_l_id = $("#order_l_id_input",this).val();
    var order_a_id = $("#order_a_id_input",this).val();
    var order_date = $("#order_date_input",this).val();
    var order_p_id = $("#order_p_id_input",this).val();
    var order_val_input = $("#order_val_input",this).val();

    order_qty = {
        order_l_id : order_l_id,
        order_a_id : order_a_id,
        order_date : order_date,
        order_p_id : order_p_id,
        order_val_input : order_val_input,
    }

    order_arr.push(order_qty);
});

/// HandOver Balance

var h_bal_obj = {};
var h_bal_arr = [];

$(".h_bal_input").each(function(){
    var h_bal_l_id = $("#h_bal_l_id_input",this).val();
    var h_bal_a_id = $("#h_bal_a_id_input",this).val();
    var h_bal_date = $("#h_bal_date_input",this).val();
    var h_bal_p_id = $("#h_bal_p_id_input",this).val();
    var h_bal_val_input = $("#h_bal_val_input",this).val();

    h_bal_obj = {
        h_bal_l_id : h_bal_l_id,
        h_bal_a_id : h_bal_a_id,
        h_bal_date : h_bal_date,
        h_bal_p_id : h_bal_p_id,
        h_bal_val_input : h_bal_val_input,
    }

    h_bal_arr.push(h_bal_obj);
});

$.ajax({
        type: "POST",
        url: "/cmp_put",
        data: {
            boxes: boxes,
            man_power : man_power_arr,
            inline: inline_arr,
            handover : handover_arr,
            sewing : sewing_arr,
            m_power_2 : m_power_arr_2,
            note: note_arr,
            order_qty : order_arr,
            h_bal : h_bal_arr,
        },
        success: function(data) {
            console.log(data);
            // window.location.href = "/report?update=ok";
        }
    });
});

        </script>
    </div>
</div>


<script>
    $("#btn_history_submit").click(function(e) {
e.preventDefault();
$("#today_report").css("display", "none");
$.ajax({
type: "POST",
url: "{{ url('report_history') }}",
data: {
date_name: $("#date").val(),
},
success: function(result) {
$("#ajax_load_div").html(result);
},
error: function(result) {
    console.log(result);
    alert('error');
}
});
});
</script>

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
@endsuperadmin

@owner


<div class="container-fluid">

    <h1 class="fw-bold heading-text">Report</h1>
    <div class="row g-3">
        <div class="col-12 col-md-4">
            <label for="date">Select Date</label>
            <input type="date" class="form-control" id="date" />
            <input class="icon-btn-one btn my-2" type="button" value="Search" name="btn_history_submit"
                id="btn_history_submit" />
        </div>
    </div>
    <div id="ajax_load_div" style=""></div>

    <div class="col-12 col-md-4 my-3 p-0">
        <ul class="horizontal-slide" id="tabs">
            <li class="span2">
                <p>Date -
                    <?php if(!$edit_status && !$date){
                                echo $date_string;
                            }else{
                                echo $date_string . 'hello';
                            }
                            ?>
                </p>
            </li>
            <li class="span2 bg-transparent">
                <a id="dlink" style="display:none;"></a>
                <div id="name" style="display:none;">
                    <?php echo $date_string_for_export_pdf . "_report_dash"; ?>
                </div>
                <button id="btn" class="icon-btn-one icon-btn-one-2 btn my-2">Export to Excel</button>
                <!-- <button onclick="tablesToExcel(['history_dash_1','history_dash_2','history_dash_3'], ['Table1','Table2','Table3'], '<?php //echo $getDate;
                                                                                                                                            ?>.xls', 'Excel')" class="icon-btn-one icon-btn-one-2 btn my-2">Export to Excel</button> -->
            </li>
            <li class="span2 bg-transparent">
                <button type="button" id="exportPDF" class="icon-btn-one icon-btn-one-2 btn my-2">Export to PDF</button>
            </li>
        </ul>
    </div>

    <?php
    $daily_report_decode = json_decode(json_encode($daily_report),true);
    $daily_report_product_decode = json_decode(json_encode($daily_report_product),true);
    $daily_report_product_2_decode = json_decode(json_encode($daily_report_product_2),true);
    ?>


    <div id="today_report">
        @if(!$edit_status)
        <a class='btn custom-btn-theme custom-btn-theme-edit text-white' href="{{ url('/report')}}?edit=1">Edit</a>
        @endif

        <form method="POST" id="cmp_put">
            @if($edit_status)
            <input class="icon-btn-one btn my-2" type="submit" value="Update" name="submit" />
            <a href="{{ url('/report') }}" class="btn-secondary btn my-2">Cancel</a>
            @endif
            <div style="overflow-x:auto;max-width:100%;">
                <table class="table table-striped my-4 tableFixHead results p-0 text-center table-bordered"
                    id="report_table">
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
                    <tbody id="myTable" class="report_tbl_2">
                        @for($i=0;$i<count($daily_report_decode);$i++) @php
                            $l_id=$daily_report_decode[$i]['l_id'];$l_name=$daily_report_decode[$i]['l_name'];$main_target=$daily_report_decode[$i]['main_target'];$ot_main_target=$daily_report_decode[$i]['ot_main_target'];$actual_target=$daily_report_decode[$i]['total_div_actual_target'];
                            $m_power=$daily_report_decode[$i]['m_power'];$actual_m_power=$daily_report_decode[$i]['actual_m_power'];$hp=$daily_report_decode[$i]['hp'];$actual_hp=$daily_report_decode[$i]['actual_hp'];
                            $assign_date=$daily_report_decode[$i]['assign_date'];
                            $man_target=$daily_report_product_decode[$i]['man_target'];
                            $man_actual_target=$daily_report_product_decode[$i]['man_actual_target'];$assign_id_2=$daily_report_decode[$i]['assign_id'];$remark=$daily_report_decode[$i]['remark'];
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
                                            $p_cat_name=$daily_report_product_decode[$j]['buyer_name'] @endphp
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
                                        <tr>
                                            <td>-</td>
                                        </tr>
                                        @for($j=0;$j<count($daily_report_product_decode);$j++) @php
                                            $l_id_2=$daily_report_product_decode[$j]['l_id'];
                                            $p_name=$daily_report_product_decode[$j]['p_name'] @endphp
                                            @if($l_id_2==$l_id) <tr>
                                            <td>{{ $p_name }}</td>
                                            </tr>
                                            @endif

                                            @endfor
                                    </tbody>
                                </table>
                            </td>
                            <td class="main_target_{{ $l_id }}">{{ number_format($main_target+$ot_main_target)}}</td>

                            <!-- Main Target -->
                            <td>
                                <table class="m-auto text-start table table-bordered custom-table-border-color">
                                    @if($edit_status)
                                    <tbody class="man_power_input">
                                        <input type="hidden" id="man_target_l_id_input" name="man_target_l_id[]"
                                            value="<?php echo $l_id; ?>" />
                                        <input type="hidden" id="man_target_a_id_input" name="man_target_a_id[]"
                                            value="<?php echo $assign_id_2; ?>" />
                                        <input type="hidden" id="man_target_date_input" name="date_input[]"
                                            value="<?php echo $date; ?>" />
                                        @for($j=0;$j<count($daily_report_product_2_decode);$j++) @php
                                            $l_id_2=$daily_report_product_2_decode[$j]['l_id'];
                                            $man_target_2=$daily_report_product_2_decode[$j]['man_target'];
                                            $man_actual_target_2=$daily_report_product_2_decode[$j]['man_actual_target'];
                                            @endphp @if($l_id_2==$l_id) <tr>
                                            <td>
                                                <input type="number" id="man_target"
                                                    class="form-control p-0 text-center" name="man_target[]"
                                                    placeholder="0" min="0" step="any"
                                                    value="<?php echo $man_target_2; ?>">
                                            </td>
                                            <td>
                                                <input type="number" id="man_actual_target"
                                                    class="form-control p-0 text-center" name="man_actual_target[]"
                                                    placeholder="0" min="0" step="any"
                                                    value="<?php echo $man_actual_target_2; ?>">
                                            </td>
                                            </tr>
                                            @endif

                                            @endfor
                                    </tbody>
                                    @else
                                    <tbody>
                                        @for($j=0;$j<count($daily_report_product_2_decode);$j++) @php
                                            $l_id_2=$daily_report_product_2_decode[$j]['l_id'];
                                            $man_target_2=$daily_report_product_2_decode[$j]['man_target'];
                                            $man_actual_target_2=$daily_report_product_2_decode[$j]['man_actual_target'];
                                            @endphp @if($l_id_2==$l_id) <tr>
                                            <td>{{ $man_target_2 }}</td>
                                            <td>{{ $man_actual_target_2 }}</td>
                                            </tr>
                                            @endif

                                            @endfor
                                            {{-- <tr>
                                                <td>{{ $man_target }}</td>
                                                <td>{{ $man_actual_target }}</td>
                                            </tr> --}}
                                    </tbody>
                                    @endif
                                </table>
                            </td>
                            <td class="actual_target_{{ $l_id }}">@if($actual_target != ''){{
                                number_format($actual_target) }} @endif</td>
                            <td class="percent_{{ $l_id }}"></td>

                            <script>
                                var main_target = parseInt($('.main_target_{{ $l_id }}').text().replace(/,/g, ''));
                            var actual_target = parseInt($('.actual_target_{{ $l_id }}').text().replace(/,/g, ''));
                            var percent = (actual_target / main_target) * 100;

                            // console.log(percent);
                            if(Number.isNaN(percent)){
                                $('.percent_{{ $l_id }}').text("");
                                }
                                else{
                                    $('.percent_{{ $l_id }}').text(percent.toFixed(0) + "%");
                                }
                            </script>

                            <td>
                                <table class="m-auto text-center table table-bordered custom-table-border-color">
                                    @if($edit_status)
                                    <tbody>
                                        <tr>
                                            <td>-</td>
                                        </tr>

                                        @for($j=0;$j<count($daily_report_product_decode);$j++) @php
                                            $l_id_2=$daily_report_product_decode[$j]['l_id'];
                                            $order_qty=$daily_report_product_decode[$j]['order_quantity'];
                                            $p_id_2=$daily_report_product_decode[$j]['p_detail_id']; @endphp
                                            @if($l_id_2==$l_id) <tr>
                                            <td class="order_quantity_input">
                                                <input type="hidden" id="order_l_id_input" name="l_id[]"
                                                    value="<?php echo $l_id; ?>" />
                                                <input type="hidden" id="order_a_id_input" name="a_id[]"
                                                    value="<?php echo $assign_id_2; ?>" />
                                                <input type="hidden" id="order_date_input" name="date_input[]"
                                                    value="<?php echo $date; ?>" />
                                                <input type="number" id="order_val_input"
                                                    class="form-control p-0 text-center" name="order_val_input[]"
                                                    placeholder="0" min="0" step="any"
                                                    value="<?php echo $order_qty; ?>">
                                                <input type="hidden" id="order_p_id_input" name="p_id_input[]"
                                                    value="<?php echo $p_id_2; ?>" />
                                            </td>
                                            </tr>
                                            @endif

                                            @endfor
                                    </tbody>
                                    @else
                                    <tbody>
                                        <tr>
                                            <td>-</td>
                                        </tr>
                                        @for($j=0;$j<count($daily_report_product_decode);$j++) @php
                                            $l_id_2=$daily_report_product_decode[$j]['l_id'];
                                            $order_qty=$daily_report_product_decode[$j]['order_quantity'];@endphp
                                            @if($l_id_2==$l_id) <tr>
                                            @if($order_qty == '')
                                            <td> - </td>
                                            @endif
                                            @if($order_qty != '')
                                            <td>{{ number_format($order_qty) }}</td>
                                            @endif
                                            </tr>
                                            @endif

                                            @endfor

                                    </tbody>
                                    @endif

                                </table>
                            </td>

                            <!-- Sewing Input --->
                            <td>
                                <table class="m-auto text-center table table-bordered custom-table-border-color">
                                    @if($edit_status)
                                    <tbody>
                                        <tr>
                                            <td>-</td>
                                        </tr>

                                        @for($j=0;$j<count($daily_report_product_decode);$j++) @php
                                            $l_id_2=$daily_report_product_decode[$j]['l_id'];
                                            $sewing_input=$daily_report_product_decode[$j]['sewing_input'];
                                            $p_id_2=$daily_report_product_decode[$j]['p_detail_id']; @endphp
                                            @if($l_id_2==$l_id) <tr>
                                            <td class="sewing_input">
                                                <input type="hidden" id="sewing_l_id_input" name="l_id[]"
                                                    value="<?php echo $l_id; ?>" />
                                                <input type="hidden" id="sewing_a_id_input" name="a_id[]"
                                                    value="<?php echo $assign_id_2; ?>" />
                                                <input type="hidden" id="sewing_date_input" name="date_input[]"
                                                    value="<?php echo $date; ?>" />
                                                <input type="number" id="sewing_val_input"
                                                    class="form-control p-0 text-center" name="sewing_input[]"
                                                    placeholder="0" min="0" step="any"
                                                    value="<?php echo $sewing_input; ?>">
                                                <input type="hidden" id="sewing_p_id_input" name="p_id_input[]"
                                                    value="<?php echo $p_id_2; ?>" />
                                            </td>
                                            </tr>
                                            @endif

                                            @endfor
                                    </tbody>
                                    @else
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
                                            <td>{{ number_format($sewing_input) }}</td>
                                            @endif
                                            </tr>
                                            @endif

                                            @endfor

                                    </tbody>
                                    @endif

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
                                            <td>{{ number_format($sewing_input) }}</td>
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
                                            $cat_actual_target=$daily_report_product_decode[$j]['cat_actual_target']
                                            @endphp @if($l_id_2==$l_id) <tr>

                                            @if($cat_actual_target == '')
                                            <td> - </td>
                                            @endif
                                            @if($cat_actual_target != '')
                                            <td class="cat_actual_target_{{ $p_id_2 }}">{{
                                                number_format($cat_actual_target) }}</td>
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
                                            $cat_actual_target=$daily_report_product_decode[$j]['cat_actual_target']
                                            @endphp @if($l_id_2==$l_id) <tr>
                                            @if($cat_actual_target == '')
                                            <td> - </td>
                                            @endif
                                            @if($cat_actual_target != '')
                                            <td>{{ number_format($cat_actual_target) }}</td>
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
                                            $cmp=$daily_report_product_decode[$j]['cmp']; @endphp @if($l_id_2==$l_id)
                                            <tr>

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
                                                <input type="hidden" id="date_input" name="date_input[]"
                                                    value="<?php echo $date; ?>" />
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
                                $p_id_2=$daily_report_product_decode[$j]['p_detail_id']; @endphp @if($l_id_2==$l_id)
                                <tr>
                                <td class="daily_cmp_{{ $p_id_2 }} cmp_product_{{ $l_id_2 }}">

                                </td>
                                </tr>


                                <script>
                                    var clothes_output = parseFloat($(".cat_actual_target_{{ $p_id_2 }}").text());
                                var cmp = parseFloat($('.cmp_{{ $p_id_2 }}').text());
                                var daily_cmp = $('.daily_cmp_{{ $p_id_2 }}');

                                // console.log(cmp);

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
                var cmp_product_text=$(this).text();
                var substring=parseFloat(cmp_product_text.substring(2));

                if(Number.isNaN(substring)){
                    substring = 0;
                }
                else{
                    total_cmp += substring;
                }

    });
        total_cmp_class.text("$ " + total_cmp.toFixed(1));

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
                        @if($edit_status)
                        <tbody>
                            <tr>
                                <td>-</td>
                            </tr>
                            @for($j=0;$j<count($daily_report_product_decode);$j++) @php
                                $l_id_2=$daily_report_product_decode[$j]['l_id'];
                                $inline_2=$daily_report_product_decode[$j]['inline'];
                                $p_id_2=$daily_report_product_decode[$j]['p_detail_id']; @endphp @if($l_id_2==$l_id)
                                <tr>
                                <td class="inline_input">
                                    <input type="hidden" id="inline_l_id_input" name="inline_l_id[]"
                                        value="<?php echo $l_id; ?>" />
                                    <input type="hidden" id="inline_a_id_input" name="inline_a_id[]"
                                        value="<?php echo $assign_id_2; ?>" />
                                    <input type="hidden" id="inline_date_input" name="date_input[]"
                                        value="<?php echo $date; ?>" />
                                    <input type="number" id="inline_val_input" class="form-control p-0 text-center"
                                        name="inline_val_input[]" value="<?php echo $inline_2; ?>">
                                    <input type="hidden" id="inline_p_id_input" name="inline_p_id_input[]"
                                        value="<?php echo $p_id_2; ?>" />

                                </td>
                                </tr>
                                @endif

                                @endfor
                        </tbody>
                        @else
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
                                <td>{{ number_format($inline_2) }}</td>
                                @endif
                                </tr>
                                @endif

                                @endfor

                        </tbody>
                        @endif

                    </table>
                </td>

                <!-- H/over Input --->
                <td>
                    <table class="m-auto text-center table table-bordered custom-table-border-color">
                        @if($edit_status)
                        <tbody>
                            <tr>
                                <td>-</td>
                            </tr>

                            @for($j=0;$j<count($daily_report_product_decode);$j++) @php
                                $l_id_2=$daily_report_product_decode[$j]['l_id'];
                                $sewing_input=$daily_report_product_decode[$j]['sewing_input'];
                                $p_id_2=$daily_report_product_decode[$j]['p_detail_id'];$h_over_input=$daily_report_product_decode[$j]['h_over_input'];
                                @endphp @if($l_id_2==$l_id) <tr>
                                <td class="h_over_input">
                                    <input type="hidden" id="handover_l_id_input" name="l_id[]"
                                        value="<?php echo $l_id; ?>" />
                                    <input type="hidden" id="handover_a_id_input" name="a_id[]"
                                        value="<?php echo $assign_id_2; ?>" />
                                    <input type="hidden" id="handover_date_input" name="date_input[]"
                                        value="<?php echo $date; ?>" />
                                    <input type="number" id="handover_val_input" class="form-control p-0 text-center"
                                        name="handover_val_input[]" placeholder="0" min="0" step="any"
                                        value="<?php echo $h_over_input; ?>">
                                    <input type="hidden" id="handover_p_id_input" name="p_id_input[]"
                                        value="<?php echo $p_id_2; ?>" />
                                </td>
                                </tr>
                                @endif

                                @endfor
                        </tbody>
                        @else
                        <tbody>
                            <tr>
                                <td>-</td>
                            </tr>
                            @for($j=0;$j<count($daily_report_product_decode);$j++) @php
                                $l_id_2=$daily_report_product_decode[$j]['l_id'];
                                $h_over_input=$daily_report_product_decode[$j]['h_over_input']; @endphp
                                @if($l_id_2==$l_id) <tr>
                                @if($h_over_input == '')
                                <td> - </td>
                                @endif
                                @if($h_over_input != '')
                                <td>{{ number_format($h_over_input) }}</td>
                                @endif
                                </tr>
                                @endif

                                @endfor

                        </tbody>
                        @endif
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
                                <td>{{ number_format($h_over_input) }}</td>
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
                        @if($edit_status)
                        <tbody>
                            <tr>
                                <td>-</td>
                            </tr>

                            @for($j=0;$j<count($daily_report_product_decode);$j++) @php
                                $l_id_2=$daily_report_product_decode[$j]['l_id'];
                                $h_balance=$daily_report_product_decode[$j]['h_balance'];
                                $p_id_2=$daily_report_product_decode[$j]['p_detail_id']; @endphp @if($l_id_2==$l_id)
                                <tr>
                                <td class="h_bal_input">
                                    <input type="hidden" id="h_bal_l_id_input" name="l_id[]"
                                        value="<?php echo $l_id; ?>" />
                                    <input type="hidden" id="h_bal_a_id_input" name="a_id[]"
                                        value="<?php echo $assign_id_2; ?>" />
                                    <input type="hidden" id="h_bal_date_input" name="date_input[]"
                                        value="<?php echo $date; ?>" />
                                    <input type="number" id="h_bal_val_input" class="form-control p-0 text-center"
                                        name="h_balance_val_input[]" placeholder="0" min="0" step="any"
                                        value="<?php echo $h_balance; ?>">
                                    <input type="hidden" id="h_bal_p_id_input" name="p_id_input[]"
                                        value="<?php echo $p_id_2; ?>" />
                                </td>
                                </tr>
                                @endif

                                @endfor
                        </tbody>
                        @else
                        <tbody>
                            <tr>
                                <td>-</td>
                            </tr>
                            @for($j=0;$j<count($daily_report_product_decode);$j++) @php
                                $l_id_2=$daily_report_product_decode[$j]['l_id'];
                                $h_balance=$daily_report_product_decode[$j]['h_balance']; @endphp @if($l_id_2==$l_id)
                                <tr>
                                @if($h_balance == '')
                                <td> - </td>
                                @endif
                                @if($h_balance != '')
                                <td>{{ number_format($h_balance) }}</td>
                                @endif
                                </tr>
                                @endif

                                @endfor

                        </tbody>
                        @endif

                    </table>
                </td>

                <!-- S,L,ADM OP --->
                <td>
                    <table class="m-auto text-center w-100 table table-bordered custom-table-border-color">
                        @if($edit_status)
                        <tbody class="m_power_input_2">
                            <input type="hidden" id="m_power_l_id_input_2" name="l_id[]" value="<?php echo $l_id; ?>" />
                            <input type="hidden" id="m_power_a_id_input_2" name="a_id[]"
                                value="<?php echo $assign_id_2; ?>" />
                            <input type="hidden" id="m_power_date_input_2" name="date_input[]"
                                value="<?php echo $date; ?>" />
                            <tr>
                                <td>
                                    <input type="number" id="m_power_value_2" class="form-control p-0 text-center"
                                        name="m_power_value_2[]" placeholder="0" min="0" step="any"
                                        value="<?php echo $m_power; ?>">
                                </td>
                                <td>
                                    <input type="number" id="hp_value_2" class="form-control p-0 text-center"
                                        name="hp_value_2[]" placeholder="0" min="0" step="any"
                                        value="<?php echo $hp; ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="number" id="actual_m_power_value_2"
                                        class="form-control p-0 text-center" name="actual_m_power_value[]"
                                        placeholder="0" min="0" step="any" value="<?php echo $actual_m_power; ?>">
                                </td>
                                <td>
                                    <input type="number" id="actual_hp_value_2" class="form-control p-0 text-center"
                                        name="actual_hp_value_2[]" placeholder="0" min="0" step="any"
                                        value="<?php echo $actual_hp; ?>">
                                </td>
                            </tr>
                        </tbody>
                        @else
                        <tbody>
                            <tr>
                                <td class="m_power_value_{{ $l_id }}">@if($m_power != ''){{ number_format($m_power) }}
                                    @endif</td>
                                <td class="hp_value_{{ $l_id }}">@if($hp != ''){{ number_format($hp) }} @endif</td>
                            </tr>
                            <tr>
                                <td class="total_m_power_{{ $l_id }}" colspan="2"></td>
                            </tr>
                            <tr>
                                <td class="actual_m_power_value_{{ $l_id }}">@if($actual_m_power != ''){{
                                    number_format($actual_m_power) }} @endif</td>
                                <td class="actual_hp_value_{{ $l_id }}">@if($actual_hp != ''){{
                                    number_format($actual_hp)
                                    }}@endif</td>
                            </tr>
                            <tr>
                                <td class="total_actual_m_power_{{ $l_id }}" colspan="2"></td>
                            </tr>
                        </tbody>
                        @endif

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
                    $total_time=(int)$daily_report_decode[$k]['total_time']; @endphp @if($l_id_2==$l_id) <td
                    class="total_time_{{ $l_id_2 }}"> {{
                    $total_time }} </td>

                    @endif

                    @endfor

                    <!----- Total Time  End ------>

                    <td class="cmp_hr_{{ $l_id }}"></td>
                    <td class="cmp_hr_ps_{{ $l_id }}"></td>
                    <td class="note_input">
                        @if($edit_status)
                        <input type="hidden" id="note_l_id_input" name="l_id[]" value="<?php echo $l_id; ?>" />
                        <input type="hidden" id="note_a_id_input" name="a_id[]" value="<?php echo $assign_id_2; ?>" />
                        <input type="hidden" id="note_date_input" name="date_input[]" value="<?php echo $date; ?>" />
                        <textarea class="form-control note" name="note[]" placeholder="Note" id="note_val_input"
                            maxlength="150"><?php echo $remark; ?></textarea>
                        @else
                        {{ $remark }}
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


    cmp_hr.text("$ " + div_time.toFixed(1));

    /// For CMP/hr end

    /// For CMP/ HR/ PS
var total_actual_m_power_2 = $('.total_actual_m_power_{{ $l_id }}').text();
var cmp_hr_3 = $('.cmp_hr_{{ $l_id }}').text();
var cmp_hr_ps = $('.cmp_hr_ps_{{ $l_id }}');


var substring_3 = parseFloat(cmp_hr_3.substring(2));
var substring_4 = parseFloat(total_actual_m_power_2.substring(2));

// console.log(substring_3);
// console.log(total_actual_m_power_2);

var div_cmp_hr_ps = substring_3 / total_actual_m_power_2;

if(total_actual_m_power_2 != ''){

    if(Number.isNaN(div_cmp_hr_ps)){
    cmp_hr_ps.text('');
}
                            else{
cmp_hr_ps.text("$ " + div_cmp_hr_ps.toFixed(1));


                            }
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
var man_power_obj = {};
var man_power_arr = [];

$('.man_power_input').each(function(){
    var man_power_l_id = $("#man_target_l_id_input", this).val();
    var man_power_a_id_input = $("#man_target_a_id_input", this).val();
    var man_power_date_input = $("#man_target_date_input", this).val();
    var man_target = $("#man_target", this).val();
    var man_actual_target = $("#man_actual_target", this).val();

    man_power_obj = {
        man_target_l_id : man_power_l_id,
        man_target_a_id_input : man_power_a_id_input,
        man_target_date_input : man_power_date_input,
        man_target : man_target,
        man_actual_target : man_actual_target,
    }

    man_power_arr.push(man_power_obj);
});


var inline_obj = {};
var inline_arr = [];


$(".inline_input").each(function(){
    var inline_l_id = $("#inline_l_id_input",this).val();
    var inline_a_id = $("#inline_a_id_input",this).val();
    var inline_date = $("#inline_date_input",this).val();
    var inline_p_id = $("#inline_p_id_input",this).val();
    var inline_val_input = $("#inline_val_input",this).val();

    inline_obj = {
        inline_l_id : inline_l_id,
        inline_a_id : inline_a_id,
        inline_date : inline_date,
        inline_p_id : inline_p_id,
        inline_val_input : inline_val_input,
    }

    inline_arr.push(inline_obj);
});

var handover_obj = {};
var handover_arr = [];

$(".h_over_input").each(function(){
    var handover_l_id = $("#handover_l_id_input",this).val();
    var handover_a_id = $("#handover_a_id_input",this).val();
    var handover_date = $("#handover_date_input",this).val();
    var handover_p_id = $("#handover_p_id_input",this).val();
    var handover_val_input = $("#handover_val_input",this).val();

    handover_obj = {
        handover_l_id : handover_l_id,
        handover_a_id : handover_a_id,
        handover_date : handover_date,
        handover_p_id : handover_p_id,
        handover_val_input : handover_val_input,
    }

    handover_arr.push(handover_obj);
})

var box = {};
var boxes = [];
$('.td_input').each(function() {
    var l_id_input = $('#l_id_input', this).val();
    var a_id_input = $('#a_id_input', this).val();
    var p_id_input = $('#p_id_input', this).val();
    var cmp_input = $('#cmp_input',this).val();
    var date_input = $('#date_input',this).val();
box = {
l_id_input: l_id_input,
a_id_input: a_id_input,
p_id_input: p_id_input,
cmp_input: cmp_input,
date_input: date_input,
}
boxes.push(box);
});


var sewing_obj = {};
var sewing_arr = [];
$(".sewing_input").each(function(){
    var sewing_l_id = $("#sewing_l_id_input",this).val();
    var sewing_a_id = $("#sewing_a_id_input",this).val();
    var sewing_date = $("#sewing_date_input",this).val();
    var sewing_p_id = $("#sewing_p_id_input",this).val();
    var sewing_val_input = $("#sewing_val_input",this).val();

    sewing_obj = {
        sewing_l_id : sewing_l_id,
        sewing_a_id : sewing_a_id,
        sewing_date : sewing_date,
        sewing_p_id : sewing_p_id,
        sewing_val_input : sewing_val_input,
    }

    sewing_arr.push(sewing_obj);
});

//// ManPower Input (S,L,ADM OP, HP)
var m_power_obj_2 = {};
var m_power_arr_2 = [];

$(".m_power_input_2").each(function(){
    var m_power_l_id_2 = $("#m_power_l_id_input_2", this).val();
    var m_power_a_id_2 = $("#m_power_a_id_input_2", this).val();
    var m_power_date_2 = $("#m_power_date_input_2", this).val();
    var m_power_value_2 = $("#m_power_value_2",this).val();
    var hp_value_2 = $("#hp_value_2",this).val();
    var actual_m_power_value_2 = $("#actual_m_power_value_2",this).val();
    var actual_hp_value_2 = $("#actual_hp_value_2",this).val();

    m_power_obj_2 = {
        m_power_l_id_2 : m_power_l_id_2,
        m_power_a_id_2 : m_power_a_id_2,
        m_power_date_2 : m_power_date_2,
        m_power_value_2 : m_power_value_2,
        hp_value_2 : hp_value_2,
        actual_m_power_value_2 : actual_m_power_value_2,
        actual_hp_value_2 : actual_hp_value_2,
    }

    m_power_arr_2.push(m_power_obj_2);
});

//// Note
var note_obj = {};
var note_arr = [];

$(".note_input").each(function(){
    var note_l_id = $("#note_l_id_input",this).val();
    var note_a_id = $("#note_a_id_input",this).val();
    var note_date = $("#note_date_input",this).val();
    var note_val_input = $("#note_val_input",this).val();

    note_obj = {
        note_l_id : note_l_id,
        note_a_id : note_a_id,
        note_date : note_date,
        note_val_input : note_val_input,
    }

    note_arr.push(note_obj);
});
/// Order Qty
var order_qty = {};
var order_arr = [];

$(".order_quantity_input").each(function(){
    var order_l_id = $("#order_l_id_input",this).val();
    var order_a_id = $("#order_a_id_input",this).val();
    var order_date = $("#order_date_input",this).val();
    var order_p_id = $("#order_p_id_input",this).val();
    var order_val_input = $("#order_val_input",this).val();

    order_qty = {
        order_l_id : order_l_id,
        order_a_id : order_a_id,
        order_date : order_date,
        order_p_id : order_p_id,
        order_val_input : order_val_input,
    }

    order_arr.push(order_qty);
});

/// HandOver Balance

var h_bal_obj = {};
var h_bal_arr = [];

$(".h_bal_input").each(function(){
    var h_bal_l_id = $("#h_bal_l_id_input",this).val();
    var h_bal_a_id = $("#h_bal_a_id_input",this).val();
    var h_bal_date = $("#h_bal_date_input",this).val();
    var h_bal_p_id = $("#h_bal_p_id_input",this).val();
    var h_bal_val_input = $("#h_bal_val_input",this).val();

    h_bal_obj = {
        h_bal_l_id : h_bal_l_id,
        h_bal_a_id : h_bal_a_id,
        h_bal_date : h_bal_date,
        h_bal_p_id : h_bal_p_id,
        h_bal_val_input : h_bal_val_input,
    }

    h_bal_arr.push(h_bal_obj);
});

$.ajax({
        type: "POST",
        url: "/cmp_put",
        data: {
            boxes: boxes,
            man_power : man_power_arr,
            inline: inline_arr,
            handover : handover_arr,
            sewing : sewing_arr,
            m_power_2 : m_power_arr_2,
            note: note_arr,
            order_qty : order_arr,
            h_bal : h_bal_arr,
        },
        success: function(data) {
            // console.log(data);
            window.location.href = "/report?update=ok";
        }
    });
});

        </script>
    </div>
</div>


<script>
    $("#btn_history_submit").click(function(e) {
e.preventDefault();
$("#today_report").css("display", "none");
$.ajax({
type: "POST",
url: "{{ url('report_history') }}",
data: {
date_name: $("#date").val(),
},
success: function(result) {
$("#ajax_load_div").html(result);
},
error: function(result) {
    console.log(result);
    alert('error');
}
});
});
</script>

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

@endowner


@admin

<div class="container-fluid">

    <h1 class="fw-bold heading-text">Report</h1>
    <div class="row g-3">
        <div class="col-12 col-md-4">
            <label for="date">Select Date</label>
            <input type="date" class="form-control" id="date" />
            <input class="icon-btn-one btn my-2" type="button" value="Search" name="btn_history_submit"
                id="btn_history_submit" />
        </div>
    </div>
    <div id="ajax_load_div" style=""></div>

    <div class="col-12 col-md-4 my-3 p-0">
        <ul class="horizontal-slide" id="tabs">
            <li class="span2">
                <p>Date -
                    <?php if(!$edit_status && !$date){
                                echo $date_string;
                            }else{
                                echo $format_date;
                            }
                            ?>
                </p>
            </li>
            <li class="span2 bg-transparent">
                <a id="dlink" style="display:none;"></a>
                <div id="name" style="display:none;">
                    <?php echo $date_string_for_export_pdf . "_report_dash"; ?>
                </div>
                <button id="btn" class="icon-btn-one icon-btn-one-2 btn my-2">Export to Excel</button>
                <!-- <button onclick="tablesToExcel(['history_dash_1','history_dash_2','history_dash_3'], ['Table1','Table2','Table3'], '<?php //echo $getDate;
                                                                                                                                            ?>.xls', 'Excel')" class="icon-btn-one icon-btn-one-2 btn my-2">Export to Excel</button> -->
            </li>
            <li class="span2 bg-transparent">
                <button type="button" id="exportPDF" class="icon-btn-one icon-btn-one-2 btn my-2">Export to PDF</button>
            </li>
        </ul>
    </div>

    <?php
    $daily_report_decode = json_decode(json_encode($daily_report),true);
    $daily_report_product_decode = json_decode(json_encode($daily_report_product),true);
    $daily_report_product_2_decode = json_decode(json_encode($daily_report_product_2),true);

    ?>


    <div id="today_report">
        @if(!$edit_status)
        <a class='btn custom-btn-theme custom-btn-theme-edit text-white' href="{{ url('/report')}}?edit=1">Edit</a>
        @endif
        <form method="POST" id="cmp_put">
            @if($edit_status)
            <input class="icon-btn-one btn my-2" type="submit" value="Update" name="submit" />
            <a href="{{ url('/report') }}" class="btn-secondary btn my-2">Cancel</a>
            @endif
            <div style="overflow-x:auto;max-width:100%;" id="report_table">
                <h2 class="fw-bold text-center report-title" style="display:none;">Musung Garment Co.,Ltd.</h2>
                <table class="table table-striped my-4 tableFixHead results p-0 text-center table-bordered">
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
                    <tbody id="myTable" class="report_tbl_2">
                        @for($i=0;$i<count($daily_report_decode);$i++) @php
                            $l_id=$daily_report_decode[$i]['l_id'];$l_name=$daily_report_decode[$i]['l_name'];$main_target=$daily_report_decode[$i]['main_target'];$ot_main_target=$daily_report_decode[$i]['ot_main_target'];$actual_target=$daily_report_decode[$i]['total_div_actual_target'];
                            $m_power=$daily_report_decode[$i]['m_power'];$actual_m_power=$daily_report_decode[$i]['actual_m_power'];$hp=$daily_report_decode[$i]['hp'];$actual_hp=$daily_report_decode[$i]['actual_hp'];
                            $assign_date=$daily_report_decode[$i]['assign_date'];
                            $man_target=$daily_report_decode[$i]['man_target'];
                            $man_actual_target=$daily_report_decode[$i]['man_actual_target'];$assign_id_2=$daily_report_decode[$i]['assign_id'];
                            $remark=$daily_report_decode[$i]['remark']; @endphp <tr>
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
                                            $p_cat_name=$daily_report_product_decode[$j]['buyer_name'] @endphp
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
                                        <tr>
                                            <td>-</td>
                                        </tr>
                                        @for($j=0;$j<count($daily_report_product_decode);$j++) @php
                                            $l_id_2=$daily_report_product_decode[$j]['l_id'];
                                            $p_name=$daily_report_product_decode[$j]['p_name'] @endphp
                                            @if($l_id_2==$l_id) <tr>
                                            <td>{{ $p_name }}</td>
                                            </tr>
                                            @endif

                                            @endfor
                                    </tbody>
                                </table>
                            </td>
                            <td class="main_target_{{ $l_id }}">{{ number_format($main_target+$ot_main_target) }}</td>

                            <!-- Man Target --->
                            <td>
                                <table class="m-auto text-start table table-bordered custom-table-border-color">
                                    @if($edit_status)
                                    <tbody class="man_power_input">
                                        <input type="hidden" id="man_target_l_id_input" name="man_target_l_id[]"
                                            value="<?php echo $l_id; ?>" />
                                        <input type="hidden" id="man_target_a_id_input" name="man_target_a_id[]"
                                            value="<?php echo $assign_id_2; ?>" />
                                        <input type="hidden" id="man_target_date_input" name="date_input[]"
                                            value="<?php echo $date; ?>" />

                                        @for($j=0;$j<count($daily_report_product_2_decode);$j++) @php
                                            $l_id_2=$daily_report_product_2_decode[$j]['l_id'];
                                            $man_target_2=$daily_report_product_2_decode[$j]['man_target'];
                                            $man_actual_target_2=$daily_report_product_2_decode[$j]['man_actual_target'];
                                            @endphp @if($l_id_2==$l_id) <tr>
                                            <td>
                                                <input type="number" id="man_target"
                                                    class="form-control p-0 text-center" name="man_target[]"
                                                    placeholder="0" min="0" step="any" value="{{ $man_target_2 }}">
                                            </td>
                                            <td>
                                                <input type="number" id="man_actual_target"
                                                    class="form-control p-0 text-center" name="man_actual_target[]"
                                                    placeholder="0" min="0" step="any"
                                                    value="{{ $man_actual_target_2 }}">
                                            </td>
                                            </tr>
                                            @endif

                                            @endfor
                                    </tbody>
                                    @else
                                    <tbody>
                                        @for($j=0;$j<count($daily_report_product_2_decode);$j++) @php
                                            $l_id_2=$daily_report_product_2_decode[$j]['l_id'];
                                            $man_target_2=$daily_report_product_2_decode[$j]['man_target'];
                                            $man_actual_target_2=$daily_report_product_2_decode[$j]['man_actual_target'];
                                            @endphp @if($l_id_2==$l_id) <tr>
                                            <td>{{ $man_target_2 }}</td>
                                            <td>{{ $man_actual_target_2 }}</td>
                                            </tr>
                                            @endif

                                            @endfor
                                            {{-- <tr>
                                                <td>{{ $man_target }}</td>
                                                <td>{{ $man_actual_target }}</td>
                                            </tr> --}}
                                    </tbody>
                                    @endif
                                </table>
                            </td>
                            <td class="actual_target_{{ $l_id }}">@if($actual_target != ''){{
                                number_format($actual_target) }} @endif</td>
                            <td class="percent_{{ $l_id }}"></td>

                            <script>
                                var main_target = parseInt($('.main_target_{{ $l_id }}').text().replace(/,/g, ''));
                            var actual_target = parseInt($('.actual_target_{{ $l_id }}').text().replace(/,/g, ''));
                            var percent = (actual_target / main_target) * 100;

                            // console.log(percent);
                            if(Number.isNaN(percent)){
                                $('.percent_{{ $l_id }}').text("");
                                }
                                else{
                                    $('.percent_{{ $l_id }}').text(percent.toFixed(0) + "%");
                                }
                            </script>


                            <td>
                                <table class="m-auto text-center table table-bordered custom-table-border-color">
                                    @if($edit_status)
                                    <tbody>
                                        <tr>
                                            <td>-</td>
                                        </tr>

                                        @for($j=0;$j<count($daily_report_product_decode);$j++) @php
                                            $l_id_2=$daily_report_product_decode[$j]['l_id'];
                                            $order_qty=$daily_report_product_decode[$j]['order_quantity'];
                                            $p_id_2=$daily_report_product_decode[$j]['p_detail_id']; @endphp
                                            @if($l_id_2==$l_id) <tr>
                                            <td class="order_quantity_input">
                                                <input type="hidden" id="order_l_id_input" name="l_id[]"
                                                    value="<?php echo $l_id; ?>" />
                                                <input type="hidden" id="order_a_id_input" name="a_id[]"
                                                    value="<?php echo $assign_id_2; ?>" />
                                                <input type="hidden" id="order_date_input" name="date_input[]"
                                                    value="<?php echo $date; ?>" />
                                                <input type="number" id="order_val_input"
                                                    class="form-control p-0 text-center" name="order_val_input[]"
                                                    placeholder="0" min="0" step="any"
                                                    value="<?php echo $order_qty; ?>">
                                                <input type="hidden" id="order_p_id_input" name="p_id_input[]"
                                                    value="<?php echo $p_id_2; ?>" />
                                            </td>
                                            </tr>
                                            @endif

                                            @endfor
                                    </tbody>
                                    @else
                                    <tbody>
                                        <tr>
                                            <td>-</td>
                                        </tr>
                                        @for($j=0;$j<count($daily_report_product_decode);$j++) @php
                                            $l_id_2=$daily_report_product_decode[$j]['l_id'];
                                            $order_qty=$daily_report_product_decode[$j]['order_quantity'];@endphp
                                            @if($l_id_2==$l_id) <tr>
                                            @if($order_qty == '')
                                            <td> - </td>
                                            @endif
                                            @if($order_qty != '')
                                            <td>{{ number_format($order_qty) }}</td>
                                            @endif
                                            </tr>
                                            @endif

                                            @endfor

                                    </tbody>
                                    @endif

                                </table>
                            </td>

                            <!-- Sewing Input --->
                            <td>
                                <table class="m-auto text-center table table-bordered custom-table-border-color">
                                    @if($edit_status)
                                    <tbody>
                                        <tr>
                                            <td>-</td>
                                        </tr>

                                        @for($j=0;$j<count($daily_report_product_decode);$j++) @php
                                            $l_id_2=$daily_report_product_decode[$j]['l_id'];
                                            $sewing_input=$daily_report_product_decode[$j]['sewing_input'];
                                            $p_id_2=$daily_report_product_decode[$j]['p_detail_id']; @endphp
                                            @if($l_id_2==$l_id) <tr>
                                            <td class="sewing_input">
                                                <input type="hidden" id="sewing_l_id_input" name="l_id[]"
                                                    value="<?php echo $l_id; ?>" />
                                                <input type="hidden" id="sewing_a_id_input" name="a_id[]"
                                                    value="<?php echo $assign_id_2; ?>" />
                                                <input type="hidden" id="sewing_date_input" name="date_input[]"
                                                    value="<?php echo $date; ?>" />
                                                <input type="number" id="sewing_val_input"
                                                    class="form-control p-0 text-center" name="sewing_input[]"
                                                    placeholder="0" min="0" step="any"
                                                    value="<?php echo $sewing_input; ?>">
                                                <input type="hidden" id="sewing_p_id_input" name="p_id_input[]"
                                                    value="<?php echo $p_id_2; ?>" />
                                            </td>
                                            </tr>
                                            @endif

                                            @endfor
                                    </tbody>
                                    @else
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
                                            <td>{{ number_format($sewing_input) }}</td>
                                            @endif
                                            </tr>
                                            @endif

                                            @endfor

                                    </tbody>
                                    @endif

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
                                            $sewing_input=$daily_report_product_decode[$j]['sewing_input']; @endphp
                                            @if($l_id_2==$l_id) <tr>
                                            @if($sewing_input == '')
                                            <td> - </td>
                                            @endif
                                            @if($sewing_input != '')
                                            <td>{{ number_format($sewing_input) }}</td>
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
                                            $cat_actual_target=$daily_report_product_decode[$j]['cat_actual_target']
                                            @endphp @if($l_id_2==$l_id) <tr>

                                            @if($cat_actual_target == '')
                                            <td> - </td>
                                            @endif
                                            @if($cat_actual_target != '')
                                            <td class="cat_actual_target_{{ $p_id_2 }}">{{
                                                number_format($cat_actual_target) }}</td>
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
                                            $cat_actual_target=$daily_report_product_decode[$j]['cat_actual_target']
                                            @endphp @if($l_id_2==$l_id) <tr>
                                            @if($cat_actual_target == '')
                                            <td> - </td>
                                            @endif
                                            @if($cat_actual_target != '')
                                            <td>{{ number_format($cat_actual_target) }}</td>
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
                                            $cmp=$daily_report_product_decode[$j]['cmp']; @endphp @if($l_id_2==$l_id)
                                            <tr>

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
                                                <input type="hidden" id="date_input" name="date_input[]"
                                                    value="<?php echo $date; ?>" />
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
                                $p_id_2=$daily_report_product_decode[$j]['p_detail_id']; @endphp @if($l_id_2==$l_id)
                                <tr>
                                <td class="daily_cmp_{{ $p_id_2 }} cmp_product_{{ $l_id_2 }}">

                                </td>
                                </tr>


                                <script>
                                    var clothes_output = parseFloat($(".cat_actual_target_{{ $p_id_2 }}").text());
                                var cmp = parseFloat($('.cmp_{{ $p_id_2 }}').text());
                                var daily_cmp = $('.daily_cmp_{{ $p_id_2 }}');

                                // console.log(cmp);

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
                var cmp_product_text=$(this).text();
                var substring=parseFloat(cmp_product_text.substring(2));

                if(Number.isNaN(substring)){
                    substring = 0;
                }
                else{
                    total_cmp += substring;
                }

    });
        total_cmp_class.text("$ " + total_cmp.toFixed(1));

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
                        @if($edit_status)
                        <tbody>
                            <tr>
                                <td>-</td>
                            </tr>
                            @for($j=0;$j<count($daily_report_product_decode);$j++) @php
                                $l_id_2=$daily_report_product_decode[$j]['l_id'];
                                $inline_2=$daily_report_product_decode[$j]['inline'];
                                $p_id_2=$daily_report_product_decode[$j]['p_detail_id']; @endphp @if($l_id_2==$l_id)
                                <tr>
                                <td class="inline_input">
                                    <input type="hidden" id="inline_l_id_input" name="inline_l_id[]"
                                        value="<?php echo $l_id; ?>" />
                                    <input type="hidden" id="inline_a_id_input" name="inline_a_id[]"
                                        value="<?php echo $assign_id_2; ?>" />
                                    <input type="hidden" id="inline_date_input" name="date_input[]"
                                        value="<?php echo $date; ?>" />
                                    <input type="number" id="inline_val_input" class="form-control p-0 text-center"
                                        name="inline_val_input[]" value="<?php echo $inline_2; ?>">
                                    <input type="hidden" id="inline_p_id_input" name="inline_p_id_input[]"
                                        value="<?php echo $p_id_2; ?>" />

                                </td>
                                </tr>
                                @endif

                                @endfor
                        </tbody>
                        @else
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
                                <td>{{ number_format($inline_2) }}</td>
                                @endif
                                </tr>
                                @endif

                                @endfor

                        </tbody>
                        @endif

                    </table>
                </td>

                <!-- H/over Input --->
                <td>
                    <table class="m-auto text-center table table-bordered custom-table-border-color">
                        @if($edit_status)
                        <tbody>
                            <tr>
                                <td>-</td>
                            </tr>

                            @for($j=0;$j<count($daily_report_product_decode);$j++) @php
                                $l_id_2=$daily_report_product_decode[$j]['l_id'];
                                $sewing_input=$daily_report_product_decode[$j]['sewing_input'];
                                $p_id_2=$daily_report_product_decode[$j]['p_detail_id'];$h_over_input=$daily_report_product_decode[$j]['h_over_input'];
                                @endphp @if($l_id_2==$l_id) <tr>
                                <td class="h_over_input">
                                    <input type="hidden" id="handover_l_id_input" name="l_id[]"
                                        value="<?php echo $l_id; ?>" />
                                    <input type="hidden" id="handover_a_id_input" name="a_id[]"
                                        value="<?php echo $assign_id_2; ?>" />
                                    <input type="hidden" id="handover_date_input" name="date_input[]"
                                        value="<?php echo $date; ?>" />
                                    <input type="number" id="handover_val_input" class="form-control p-0 text-center"
                                        name="handover_val_input[]" placeholder="0" min="0" step="any"
                                        value="<?php echo $h_over_input; ?>">
                                    <input type="hidden" id="handover_p_id_input" name="p_id_input[]"
                                        value="<?php echo $p_id_2; ?>" />
                                </td>
                                </tr>
                                @endif

                                @endfor
                        </tbody>
                        @else
                        <tbody>
                            <tr>
                                <td>-</td>
                            </tr>
                            @for($j=0;$j<count($daily_report_product_decode);$j++) @php
                                $l_id_2=$daily_report_product_decode[$j]['l_id'];
                                $h_over_input=$daily_report_product_decode[$j]['h_over_input']; @endphp
                                @if($l_id_2==$l_id) <tr>
                                @if($h_over_input == '')
                                <td> - </td>
                                @endif
                                @if($h_over_input != '')
                                <td>{{ number_format($h_over_input) }}</td>
                                @endif
                                </tr>
                                @endif

                                @endfor

                        </tbody>
                        @endif
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
                                <td>{{ number_format($h_over_input) }}</td>
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
                        @if($edit_status)
                        <tbody>
                            <tr>
                                <td>-</td>
                            </tr>

                            @for($j=0;$j<count($daily_report_product_decode);$j++) @php
                                $l_id_2=$daily_report_product_decode[$j]['l_id'];
                                $h_balance=$daily_report_product_decode[$j]['h_balance'];
                                $p_id_2=$daily_report_product_decode[$j]['p_detail_id']; @endphp @if($l_id_2==$l_id)
                                <tr>
                                <td class="h_bal_input">
                                    <input type="hidden" id="h_bal_l_id_input" name="l_id[]"
                                        value="<?php echo $l_id; ?>" />
                                    <input type="hidden" id="h_bal_a_id_input" name="a_id[]"
                                        value="<?php echo $assign_id_2; ?>" />
                                    <input type="hidden" id="h_bal_date_input" name="date_input[]"
                                        value="<?php echo $date; ?>" />
                                    <input type="number" id="h_bal_val_input" class="form-control p-0 text-center"
                                        name="h_balance_val_input[]" placeholder="0" min="0" step="any"
                                        value="<?php echo $h_balance; ?>">
                                    <input type="hidden" id="h_bal_p_id_input" name="p_id_input[]"
                                        value="<?php echo $p_id_2; ?>" />
                                </td>
                                </tr>
                                @endif

                                @endfor
                        </tbody>
                        @else
                        <tbody>
                            <tr>
                                <td>-</td>
                            </tr>
                            @for($j=0;$j<count($daily_report_product_decode);$j++) @php
                                $l_id_2=$daily_report_product_decode[$j]['l_id'];
                                $h_balance=$daily_report_product_decode[$j]['h_balance']; @endphp @if($l_id_2==$l_id)
                                <tr>
                                @if($h_balance == '')
                                <td> - </td>
                                @endif
                                @if($h_balance != '')
                                <td>{{ number_format($h_balance) }}</td>
                                @endif
                                </tr>
                                @endif

                                @endfor

                        </tbody>
                        @endif

                    </table>
                </td>

                <!-- S,L,ADM OP --->
                <td>
                    <table class="m-auto text-center w-100 table table-bordered custom-table-border-color">
                        @if($edit_status)
                        <tbody class="m_power_input_2">
                            <input type="hidden" id="m_power_l_id_input_2" name="l_id[]" value="<?php echo $l_id; ?>" />
                            <input type="hidden" id="m_power_a_id_input_2" name="a_id[]"
                                value="<?php echo $assign_id_2; ?>" />
                            <input type="hidden" id="m_power_date_input_2" name="date_input[]"
                                value="<?php echo $date; ?>" />
                            <tr>
                                <td>
                                    <input type="number" id="m_power_value_2" class="form-control p-0 text-center"
                                        name="m_power_value_2[]" placeholder="0" min="0" step="any"
                                        value="<?php echo $m_power; ?>">
                                </td>
                                <td>
                                    <input type="number" id="hp_value_2" class="form-control p-0 text-center"
                                        name="hp_value_2[]" placeholder="0" min="0" step="any"
                                        value="<?php echo $hp; ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="number" id="actual_m_power_value_2"
                                        class="form-control p-0 text-center" name="actual_m_power_value[]"
                                        placeholder="0" min="0" step="any" value="<?php echo $actual_m_power; ?>">
                                </td>
                                <td>
                                    <input type="number" id="actual_hp_value_2" class="form-control p-0 text-center"
                                        name="actual_hp_value_2[]" placeholder="0" min="0" step="any"
                                        value="<?php echo $actual_hp; ?>">
                                </td>
                            </tr>
                        </tbody>
                        @else
                        <tbody>
                            <tr>
                                <td class="m_power_value_{{ $l_id }}">@if($m_power != ''){{ number_format($m_power) }}
                                    @endif</td>
                                <td class="hp_value_{{ $l_id }}">@if($hp != ''){{ number_format($hp) }} @endif</td>
                            </tr>
                            <tr>
                                <td class="total_m_power_{{ $l_id }}" colspan="2" id="total_m_power"></td>
                            </tr>
                            <tr>
                                <td class="actual_m_power_value_{{ $l_id }}">@if($actual_m_power != ''){{
                                    number_format($actual_m_power) }} @endif</td>
                                <td class="actual_hp_value_{{ $l_id }}">@if($actual_hp != ''){{
                                    number_format($actual_hp)
                                    }}@endif</td>
                            </tr>
                            <tr>
                                <td class="total_actual_m_power_{{ $l_id }}" colspan="2" id="total_actual_m_power"></td>
                            </tr>
                        </tbody>
                        @endif

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
                    $total_time=(int)$daily_report_decode[$k]['total_time']; @endphp @if($l_id_2==$l_id) <td
                    class="total_time_{{ $l_id_2 }}"> {{
                    $total_time }} </td>

                    @endif

                    @endfor

                    <!----- Total Time  End ------>

                    <td class="cmp_hr_{{ $l_id }}"></td>
                    <td class="cmp_hr_ps_{{ $l_id }}"></td>
                    <td class="note_input">
                        @if($edit_status)
                        <input type="hidden" id="note_l_id_input" name="l_id[]" value="<?php echo $l_id; ?>" />
                        <input type="hidden" id="note_a_id_input" name="a_id[]" value="<?php echo $assign_id_2; ?>" />
                        <input type="hidden" id="note_date_input" name="date_input[]" value="<?php echo $date; ?>" />
                        <textarea class="form-control note" name="note[]" placeholder="Note" id="note_val_input"
                            maxlength="150"><?php echo $remark; ?></textarea>
                        @else
                        {{ $remark }}
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


    cmp_hr.text("$ " + div_time.toFixed(1));

    /// For CMP/hr end

    /// For CMP/ HR/ PS
var total_actual_m_power_2 = $('.total_actual_m_power_{{ $l_id }}').text();
var cmp_hr_3 = $('.cmp_hr_{{ $l_id }}').text();
var cmp_hr_ps = $('.cmp_hr_ps_{{ $l_id }}');


var substring_3 = parseFloat(cmp_hr_3.substring(2));
var substring_4 = parseFloat(total_actual_m_power_2.substring(2));

// console.log(substring_3);
// console.log(total_actual_m_power_2);

var div_cmp_hr_ps = substring_3 / total_actual_m_power_2;

if(total_actual_m_power_2 != ''){

    if(Number.isNaN(div_cmp_hr_ps)){
    cmp_hr_ps.text('');
}
                            else{
cmp_hr_ps.text("$ " + div_cmp_hr_ps.toFixed(1));


                            }
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
var man_power_obj = {};
var man_power_arr = [];

$('.man_power_input').each(function(){
    var man_power_l_id = $("#man_target_l_id_input", this).val();
    var man_power_a_id_input = $("#man_target_a_id_input", this).val();
    var man_power_date_input = $("#man_target_date_input", this).val();
    var man_target = $("#man_target", this).val();
    var man_actual_target = $("#man_actual_target", this).val();

    man_power_obj = {
        man_target_l_id : man_power_l_id,
        man_target_a_id_input : man_power_a_id_input,
        man_target_date_input : man_power_date_input,
        man_target : man_target,
        man_actual_target : man_actual_target,
    }

    man_power_arr.push(man_power_obj);
});


var inline_obj = {};
var inline_arr = [];


$(".inline_input").each(function(){
    var inline_l_id = $("#inline_l_id_input",this).val();
    var inline_a_id = $("#inline_a_id_input",this).val();
    var inline_date = $("#inline_date_input",this).val();
    var inline_p_id = $("#inline_p_id_input",this).val();
    var inline_val_input = $("#inline_val_input",this).val();

    inline_obj = {
        inline_l_id : inline_l_id,
        inline_a_id : inline_a_id,
        inline_date : inline_date,
        inline_p_id : inline_p_id,
        inline_val_input : inline_val_input,
    }

    inline_arr.push(inline_obj);
});

var handover_obj = {};
var handover_arr = [];

$(".h_over_input").each(function(){
    var handover_l_id = $("#handover_l_id_input",this).val();
    var handover_a_id = $("#handover_a_id_input",this).val();
    var handover_date = $("#handover_date_input",this).val();
    var handover_p_id = $("#handover_p_id_input",this).val();
    var handover_val_input = $("#handover_val_input",this).val();

    handover_obj = {
        handover_l_id : handover_l_id,
        handover_a_id : handover_a_id,
        handover_date : handover_date,
        handover_p_id : handover_p_id,
        handover_val_input : handover_val_input,
    }

    handover_arr.push(handover_obj);
})

var box = {};
var boxes = [];
$('.td_input').each(function() {
    var l_id_input = $('#l_id_input', this).val();
    var a_id_input = $('#a_id_input', this).val();
    var p_id_input = $('#p_id_input', this).val();
    var cmp_input = $('#cmp_input',this).val();
    var date_input = $('#date_input',this).val();
box = {
l_id_input: l_id_input,
a_id_input: a_id_input,
p_id_input: p_id_input,
cmp_input: cmp_input,
date_input: date_input,
}
boxes.push(box);
});


var sewing_obj = {};
var sewing_arr = [];
$(".sewing_input").each(function(){
    var sewing_l_id = $("#sewing_l_id_input",this).val();
    var sewing_a_id = $("#sewing_a_id_input",this).val();
    var sewing_date = $("#sewing_date_input",this).val();
    var sewing_p_id = $("#sewing_p_id_input",this).val();
    var sewing_val_input = $("#sewing_val_input",this).val();

    sewing_obj = {
        sewing_l_id : sewing_l_id,
        sewing_a_id : sewing_a_id,
        sewing_date : sewing_date,
        sewing_p_id : sewing_p_id,
        sewing_val_input : sewing_val_input,
    }

    sewing_arr.push(sewing_obj);
});

//// ManPower Input (S,L,ADM OP, HP)
var m_power_obj_2 = {};
var m_power_arr_2 = [];

$(".m_power_input_2").each(function(){
    var m_power_l_id_2 = $("#m_power_l_id_input_2", this).val();
    var m_power_a_id_2 = $("#m_power_a_id_input_2", this).val();
    var m_power_date_2 = $("#m_power_date_input_2", this).val();
    var m_power_value_2 = $("#m_power_value_2",this).val();
    var hp_value_2 = $("#hp_value_2",this).val();
    var actual_m_power_value_2 = $("#actual_m_power_value_2",this).val();
    var actual_hp_value_2 = $("#actual_hp_value_2",this).val();

    m_power_obj_2 = {
        m_power_l_id_2 : m_power_l_id_2,
        m_power_a_id_2 : m_power_a_id_2,
        m_power_date_2 : m_power_date_2,
        m_power_value_2 : m_power_value_2,
        hp_value_2 : hp_value_2,
        actual_m_power_value_2 : actual_m_power_value_2,
        actual_hp_value_2 : actual_hp_value_2,
    }

    m_power_arr_2.push(m_power_obj_2);
});

//// Note
var note_obj = {};
var note_arr = [];

$(".note_input").each(function(){
    var note_l_id = $("#note_l_id_input",this).val();
    var note_a_id = $("#note_a_id_input",this).val();
    var note_date = $("#note_date_input",this).val();
    var note_val_input = $("#note_val_input",this).val();

    note_obj = {
        note_l_id : note_l_id,
        note_a_id : note_a_id,
        note_date : note_date,
        note_val_input : note_val_input,
    }

    note_arr.push(note_obj);
});

/// Order Qty
var order_qty = {};
var order_arr = [];

$(".order_quantity_input").each(function(){
    var order_l_id = $("#order_l_id_input",this).val();
    var order_a_id = $("#order_a_id_input",this).val();
    var order_date = $("#order_date_input",this).val();
    var order_p_id = $("#order_p_id_input",this).val();
    var order_val_input = $("#order_val_input",this).val();

    order_qty = {
        order_l_id : order_l_id,
        order_a_id : order_a_id,
        order_date : order_date,
        order_p_id : order_p_id,
        order_val_input : order_val_input,
    }

    order_arr.push(order_qty);
});

/// HandOver Balance

var h_bal_obj = {};
var h_bal_arr = [];

$(".h_bal_input").each(function(){
    var h_bal_l_id = $("#h_bal_l_id_input",this).val();
    var h_bal_a_id = $("#h_bal_a_id_input",this).val();
    var h_bal_date = $("#h_bal_date_input",this).val();
    var h_bal_p_id = $("#h_bal_p_id_input",this).val();
    var h_bal_val_input = $("#h_bal_val_input",this).val();

    h_bal_obj = {
        h_bal_l_id : h_bal_l_id,
        h_bal_a_id : h_bal_a_id,
        h_bal_date : h_bal_date,
        h_bal_p_id : h_bal_p_id,
        h_bal_val_input : h_bal_val_input,
    }

    h_bal_arr.push(h_bal_obj);
});

$.ajax({
        type: "POST",
        url: "/cmp_put",
        data: {
            boxes: boxes,
            man_power : man_power_arr,
            inline: inline_arr,
            handover : handover_arr,
            sewing : sewing_arr,
            m_power_2 : m_power_arr_2,
            note: note_arr,
            order_qty : order_arr,
            h_bal : h_bal_arr,
        },
        success: function(data) {
            // console.log(data);
            window.location.href = "/report?update=ok";
        }
    });
});

        </script>
    </div>
</div>


<script>
    $("#btn_history_submit").click(function(e) {
e.preventDefault();
$("#today_report").css("display", "none");
$.ajax({
type: "POST",
url: "{{ url('report_history') }}",
data: {
date_name: $("#date").val(),
},
success: function(result) {
$("#ajax_load_div").html(result);
},
error: function(result) {
    // console.log(result);
    alert('error');
}
});
});
</script>

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

    <h1 class="fw-bold heading-text">Report</h1>
    <div class="row g-3">
        <div class="col-12 col-md-4">
            <label for="date">Select Date</label>
            <input type="date" class="form-control" id="date" />
            <input class="icon-btn-one btn my-2" type="button" value="Search" name="btn_history_submit"
                id="btn_history_submit" />
        </div>
    </div>
    <div id="ajax_load_div" style=""></div>

    <div class="col-12 col-md-4 my-3 p-0">
        <ul class="horizontal-slide" id="tabs">
            <li class="span2">
                <p>Date -
                    <?php if(!$edit_status && !$date){
                                echo $date_string;
                            }else{
                                echo $date_string;
                            }
                            ?>
                </p>
            </li>
            <li class="span2 bg-transparent">
                <a id="dlink" style="display:none;"></a>
                <div id="name" style="display:none;">
                    <?php echo $date_string_for_export_pdf . "_report_dash"; ?>
                </div>
                <button id="btn" class="icon-btn-one icon-btn-one-2 btn my-2">Export to Excel</button>
                <!-- <button onclick="tablesToExcel(['history_dash_1','history_dash_2','history_dash_3'], ['Table1','Table2','Table3'], '<?php //echo $getDate;
                                                                                                                                            ?>.xls', 'Excel')" class="icon-btn-one icon-btn-one-2 btn my-2">Export to Excel</button> -->
            </li>
            <li class="span2 bg-transparent">
                <button type="button" id="exportPDF" class="icon-btn-one icon-btn-one-2 btn my-2">Export to PDF</button>
            </li>
        </ul>
    </div>

    <?php
    $daily_report_decode = json_decode(json_encode($daily_report),true);
    $daily_report_product_decode = json_decode(json_encode($daily_report_product),true);    $daily_report_product_2_decode = json_decode(json_encode($daily_report_product_2),true);

    ?>


    <div id="today_report">
        @if(!$edit_status)
        <a class='btn custom-btn-theme custom-btn-theme-edit text-white' href="{{ url('/report')}}?edit=1">Edit</a>
        @endif

        <form method="POST" id="remark_post">
            @if($edit_status)
            <input class="icon-btn-one btn my-2" type="submit" value="Update" name="submit" />
            <a href="{{ url('/report') }}" class="btn-secondary btn my-2">Cancel</a>
            @endif
            <div style="overflow-x:auto;max-width:100%;">
                <table class="table table-striped my-4 tableFixHead results p-0 text-center table-bordered"
                    id="report_table">
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
                            <th scope="col">
                                Remark
                            </th>
                        </tr>
                    </thead>
                    <tbody id="myTable" class="report_tbl_2">
                        @for($i=0;$i<count($daily_report_decode);$i++) @php
                            $l_id=$daily_report_decode[$i]['l_id'];$l_name=$daily_report_decode[$i]['l_name'];$main_target=$daily_report_decode[$i]['main_target'];$ot_main_target=$daily_report_decode[$i]['ot_main_target'];$actual_target=$daily_report_decode[$i]['total_div_actual_target'];
                            $m_power=$daily_report_decode[$i]['m_power'];$actual_m_power=$daily_report_decode[$i]['actual_m_power'];$hp=$daily_report_decode[$i]['hp'];$actual_hp=$daily_report_decode[$i]['actual_hp'];
                            $assign_date=$daily_report_decode[$i]['assign_date'];
                            $man_target=$daily_report_product_decode[$i]['man_target'];
                            $man_actual_target=$daily_report_product_decode[$i]['man_actual_target'];$assign_id_2=$daily_report_decode[$i]['assign_id'];
                            $note=$daily_report_product_decode[$i]['remark']; @endphp <tr>
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
                                            $p_cat_name=$daily_report_product_decode[$j]['buyer_name'] @endphp
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
                                        <tr>
                                            <td>-</td>
                                        </tr>
                                        @for($j=0;$j<count($daily_report_product_decode);$j++) @php
                                            $l_id_2=$daily_report_product_decode[$j]['l_id'];
                                            $p_name=$daily_report_product_decode[$j]['p_name'] @endphp
                                            @if($l_id_2==$l_id) <tr>
                                            <td>{{ $p_name }}</td>
                                            </tr>
                                            @endif

                                            @endfor
                                    </tbody>
                                </table>
                            </td>
                            <td class="main_target_{{ $l_id }}">{{ number_format($main_target+$ot_main_target)}}</td>

                            <!-- Man Target --->
                            <td>
                                <table class="m-auto text-start table table-bordered custom-table-border-color">
                                    @if($edit_status)
                                    <tbody class="man_power_input">
                                        <input type="hidden" id="man_target_l_id_input" name="man_target_l_id[]"
                                            value="<?php echo $l_id; ?>" />
                                        <input type="hidden" id="man_target_a_id_input" name="man_target_a_id[]"
                                            value="<?php echo $assign_id_2; ?>" />
                                        <input type="hidden" id="man_target_date_input" name="date_input[]"
                                            value="<?php echo $date; ?>" />
                                        @for($j=0;$j<count($daily_report_product_2_decode);$j++) @php
                                            $l_id_2=$daily_report_product_2_decode[$j]['l_id'];
                                            $man_target_2=$daily_report_product_2_decode[$j]['man_target'];
                                            $man_actual_target_2=$daily_report_product_2_decode[$j]['man_actual_target'];
                                            @endphp @if($l_id_2==$l_id) <tr>
                                            <td>
                                                <input type="number" id="man_target"
                                                    class="form-control p-0 text-center" name="man_target[]"
                                                    placeholder="0" min="0" step="any"
                                                    value="<?php echo $man_target_2; ?>">
                                            </td>
                                            <td>
                                                <input type="number" id="man_actual_target"
                                                    class="form-control p-0 text-center" name="man_actual_target[]"
                                                    placeholder="0" min="0" step="any"
                                                    value="<?php echo $man_actual_target_2; ?>">
                                            </td>
                                            </tr>
                                            @endif

                                            @endfor
                                    </tbody>
                                    @else
                                    <tbody>
                                        @for($j=0;$j<count($daily_report_product_2_decode);$j++) @php
                                            $l_id_2=$daily_report_product_2_decode[$j]['l_id'];
                                            $man_target_2=$daily_report_product_2_decode[$j]['man_target'];
                                            $man_actual_target_2=$daily_report_product_2_decode[$j]['man_actual_target'];
                                            @endphp @if($l_id_2==$l_id) <tr>
                                            <td>{{ $man_target_2 }}</td>
                                            <td>{{ $man_actual_target_2 }}</td>
                                            </tr>
                                            @endif

                                            @endfor
                                            {{-- <tr>
                                                <td>{{ $man_target }}</td>
                                                <td>{{ $man_actual_target }}</td>
                                            </tr> --}}
                                    </tbody>
                                    @endif
                                </table>
                            </td>
                            <td class="actual_target_{{ $l_id }}">@if($actual_target != ''){{
                                number_format($actual_target) }} @endif</td>
                            <td class="percent_{{ $l_id }}"></td>

                            <script>
                                var main_target = parseInt($('.main_target_{{ $l_id }}').text());
                            var actual_target = parseInt($('.actual_target_{{ $l_id }}').text());
                            var percent = (actual_target / main_target) * 100;

                            // console.log(percent);
                            if(Number.isNaN(percent)){
                                $('.percent_{{ $l_id }}').text("");
                                }
                                else{
                                    $('.percent_{{ $l_id }}').text(percent.toFixed(0) + "%");
                                }
                            </script>


                            <td>
                                <table class="m-auto text-center table table-bordered custom-table-border-color">
                                    @if($edit_status)
                                    <tbody>
                                        <tr>
                                            <td>-</td>
                                        </tr>

                                        @for($j=0;$j<count($daily_report_product_decode);$j++) @php
                                            $l_id_2=$daily_report_product_decode[$j]['l_id'];
                                            $order_qty=$daily_report_product_decode[$j]['order_quantity'];
                                            $p_id_2=$daily_report_product_decode[$j]['p_detail_id']; @endphp
                                            @if($l_id_2==$l_id) <tr>
                                            <td class="order_quantity_input">
                                                <input type="hidden" id="order_l_id_input" name="l_id[]"
                                                    value="<?php echo $l_id; ?>" />
                                                <input type="hidden" id="order_a_id_input" name="a_id[]"
                                                    value="<?php echo $assign_id_2; ?>" />
                                                <input type="hidden" id="order_date_input" name="date_input[]"
                                                    value="<?php echo $date; ?>" />
                                                <input type="number" id="order_val_input"
                                                    class="form-control p-0 text-center" name="order_val_input[]"
                                                    placeholder="0" min="0" step="any"
                                                    value="<?php echo $order_qty; ?>">
                                                <input type="hidden" id="order_p_id_input" name="p_id_input[]"
                                                    value="<?php echo $p_id_2; ?>" />
                                            </td>
                                            </tr>
                                            @endif

                                            @endfor
                                    </tbody>
                                    @else
                                    <tbody>
                                        <tr>
                                            <td>-</td>
                                        </tr>
                                        @for($j=0;$j<count($daily_report_product_decode);$j++) @php
                                            $l_id_2=$daily_report_product_decode[$j]['l_id'];
                                            $order_qty=$daily_report_product_decode[$j]['order_quantity'];@endphp
                                            @if($l_id_2==$l_id) <tr>
                                            @if($order_qty == '')
                                            <td> - </td>
                                            @endif
                                            @if($order_qty != '')
                                            <td>{{ number_format($order_qty) }}</td>
                                            @endif
                                            </tr>
                                            @endif

                                            @endfor

                                    </tbody>
                                    @endif

                                </table>
                            </td>

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
                                            <td>{{ number_format($sewing_input) }}</td>
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
                                            <td>{{ number_format($sewing_input) }}</td>
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
                                            $cat_actual_target=$daily_report_product_decode[$j]['cat_actual_target']
                                            @endphp @if($l_id_2==$l_id) <tr>

                                            @if($cat_actual_target == '')
                                            <td> - </td>
                                            @endif
                                            @if($cat_actual_target != '')
                                            <td class="cat_actual_target_{{ $p_id_2 }}">{{
                                                number_format($cat_actual_target) }}</td>
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
                                            $cat_actual_target=$daily_report_product_decode[$j]['cat_actual_target']
                                            @endphp @if($l_id_2==$l_id) <tr>
                                            @if($cat_actual_target == '')
                                            <td> - </td>
                                            @endif
                                            @if($cat_actual_target != '')
                                            <td>{{ number_format($cat_actual_target) }}</td>
                                            @endif </tr>
                                            @endif

                                            @endfor

                                    </tbody>
                                </table>
                            </td>

                            <script>
                                var total_cmp_class = $(".total_cmp_{{ $l_id }}").text();
                var accumulation = $('.accumulation_{{ $l_id }}');

                accumulation.text(total_cmp_class);
                            </script>
                            <!-- Inline --->
                            <td>
                                <table class="m-auto text-center table table-bordered custom-table-border-color">
                                    @if($edit_status)
                                    <tbody>
                                        <tr>
                                            <td>-</td>
                                        </tr>
                                        @for($j=0;$j<count($daily_report_product_decode);$j++) @php
                                            $l_id_2=$daily_report_product_decode[$j]['l_id'];
                                            $inline_2=$daily_report_product_decode[$j]['inline'];
                                            $p_id_2=$daily_report_product_decode[$j]['p_detail_id']; @endphp
                                            @if($l_id_2==$l_id) <tr>
                                            <td class="inline_input">
                                                <input type="hidden" id="inline_l_id_input" name="inline_l_id[]"
                                                    value="<?php echo $l_id; ?>" />
                                                <input type="hidden" id="inline_a_id_input" name="inline_a_id[]"
                                                    value="<?php echo $assign_id_2; ?>" />
                                                <input type="hidden" id="inline_date_input" name="date_input[]"
                                                    value="<?php echo $date; ?>" />
                                                <input type="number" id="inline_val_input"
                                                    class="form-control p-0 text-center" name="inline_val_input[]"
                                                    value="<?php echo $inline_2; ?>">
                                                <input type="hidden" id="inline_p_id_input" name="inline_p_id_input[]"
                                                    value="<?php echo $p_id_2; ?>" />

                                            </td>
                                            </tr>
                                            @endif

                                            @endfor
                                    </tbody>
                                    @else
                                    <tbody>
                                        <tr>
                                            <td>-</td>
                                        </tr>
                                        @for($j=0;$j<count($daily_report_product_decode);$j++) @php
                                            $l_id_2=$daily_report_product_decode[$j]['l_id'];
                                            $inline_2=$daily_report_product_decode[$j]['inline'] @endphp
                                            @if($l_id_2==$l_id) <tr>
                                            @if($inline_2 == '')
                                            <td> - </td>
                                            @endif
                                            @if($inline_2 != '')
                                            <td>{{ number_format($inline_2) }}</td>
                                            @endif
                                            </tr>
                                            @endif

                                            @endfor

                                    </tbody>
                                    @endif

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
                                            <td>{{ number_format($h_over_input) }}</td>
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
                                            <td>{{ number_format($h_over_input) }}</td>
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
                                    @if($edit_status)
                                    <tbody>
                                        <tr>
                                            <td>-</td>
                                        </tr>

                                        @for($j=0;$j<count($daily_report_product_decode);$j++) @php
                                            $l_id_2=$daily_report_product_decode[$j]['l_id'];
                                            $h_balance=$daily_report_product_decode[$j]['h_balance'];
                                            $p_id_2=$daily_report_product_decode[$j]['p_detail_id']; @endphp
                                            @if($l_id_2==$l_id) <tr>
                                            <td class="h_bal_input">
                                                <input type="hidden" id="h_bal_l_id_input" name="l_id[]"
                                                    value="<?php echo $l_id; ?>" />
                                                <input type="hidden" id="h_bal_a_id_input" name="a_id[]"
                                                    value="<?php echo $assign_id_2; ?>" />
                                                <input type="hidden" id="h_bal_date_input" name="date_input[]"
                                                    value="<?php echo $date; ?>" />
                                                <input type="number" id="h_bal_val_input"
                                                    class="form-control p-0 text-center" name="h_balance_val_input[]"
                                                    placeholder="0" min="0" step="any"
                                                    value="<?php echo $h_balance; ?>">
                                                <input type="hidden" id="h_bal_p_id_input" name="p_id_input[]"
                                                    value="<?php echo $p_id_2; ?>" />
                                            </td>
                                            </tr>
                                            @endif

                                            @endfor
                                    </tbody>
                                    @else
                                    <tbody>
                                        <tr>
                                            <td>-</td>
                                        </tr>
                                        @for($j=0;$j<count($daily_report_product_decode);$j++) @php
                                            $l_id_2=$daily_report_product_decode[$j]['l_id'];
                                            $h_balance=$daily_report_product_decode[$j]['h_balance']; @endphp
                                            @if($l_id_2==$l_id) <tr>
                                            @if($h_balance == '')
                                            <td> - </td>
                                            @endif
                                            @if($h_balance != '')
                                            <td>{{ number_format($h_balance) }}</td>
                                            @endif
                                            </tr>
                                            @endif

                                            @endfor

                                    </tbody>
                                    @endif

                                </table>
                            </td>

                            <td>
                                <table class="m-auto text-center w-100 table table-bordered custom-table-border-color">
                                    <tbody>
                                        <tr>
                                            <td class="m_power_value_{{ $l_id }}">@if($m_power != ''){{
                                                number_format($m_power) }}
                                                @endif</td>
                                            <td class="hp_value_{{ $l_id }}">@if($hp != ''){{ number_format($hp) }}
                                                @endif</td>
                                        </tr>
                                        <tr>
                                            <td class="total_m_power_{{ $l_id }}" colspan="2"></td>
                                        </tr>
                                        <tr>
                                            <td class="actual_m_power_value_{{ $l_id }}">@if($actual_m_power != ''){{
                                                number_format($actual_m_power) }} @endif</td>
                                            <td class="actual_hp_value_{{ $l_id }}">@if($actual_hp != ''){{
                                                number_format($actual_hp)
                                                }}@endif</td>
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


                            <td class="td_input">
                                @if($edit_status==1)
                                <input type="hidden" id="l_id_input" name="l_id[]" value="<?php echo $l_id; ?>" />
                                <input type="hidden" id="date_input" name="date_input[]" value="<?php echo $date; ?>" />
                                <input type="hidden" id="user_role" name="user_role"
                                    value="<?php echo Auth::user()->role; ?>" />
                                <input type="hidden" name="l_id_remark[]" value="<?php echo $l_id; ?>" /><textarea
                                    class="form-control note" name="note[]" placeholder="Note" id="note"
                                    maxlength="150">{{ $note }}</textarea>

                                @else
                                <span class="note_span">{{ $note }}</span>
                                @endif
                            </td>
                            </tr>

                            @endfor

                    </tbody>
                </table>
            </div>
        </form>
        <script>
            $("#remark_post").submit(function(e) {
e.preventDefault();

// Get NON-INPUT table cell data
var box = {};
var boxes = [];
$('.td_input').each(function() {
    var l_id_input = $('#l_id_input', this).val();
    var date_input = $('#date_input',this).val();
    var note = $('#note', this).val();
    var user_role = $("#user_role", this).val();
box = {
l_id_input: l_id_input,
date_input: date_input,
note: note,
role: user_role,
}
boxes.push(box);
});

$.ajax({
        type: "POST",
        url: "/cmp_put",
        data: {
            boxes: boxes,
        },
        success: function(data) {
            // console.log(data);
            window.location.href = "/report?update=ok";
        }
    });
});

        </script>
    </div>
</div>


<script>
    $("#btn_history_submit").click(function(e) {
e.preventDefault();
$("#today_report").css("display", "none");
$.ajax({
type: "POST",
url: "{{ url('report_history') }}",
data: {
date_name: $("#date").val(),
},
success: function(result) {
$("#ajax_load_div").html(result);
},
error: function(result) {
    console.log(result);
    alert('error');
}
});
});
</script>

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


<script>
    $("#exportPDF").click(function() {

    $(".report_tbl_2 td").css("padding", 0);
    $(".report-title").css("display",'block');
    $("[id=total_m_power]").css("display","none");
    $("[id=total_actual_m_power]").css("display","none");

        html2canvas($('#report_table')[0], {
                    onrendered: function(canvas) {
                        var data = canvas.toDataURL();
                        var docDefinition = {
                            content: [{
                                image: data,
                                width: 800,
                            }],
                            pageSize: 'A4',
                            pageOrientation: 'landscape',
                            pageMargins: [ 20, 20, 20, 20 ],
                        };
                        pdfMake.createPdf(docDefinition).download("<?php echo $date_string_for_export_pdf . '_report'; ?>.pdf");
                    }
                });

    });
</script>

<script>
    function toggle_div_fun(id) {
        var divelement = document.getElementById(id);
        if (divelement.style.display == "none") divelement.style.display = "block";
        else divelement.style.display = "none";
    }
    var tableToExcel = (function() {

        var uri = 'data:application/vnd.ms-excel;base64,',
            template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="https://www.w3.org/TR/REC-html40"><head></head><body><table border="1">{table}</table></body></html>',
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
        tableToExcel('report_table', 'Sheet 1', name.replace(/\s+/g, ' ') + '.xls')
        //setTimeout("window.location.reload()",0.0000001);

    }
    var btn = document.getElementById("btn");
    btn.addEventListener("click", download);
</script>
@endsection

@endsection