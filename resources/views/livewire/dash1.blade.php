<div class="panel-body" wire:poll.1000ms>
    @php $time_arr = [];
    foreach(array_reverse($time) as $t3){
    $time_arr[] = $t3->time_name;
    }
    // print_r($time_arr);
    @endphp
    @if(count($time_arr) > 0)
    <table class="table table-hover table-striped table-bordered text-center table-dash" id="live_dash_1">
        <thead>
            <tr class="tr-2 tr-3">
                <th scope="col" style="vertical-align: middle;">Line</th>
                <th scope="col" style="vertical-align: middle;" class="p-0">
                    <table class="w-100 text-center table m-0 text-white table-bordered">
                        <tr class="">
                            <th colspan="2">Manpower</th>
                        </tr>
                        <tr>
                            <td>OP</td>
                            <td>HP</td>
                        </tr>
                    </table>
                </th>
                <th scope="col" style="vertical-align: middle;">Order <br />Qty</th>
                <th scope="col" style="vertical-align: middle;">Item Name</th>
                <th scope="col" style="vertical-align: middle;">Inline<br />Stock</th>
                <th scope="col" style="vertical-align: middle;">Target</th>
                @foreach(array_reverse($time) as $t)
                <th scope="col" id="th_{{ $t->time_name }}" style="vertical-align: middle;">{{ $t->time_name }}</th>
                @endforeach
                <th scope="col" style="vertical-align: middle;">Total</th>
                <th scope="col" style="vertical-align: middle;">Rank</th>
                <th scope="col" style="vertical-align: middle;">%</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($getLine as $g_line)
            @php
            $g_line_id=$g_line->l_id;
            $g_line_name = $g_line->l_name;
            $g_main_target = $g_line->main_target;
            $g_m_power = $g_line->m_power;
            $g_actual_m_power = $g_line->actual_m_power;
            $g_hp = $g_line->hp;
            $g_actual_hp = $g_line->actual_hp;
            @endphp
            <tr>
                <td style="vertical-align: middle;">{{ $g_line_name }}</td>
                <td>
                    <table class="w-100 text-center table m-0 table-bordered">
                        <tr>
                            <td>{{ $g_m_power }}</td>
                            <td>{{ $g_hp }}</td>
                        </tr>
                        <tr>
                            <td>{{ $g_actual_m_power }}</td>
                            <td>{{ $g_actual_hp }}</td>
                        </tr>
                    </table>
                </td>
                <td></td>

                <!-- Item Name --->
                <td>
                    <table class="m-auto text-start table table-bordered">
                        <tbody>
                            @foreach($p_detail_2 as $p_2)
                            @if($p_2->l_id == $g_line_id)
                            <tr>
                                <td>
                                    #{{ $p_2->style_no }}, {{ $p_2->p_name }}
                                </td>
                            </tr>
                            @endif

                            @endforeach
                        </tbody>
                    </table>
                </td>
                <td style="vertical-align: middle;">@foreach($total_inline as $t_inline)
                    @if($t_inline->l_id == $g_line_id)
                    {{ $t_inline->total_inline }}
                    @endif
                    @endforeach</td>
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

var new_div_target = $("#new_div_target_<?php echo $current_target; ?>").text();
var div_actual_target = parseInt($("#div_actual_target_<?php echo $current_target; ?>").text());

var percentage =(div_actual_target / new_div_target) * 100;
var div_actual_target_percent = $("#div_actual_target_percent_<?php echo $current_target; ?>");


