<div class="col-12 col-md-8" id="live_dash_refresh" wire:poll.1000ms>
    <div class="panel-body">
        @php $time_arr = [];
        foreach(array_reverse($time) as $t3){
        $time_arr[] = $t3->time_name;
        }
        // print_r($time_arr);
        @endphp
        <table class="table table-hover table-striped table-bordered text-center table-dash" id="live_dash_1">
            <thead>
                <tr class="tr-2 tr-3">
                    <th scope="col">Line</th>
                    <th scope="col">Target</th>
                    @foreach(array_reverse($time) as $t)
                    <th scope="col" id="th_{{ $t->time_name }}">{{ $t->time_name }}</th>
                    @endforeach
                    <th>Total</th>
                    <th>Rank</th>
                    <th>%</th>
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
                    <td style="vertical-align: middle;">{{ $g_line_name }}</td>
                    <td style="vertical-align: middle;"><span id="g_main_target_{{ $g_line_id }}">{{ $g_main_target
                            }}</span></td>

                    @foreach($time_2 as $t_2)
                    @if($g_line_id==$t_2->line_id && $t_2->time_name != 'temp')
                    @php $current_target=$t_2->time_id;
                    $prev_target = ((int)$current_target)-1;
                    @endphp
                    <td id="{{ $t_2->time_name }}">
                        <table class="w-100 text-center table m-0">
                            <tr>
                                <td><span id="new_div_target_{{ $t_2->time_id }}" class="new_div_target">{{
                                        $t_2->actual_target_entry
                                        }}</span></td>
                                <td style="display:none;"><span id="div_target_{{ $t_2->time_id }}">{{
                                        $t_2->div_target }}</span>
                                </td>
                            </tr>
                            <tr class="text-white">
                                <td id="td_div_actual_target_{{ $t_2->time_id }}">
                                    <span id="div_actual_target_{{ $t_2->time_id }}"
                                        class="div_actual_target_{{ $g_line_id }}">{{
                                        $t_2->div_actual_target }}</span>
                                </td>
                                <td style="display:none;" id="td_div_actual_target_total_{{ $t_2->time_id }}"><span
                                        id="div_actual_target_total_{{ $t_2->time_id }}"
                                        class="div_actual_target_total_{{ $g_line_id }}"></span></td>
                            </tr>
                            <tr class="text-white">
                                <td id="td_div_actual_target_percent_{{ $t_2->time_id }}" colspan="2"><span
                                        id="div_actual_target_percent_{{ $t_2->time_id }}"></span>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <script>
                        window.addEventListener('initSomething', event => {
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
})
                    </script>
                    @endif

                    @endforeach
                    @foreach($target_total as $t_2_total)
                    @if ($g_line_id == $t_2_total->line_id && $t_2_total->total != 0)
                    <td>
                        <table class="w-100 text-center table m-0">
                            @foreach($actual_target_total as $a_total)
                            @if ($g_line_id == $a_total->line_id)
                            <tr>
                                <td><span class="t_2_total_{{ $t_2_total->line_id }}"> {{ $t_2_total->total }}</span>
                                </td>
                            </tr>
                            <tr class="text-white">
                                <td class="td_a_total_{{ $t_2_total->line_id }}">
                                    <span class="a_total_{{ $t_2_total->line_id }}">{{ $a_total->total_actual_target
                                        }}</span>
                                </td>
                            </tr>
                            <tr class="text-white">
                                <td class="td_t_percent_{{ $t_2_total->line_id }}">
                                    <span class="t_percent_{{ $t_2_total->line_id }}"></span>
                                </td>
                            </tr>
                            <script>
                                window.addEventListener('additionalInit', event => {
                                    var t_2_total = parseInt($('.t_2_total_{{ $t_2_total->line_id }}').text());
                                    var a_total = parseInt($('.a_total_{{ $t_2_total->line_id }}').text());
                                    var t_percent_span = $('.t_percent_{{ $t_2_total->line_id }}');
                                    var td_t_percent = $('.td_a_total_{{ $t_2_total->line_id }}');
                                    var td_a_percent = $('.td_t_percent_{{ $t_2_total->line_id }}');


                                    if(parseInt(t_2_total) > parseInt(a_total)){
                                        td_a_percent.css('background-color','red');
                                    }
                                    if(parseInt(t_2_total) <= parseInt(a_total)){
                                        td_a_percent.css('background-color','green');
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
                                            t_percent_span.text(t_percent.toFixed(1));
                                            if (parseInt(t_percent_span.text()) >= 100) {
                                                td_t_percent.css('background-color', 'green');
                                            }
                                            if (parseInt(t_percent_span.text()) < 100) {
                                                td_t_percent.css('background-color', 'red');
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
                    <td style="vertical-align: middle;" class="t_line_{{ $t_line->row_num }} t_line_count">{{
                        $t_line->row_num }}
                    </td>

                    <script>
                        window.addEventListener('additionalInit', event => {
                            var t_line_row_num = $(".t_line_{{ $t_line->row_num }}");

                            if(t_line_row_num.text()==1 || t_line_row_num.text()==2 || t_line_row_num.text()==3){
                                t_line_row_num.css({'background-color':'green','color':'#fff'});
                            }
                        });
                    </script>
                    @endif
                    @endforeach
                    <script>
                        window.addEventListener('additionalInit', event => {
                            var t_line_count = $('.t_line_count:last').text();
$(".t_line_" + t_line_count).css({'background-color':'red','color':'#fff'});
                        });
                    </script>
                </tr>
                @endforeach
                <tr>
                    <td style="vertical-align: middle;">Total</td>
                    @foreach ($total_main_target as $t_main_target)
                    <td style="vertical-align: middle;"><span id="">{{ $t_main_target->t_main_target }}</span></td>
                    @endforeach
                    @foreach(array_reverse($total_div_target) as $t_div_target)
                    @php $total_time_name = $t_div_target->time_name;$new_num = 0; @endphp
                    <td id="{{ $t_div_target->time_name }}">
                        <table class="w-100 text-center table table-bordered m-0">
                            <tr>
                                <td><span id="new_t_div_target_num_{{ $t_div_target->row_num_1 }}">{{
                                        $t_div_target->t_div_target }}</span></td>
                            </tr>

                            @foreach ($total_div_actual_target as $t_div_actual_target_1)

                            @if($total_time_name == $t_div_actual_target_1->time_name)
                            @php $prev_row_num = $t_div_actual_target_1->row_num - 1; @endphp

                            <tr class="text-white">
                                <input type="hidden"
                                    id="new_t_div_actual_target_num_{{ $t_div_actual_target_1->row_num }}"
                                    class="new_t_div_actual_target_num"
                                    value="{{ $t_div_actual_target_1->t_div_actual_target_1 }}" />
                                <td id="td_tmp_num_{{ $t_div_actual_target_1->row_num }}">
                                    <span id="tmp_num_{{ $t_div_actual_target_1->row_num }}" class="">{{
                                        $t_div_actual_target_1->t_div_actual_target_1 }}</span>
                                </td>
                            </tr>
                            <tr class="text-white">
                                <td id="total_percent_{{ $t_div_actual_target_1->row_num }}" colspan="2">
                                </td>
                            </tr>
                            <script>
                                window.addEventListener('additionalInit', event => {
                                    var curr_target_num_val = $("#new_t_div_actual_target_num_{{ $t_div_actual_target_1->row_num }}");
                                    var prev_target_num_val = parseInt($("#new_t_div_actual_target_num_{{ $prev_row_num }}").val());
                                    var curr_target_val = parseInt("<?php echo $t_div_actual_target_1->t_div_actual_target_1; ?>");
var tmp_num_val = $("#tmp_num_{{ $t_div_actual_target_1->row_num }}");


// var sum = 0;
// $('.new_t_div_actual_target_num').each(function(){
//     sum += parseFloat(this.value);
// });
// console.log(sum);
                                    var total_row_num_val = prev_target_num_val + curr_target_val;
                                    // console.log(total_row_num_val);

                                    if(!Number.isNaN(total_row_num_val)){
                                        tmp_num_val.text(total_row_num_val);
}
var new_t_div_target_num = parseInt($("#new_t_div_target_num_{{ $t_div_actual_target_1->row_num }}").text());
var new_t_div_actual_target_num = parseInt($("#new_t_div_actual_target_num_{{ $t_div_actual_target_1->row_num }}").val());
var total_percentage =(new_t_div_actual_target_num / new_t_div_target_num) * 100;
var new_total_percent = $("#total_percent_{{ $t_div_actual_target_1->row_num }}");
var tmp_num = $("#tmp_num_{{ $t_div_actual_target_1->row_num }}").text();
new_total_percent.text(total_percentage.toFixed(1));


if(parseInt(new_t_div_target_num) > parseInt(tmp_num)){
$("#td_tmp_num_{{ $t_div_actual_target_1->row_num }}").css('background-color','red');
}
if(parseInt(new_t_div_target_num) <= parseInt(tmp_num)){
$("#td_tmp_num_{{ $t_div_actual_target_1->row_num }}").css('background-color','green');
}


    if(Number.isNaN(total_percentage)){
        new_total_percent.text("");
    }
    if(!Number.isNaN(total_percentage)){
        new_total_percent.text(total_percentage.toFixed(1));
        if(parseInt(new_t_div_actual_target_num) >= 100){
   $("#total_percent_{{ $t_div_actual_target_1->row_num }}").css('background-color','green');
} if(parseInt(new_t_div_actual_target_num) < 100){
   $("#total_percent_{{ $t_div_actual_target_1->row_num }}").css('background-color','red');
}

new_total_percent.append('%');
    }
                                });
                            </script>
                            @endif

                            @endforeach
                        </table>
                    </td>
                    @endforeach
                    {{-- <td>
                        <table class="w-100 text-center table table-bordered m-0">
                            <tr>
                                <td>
                                    hello
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    hello
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    hello
                                </td>
                            </tr>
                        </table>
                    </td> --}}
                </tr>
            </tbody>
        </table>
    </div>
</div>
