<div class="col-12 col-md-8" wire:poll.1000ms>
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
                            window.addEventListener('initSomething2', event => {
                            var g_main_target = $("#g_main_target_{{ $g_line_id }}").text();
                            var main_target_actual_chart = $("#main_target_actual_chart_{{ $g_line_id }}");
                            main_target_actual_chart.text(g_main_target);
                             });
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
                            window.addEventListener('initSomething2', event => {
                                var g_main_target = $("#g_main_target_{{ $g_line_id }}").text();
                            var main_target_actual_chart = $("#main_target_actual_chart_{{ $g_line_id }}");
                            main_target_actual_chart.text(g_main_target);
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
                             });
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
                            window.addEventListener('initSomething2', event => {
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
} if(parseInt(actual_target_percent_actual_chart.text()) < 100){
$("#td_actual_percent_actual_chart_{{ $g_line_id }}").css('background-color','red');
}
                            actual_target_percent_actual_chart.append('%');
                            }
                        });
                        </script>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