if(Number.isNaN(div_actual_target_total)){
if(div_actual_target!=''){
    var new_percent = (div_actual_target/div_target) * 100;
    if(Number.isNaN(new_percent)){
        div_actual_target_percent.text("");
    }if(!Number.isNaN(new_percent)){
        div_actual_target_percent.text(parseInt(new_percent));
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
div_actual_target_percent.text(parseInt(percentage));
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
                                            t_percent_span.text(parseInt(t_percent));
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

                @endif
                @endforeach
                <script>
                    window.addEventListener('additionalInit', event => {

                            var t_line_count = $('.t_line_count').text();
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

                    // if(top_1 != ''){
                    //     $('.t_line_1').css({
                    //         'background-color': 'green',
                    //         'color': '#fff'
                    //     });
                    // }
                    // if(top_2 != ''){
                    //     $('.t_line_2').css({
                    //         'background-color': 'green',
                    //         'color': '#fff'
                    //     });
                    // }
                    // if(top_3 != ''){
                    //     $('.t_line_3').css({
                    //         'background-color': 'green',
                    //         'color': '#fff'
                    //     });
                    // }
                        $('.t_line_1').css({
                            'background-color': 'green',
                            'color': '#fff'
                        });
                        $('.t_line_2').css({
                            'background-color': 'green',
                            'color': '#fff'
                        });
                        $('.t_line_3').css({
                            'background-color': 'green',
                            'color': '#fff'
                        });

                        /// Do not delete (get last rank data)
                                    // var max_num = Math.max(...val_arr);

                                    // $(".t_line_" + max_num).css({
                                    //     'background-color': 'red',
                                    //     'color': '#fff'
                                    // });

                    $(".t_line_" + 10).css({
                        'background-color': 'red',
                        'color': '#fff'
                    });

                        });
                </script>


                @foreach($top_line as $t_line)
                @if ($g_line_id == $t_line->l_id)
                <td style="vertical-align: middle;" class="t_line_{{ $t_line->row_num }} t_line_count">
                    <span class="input_row_num_{{ $t_line->row_num }} input_row_num" style="display:none;">{{
                        $t_line->row_num
                        }}</span>
                    {{
                    $t_line->diff_target_percent }}%
                </td>

                @endif
                @endforeach
                <script>
                    window.addEventListener('additionalInit', event => {

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

$(".t_line_" + 10).css({
    'background-color': 'red',
    'color': '#fff'
});

    });
                </script>
            </tr>
            @endforeach
            <tr>
                <td style="vertical-align: middle;">Total</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
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

                        <tr class="text-white">
                            <input type="hidden" id="new_t_div_actual_target_num_{{ $t_div_actual_target_1->row_num }}"
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

                                    var curr_target_val = parseInt("<?php echo $t_div_actual_target_1->t_div_actual_target_1; ?>");
var tmp_num_val = $("#tmp_num_{{ $t_div_actual_target_1->row_num }}");

var new_t_div_target_num = parseInt($("#new_t_div_target_num_{{ $t_div_actual_target_1->row_num }}").text());
var new_t_div_actual_target_num = parseInt($("#new_t_div_actual_target_num_{{ $t_div_actual_target_1->row_num }}").val());
var total_percentage =(new_t_div_actual_target_num / new_t_div_target_num) * 100;
var new_total_percent = $("#total_percent_{{ $t_div_actual_target_1->row_num }}");
var tmp_num = $("#tmp_num_{{ $t_div_actual_target_1->row_num }}").text();
new_total_percent.text(parseInt(total_percentage));


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
        new_total_percent.text(parseInt(total_percentage));
        if(parseInt(new_t_div_actual_target_num) >= parseInt(new_t_div_target_num)){
   $("#total_percent_{{ $t_div_actual_target_1->row_num }}").css('background-color','green');
} if(parseInt(new_t_div_actual_target_num) < parseInt(new_t_div_target_num)){
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

                <td>
                    <table class="w-100 text-center table table-bordered m-0">
                        <tr>
                            @foreach($total_overall_target as $t_overall_target)
                            <td id="t_overall_target">
                                {{ $t_overall_target->t_overall_target }}
                            </td>
                            @endforeach
                        </tr>
                        <tr class="text-white">
                            @foreach($total_overall_actual_target as $t_overall_actual_target)
                            <td id="t_overall_actual_target">
                                {{ $t_overall_actual_target->t_overall_actual_target }}
                            </td>
                            @endforeach
                        </tr>
                        <tr class="text-white">
                            <td id="t_overall_percent"></td>
                        </tr>
                    </table>
                    <script>
                        window.addEventListener('additionalInit', event => {
                                var t_overall_target = $("#t_overall_target").text();
                                var t_overall_actual_target = $("#t_overall_actual_target").text();
                                var t_overall_percent = $("#t_overall_percent");

                                if(parseInt(t_overall_target) > parseInt(t_overall_actual_target)){
                                    $("#t_overall_actual_target").css('background-color','red');
                                }
                                if(parseInt(t_overall_target) <= parseInt(t_overall_actual_target)){
                                    $("#t_overall_actual_target").css('background-color','green');
                                }

                                var t_percent_cal = (t_overall_actual_target / t_overall_target) * 100;
                                if(Number.isNaN(t_percent_cal)){
                                    t_overall_percent.text("");
                                }
                                t_overall_percent.text(parseInt(t_percent_cal));
                                if(parseInt(t_overall_actual_target) >= parseInt(t_overall_target)){
                                    t_overall_percent.css('background-color','green');
                                } if(parseInt(t_overall_actual_target) < parseInt(t_overall_target)){
                                    t_overall_percent.css('background-color','red');
                                }
                                t_overall_percent.append('%');
                        });
                    </script>
                </td>
                <td style="vertical-align:middle;" class="fw-bolder">-</td>
                <td style="vertical-align:middle;" class="fw-bolder">-</td>
            </tr>
        </tbody>
    </table>
    @else
    <h1 class="fw-bold text-danger fs-4">Please Assign Line First</h1>
    @endif
</div>
