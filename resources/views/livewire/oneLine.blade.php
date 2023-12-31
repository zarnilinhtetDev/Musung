{{--
<link rel="shortcut icon" href="{{URL::asset('img/logo_2.png')}}"> --}}

{{--
<link href="{{ URL::asset('css/styles.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/app.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/jquery_numpad.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/clock.css') }}" rel="stylesheet"> --}}

@section('jQuery')
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
@endsection


@extends('layouts.app')
@section('content')
@section('content_2')

{{--
<link href="{{ asset('/css/styles.css') }}" rel="stylesheet"> --}}



<div class="container-fluid">

    @php $date_string = date("d.m.Y");
    $date_string_for_export_pdf = date("Y_m_d", strtotime($date_string)); @endphp
    <div class="row container-fluid pt-4">
        <div class="col-12 col-md-6 m-auto">
            <ul class="horizontal-slide" style="" id="tabs">
                <li class="span2 bg-transparent">
                    <h2 class="m-0 fw-bold">Date - {{ $date_string }}</h2>
                </li>
            </ul>
        </div>
        <div class="col-12 col-md-6 my-auto text-center text-md-start p-0">
            <div>
                <h2 class="m-0 fw-bold" id="digital-clock-2"></h2>
            </div>
            <script>
                /// Live Clock in line_entry.blade
            function showTime() {
                var date = new Date().toLocaleTimeString(
                    "en-US",
                    Intl.DateTimeFormat().resolvedOptions().timeZone
                );
                document.getElementById("digital-clock-2").innerHTML = date;
            }
            setInterval(showTime, 1000);
            /// Live Clock in line_entry.blade End
            </script>
        </div>
    </div>












    {{-- <div id="history_div">
        <div class="row container-fluid p-0 my-3 mx-auto">
            <div class="col-12 col-md-8" id="live_dash_wrapper"> --}}
                <div class="panel-body d-flex flex-row" wire:poll.1000ms>
                    @php $time_arr = [];
                    foreach(array_reverse($time) as $t3){
                    $time_arr[] = $t3->time_name;
                    }
                    // print_r($time_arr);

                    @endphp

                    @if(count($time_arr) > 0)

                    <div class="flex-grow-1">
                        <table class="table table-hover table-striped table-bordered text-center table-dash"
                            id="live_dash_1">
                            <thead>
                                <tr class="tr-2 tr-3">
                                    <th scope="col" style="vertical-align: middle;">Status</th>
                                    <th scope="col" style="vertical-align: middle;">Line</th>
                                    <th scope="col" style="vertical-align: middle;" class="p-0">
                                        <table class="w-100 text-center table m-0 text-white table-bordered" border="1">
                                            <tr class="">
                                                <th colspan="2">Manpower</th>
                                            </tr>
                                            <tr>
                                                <td>OP</td>
                                                <td>HP</td>
                                            </tr>
                                        </table>
                                    </th>
                                    <th scope="col" style="vertical-align: middle;">Item Name</th>
                                    <th scope="col" style="vertical-align: middle;">Inline<br />Stock</th>
                                    <th scope="col" style="vertical-align: middle;">Target</th>
                                    @foreach(array_reverse($time) as $t)
                                    <th scope="col" id="th_{{ $t->time_name }}" style="vertical-align: middle;">
                                        @php
                                        echo date('g:i A',strtotime($t->time_name));
                                        @endphp
                                    </th>
                                    @break
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($getLine as $g_line)
                                @php
                                $g_line_id=$g_line->l_id;
                                $g_line_name = $g_line->l_name;
                                $g_main_target = $g_line->main_target;
                                $g_ot_main_target = $g_line->ot_main_target;
                                $g_m_power = $g_line->m_power;
                                $g_actual_m_power = $g_line->actual_m_power;
                                $g_hp = $g_line->hp;
                                $g_actual_hp = $g_line->actual_hp;


                                $a_id = $g_line->assign_id;
                                $one_line_id = $g_line->l_id;
                                $one_line_date = $g_line->assign_date;
                                @endphp
                                @if($line_id == $g_line_id)
                                <tr style="border-bottom: 2px solid black;" class="tr_line_{{ $g_line_id }}">
                                    <td class="line_column_{{ $g_line_id }}"></td>

                                    <td class="fw-bold line_name_{{ $g_line_id }} fs-4" style="vertical-align: middle;">
                                        <a href="/one_line/{{ $one_line_id }}/{{ $one_line_date }}">
                                            @if($line_id == $g_line_id)
                                            {{
                                            $g_line_name
                                            }}
                                            {{
                                            $a_id
                                            }}
                                            @endif
                                        </a>
                                    </td>
                                    <td>
                                        <table class="w-100 text-center table table-bordered">
                                            <tr>
                                                <div style="height:9px;width:2rem;overflow-x:scroll;">
                                                    <td>{{ $g_m_power }}</td>
                                                    <td>{{ $g_hp }}</td>
                                                </div>
                                            </tr>
                                            <tr>
                                                <div style="height:8px;width:2rem;overflow-x:scroll;">
                                                    <td>{{ $g_actual_m_power }}</td>
                                                    <td>{{ $g_actual_hp }}</td>
                                                </div>
                                            </tr>
                                        </table>
                                    </td>

                                    <!-- Item Name --->
                                    <td>
                                        <table class="m-auto text-start table table-bordered">
                                            <tbody>
                                                @foreach($p_detail_3 as $p_3)
                                                @if($p_3->l_id == $g_line_id)
                                                <tr style="border-bottom: 1px solid #848484;">
                                                    <td class="text-center item_name_{{ $g_line_id }}">
                                                        {{ $p_3->p_name }}
                                                    </td>
                                                </tr>
                                                @endif

                                                @endforeach
                                            </tbody>
                                        </table>
                                    </td>
                                    <td style=" vertical-align: middle;">@foreach($total_inline as $t_inline)
                                        @if($t_inline->l_id == $g_line_id)
                                        {{ $t_inline->total_inline }}
                                        @endif
                                        @break
                                        @endforeach

                                    </td>
                                    <td style="vertical-align: middle;"><span
                                            id="g_main_target_{{ $g_line_id }}">@if($g_ot_main_target
                                            !=
                                            '') {{ number_format($g_main_target + $g_ot_main_target) }}
                                            @else {{ number_format($g_main_target) }}
                                            @endif</span></td>


                                    @foreach($time_2 as $t_2)

                                    @if($g_line_id==$t_2->line_id && $t_2->time_name != 'temp')

                                    @php $current_target=$t_2->time_id;
                                    $prev_target = ((int)$current_target)-1;
                                    @endphp



                                    {{-- set onttime for oneline --}}
                                    @php
                                    $one_time = explode(':', $t_2->time_name);
                                    $one_time = (int) $one_time[0];
                                    @endphp


                                    {{-- one line --}}
                                    @if($one_time === (int) date("H") || $one_time > (int) date("H") || $one_time < 8)
                                        <td id="{{ $t_2->time_name }}">

                                        <table class="w-100 text-center table table-bordered m-0" border="1">

                                            <tr>
                                                <td><span id="new_div_target_{{ $t_2->time_id }}"
                                                        class="new_div_target">
                                                        @if($t_2->div_actual_target=='') <span style="color:#adadad;">{{
                                                            number_format($t_2->actual_target_entry) }}</span>
                                                        @elseif($t_2->
                                                        div_actual_target!='') {{
                                                        number_format($t_2->actual_target_entry) }}
                                                        @endif
                                                    </span></td>
                                                <td><span id="div_target_total_{{ $t_2->time_id }}"
                                                        class="hide_div_target_total d-none">{{ $t_2->div_target
                                                        }}</span></td>
                                            </tr>


                                            <tr class="text-white">
                                                <td id="td_div_actual_target_{{ $t_2->time_id }}"
                                                    class="td_div_actual_target">
                                                    <span id="div_actual_target_{{ $t_2->time_id }}"
                                                        class="div_actual_target_{{ $g_line_id }}">@if($t_2->div_actual_target
                                                        !=
                                                        ''){{
                                                        $t_2->div_actual_target }} @endif</span>
                                                </td>
                                                <td><span id="div_actual_target_total_{{ $t_2->time_id }}"
                                                        class="hide_div_actual_target_total d-none"></span></td>
                                            </tr>
                                            <tr class="text-white">
                                                <td id="td_div_actual_target_percent_{{ $t_2->time_id }}"><span
                                                        id="div_actual_target_percent_{{ $t_2->time_id }}"></span>
                                                </td>
                                                <td class="d-none"></td>
                                            </tr>

                                        </table>
                                        </td>



                                        <script>
                                            window.addEventListener('initSomething10', event => {
                                    var prev_target = parseInt($("#div_actual_target_<?php echo $prev_target; ?>").text());



var current_target = parseInt($("#div_actual_target_<?php echo $current_target; ?>").text());

var total = prev_target+current_target;
var current_target_total = $("#div_actual_target_total_<?php echo $current_target; ?>");

if(Number.isNaN(total)){
current_target_total.text(current_target);
}
if(!Number.isNaN(total)){
current_target_total.text(total);
}

var new_div_actual_target_total_prev = $("#div_actual_target_total_<?php echo $prev_target; ?>").text();
var new_div_actual_target_total_current = $("#div_actual_target_total_<?php echo $current_target; ?>");
var new_div_actual_target_prev = $("#div_actual_target_<?php echo $prev_target; ?>").text();
var new_div_actual_target_current = $("#div_actual_target_<?php echo $current_target; ?>").text();

if(new_div_actual_target_total_prev!=''){
var new_total = parseInt(new_div_actual_target_total_prev) + parseInt(new_div_actual_target_current);
if(Number.isNaN(new_total)){
new_div_actual_target_total_current.text("");
}
if(!Number.isNaN(new_total)){
    new_div_actual_target_total_current.text(new_total);
    // console.log(new_div_actual_target_total);
}
}

var new_div_target = $("#new_div_target_<?php echo $current_target; ?>").text();
var div_actual_target = parseInt($("#div_actual_target_<?php echo $current_target; ?>").text());

var percentage =(parseInt(current_target) / parseInt(new_div_target) ) * 100;
var div_actual_target_percent = $("#div_actual_target_percent_<?php echo $current_target; ?>");

if(Number.isNaN(div_actual_target)){
if(div_actual_target!=''){
    var new_percent = (div_actual_target/new_div_target) * 100;
    if(Number.isNaN(new_percent)){
        div_actual_target_percent.text("");
    }if(!Number.isNaN(new_percent)){
        div_actual_target_percent.text(parseInt(new_percent));

div_actual_target_percent.append('%');
    }
}
}
if(!Number.isNaN(div_actual_target)){
if(Number.isNaN(percentage)){
div_actual_target_percent.text("");
}
if(!Number.isNaN(percentage)){
div_actual_target_percent.text(parseInt(percentage));


if(parseInt(div_actual_target_percent.text()) <= 80){
   $("#td_div_actual_target_percent_<?php echo $current_target; ?>").css('background-color','rgba(255,0,0,0.8)');
   $("#td_div_actual_target_<?php echo $current_target; ?>").css('background-color','rgba(255,0,0,0.8)');
}if(parseInt(div_actual_target_percent.text()) > 80){
   $("#td_div_actual_target_percent_<?php echo $current_target; ?>").css({'background-color':'#FF8000','color':'#fff'});
   $("#td_div_actual_target_<?php echo $current_target; ?>").css({'background-color':'#FF8000','color':'#fff'});
}
if(parseInt(div_actual_target_percent.text()) >= 100){
   $("#td_div_actual_target_percent_<?php echo $current_target; ?>").css({'background-color':'rgba(30,113,0,1)','color':'#fff'});
   $("#td_div_actual_target_<?php echo $current_target; ?>").css({'background-color':'rgba(30,113,0,1)','color':'#fff'});
}

div_actual_target_percent.append('%');
}
}

})
                                        </script>

                                        @break
                                        @endif
                                        {{-- oneline end if --}}


                                        @endif

                                        @endforeach
                                </tr>

                                @endif


                                @endforeach


                                <tr>
                                    <td></td>
                                    <td class="fw-bold total fs-4" style=" vertical-align: middle;">Total</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    @foreach ($total_main_target as $t_main_target)
                                    <td style="vertical-align: middle;"><span id="t_main_target">{{
                                            number_format($t_main_target->t_main_target +
                                            $t_main_target->ot_main_target)
                                            }}</span></td>

                                    @endforeach

                                    @php $new_num_1 = 1; @endphp
                                    @foreach($total_div_target as $t_div_target)
                                    @php $total_time_name = $t_div_target->time_name;$new_num = 0; @endphp



                                    @php
                                    $one_time = explode(':', $t_div_target->time_name);
                                    $one_time = (int) $one_time[0];
                                    @endphp


                                    @if($one_time === (int) date("H") || $one_time > (int) date("H") || $one_time < 8)
                                        <td id="{{ $t_div_target->time_name }}">
                                        <table class="w-100 text-center table table-bordered m-0" border="1">
                                            <tr>
                                                <td><span id="new_t_div_target_num_{{ $t_div_target->row_num_1 }}">{{
                                                        number_format($t_div_target->t_div_target) }}</span></td>
                                            </tr>

                                            @foreach ($total_div_actual_target as $t_div_actual_target_1)


                                            @if($total_time_name == $t_div_actual_target_1->time_name)

                                            <tr class="text-white">
                                                @foreach($total_percent_accumulation as $t_per_acc)
                                                @if($total_time_name == $t_per_acc->time_name)
                                                <input type="hidden" id="new_t_per_acc_num_{{ $new_num_1 }}"
                                                    class="new_t_per_acc_num" value="{{ $t_per_acc->t_div_target }}" />
                                                @endif
                                                @endforeach

                                                @foreach($total_percent_accumulation as $t_per_acc)
                                                @if($total_time_name == $t_per_acc->time_name)
                                                <input type="hidden" id="new_t_div_actual_target_num_{{ $new_num_1}}"
                                                    class="new_t_div_actual_target_num"
                                                    value="{{ $t_per_acc->t_div_actual_target }}" />
                                                @endif
                                                @endforeach

                                                <td id="td_tmp_num_{{ $new_num_1 }}">
                                                    <span id="tmp_num_{{ $new_num_1 }}"
                                                        class="">@if($t_div_actual_target_1->t_div_actual_target_1
                                                        !=''){{
                                                        number_format($t_div_actual_target_1->t_div_actual_target_1) }}
                                                        @endif</span>
                                                </td>
                                            </tr>
                                            <tr class="text-white">
                                                <td id="total_percent_{{ $new_num_1 }}">
                                                </td>
                                            </tr>
                                            <script>
                                                window.addEventListener('additionalInit10', event => {
                                    var curr_target_num_val = $("#new_t_div_actual_target_num_{{ $new_num_1}}");
                                    var curr_target_val = parseInt("<?php echo $t_div_actual_target_1->t_div_actual_target_1; ?>");
var tmp_num_val = $("#tmp_num_{{ $new_num_1 }}");
var new_t_div_target_num = parseInt($("#new_t_div_target_num_{{ $new_num_1 }}").text());
var new_t_div_target_num_disable = $("#new_t_div_target_num_{{ $new_num_1 }}");
var new_t_per_acc_num = parseInt($("#new_t_per_acc_num_{{ $new_num_1 }}").val());
var new_t_div_actual_target_num = parseInt($("#new_t_div_actual_target_num_{{ $new_num_1 }}").val());
var total_percentage =(tmp_num_val.text() / new_t_div_target_num) * 100;
var new_total_percent = $("#total_percent_{{ $new_num_1 }}");
var tmp_num = $("#tmp_num_{{ $new_num_1 }}").text();
// console.log(new_t_div_target_num);
if(!tmp_num){
    new_t_div_target_num_disable.text('');
}

new_total_percent.text(parseInt(total_percentage));

    if(!Number.isNaN(total_percentage)){
        new_total_percent.text(parseFloat(total_percentage).toFixed(0));


if(parseInt(total_percentage) <= 80){
   $("#total_percent_{{ $new_num_1 }}").css('background-color','rgba(255,0,0,0.8)');
   $("#td_tmp_num_{{ $new_num_1 }}").css('background-color','rgba(255,0,0,0.8)');
}
if(parseInt(total_percentage) > 80){
   $("#total_percent_{{ $new_num_1 }}").css({'background-color':'#FF8000','color':'#fff'});
   $("#td_tmp_num_{{ $new_num_1 }}").css({'background-color':'#FF8000','color':'#fff'});
}
if(parseInt(total_percentage) >= 100){
   $("#total_percent_{{ $new_num_1 }}").css({'background-color':'#085820','color':'#fff'});
   $("#td_tmp_num_{{ $new_num_1 }}").css({'background-color':'#085820','color':'#fff'});
}

new_total_percent.append('%');
    }


if(Number.isNaN(total_percentage) || total_percentage == 0){
        new_total_percent.text("");
    }
});

                                            </script>

                                            @php $new_num_1++; @endphp
                                            @endif




                                            @endforeach
                                        </table>

                                        </td>

                                        @break
                                        @endif

                                        @endforeach

                                        <td class="d-none">
                                            <table class="w-100 text-center table table-bordered m-0" border="1">
                                                <tr>
                                                    @foreach($total_overall_target as $t_overall_target)
                                                    <td class='fw-bold' id="t_overall_target">

                                                    </td>

                                                    <script>
                                                        var t_main_target = $("#t_main_target").text();
                                var t_overall_target = $("#t_overall_target");
                                t_overall_target.text(t_main_target);

                                                    </script>
                                                    @endforeach
                                                </tr>
                                                <tr class="text-white">
                                                    @foreach($total_overall_actual_target as $t_overall_actual_target)
                                                    <td class='fw-bold' id="t_overall_actual_target">
                                                        {{
                                                        number_format($t_overall_actual_target->t_overall_actual_target)
                                                        }}
                                                    </td>
                                                    @endforeach

                                                </tr>
                                                <tr class="text-white">
                                                    <td id="t_overall_percent" class='fw-bold'></td>
                                                </tr>
                                            </table>
                                            <script>
                                                window.addEventListener('additionalInit10', event => {
                                var t_overall_target = parseInt($("#t_overall_target").text().replace(/,/g, ''));
                                var t_overall_actual_target = parseInt($("#t_overall_actual_target").text().replace(/,/g, ''));
                                var t_overall_percent = $("#t_overall_percent");

                                if(parseInt(t_overall_target) > parseInt(t_overall_actual_target)){
                                    $("#t_overall_actual_target").css('background-color','red');
                                }
                                if(parseInt(t_overall_target) <= parseInt(t_overall_actual_target)){
                                    $("#t_overall_actual_target").css('background-color','green');
                                }

                                var t_percent_cal = (t_overall_actual_target/t_overall_target) * 100;


                                if(Number.isNaN(t_percent_cal)){
                                    t_overall_percent.text("");
                                }
                                if (!Number.isNaN(t_percent_cal)) {
                                    t_overall_percent.text(parseInt(t_percent_cal));

                                        if(parseInt(t_overall_actual_target) >= parseInt(t_overall_target)){
                                            t_overall_percent.css('background-color','green');
                                        }
                                        if(parseInt(t_overall_actual_target) < parseInt(t_overall_target)){
                                            t_overall_percent.css('background-color','red');
                                        }
                                t_overall_percent.append('%');
                                }

                        });
                                            </script>
                                        </td>
                                        <td class="d-none" style="vertical-align:middle;" class="fw-bolder">-</td>
                                        <td class="d-none" style="vertical-align:middle;" class="fw-bolder">-</td>
                                </tr>
                            </tbody>
                        </table>

                    </div>



                    <div class="">
                        <table class="table table-hover table-striped table-bordered text-center table-dash"
                            id="live_dash_1">
                            <thead>
                                <tr class="tr-2 tr-3">
                                    <th scope="col" style="padding:0px; border:none;background-color:#000;"></th>
                                    <th scope="col" style="padding:0px; border:none;"></th>
                                    <th scope="col" style="vertical-align: middle; height:73px !important;">Total</th>
                                    <th scope="col" style="vertical-align: middle; height:73px !important;">Rank</th>
                                    <th scope="col" style="vertical-align: middle; height:73`px !important;">%</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($getLine as $g_line)
                                @php
                                $g_line_id=$g_line->l_id;
                                $g_line_name = $g_line->l_name;
                                $g_main_target = $g_line->main_target;
                                $g_ot_main_target = $g_line->ot_main_target;
                                $g_m_power = $g_line->m_power;
                                $g_actual_m_power = $g_line->actual_m_power;
                                $g_hp = $g_line->hp;
                                $g_actual_hp = $g_line->actual_hp;

                                @endphp

                                @if($line_id == $g_line_id)
                                <tr style="border-bottom: 3px solid #000;" class="tr_line_{{ $g_line_id }}">
                                    @foreach($target_total as $t_2_total)

                                    @if ($g_line_id == $t_2_total->line_id)

                                    <td colspan="0" style="background:#000;">
                                        <table class="text-center table table-bordered border-dark"
                                            style="background:#000;">
                                            <tr style="border-bottom: 1px solid transparent; background:#000;">
                                                <td style="background:#000;">
                                                    <div style="width:0px !important;overflow-x:scroll;">{{ $g_m_power
                                                        }}
                                                    </div>
                                                </td>
                                                <td style="background:#000;">
                                                    <div style="width:0px !important;overflow-x:scroll;">{{ $g_hp }}
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr style="border-bottom: 1px solid transparent;background:#000;">
                                                <td style="background:#000;">
                                                    <div style="width:0px !important;overflow-x:scroll;">{{
                                                        $g_actual_m_power }}</div>
                                                </td>
                                                <td style="background:#000;">
                                                    <div style="width:0px !important;overflow-x:scroll;">{{ $g_actual_hp
                                                        }}
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>

                                    <td colspan="0">
                                        <table class="m-auto text-start table table-bordered">
                                            <tbody>
                                                @foreach($p_detail_3 as $p_3)

                                                @if($p_3->l_id == $g_line_id)
                                                <tr style="border-bottom: 1px #000">
                                                    <td class="item_name_{{ $g_line_id }}" colspan="0">
                                                        <div
                                                            style="text-overflow:ellipsis;width:0px !important; opacity:0;">
                                                            {{
                                                            $p_3->p_name }}</div>
                                                    </td>
                                                </tr>
                                                @endif

                                                @endforeach
                                            </tbody>
                                        </table>
                                    </td>
                                    <td>
                                        <table class="w-100 text-center table m-0">

                                            @foreach($actual_target_total as $a_total)
                                            @if ($g_line_id == $a_total->line_id)
                                            <tr>
                                                <td><span class="fw-bold t_2_total_{{ $t_2_total->line_id }}">
                                                        {{ $a_total->total_div_target }}
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr class="text-white">
                                                <td class="fw-bold td_a_total_{{ $t_2_total->line_id }}">
                                                    <span class="a_total_{{ $t_2_total->line_id }}">{{
                                                        $a_total->total_actual_target
                                                        }}</span>
                                                </td>
                                            </tr>
                                            <tr class="text-white">
                                                <td class="fw-bold td_t_percent_{{ $t_2_total->line_id }}">
                                                    <span class="t_percent_{{ $t_2_total->line_id }}"></span>
                                                </td>
                                            </tr>
                                            <script>
                                                window.addEventListener('additionalInit10', event => {
                                                var t_2_total = parseInt($('.t_2_total_{{ $t_2_total->line_id }}').text().replace(/,/g, ''));
                                                var a_total = parseInt($('.a_total_{{ $t_2_total->line_id }}').text().replace(/,/g, ''));
                                                var t_percent_span = $('.t_percent_{{ $t_2_total->line_id }}');
                                                var td_t_percent = $('.td_a_total_{{ $t_2_total->line_id }}');
                                                var td_a_percent = $('.td_t_percent_{{ $t_2_total->line_id }}');
                                                var g_line = $('.line_name_{{ $t_2_total->line_id }}');
                                                var tr_line = $(".tr_line_{{ $t_2_total->line_id }}");
                                                var item_name = $(".item_name_{{ $t_2_total->line_id }}");
                                                var g_main_target =$("#g_main_target_{{ $t_2_total->line_id }}");
                                                var line_column = $(".line_column_{{ $t_2_total->line_id }}");

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


            if(parseInt(t_percent_span.text()) <= 80){
                td_t_percent.css('background-color','rgba(255,0,0,0.8)');
                td_a_percent.css('background-color','rgba(255,0,0,0.8)');
                                                    line_column.addClass('bounce');
                                                    line_column.css('background-color','red');
            }if(parseInt(t_percent_span.text()) > 80){
                td_t_percent.css({'background-color':'#FF8000','color':'#fff'});
                td_a_percent.css({'background-color':'#FF8000','color':'#fff'});
                                                    line_column.addClass('bounce');
                                                    line_column.css('background-color','#FF8000');
            }
            if(parseInt(t_percent_span.text()) >= 100){
                td_t_percent.css({'background-color':'rgba(30,113,0,1)','color':'#fff'});
                td_a_percent.css({'background-color':'rgba(30,113,0,1)','color':'#fff'});
                                                    line_column.addClass('bounce');
                                                    line_column.css('background-color','rgba(30,113,0,1)');
            }

                                                        t_percent_span.append('%');
                                                    }
                                                }
                                              });
                                            </script>
                                            @endif
                                            @endforeach

                                        </table>
                                    </td>
                                    @endif
                                    @endforeach

                                    @foreach($top_line as $t_line)
                                    @if ($g_line_id == $t_line->l_id)
                                    <td style="vertical-align: middle;"
                                        class="t_line_{{ $t_line->row_num }} t_line_count fw-bold">
                                        {{
                                        $t_line->row_num }}
                                    </td>

                                    @endif
                                    @endforeach

                                    @foreach($top_line as $t_line)
                                    @if ($g_line_id == $t_line->l_id)
                                    <td style="vertical-align: middle;"
                                        class="t_line_{{ $t_line->row_num }} t_line_count">
                                        <span class="input_row_num_{{ $t_line->row_num }} input_row_num"
                                            style="display:none;">{{
                                            $t_line->row_num
                                            }}</span>
                                        {{
                                        $t_line->diff_target_percent }}%
                                    </td>

                                    @endif
                                    @endforeach
                                    <script>
                                        window.addEventListener('additionalInit10', event => {

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

            if(top_1 != ''){
                $('.t_line_' + top_1).css({
                    'background-color': 'green',
                    'color': '#fff'
                });
            }
            if(top_2 != ''){
                $('.t_line_' + top_2).css({
                    'background-color': 'green',
                    'color': '#fff'
                });
            }
            if(top_3 != ''){
                $('.t_line_' + top_3).css({
                    'background-color': 'green',
                    'color': '#fff'
                });
            }

              /// Do not delete (get last rank data)
                                                // var max_num = Math.max(...val_arr);

                                                // $(".t_line_" + max_num).css({
                                                //     'background-color': 'red',
                                                //     'color': '#fff'
                                                // });
                                                // var max_num = Math.max(...val_arr);

            $(".t_line_" + 10).css({
                'background-color': 'red',
                'color': '#fff'
            });
                });
                                    </script>
                                </tr>
                                @endif
                                @endforeach
                                <tr>
                                    <td colspan="0" style="background:#000 !important;">
                                        <div style="width:0px !important;overflow-x:scroll;">

                                        </div>
                                    </td>
                                    <td colspan="0">
                                        <div style="width:0px !important;overflow-x:scroll;">

                                        </div>
                                    </td>
                                    <td>
                                        <table class="w-100 text-center table table-bordered m-0" border="1">
                                            <tr>
                                                @foreach($total_overall_target as $t_overall_target)
                                                <td class='fw-bold' id="t_overall_target_2">
                                                    {{ $t_overall_target->t_overall_target }}
                                                </td>

                                                @endforeach
                                            </tr>
                                            <tr class="text-white">
                                                @foreach($total_overall_actual_target as $t_overall_actual_target)
                                                <td class='fw-bold' id="t_overall_actual_target_2">
                                                    {{ number_format($t_overall_actual_target->t_overall_actual_target)
                                                    }}
                                                </td>
                                                @endforeach
                                            </tr>
                                            <tr class="text-white">
                                                <td id="t_overall_percent_2" class='fw-bold'></td>
                                            </tr>
                                        </table>
                                        <script>
                                            window.addEventListener('additionalInit10', event => {
                                            var t_overall_target_2 = parseInt($("#t_overall_target_2").text().replace(/,/g, ''));
                                            var t_overall_actual_target_2 = parseInt($("#t_overall_actual_target_2").text().replace(/,/g, ''));
                                            var t_overall_percent_2 = $("#t_overall_percent_2");
                                            // console.log(t_overall_actual_target_2);

                                            var t_percent_cal_2 = (t_overall_actual_target_2/t_overall_target_2) * 100;
                                            // console.log(t_percent_cal_2);

                                            if(Number.isNaN(t_percent_cal_2)){
                                                t_overall_percent_2.text("");
                                            }
                                            if (!Number.isNaN(t_percent_cal_2)) {
                                                t_overall_percent_2.text(parseFloat(t_percent_cal_2).toFixed(0));

                                                    if(parseInt(t_overall_percent_2.text()) <= 80){
                                                        t_overall_percent_2.css('background-color','rgba(255,0,0,0.8)');
                                                        $("#t_overall_actual_target_2").css('background-color','rgba(255,0,0,0.8)');
                                                    }
                                                    if(parseInt(t_overall_percent_2.text()) > 80){
                                                        t_overall_percent_2.css({'background-color':'#FF8000','color':'#fff'});
                                                        $("#t_overall_actual_target_2").css({'background-color':'#FF8000','color':'#fff'});
                                                    }
                                                    if(parseInt(t_overall_percent_2.text()) >= 100){
                                                        t_overall_percent_2.css({'background-color':'rgba(30,113,0,1)','color':'#fff'});
                                                        $("#t_overall_actual_target_2").css({'background-color':'rgba(30,113,0,1)','color':'#fff'});
                                                    }
                                                    t_overall_percent_2.append('%');
                                            }

                                    });
                                        </script>
                                    </td>
                                    <td style="vertical-align:middle;" class="fw-bolder">-</td>
                                    <td style="vertical-align:middle;" class="fw-bolder">-</td>

                                </tr>

                            </tbody>
                        </table>
                    </div>

                    @else
                    <h1 class="fw-bold text-danger fs-4">Please Assign Line First</h1>
                    @endif

                </div>

            </div>
            {{-- <div class="col-12 col-md-4 p-sm-0 p-md-2 my-sm-2 my-md-0 top-3" id="percent_dash_wrapper">
                <livewire:dash-chart />
            </div>
        </div>
    </div>
</div> --}}
</div>




<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>


@endsection

@endsection
