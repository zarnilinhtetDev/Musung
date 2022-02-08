@extends('layouts.app')
@section('content')
@section('content_2')

<div class="container-fluid">
    @php
    $json_encode = json_encode($responseBody);
    $json_decode = json_decode($json_encode);
    @endphp
    @foreach($json_decode as $d)
    @php
    $line_id = $d->l_id;
    $line_name = $d->l_name;
    $a_id=$d->assign_id;
    $main_target=$d->main_target;
    $s_time = $d->s_time;
    $e_time=$d->e_time;
    $lunch_s_time=$d->lunch_s_time;
    $lunch_e_time=$d->lunch_e_time;
    $time_id=$d->time_id;
    $time_name=$d->time_name;
    $line_status=$d->status;
    $div_target=$d->div_target;
    $actual_target=$d->actual_target_entry;
    $assign_date = $d->assign_date;

    // $date_string = date("d.m.Y");

    @endphp
    @endforeach
    @php $date_string = date("d.m.Y"); @endphp
    <div class="container-fluid">
        <ul class="horizontal-slide" style="" id="tabs">
            <li class="span2 bg-transparent">
                <input class="icon-btn-one btn my-2" type="submit" value="Date - {{ $date_string }}" />
            </li>
            <li class="span2 bg-transparent">
                <input class="icon-btn-one icon-btn-one-2 btn my-2" type="submit" value="Export to Excel"
                    name="submit" />
            </li>
        </ul>
    </div>
    <div class="row container-fluid p-0 my-3 mx-auto">
        <div class="col-12 col-md-8">
            <div class="panel-body">
                <table class="table table-hover table-striped table-bordered text-center table-dash" id="live_dash_1">
                    <thead>
                        <tr class="tr-2 tr-3">
                            <th scope="col">Line</th>
                            <th scope="col">Target</th>
                            @foreach($time as $t)
                            <th scope="col">{{ $t->time_name }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($getLine as $g_line)
                        @php
                        $g_line_id=$g_line->l_id;
                        $g_line_name = $g_line->l_name;
                        $g_main_target = $g_line->main_target;
                        @endphp
                        <tr>
                            <td>{{ $g_line_name }}</td>
                            <td><span id="g_main_target_{{ $g_line_id }}">{{ $g_main_target }}</span></td>

                            @foreach($time_2 as $t_2)
                            @if($g_line_id==$t_2->line_id)
                            @php $current_target = $t_2->time_id;
                            $prev_target = ((int)$current_target)-1;
                            @endphp
                            <td>
                                <table class="w-100 text-center">
                                    <tr>
                                        <td><span id="new_div_target_{{ $t_2->time_id }}">{{ $t_2->actual_target_entry
                                                }}</span></td>
                                        <td><span id="div_target_{{ $t_2->time_id }}">{{ $t_2->div_target }}</span></td>
                                    </tr>
                                    <tr class="text-white">
                                        <td id="td_div_actual_target_{{ $t_2->time_id }}">
                                            <span id="div_actual_target_{{ $t_2->time_id }}"
                                                class="div_actual_target_{{ $g_line_id }}">{{
                                                $t_2->div_actual_target }}</span>
                                        </td>
                                        <td id="td_div_actual_target_total_{{ $t_2->time_id }}"><span
                                                id="div_actual_target_total_{{ $t_2->time_id }}"
                                                class="div_actual_target_total_{{ $g_line_id }}"></span></td>
                                    </tr>
                                    <tr class="text-white">
                                        <td id="td_div_actual_target_percent_{{ $t_2->time_id }}" colspan="2"><span
                                                id="div_actual_target_percent_{{ $t_2->time_id }}"></span>
                                        </td>
                                    </tr>
                                </table>
                                <script>
                                    var prev_target = parseInt($("#div_actual_target_<?php echo $prev_target; ?>").text());
var current_target = parseInt($("#div_actual_target_<?php echo $current_target; ?>").text());

var total = prev_target+current_target;
var current_target_total = $("#div_actual_target_total_<?php echo $current_target; ?>");

if(Number.isNaN(total)){
    current_target_total.text('');
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
    }
}

