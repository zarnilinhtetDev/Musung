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

    $date_string = date("d.m.Y");

    @endphp
    @endforeach

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
                <table class="table table-hover table-striped table-bordered text-center table-dash">
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
                            <td> {{ $g_main_target }}</td>

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
                                            <span id="div_actual_target_{{ $t_2->time_id }}">{{
                                                $t_2->div_actual_target }}</span>
                                        </td>
                                        <td id="td_div_actual_target_total_{{ $t_2->time_id }}"><span
                                                id="div_actual_target_total_{{ $t_2->time_id }}"></span></td>
                                    </tr>
                                    <tr class="text-white">
                                        <td id="td_div_actual_target_percent_{{ $t_2->time_id }}" colspan="2"><span
                                                id="div_actual_target_percent_{{ $t_2->time_id }}"></span>
                                        </td>
                                    </tr>
                                </table>
                                <script>
                                    var prev_target = parseInt($("#div_actual_target_<?php echo $prev_target; ?>").text());
                                    // console.log(prev_target);
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
var new_div_actual_target_prev = $("#div_actual_target_<?php echo $prev_target; ?>").text();
var new_div_actual_target_current = $("#div_actual_target_<?php echo $current_target; ?>").text();
if(new_div_actual_target_total_prev==''){
    // console.log(new_div_actual_target_prev);
    // console.log("Current" + new_div_actual_target_current);
   var new_total = parseInt(new_div_actual_target_prev) + parseInt(new_div_actual_target_current);
   console.log(new_total);
}
//// Last Written Code Before Meething 14:40 4.2.2022(DD-MM--YY)


var div_target = parseInt($("#div_target_<?php echo $current_target; ?>").text());
var div_actual_target_total = parseInt($("#div_actual_target_total_<?php echo $current_target; ?>").text());
var percentage =(div_actual_target_total / div_target) * 100;
var div_actual_target_percent = $("#div_actual_target_percent_<?php echo $current_target; ?>");
var new_div_target = $("#new_div_target_<?php echo $current_target; ?>").text();
var div_actual_target = parseInt($("#div_actual_target_<?php echo $current_target; ?>").text());

if(Number.isNaN(div_actual_target_total)){
    if(div_actual_target==''){
        // console.log('h');
    }
    if(div_actual_target!=''){
        // console.log(div_actual_target);
        var new_percent = (div_actual_target/div_target) * 100;
        if(Number.isNaN(new_percent)){
            div_actual_target_percent.text("");
        }if(!Number.isNaN(new_percent)){
            div_actual_target_percent.text(new_percent);
            if(parseInt(div_actual_target_percent.text()) >= 100){
       $("#td_div_actual_target_percent_<?php echo $current_target; ?>").css('background-color','green');
    } if(parseInt(div_actual_target_percent.text()) <= 100){
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
    div_actual_target_percent.text(percentage);
    if(parseInt(div_actual_target_percent.text()) >= 100){
       $("#td_div_actual_target_percent_<?php echo $current_target; ?>").css('background-color','green');
    } if(parseInt(div_actual_target_percent.text()) <= 100){
       $("#td_div_actual_target_percent_<?php echo $current_target; ?>").css('background-color','red');
    }

    div_actual_target_percent.append('%');
}
}


if(parseInt(new_div_target) < parseInt(div_actual_target)){
    $("#td_div_actual_target_<?php echo $current_target; ?>").css('background-color','red');
}
if(parseInt(new_div_target) < parseInt(div_actual_target)){
    $("#td_div_actual_target_<?php echo $current_target; ?>").css('background-color','green');
}

if(parseInt(div_target) > parseInt(div_actual_target_total)){
    $("#td_div_actual_target_total_<?php echo $current_target; ?>").css('background-color','red');
}
if(parseInt(div_target) < parseInt(div_actual_target_total)){
    $("#td_div_actual_target_total_<?php echo $current_target; ?>").css('background-color','green');
}


                                </script>
                            </td>
                            {{-- <td>
                                {{ $t_2->actual_target_entry }}
                            </td> --}}
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
                    <div id="live_bar_chart"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid p-0 my-3">
        <div class="row">
            <div class="col-12 col-md-8">
                <div class="div-bg-1">
                    <h1 class="fw-bold heading-text fs-3 p-2">Actual Percentage Chart</h1>
                    <div class="panel-body">
                        <table class="table table-hover table-striped table-bordered text-center">
                            <thead>
                                <tr class="tr-2 tr-3">
                                    <th scope="col">Line Name</th>
                                    <th scope="col">Line 1</th>
                                    <th scope="col">Line 3</th>
                                    <th scope="col">Line 4</th>
                                    <th scope="col">Line 4S</th>
                                    <th scope="col">Line 5A</th>
                                    <th scope="col">Line 5</th>
                                    <th scope="col">Line 5S</th>
                                    <th scope="col">Line 8</th>
                                    <th scope="col">Line Mini</th>
                                    <th scope="col">Line Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>
                                        Target
                                    </th>
                                    <td>
                                        370
                                    </td>
                                    <td>
                                        224
                                    </td>
                                    <td>
                                        315
                                    </td>
                                    <td>
                                        405
                                    </td>
                                    <td>
                                        564
                                    </td>
                                    <td>
                                        871
                                    </td>
                                    <td>
                                        809
                                    </td>
                                    <td>
                                        286
                                    </td>
                                    <td>
                                        188
                                    </td>
                                    <td>
                                        4032
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Actual
                                    </th>
                                    <td>
                                        332
                                    </td>
                                    <td>
                                        111
                                    </td>
                                    <td>
                                        278
                                    </td>
                                    <td>
                                        240
                                    </td>
                                    <td>
                                        385
                                    </td>
                                    <td>
                                        770
                                    </td>
                                    <td>
                                        340
                                    </td>
                                    <td>
                                        173
                                    </td>
                                    <td>
                                        148
                                    </td>
                                    <td>
                                        2777
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        %
                                    </th>
                                    <td>
                                        90%
                                    </td>
                                    <td>
                                        50%
                                    </td>
                                    <td>
                                        88%
                                    </td>
                                    <td>
                                        59%
                                    </td>
                                    <td>
                                        68%
                                    </td>
                                    <td>
                                        88%
                                    </td>
                                    <td>
                                        42%
                                    </td>
                                    <td>
                                        60%
                                    </td>
                                    <td>
                                        79%
                                    </td>
                                    <td>
                                        69%
                                    </td>
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
                                <tr class="bg-success">
                                    <th class="text-white">
                                        Top 1
                                    </th>
                                    <td class="text-white">
                                        Line 1
                                    </td>
                                    <td class="text-white">
                                        332
                                    </td>
                                    <td class="text-white">
                                        90%
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Top 2
                                    </th>
                                    <td>
                                        Line 5
                                    </td>
                                    <td>
                                        770
                                    </td>
                                    <td>
                                        88%
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Top 3
                                    </th>
                                    <td>
                                        Line 4
                                    </td>
                                    <td>
                                        278
                                    </td>
                                    <td>
                                        70%
                                    </td>
                                </tr>
                                <tr class="bg-danger text-white">
                                    <th>
                                        Last
                                    </th>
                                    <td>
                                        Line 5S
                                    </td>
                                    <td>
                                        340
                                    </td>
                                    <td>
                                        40%
                                    </td>
                                </tr>
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


{{--

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
$user_id = $d->id;
$user_name = $d->name;
$div_actual_target = $d->div_actual_target;
$div_actual_percent = $d->div_actual_percent;
@endphp
@if ($line_id_1 == $line_id)
<td class="p-0">
    1
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
@endif
@endforeach --}}
