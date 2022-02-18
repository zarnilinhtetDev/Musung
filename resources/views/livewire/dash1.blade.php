<div class="col-12 col-md-8" id="live_dash_refresh" wire:poll.1000ms>
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
                    <td style="vertical-align: middle;">{{ $g_line_name }}</td>
                    <td style="vertical-align: middle;"><span id="g_main_target_{{ $g_line_id }}">{{ $g_main_target
                            }}</span></td>

                    @foreach($time_2 as $t_2)
                    @if($g_line_id==$t_2->line_id)
                    @php $current_target = $t_2->time_id;
                    $prev_target = ((int)$current_target)-1;
                    @endphp
                    <td>
                        <table class="w-100 text-center table table-bordered m-0">
                            <tr>
                                <td><span id="new_div_target_{{ $t_2->time_id }}">{{
                                        $t_2->actual_target_entry
                                        }}</span></td>
                                <td><span id="div_target_{{ $t_2->time_id }}">{{ $t_2->div_target }}</span>
                                </td>
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
                    </td>
                    @endif
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