var div_target = parseInt($("#div_target_<?php echo $current_target; ?>").text());
var div_actual_target_total = parseInt($("#div_actual_target_total_<?php echo $current_target; ?>").text());
var percentage =(div_actual_target_total / div_target) * 100;
var div_actual_target_percent = $("#div_actual_target_percent_<?php echo $current_target; ?>");
var new_div_target = $("#new_div_target_<?php echo $current_target; ?>").text();
var div_actual_target = parseInt($("#div_actual_target_<?php echo $current_target; ?>").text());

if(Number.isNaN(div_actual_target_total)){
    if(div_actual_target!=''){
        var new_percent = (div_actual_target/div_target) * 100;
        if(Number.isNaN(new_percent)){
            div_actual_target_percent.text("");
        }if(!Number.isNaN(new_percent)){
            div_actual_target_percent.text(new_percent.toFixed(1));
            if(parseInt(div_actual_target_percent.text()) >= 100){
       $("#td_div_actual_target_percent_<?php echo $current_target; ?>").css('background-color','green');
    } if(parseInt(div_actual_target_percent.text()) < 100){
       $("#td_div_actual_target_percent_<?php echo $current_target; ?>").css('background-color','red');
    }

    div_actual_target_percent.append('%');
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
       $("#td_div_actual_target_percent_<?php echo $current_target; ?>").css('background-color','green');
    } if(parseInt(div_actual_target_percent.text()) < 100){
       $("#td_div_actual_target_percent_<?php echo $current_target; ?>").css('background-color','red');
    }

    div_actual_target_percent.append('%');
}
}


if(parseInt(new_div_target) > parseInt(div_actual_target)){
    $("#td_div_actual_target_<?php echo $current_target; ?>").css('background-color','red');
}
if(parseInt(new_div_target) <= parseInt(div_actual_target)){
    $("#td_div_actual_target_<?php echo $current_target; ?>").css('background-color','green');
}

if(parseInt(div_target) > parseInt(div_actual_target_total)){
    $("#td_div_actual_target_total_<?php echo $current_target; ?>").css('background-color','red');
}
if(parseInt(div_target) <= parseInt(div_actual_target_total)){
    $("#td_div_actual_target_total_<?php echo $current_target; ?>").css('background-color','green');
}

                                </script>
                            </td>
                            @endif
                            @endforeach
                        </tr>
                        @endforeach

                        {{-- <tr>
                            <td>
                                Mini
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td>1</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td>100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>2</td>
                                        <td>3</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-danger">1</td>
                                        <td class="bg-danger">2</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td colspan="2" class="bg-danger">66.7%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>4</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>5</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-danger">2</td>
                                        <td class="bg-danger">4</td>
                                    </tr>
                                    <tr class="bg-danger text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>6</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>7</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>8</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-danger">2</td>
                                        <td class="bg-danger">4</td>
                                    </tr>
                                    <tr class="bg-danger text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>9</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>10</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-danger">2</td>
                                        <td class="bg-danger">4</td>
                                    </tr>
                                    <tr class="bg-danger text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>11</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>12</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>13</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Total
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td>1</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td>100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>2</td>
                                        <td>3</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-danger">1</td>
                                        <td class="bg-danger">2</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td colspan="2" class="bg-danger">66.7%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>4</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>5</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-danger">2</td>
                                        <td class="bg-danger">4</td>
                                    </tr>
                                    <tr class="bg-danger text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>6</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>7</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>8</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-danger">2</td>
                                        <td class="bg-danger">4</td>
                                    </tr>
                                    <tr class="bg-danger text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>9</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>10</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-danger">2</td>
                                        <td class="bg-danger">4</td>
                                    </tr>
                                    <tr class="bg-danger text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>11</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>12</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>13</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                        </tr> --}}
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-12 col-md-4 p-0">
            <div class="container-fluid p-0 h-100">
                <div class="div-bg-1 h-100">
                    <h1 class="fw-bold heading-text fs-3 p-2">Today's Percentage Chart</h1>
                    {{-- <div id="live_bar_chart"></div> --}}
                    <div id="live_bar_chart_2">
                        {!! $percent_chart->container() !!}
                        <script src="{{ $percent_chart->cdn() }}"></script>

                        {!! $percent_chart->script() !!}
                    </div>
                </div>
            </div>
        </div>
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
                                    <th scope="col">Line Name</th>
                                    @foreach ($getLine as $g_line)
                                    @php
                                    $g_line_id=$g_line->l_id;
                                    $g_line_name = $g_line->l_name;
                                    $g_main_target = $g_line->main_target;
                                    @endphp
                                    <th scope="col"><span class="actual_target_div_{{ $g_line_id }}">{{ $g_line_name
                                            }}</span></th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>
                                        Target
                                    </th>
                                    @foreach ($getLine as $g_line)
                                    @php
                                    $g_line_id=$g_line->l_id;
                                    $g_line_name = $g_line->l_name;
                                    $g_main_target = $g_line->main_target;
                                    @endphp
                                    <td id="td_main_target_actual_chart_{{ $g_line_id }}">
                                        <span id="main_target_actual_chart_{{ $g_line_id }}"
                                            class="actual_target_div_{{ $g_line_id }}"></span>
                                    </td>
                                    <script>
                                        var g_main_target = $("#g_main_target_{{ $g_line_id }}").text();
                                        var main_target_actual_chart = $("#main_target_actual_chart_{{ $g_line_id }}");
                                        main_target_actual_chart.text(g_main_target);
                                    </script>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>
                                        Actual
                                    </th>
                                    @foreach ($getLine as $g_line)
                                    @php
                                    $g_line_id=$g_line->l_id;
                                    $g_line_name = $g_line->l_name;
                                    $g_main_target = $g_line->main_target;
                                    @endphp
                                    <td id="td_actual_target_actual_chart_{{ $g_line_id }}">
                                        <span id="actual_target_actual_chart_{{ $g_line_id }}"
                                            class="text-white actual_target_div_{{ $g_line_id }}"></span>
                                    </td>
                                    <script>
                                        var div_actual_target = $(".div_actual_target_total_{{ $g_line_id }}");
                                        if(div_actual_target.text()==''){
                                        var front_div_actual_target = $(".div_actual_target_{{ $g_line_id }}");
var actual_target_array = [];
for(var i = 0; i < front_div_actual_target.length; i++){
    actual_target_array.push($(front_div_actual_target[i]).text());
}
var newActualTargetArray = actual_target_array.filter(function(v){return v!==''});
var lastActualTargetItem = newActualTargetArray[newActualTargetArray.length - 1];

var actual_target_actual_chart = $("#actual_target_actual_chart_{{ $g_line_id }}");
actual_target_actual_chart.text(lastActualTargetItem);
if(parseInt(actual_target_actual_chart.text()) >= parseInt(g_main_target)){
       $("#td_actual_target_actual_chart_{{ $g_line_id }}").css('background-color','green');
    }
    if(parseInt(actual_target_actual_chart.text()) <= parseInt(g_main_target)){
        $("#td_actual_target_actual_chart_{{ $g_line_id }}").css('background-color','red');
}
                                        }
                                        if(div_actual_target.text()!=''){
var actual_target_array = [];
for(var i = 0; i < div_actual_target.length; i++){
    actual_target_array.push($(div_actual_target[i]).text());
}
var newActualTargetArray = actual_target_array.filter(function(v){return v!==''});
var lastActualTargetItem = newActualTargetArray[newActualTargetArray.length - 1];

var actual_target_actual_chart = $("#actual_target_actual_chart_{{ $g_line_id }}");
actual_target_actual_chart.text(lastActualTargetItem);
if(parseInt(actual_target_actual_chart.text()) >= parseInt(g_main_target)){
       $("#td_actual_target_actual_chart_{{ $g_line_id }}").css('background-color','green');
    }
    if(parseInt(actual_target_actual_chart.text()) <= parseInt(g_main_target)){
        $("#td_actual_target_actual_chart_{{ $g_line_id }}").css('background-color','red');
}
                                        }
                                    </script>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>
                                        %
                                    </th>
                                    @foreach ($getLine as $g_line)
                                    @php
                                    $g_line_id=$g_line->l_id;
                                    $g_line_name = $g_line->l_name;
                                    $g_main_target = $g_line->main_target;
                                    @endphp
                                    <td id="td_actual_percent_actual_chart_{{ $g_line_id }}" class="text-white">
                                        <span id="actual_target_percent_actual_chart_{{ $g_line_id }}"
                                            class="actual_target_div_{{ $g_line_id }}"></span>
                                    </td>
                                    <script>
                                        var main_target_actual_chart_val = parseInt($("#main_target_actual_chart_{{ $g_line_id }}").text());
                                        var actual_target_actual_chart_val = parseInt($("#actual_target_actual_chart_{{ $g_line_id }}").text());
                                        var actual_target_percent_actual_chart = $("#actual_target_percent_actual_chart_{{ $g_line_id }}");

                                        var actual_percent_val =(actual_target_actual_chart_val / main_target_actual_chart_val) * 100;
                                        if(Number.isNaN(actual_percent_val)){
                                        actual_target_percent_actual_chart.text('');
                                        }
                                        if(!Number.isNaN(actual_percent_val)){
                                            actual_percent_val = actual_percent_val;
                                        actual_target_percent_actual_chart.text(actual_percent_val.toFixed(1));
                                        if(parseInt(actual_target_percent_actual_chart.text()) >= 100){
       $("#td_actual_percent_actual_chart_{{ $g_line_id }}").css('background-color','green');
    } if(parseInt(actual_target_percent_actual_chart.text()) <= 100){
        $("#td_actual_percent_actual_chart_{{ $g_line_id }}").css('background-color','red');
    }
                                        actual_target_percent_actual_chart.append('%');
                                        }
                                    </script>
                                    @endforeach
                                </tr>
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
                                </script>
                                @php $list_num = 1; @endphp
                                @foreach($top_line as $t_data)
                                @php $g_line_id=$t_data->line_id; @endphp
                                <tr id="tr_top_{{ $g_line_id }}">
                                    <th id="top_name_{{ $g_line_id }}">
                                        Top {{ $list_num }}
                                    </th>
                                    <td>
                                        <span id="top_line_name_{{ $g_line_id }}">{{ $t_data->l_name }}</span>
                                    </td>
                                    <td>
                                        <span id="top_actual_target_{{ $g_line_id }}">{{ $t_data->total_actual }}</span>
                                    </td>
                                    <td>
                                        <span id="top_actual_percent_{{ $g_line_id }}"></span>
                                    </td>
                                </tr>
                                @php $list_num++; @endphp
                                <script>
                                    var top_percent = $("#actual_target_percent_actual_chart_{{ $g_line_id }}").text();
                                    var top_actual_percent = $("#top_actual_percent_{{ $g_line_id }}");
                                    top_actual_percent.text(top_percent);

                                    $top_1 = $("#tr_top_1");
                                    $top_1_th = $("#top_name_1");
                                    $top_1_td = $("#tr_top_1 td");

                                    $top_1.css('background-color','green');
                                    $top_1_th.css('color','white');
                                    $top_1_td.css('color','white');
                                </script>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@endsection
