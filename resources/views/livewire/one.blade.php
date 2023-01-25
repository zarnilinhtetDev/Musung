<div wire:poll.1000ms>
    <div id="body" class="d-flex flex-row kbody">

        @php $time_arr = [];
        foreach(array_reverse($time) as $t3){
        $time_arr[] = $t3->time_name;
        }
        // print_r($time_arr);

        @endphp

        @if (count($time_arr) > 0)

            <div>

                <table class="" id="live_dash_1" style="margin-left: 60px;margin-right:10px;">

                    <thead>

                        <tr>
                            <th scope="col" style="vertical-align: middle;position: relative;left:88px;top:60px;"></th>

                        </tr>
                    </thead>




                    <tbody>
                        @foreach ($getLine as $g_line)
                            @php
                                $g_line_id = $g_line->l_id;
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
                            @if ($line_id == $g_line_id)

                                <tr style="" class="tr_line_{{ $g_line_id }}">


                                    <td class="fw-bold line_name_{{ $g_line_id }} fs-4"
                                        style="vertical-align: middle;min-width: 40px;">
                                        @if ($line_id == $g_line_id)

                                        <h1 class='text-center'
                                                    style="color:rgb(40, 115, 206);position: relative;left:285px;top:-10px;width:250px;
                                                    font-size:50px;font-weight: 900;font-family: Arial, Helvetica, sans-serif;text-shadow: 2px 2px 5px #9b9ea0;">
                                                    Line-{{ $g_line_name }}</h1>

                                                    {{-- @if ($g_line_name == 'Mini')
                                                <h1 class='text-center'
                                                    style="font-weight: bold;border-style: solid;color:black;padding: 13.2px 10px 13.2px 10px;position: relative;left:99px;top:10px;font-size:58px;width:130px;
                        background:#e6f0ff;">
                                                    {{ $g_line_name }}</h1>
                                            @elseif($g_line_name != 'Mini')
                                                <h1 class='text-center'
                                                    style="font-weight: bold;border-style: solid;color:black;padding: 0 10px 0 10px;position: relative;left:99px;top:10px;font-size:80px;width:130px;
                        background:#e6f0ff;">
                                                    {{ $g_line_name }}</h1>
                                            @endif --}}

                                        @endif
                                    </td>
                    </tbody>
                </table>






                <div style='position: relative;top:102.4px;right:0px;
                margin-left:60px;height:34px;padding: 0 0 0 0;font-size:24px;max-width:120px;margin-bottom:10px;
                                text-align:center;font-size:19px;background: linear-gradient(0deg, rgb(234, 229, 229) 34%, rgb(231, 52, 73) 63%)'>
                            <h3>
                                </h3></div>
                <table class="text-center table table-bordered table-sm border-white" style="margin-left:30px;max-width:120px;position:relative;top:100.7px;left:30px;">
                    <tr>
                        <td style="height:35px;background: linear-gradient(0deg, rgb(234, 229, 229) 34%, rgb(11, 189, 88) 63%);">
                            <span style="font-size:17px;font-weight:bold;"
                            class="">
                             Target
                            </span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; <span style="font-size:17px;font-weight:bold;">:</span>
                        </td>
                    </tr>


                    <tr><td></td></tr>


                    <tr class="text-dark">
                        <td style="height:34px; background: linear-gradient(0deg, rgb(234, 229, 229)  34%, rgba(0,108,255,1) 63%);" class="">
                            <span style="font-size:17px;font-weight:bold;"
                                class="">Production</span>&nbsp;&nbsp; <span style="font-size:17px;font-weight:bold;">:</span>
                        </td>
                    </tr>
                </tr>


                <tr><td></td></tr>


                    <tr class="text-dark">
                        <td style="height:41px;" id="percent_val"
                            class="">
                            <span style="font-size:17px;font-weight:bold;" class="">
                            Percentage
                        </span>
                        &nbsp;<span style="font-size:17px;font-weight:bold;">:</span>
                        </td>
                    </tr>
                </table>



     {{-- Total percentage by msn--}}
<div>
    @foreach($target_total as $t_1_total)

<div style='position: relative;top:-90px;left:30px;
margin-left:155px;height:34px;padding: 0 0 0 0;font-size:24px;max-width:120px;margin-bottom:10px;
                text-align:center;background: linear-gradient(0deg, rgb(234, 229, 229) 34%, rgb(231, 52, 73) 63%);'>
            <h3 style="font-size: 22px;color:black;padding: 2px 0 0 0;font-family: Times New Roman;font-weigth:900;">
                Present</h3></div>

                <table class="w-100 text-center table table-bordered table-sm border-white" id="total_table" style="margin-left:105px;max-width:120px;position:relative;top:30px;left:60px;">
                    <tr>
                        <td style="height:47px;">
                        </td>
                    </tr>
                    <tr class="text-dark">
                        <td style="height:47px;" class="fw-bold td_a_total1_{{ $t_1_total->line_id }}">
                        </td>
                    </tr>
                    <tr class="text-dark">
                        <td style="height:47px;"
                            class="fw-bold td_t_percent1_{{ $t_1_total->line_id }}">
                        </td>
                    </tr>
                </table>

            @foreach ($actual_target_total as $a_total)

             @if ($g_line_id == $a_total->line_id)

             {{-- kmk --}}
             <table class="w-100 text-center table table-bordered table-sm border-white" id="total_table" style="margin-left:155px;max-width:120px;position:relative;top:-91.6px;left:30px;">
                    <tr>
                        <td style="height:35px;background: linear-gradient(0deg, rgba(234,229,229) 34%, rgb(11, 189, 88) 63%);">
                            <span style="font-size:17px;"
                            class="right_table_text1 fw-bold t_1_total_{{ $t_1_total->line_id }}">
                              {{ $a_total->total_div_target }}
                            </span>
                        </td>
                    </tr>


                    <tr><td></td></tr>


                    <tr class="text-dark">
                        <td style="height:34px;background: linear-gradient(0deg, rgb(234, 229, 229)  34%, rgba(0,108,255,1) 63%);" class="fw-bold td_a_total1_{{ $t_1_total->line_id }}">
                            <span style="font-size:17px;"
                                class="right_table_text2 a_total1_{{ $t_1_total->line_id }}">{{ $a_total->total_actual_target }}</span>
                        </td>
                    </tr>
                </tr>


                <tr><td></td></tr>


                    <tr class="text-dark">
                        <td style="height:41px;"
                            class="fw-bold td_t_percent1_{{ $t_1_total->line_id }}">
                            <span style="font-size:20px;" class="right_table_text3 t_percent1_{{ $t_1_total->line_id }}"></span>

                            <span id="present_third_value" style="display: none"></span>
                        </td>
                    </tr>
                </table>

                    <script>
                        window.addEventListener('additionalInit10', event => {
                            var t = document.getElementById("total_table");
                            t.style.display = "none";

                            var t_1_total = parseInt($('.t_1_total_{{ $t_1_total->line_id }}').text().replace(/,/g, ''));
                            var a_total = parseInt($('.a_total1_{{ $t_1_total->line_id }}').text().replace(/,/g, ''));
                            var t_percent_span = $('.t_percent1_{{ $t_1_total->line_id }}');
                            var td_t_percent = $('.td_a_total1_{{ $t_1_total->line_id }}');
                            var td_a_percent = $('.td_t_percent1_{{ $t_1_total->line_id }}');
                            var g_line = $('.line_name_{{ $t_1_total->line_id }}');
                            var tr_line = $(".tr_line_{{ $t_1_total->line_id }}");
                            var item_name = $(".item_name_{{ $t_1_total->line_id }}");
                            var g_main_target = $("#g_main_target_{{ $t_1_total->line_id }}");
                            var line_column = $(".line_column_{{ $t_1_total->line_id }}");
                            var percent_name = $("#percent_val");


                            var present_third_value = $("#present_third_value");



                            if (Number.isNaN(t_1_total)) {
                                t_percent_span.text("");
                            }
                            if (!Number.isNaN(t_1_total)) {
                                var t_percent = (a_total / t_1_total) * 100;
                                if (Number.isNaN(t_percent)) {
                                    t_percent_span.text("");
                                }
                                if (!Number.isNaN(t_percent)) {
                                    t_percent_span.text(parseInt(t_percent));


                                    if (parseInt(t_percent_span.text()) <= 80) {


                                        td_t_percent.css('color', 'black');
                                        td_a_percent.css('color', 'black');

                                        // td_t_percent.css('background-color','rgba(255,0,0,0.8)');
                                        td_a_percent.css('background', 'linear-gradient(0deg, rgb(234, 229, 229) 34%, rgb(231, 52, 73) 63%)');
                                        percent_name.css('background', 'linear-gradient(0deg, rgb(234, 229, 229) 34%, rgb(231, 52, 73) 63%)');

                                        line_column.addClass('bounce');
                                        line_column.css('background-color', '#FF0000');

                                        present_third_value.text("red");
                                    }
                                    if (parseInt(t_percent_span.text()) > 80) {
                                        td_t_percent.css('color', 'black');
                                        td_a_percent.css('color', 'black');

                                        // td_t_percent.css({'background-color':'#FF8000','color':'#fff'});
                                        td_a_percent.css({'background': 'linear-gradient(0deg, rgba(234, 229, 229) 34%, rgba(255,128,0,1) 63%)',});
                                        percent_name.css('background', 'linear-gradient(0deg, rgba(234, 229, 229) 34%, rgba(255,128,0,1) 63%)');

                                        line_column.addClass('bounce');
                                        line_column.css('background-color', '#FF8000');

                                        present_third_value.text("orange");
                                    }
                                    if (parseInt(t_percent_span.text()) >= 100) {
                                        td_t_percent.css('color', 'black');
                                        td_a_percent.css('color', 'black');

                                        // td_t_percent.css({'background-color':'rgba(30,113,0,1)','color':'#fff'});
                                        td_a_percent.css({'background': 'linear-gradient(0deg, rgba(234,229,229) 34%, rgb(11, 189, 88) 63%)',});
                                        percent_name.css('background', 'linear-gradient(0deg, rgba(234,229,229) 34%, rgb(11, 189, 88) 63%)');

                                        line_column.addClass('bounce');
                                        line_column.css('background-color', 'rgba(30,113,0,1)');

                                        present_third_value.text("green");
                                    }

                                    t_percent_span.append('%');

                                }
                            }
                        });
                    </script>

              @endif
            @endforeach
            @break
        @endforeach
</div>
@endif
@endforeach
    <tr>



        @php $new_num_1 = 1; @endphp
        @foreach ($total_div_target as $t_div_target)
            @php
                $total_time_name = $t_div_target->time_name;
                $new_num = 0;
            @endphp



            @php
                $one_time = explode(':', $t_div_target->time_name);
                $one_time = (int) $one_time[0];
                $one_time_line = (int) date('H');
                $static_hour = (int) date('H');

                $static_hour2 = date('h.i');
                $static_hour2 = (float) $static_hour2;

            @endphp



            @if ($one_time === $static_hour || $one_time > (int) date('H') || $one_time < 8)
                <td class="confuse3" id="{{ $t_div_target->time_name }}">
                    {{-- ************************ <table
                                            class="w-100 text-center table table-bordered m-0" border="1">
                                            <tr>
                                                <td><span id="new_t_div_target_num_{{ $t_div_target->row_num_1 }}">{{
                                                        number_format($t_div_target->t_div_target) }}</span></td>
                                            </tr> --}}

                    @foreach ($total_div_actual_target as $t_div_actual_target_1)
                        @php
                            $two_time = explode(':', $t_div_actual_target_1->time_name);
                            $two_time = $two_time[0];
                            $two_time_now = (int) date('H');
                        @endphp




                        <script>
                            window.addEventListener('additionalInit10', event => {
                                var curr_target_num_val = $("#new_t_div_actual_target_num_{{ $new_num_1 }}");
                                var curr_target_val = parseInt("<?php echo $t_div_actual_target_1->t_div_actual_target_1; ?>");

                                var tmp_num_val = $("#tmp_num_{{ $new_num_1 }}");
                                var new_t_div_target_num = parseInt($("#new_t_div_target_num_{{ $new_num_1 }}").text());
                                var new_t_div_target_num_disable = $("#new_t_div_target_num_{{ $new_num_1 }}");
                                var new_t_per_acc_num = parseInt($("#new_t_per_acc_num_{{ $new_num_1 }}").val());
                                var new_t_div_actual_target_num = parseInt($("#new_t_div_actual_target_num_{{ $new_num_1 }}")
                            .val());
                                var total_percentage = (tmp_num_val.text() / new_t_div_target_num) * 100;
                                var new_total_percent = $("#total_percent_{{ $new_num_1 }}");
                                var tmp_num = $("#tmp_num_{{ $new_num_1 }}").text();
                                // console.log(new_t_div_target_num);

                                if (!tmp_num) {
                                    new_t_div_target_num_disable.text('');
                                }

                                new_total_percent.text(parseInt(total_percentage));

                                if (!Number.isNaN(total_percentage)) {
                                    new_total_percent.text(parseFloat(total_percentage).toFixed(0));


                                    if (parseInt(total_percentage) <= 80) {
                                        $("#total_percent_{{ $new_num_1 }}").css('color', 'black');
                                        $("#td_tmp_num_{{ $new_num_1 }}").css('color', 'black');


                                    }
                                    if (parseInt(total_percentage) > 80) {
                                        $("#total_percent_{{ $new_num_1 }}").css('color', 'black');
                                        $("#td_tmp_num_{{ $new_num_1 }}").css('color', 'black');


                                    }
                                    if (parseInt(total_percentage) >= 100) {
                                        $("#total_percent_{{ $new_num_1 }}").css('color', 'black');
                                        $("#td_tmp_num_{{ $new_num_1 }}").css('color', 'black');

                                    }

                                    new_total_percent.append('%');
                                }


                                if (Number.isNaN(total_percentage) || total_percentage == 0) {
                                    new_total_percent.text("");
                                }


                                // remote old line for displaying one line
                                var magic = document.getElementById("td_tmp_num_{{ $new_num_1 }}");



                                var two_time = "<?php echo $two_time; ?>";
                                var two_time_line = "<?php echo $two_time_now; ?>";

                                if (two_time == two_time_line) {
                                    magic.style.display = "display";

                                    if (Number.isNaN(total_percentage) || total_percentage == 0) {
                                        magic.style.display = "none";
                                    }
                                } else {
                                    if (Number.isNaN(total_percentage) || total_percentage == 0) {
                                        magic.style.display = "none";
                                    }
                                }


                            });
                        </script>

                        @php $new_num_1++; @endphp
                    @endforeach
                @break
        @endif
    @endforeach



    <script>
        window.addEventListener('additionalInit10', event => {
            var t_overall_target = parseInt($("#t_overall_target").text().replace(/,/g, ''));
            var t_overall_actual_target = parseInt($("#t_overall_actual_target").text().replace(/,/g, ''));
            var t_overall_percent = $("#t_overall_percent");

            if (parseInt(t_overall_target) > parseInt(t_overall_actual_target)) {
                $("#t_overall_actual_target").css('background-color', 'red');
            }
            if (parseInt(t_overall_target) <= parseInt(t_overall_actual_target)) {
                $("#t_overall_actual_target").css('background-color', 'green');
            }

            var t_percent_cal = (t_overall_actual_target / t_overall_target) * 100;


            if (Number.isNaN(t_percent_cal)) {
                t_overall_percent.text("");
            }
            if (!Number.isNaN(t_percent_cal)) {
                t_overall_percent.text(parseInt(t_percent_cal));

                if (parseInt(t_overall_actual_target) >= parseInt(t_overall_target)) {
                    t_overall_percent.css('background-color', 'green');
                }
                if (parseInt(t_overall_actual_target) < parseInt(t_overall_target)) {
                    t_overall_percent.css('background-color', 'red');
                }
                t_overall_percent.append('%');
            }

        });
    </script>

</div>




<table class="text-center" id="live_dash_1" style="margin-left:170px;">

<thead>

    <tr>

    </tr>
</thead>
<tbody>
    @foreach ($getLine as $g_line)
        @php
            $g_line_id = $g_line->l_id;
            $g_line_name = $g_line->l_name;
            $g_main_target = $g_line->main_target;
            $g_ot_main_target = $g_line->ot_main_target;
            $g_m_power = $g_line->m_power;
            $g_actual_m_power = $g_line->actual_m_power;
            $g_hp = $g_line->hp;
            $g_actual_hp = $g_line->actual_hp;

        @endphp

        @if ($line_id == $g_line_id)
            {{-- need to remove this --}}


{{-- Update Ranking by msn --}}
<table class="m-auto text-start text-center"
style="width: 100px;position: relative;right:40px;top:-30px;" id="ranking_table">
<tbody>
    <tr>
        <td style="vertical-align: middle;">
            {{-- <td style="vertical-align: middle;" class="t_line_{{ $t_line->row_num }} t_line_count fw-bold"> ******************************** --}}
            <h3 style="font-size: 40px;font-weight: bold;">Rank
            </h3>
        </td>
    </tr>
    <tr>
        <td style="font-size:10px;vertical-align: middle;min-width:220px;height:120px;"
          class="t_line t_line_count">
          <span>
            <h3 class="text-white" style="font-size: 50px;font-weight: bold;">
            </h3>
          </span>
        </td>
    </tr>
</tbody>
</table>

            @foreach ($top_line as $t_line)
              @if ($g_line_id == $t_line->l_id)
                    <div class="m-auto text-start text-center"
                        style="position: relative;right:425px;top:-160px;" id="ranking_table">
                        <div>
                            <div>
                                <div style="vertical-align: middle;">
                                    {{-- <div style="vertical-align: middle;" class="t_line_{{ $t_line->row_num }} t_line_count fw-bold"> ******************************** --}}
                                    <h3 style="font-size: 35px;font-weight: 900;color:#000;font-family: Arial, Helvetica, sans-serif;
                                    border-bottom: 1px solid #86630b;width: 810px;">Rank
                                        {{ $t_line->row_num }}
                                    </h3>

                                </div>
                            </div>
                        </div>
                    </div>


                <div style="font-size:10px;vertical-align: middle;min-width:210px;height:100px;position:relative;right:760px;top:120px;padding: 15px 0 0 0;
                border-radius:10px;border-style: solid;border-color: #86630b;"
                            class="t_line_{{ $t_line->row_num }} t_line_count">
                            <span class="input_row_num_{{ $t_line->row_num }} input_row_num"
                                style="display:none;">
                                <h3>{{ $t_line->row_num }}</h3>
                            </span>
                            <span>
                                <h3 class="text-dark" style="font-size: 50px;font-weight: bold;">
                                    {{ $t_line->diff_target_percent }}%
                                </h3>
                            </span>
                        </div>

<script>
    window.addEventListener('additionalInit10', event => {
        var r = document.getElementById("ranking_table");
        r.style.display = "none";

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

        if (top_1 != '') {
            $('.t_line_' + top_1).css({
                'background': 'linear-gradient(0deg, rgb(234, 229, 229) 0%, rgba(113, 206, 13, 0.872) 100%)',
                'color': '#000'
            });
        }
        if (top_2 != '') {
            $('.t_line_' + top_2).css({
                'background-color': 'linear-gradient(0deg, rgb(234, 229, 229) 0%, rgba(113, 206, 13, 0.872) 100%)',
                'color': '#000'
            });
        }
        if (top_3 != '') {
            $('.t_line_' + top_3).css({
                'background-color': 'linear-gradient(0deg, rgb(234, 229, 229) 0%, rgba(113, 206, 13, 0.872) 100%)',
                'color': '#000'
            });
        }


        $(".t_line_" + 10).css({
            'background': 'linear-gradient(0deg, rgb(234, 229, 229) 0%, rgb(231, 52, 73) 100%)',
            'color': '#000'
        });
    });
</script>
@endif
@endforeach
</tr>




{{-- ******************************** NEWENEWNEWNENNWNEW ******************************** --}}

<tr class="tr_line_{{ $g_line_id }}">


@foreach ($target_total as $t_2_total)
    @if ($g_line_id == $t_2_total->line_id)
        <td colspan="0" style="display: none;">
            <table class="m-auto text-start table table-bordered">
                <tbody>
                    @foreach ($p_detail_3 as $p_3)
                        @if ($p_3->l_id == $g_line_id)
                            <tr>
                                {{-- <tr style="border-bottom: 1px #000">******************************** --}}
                                <td class="item_name_{{ $g_line_id }}" colspan="0"
                                    style="display: none;">
                                    <div style="text-overflow:ellipsis;width:0px !important; opacity:0;">
                                        {{ $p_3->p_name }}</div>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </td>





 {{-- Total target percentage start by msn--}}
        <td>
            <table
            class="w-100 text-center table m-0 totalTable table-bordered table-sm border-white right_table">

                <h3 class="rank_heading" style="font-size: 22px;color:black;padding: 2px 0 0 0;font-family: Times New Roman;font-weigth:900;">
                    Daily</h3>
@if(isset($actual_target_total))

{{-- kmk --}}
<tr id="tcurrent1">
    <td style="height: 47px;" >
    </td>
</tr>
<tr class="text-dark" id="tcurrent2">
    <td style="height:47px;" class="fw-bold td_a_total_{{ $t_2_total->line_id }}">
    </td>
</tr>
<tr class="text-dark" id="tcurrent3">
    <td style="height:47px;min-width:120px;"
        class="fw-bold td_t_percent_{{ $t_2_total->line_id }} ">
    </td>
</tr>


                @foreach ($actual_target_total as $a_total)
                    @if ($g_line_id == $a_total->line_id)
                        <tr>
                            <td style="height: 12px;background: linear-gradient(0deg, rgb(234, 229, 229) 34%, rgb(11, 189, 88) 63%);"><span
                                    class="right_table_text1 fw-bold t_2_total_{{ $t_2_total->line_id }}">
                                    @if($g_ot_main_target
                                    !=
                                    '') {{ number_format($g_main_target + $g_ot_main_target) }}
                                    @else {{ number_format($g_main_target) }}
                                    @endif
                                </span>
                            </td>
                        </tr>


                <tr><td></td></tr>


                        <tr class="text-dark">
                            <td style="height:2px;background:linear-gradient(0deg, rgb(234, 229, 229)  34%, rgba(0,108,255,1) 63%);" class="fw-bold td_a_total_{{ $t_2_total->line_id }}">
                                <span
                                    class="right_table_text2 a_total_{{ $t_2_total->line_id }}">{{ $a_total->total_actual_target }}</span>
                            </td>
                        </tr>


                        <tr><td></td></tr>


                        <tr class="text-dark">
                            <td style="height:2px;min-width:120px;"
                                class="fw-bold td_t_percent_{{ $t_2_total->line_id }}">
                                <span class="right_table_text3 t_percent_{{ $t_2_total->line_id }}"></span>
                            </td>
                        </tr>
                        <script>
                            window.addEventListener('additionalInit10', event => {

                                var t1 = document.getElementById("tcurrent1");
                                var t2 = document.getElementById("tcurrent2");
                                var t3 = document.getElementById("tcurrent3");
                                t1.style.display = "none";
                                t2.style.display = "none";
                                t3.style.display = "none";

                                var t_2_total = parseInt($('.t_2_total_{{ $t_2_total->line_id }}').text().replace(/,/g, ''));
                                var a_total = parseInt($('.a_total_{{ $t_2_total->line_id }}').text().replace(/,/g, ''));
                                var t_percent_span = $('.t_percent_{{ $t_2_total->line_id }}');
                                var td_t_percent = $('.td_a_total_{{ $t_2_total->line_id }}');
                                var td_a_percent = $('.td_t_percent_{{ $t_2_total->line_id }}');
                                var g_line = $('.line_name_{{ $t_2_total->line_id }}');
                                var tr_line = $(".tr_line_{{ $t_2_total->line_id }}");
                                var item_name = $(".item_name_{{ $t_2_total->line_id }}");
                                var g_main_target = $("#g_main_target_{{ $t_2_total->line_id }}");
                                var line_column = $(".line_column_{{ $t_2_total->line_id }}");

                                var present_third_value = $("#present_third_value");
                                var present_third_value_color = present_third_value.text();



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

                                        if (present_third_value_color == "red") {
                                            td_t_percent.css('color', 'black');
                                            td_a_percent.css('color', 'black');

                                            // td_t_percent.css('background-color','rgba(255,0,0,0.8)');
                                            td_a_percent.css('background', 'linear-gradient(0deg, rgb(234, 229, 229) 34%, rgb(231, 52, 73) 63%)');
                                            line_column.addClass('bounce');
                                            line_column.css('background-color', 'red');
                                        }

                                        if (present_third_value_color == "orange") {
                                            td_t_percent.css('color', 'black');
                                            td_a_percent.css('color', 'black');

                                            // td_t_percent.css({'background-color':'#FF8000','color':'#fff'});
                                            td_a_percent.css({'background': 'linear-gradient(0deg, rgba(234, 229, 229) 34%, rgba(255,128,0,1) 63%)',});
                                            line_column.addClass('bounce');
                                            line_column.css('background-color', '#FF8000');
                                        }

                                        if (present_third_value_color == "green") {
                                            td_t_percent.css('color', 'black');
                                            td_a_percent.css('color', 'black');

                                            // td_t_percent.css({'background-color':'rgba(30,113,0,1)','color':'#fff'});
                                            td_a_percent.css({'background': 'linear-gradient(0deg, rgba(234,229,229) 34%, rgb(11, 189, 88) 63%)',});
                                            line_column.addClass('bounce');
                                            line_column.css('background-color', 'rgba(30,113,0,1)');
                                        }

                                        // if (parseInt(t_percent_span.text()) <= 80) {
                                        //     td_t_percent.css('color', 'black');
                                        //     td_a_percent.css('color', 'black');

                                        //     // td_t_percent.css('background-color','rgba(255,0,0,0.8)');
                                        //     td_a_percent.css('background', 'linear-gradient(0deg, rgb(234, 229, 229) 34%, rgb(231, 52, 73) 63%)');
                                        //     line_column.addClass('bounce');
                                        //     line_column.css('background-color', 'red');
                                        // }
                                        // if (parseInt(t_percent_span.text()) > 80) {
                                        //     td_t_percent.css('color', 'black');
                                        //     td_a_percent.css('color', 'black');

                                        //     // td_t_percent.css({'background-color':'#FF8000','color':'#fff'});
                                        //     td_a_percent.css({
                                        //         'background-color': '#FF8000',
                                        //     });
                                        //     line_column.addClass('bounce');
                                        //     line_column.css('background-color', '#FF8000');
                                        // }
                                        // if (parseInt(t_percent_span.text()) >= 100) {
                                        //     td_t_percent.css('color', 'black');
                                        //     td_a_percent.css('color', 'black');

                                        //     // td_t_percent.css({'background-color':'rgba(30,113,0,1)','color':'#fff'});
                                        //     td_a_percent.css({
                                        //         'background-color': 'rgba(30,113,0,1)',
                                        //     });
                                        //     line_column.addClass('bounce');
                                        //     line_column.css('background-color', 'rgba(30,113,0,1)');
                                        // }

                                        t_percent_span.append('%');
                                    }
                                }
                            });
                        </script>

                    @endif
                @endforeach
                @endif
            </table>
        </td>
         {{-- Total target percentage end --}}
    @endif
@endforeach
@endif
@endforeach

<script>
    window.addEventListener('additionalInit10', event => {
        var t_overall_target_2 = parseInt($("#t_overall_target_2").text().replace(/,/g, ''));
        var t_overall_actual_target_2 = parseInt($("#t_overall_actual_target_2").text().replace(/,/g, ''));
        var t_overall_percent_2 = $("#t_overall_percent_2");
        // console.log(t_overall_actual_target_2);

        var t_percent_cal_2 = (t_overall_actual_target_2 / t_overall_target_2) * 100;
        // console.log(t_percent_cal_2);

        if (Number.isNaN(t_percent_cal_2)) {
            t_overall_percent_2.text("");
        }
        if (!Number.isNaN(t_percent_cal_2)) {
            t_overall_percent_2.text(parseFloat(t_percent_cal_2).toFixed(0));


            t_overall_percent_2.append('%');
        }

    });
</script>

</tbody>
</table>
@else
<h1 class="fw-bold text-danger fs-4">Please Assign Line First</h1>
@endif

</div>



<div></div>


@foreach ($getLine as $g_line)
@php
    $g_line_id = $g_line->l_id;
    $g_line_name = $g_line->l_name;
    $g_main_target = $g_line->main_target;
    $g_ot_main_target = $g_line->ot_main_target;
    $g_m_power = $g_line->m_power;
    $g_actual_m_power = $g_line->actual_m_power;
    $g_hp = $g_line->hp;
    $g_actual_hp = $g_line->actual_hp;

@endphp


{{-- Line by msn --}}
@if ($line_id == $g_line_id)
@foreach ($top_line as $t_line)
    @if ($g_line_id == $t_line->l_id)
        @php

            if ($t_line->row_num == 1) {
                foreach ($top_line as $t_line2) {
                    if ($t_line2->row_num == 2 || $t_line2->row_num == 3 || $t_line2->row_num == 4) {
                        foreach ($getLine as $g_line) {
                            if ($t_line2->l_id == $g_line->l_id) {
                                $magic = $g_line->l_name;
                                break;
                            }
                        }

                        echo "
            <div class='bottom_rank' style='padding: 3px 0 0 0;display: flex;margin:auto;width:340px;position: relative;top:-215px;margin-left:435px;height:28px;
            background:linear-gradient(0deg, rgb(234, 229, 229) 0%, rgba(113, 206, 13, 0.872) 100%);'>" .
                            "<div style='display: flex;min-width:230px;margin-right:60px;'>" .

                                "<h3 style='font-weight: bold;font-size:17px;margin-left:8px;'>Rank</h3>           &nbsp;&nbsp;
                <h3 style='margin-right: :0px;font-weight: bold;min-width:50px;font-size:17px;'>" .
                            $t_line2->row_num .
                            '</h3>'.


                "
                <h3 style='font-weight: bold;font-size:17px;margin-left:45px;'>Line -</h3>           &nbsp;
                <h3 style='font-weight: bold;font-size:17px;'>" .
                            $magic .
                            "</h3>
                    </div>" .

                            "<div style='display:flex;position: relative;top:1px;padding:0 0 0 0;min-width:28px;height:20px;background:#ff0000;text-align: center;'>
                                <p style='font-size:17px;position: relative;bottom:3px;'
                    class='text-dark'>" .
                            $t_line2->diff_target_percent .
                            '%' .
                            "</p></div>" .

                            "<div style='display: flex;background:linear-gradient(0deg, rgb(199, 195, 195) 0%, rgba(131, 132, 131, 0.872) 100%);
                                    min-width:65px;margin-left:30px;padding: 0 0 0 10px;
                                    position: relative;bottom:2px;
                                    '><h3 style='font-size:17px;color:black;font-weight:900;padding: 3px 0 0 0;'>" . $t_line->diff_target_percent-$t_line2->diff_target_percent
                                . "%" .
                                "</h3> &nbsp;" .

                            "<h3><i class='bi bi-arrow-down' style='color:red;font-weight:900;font-size:17px;position:relative;bottom:5px;'></i></h3></div>" .

                "</div><br>
                    ";
                 }
                }
            } elseif ($t_line->row_num == 2) {
                foreach ($top_line as $t_line2) {
                    if ($t_line2->row_num == 1) {
                        foreach ($getLine as $g_line) {
                            if ($t_line2->l_id == $g_line->l_id) {
                                $magic = $g_line->l_name;
                                break;
                            }
                        }

                        echo "
            <div class='bottom_rank' style='padding: 3px 0 0 0;display: flex;margin:auto;width:340px;position: relative;top:-215px;margin-left:435px;height:28px;
            background:linear-gradient(0deg, rgb(234, 229, 229) 0%, rgba(113, 206, 13, 0.872) 100%);'>" .
                            "<div style='display: flex;min-width:230px;margin-right:60px;'>" .

                                "<h3 style='font-weight: bold;font-size:17px;margin-left:8px;'>Rank</h3>           &nbsp;&nbsp;
                <h3 style='margin-right: :0px;font-weight: bold;min-width:50px;font-size:17px;'>" .
                            $t_line2->row_num .
                            '</h3>'.


                "
                <h3 style='font-weight: bold;font-size:17px;margin-left:45px;'>Line -</h3>           &nbsp;
                <h3 style='font-weight: bold;font-size:17px;'>" .
                            $magic .
                            "</h3>
                    </div>" .

                            "<div style='display:flex;position: relative;top:1px;padding:0 0 0 0;min-width:28px;height:20px;background:#09ff00;text-align: center;'>
                                <p style='font-size:17px;position: relative;bottom:3px;'
                    class='text-dark'>" .
                            $t_line2->diff_target_percent .
                            '%' .
                            "</p></div>" .

                            "<div style='display: flex;background:linear-gradient(0deg, rgb(199, 195, 195) 0%, rgba(131, 132, 131, 0.872) 100%);
                                    min-width:65px;margin-left:30px;padding: 0 0 0 10px;
                                    position: relative;bottom:2px;
                                    '><h3 style='font-size:17px;color:black;font-weight:900;padding: 3px 0 0 0;'>" . $t_line2->diff_target_percent-$t_line->diff_target_percent
                                . "%" .
                                "</h3> &nbsp;" .

                            "<h3><i class='bi bi-arrow-up' style='color:#09ff00;font-weight:900;font-size:17px;position:relative;bottom:5px;'></i></h3></div>" .

                "</div><br>
                    ";
                    }
                    if ($t_line2->row_num == 3 || $t_line2->row_num == 4) {
                        foreach ($getLine as $g_line) {
                            if ($t_line2->l_id == $g_line->l_id) {
                                $magic = $g_line->l_name;
                                break;
                            }
                        }

                        echo "
            <div class='bottom_rank' style='padding: 3px 0 0 0;display: flex;margin:auto;width:340px;position: relative;top:-215px;margin-left:435px;height:28px;
            background:linear-gradient(0deg, rgb(234, 229, 229) 0%, rgba(113, 206, 13, 0.872) 100%);'>" .
                            "<div style='display: flex;min-width:230px;margin-right:60px;'>" .

                                "<h3 style='font-weight: bold;font-size:17px;margin-left:8px;'>Rank</h3>           &nbsp;&nbsp;
                <h3 style='margin-right: :0px;font-weight: bold;min-width:50px;font-size:17px;'>" .
                            $t_line2->row_num .
                            '</h3>'.


                "
                <h3 style='font-weight: bold;font-size:17px;margin-left:45px;'>Line -</h3>           &nbsp;
                <h3 style='font-weight: bold;font-size:17px;'>" .
                            $magic .
                            "</h3>
                    </div>" .

                            "<div style='display:flex;position: relative;top:1px;padding:0 0 0 0;min-width:28px;height:20px;background:#ff0000;text-align: center;'>
                                <p style='font-size:17px;position: relative;bottom:3px;'
                    class='text-dark'>" .
                            $t_line2->diff_target_percent .
                            '%' .
                            "</p></div>" .

                            "<div style='display: flex;background:linear-gradient(0deg, rgb(199, 195, 195) 0%, rgba(131, 132, 131, 0.872) 100%);
                                    min-width:65px;margin-left:30px;padding: 0 0 0 10px;
                                    position: relative;bottom:2px;
                                    '><h3 style='font-size:17px;color:black;font-weight:900;padding: 3px 0 0 0;'>" . $t_line->diff_target_percent-$t_line2->diff_target_percent
                                . "%" .
                                "</h3> &nbsp;" .

                            "<h3><i class='bi bi-arrow-down' style='color:red;font-weight:900;font-size:17px;position:relative;bottom:5px;'></i></h3></div>" .

                "</div><br>
                    ";
                    }
                }
            } elseif ($t_line->row_num == 3) {
                foreach ($top_line as $t_line2) {
                    if ($t_line2->row_num == 1 || $t_line2->row_num == 2) {
                        foreach ($getLine as $g_line) {
                            if ($t_line2->l_id == $g_line->l_id) {
                                $magic = $g_line->l_name;
                                break;
                            }
                        }

                        echo "
            <div class='bottom_rank' style='padding: 3px 0 0 0;display: flex;margin:auto;width:340px;position: relative;top:-215px;margin-left:435px;height:28px;
            background:linear-gradient(0deg, rgb(234, 229, 229) 0%, rgba(113, 206, 13, 0.872) 100%);'>" .
                            "<div style='display: flex;min-width:230px;margin-right:60px;'>" .

                                "<h3 style='font-weight: bold;font-size:17px;margin-left:8px;'>Rank</h3>           &nbsp;&nbsp;
                <h3 style='margin-right: :0px;font-weight: bold;min-width:50px;font-size:17px;'>" .
                            $t_line2->row_num .
                            '</h3>'.


                "
                <h3 style='font-weight: bold;font-size:17px;margin-left:45px;'>Line -</h3>           &nbsp;
                <h3 style='font-weight: bold;font-size:17px;'>" .
                            $magic .
                            "</h3>
                    </div>" .

                            "<div style='display:flex;position: relative;top:1px;padding:0 0 0 0;min-width:28px;height:20px;background:#09ff00;text-align: center;'>
                                <p style='font-size:17px;position: relative;bottom:3px;'
                    class='text-dark'>" .
                            $t_line2->diff_target_percent .
                            '%' .
                            "</p></div>" .

                            "<div style='display: flex;background:linear-gradient(0deg, rgb(199, 195, 195) 0%, rgba(131, 132, 131, 0.872) 100%);
                                    min-width:65px;margin-left:30px;padding: 0 0 0 10px;
                                    position: relative;bottom:2px;
                                    '><h3 style='font-size:17px;color:black;font-weight:900;padding: 3px 0 0 0;'>" . $t_line2->diff_target_percent-$t_line->diff_target_percent
                                . "%" .
                                "</h3> &nbsp;" .

                            "<h3><i class='bi bi-arrow-up' style='color:#09ff00;font-weight:900;font-size:17px;position:relative;bottom:5px;'></i></h3></div>" .

                "</div><br>
                    ";
                    }
                    if ($t_line2->row_num == 4) {
                        foreach ($getLine as $g_line) {
                            if ($t_line2->l_id == $g_line->l_id) {
                                $magic = $g_line->l_name;
                                break;
                            }
                        }

                        echo "
            <div class='bottom_rank' style='padding: 3px 0 0 0;display: flex;margin:auto;width:340px;position: relative;top:-215px;margin-left:435px;height:28px;
            background:linear-gradient(0deg, rgb(234, 229, 229) 0%, rgba(113, 206, 13, 0.872) 100%);'>" .
                            "<div style='display: flex;min-width:230px;margin-right:60px;'>" .

                                "<h3 style='font-weight: bold;font-size:17px;margin-left:8px;'>Rank</h3>           &nbsp;&nbsp;
                <h3 style='margin-right: :0px;font-weight: bold;min-width:50px;font-size:17px;'>" .
                            $t_line2->row_num .
                            '</h3>'.


                "
                <h3 style='font-weight: bold;font-size:17px;margin-left:45px;'>Line -</h3>           &nbsp;
                <h3 style='font-weight: bold;font-size:17px;'>" .
                            $magic .
                            "</h3>
                    </div>" .

                            "<div style='display:flex;position: relative;top:1px;padding:0 0 0 0;min-width:28px;height:20px;background:#ff0000;text-align: center;'>
                                <p style='font-size:17px;position: relative;bottom:3px;'
                    class='text-dark'>" .
                            $t_line2->diff_target_percent .
                            '%' .
                            "</p></div>" .

                            "<div style='display: flex;background:linear-gradient(0deg, rgb(199, 195, 195) 0%, rgba(131, 132, 131, 0.872) 100%);
                                    min-width:65px;margin-left:30px;padding: 0 0 0 10px;
                                    position: relative;bottom:2px;
                                    '><h3 style='font-size:17px;color:black;font-weight:900;padding: 3px 0 0 0;'>" . $t_line->diff_target_percent-$t_line2->diff_target_percent
                                . "%" .
                                "</h3> &nbsp;" .

                            "<h3><i class='bi bi-arrow-down' style='color:red;font-weight:900;font-size:17px;position:relative;bottom:5px;'></i></h3></div>" .

                "</div><br>
                    ";
                    }
                }
            } elseif ($t_line->row_num == 4) {
                foreach ($top_line as $t_line2) {
                    if ($t_line2->row_num == 2 || $t_line2->row_num == 3) {
                        foreach ($getLine as $g_line) {
                            if ($t_line2->l_id == $g_line->l_id) {
                                $magic = $g_line->l_name;
                                break;
                            }
                        }

                        echo "
            <div class='bottom_rank' style='padding: 3px 0 0 0;display: flex;margin:auto;width:340px;position: relative;top:-215px;margin-left:435px;height:28px;
            background:linear-gradient(0deg, rgb(234, 229, 229) 0%, rgba(113, 206, 13, 0.872) 100%);'>" .
                            "<div style='display: flex;min-width:230px;margin-right:60px;'>" .

                                "<h3 style='font-weight: bold;font-size:17px;margin-left:8px;'>Rank</h3>           &nbsp;&nbsp;
                <h3 style='margin-right: :0px;font-weight: bold;min-width:50px;font-size:17px;'>" .
                            $t_line2->row_num .
                            '</h3>'.


                "
                <h3 style='font-weight: bold;font-size:17px;margin-left:45px;'>Line -</h3>           &nbsp;
                <h3 style='font-weight: bold;font-size:17px;'>" .
                            $magic .
                            "</h3>
                    </div>" .

                            "<div style='display:flex;position: relative;top:1px;padding:0 0 0 0;min-width:28px;height:20px;background:#09ff00;text-align: center;'>
                                <p style='font-size:17px;position: relative;bottom:3px;'
                    class='text-dark'>" .
                            $t_line2->diff_target_percent .
                            '%' .
                            "</p></div>" .

                            "<div style='display: flex;background:linear-gradient(0deg, rgb(199, 195, 195) 0%, rgba(131, 132, 131, 0.872) 100%);
                                    min-width:65px;margin-left:30px;padding: 0 0 0 10px;
                                    position: relative;bottom:2px;
                                    '><h3 style='font-size:17px;color:black;font-weight:900;padding: 3px 0 0 0;'>" . $t_line2->diff_target_percent-$t_line->diff_target_percent
                                . "%" .
                                "</h3> &nbsp;" .

                            "<h3><i class='bi bi-arrow-up' style='color:#09ff00;font-weight:900;font-size:17px;position:relative;bottom:5px;'></i></h3></div>" .

                "</div><br>
                    ";
                    }
                    if ($t_line2->row_num == 5) {
                        foreach ($getLine as $g_line) {
                            if ($t_line2->l_id == $g_line->l_id) {
                                $magic = $g_line->l_name;
                                break;
                            }
                        }

                        echo "
            <div class='bottom_rank' style='padding: 3px 0 0 0;display: flex;margin:auto;width:340px;position: relative;top:-215px;margin-left:435px;height:28px;
            background:linear-gradient(0deg, rgb(234, 229, 229) 0%, rgba(113, 206, 13, 0.872) 100%);'>" .
                            "<div style='display: flex;min-width:230px;margin-right:60px;'>" .

                                "<h3 style='font-weight: bold;font-size:17px;margin-left:8px;'>Rank</h3>           &nbsp;&nbsp;
                <h3 style='margin-right: :0px;font-weight: bold;min-width:50px;font-size:17px;'>" .
                            $t_line2->row_num .
                            '</h3>'.


                "
                <h3 style='font-weight: bold;font-size:17px;margin-left:45px;'>Line -</h3>           &nbsp;
                <h3 style='font-weight: bold;font-size:17px;'>" .
                            $magic .
                            "</h3>
                    </div>" .

                            "<div style='display:flex;position: relative;top:1px;padding:0 0 0 0;min-width:28px;height:20px;background:#ff0000;text-align: center;'>
                                <p style='font-size:17px;position: relative;bottom:3px;'
                    class='text-dark'>" .
                            $t_line2->diff_target_percent .
                            '%' .
                            "</p></div>" .

                            "<div style='display: flex;background:linear-gradient(0deg, rgb(199, 195, 195) 0%, rgba(131, 132, 131, 0.872) 100%);
                                    min-width:65px;margin-left:30px;padding: 0 0 0 10px;
                                    position: relative;bottom:2px;
                                    '><h3 style='font-size:17px;color:black;font-weight:900;padding: 3px 0 0 0;'>" . $t_line->diff_target_percent-$t_line2->diff_target_percent
                                . "%" .
                                "</h3> &nbsp;" .

                            "<h3><i class='bi bi-arrow-down' style='color:red;font-weight:900;font-size:17px;position:relative;bottom:5px;'></i></h3></div>" .

                "</div><br>
                    ";
                    }
                }
            } elseif ($t_line->row_num == 5) {
                foreach ($top_line as $t_line2) {
                    if ($t_line2->row_num == 3 || $t_line2->row_num == 4) {
                        foreach ($getLine as $g_line) {
                            if ($t_line2->l_id == $g_line->l_id) {
                                $magic = $g_line->l_name;
                                break;
                            }
                        }

                        echo "
            <div class='bottom_rank' style='padding: 3px 0 0 0;display: flex;margin:auto;width:340px;position: relative;top:-215px;margin-left:435px;height:28px;
            background:linear-gradient(0deg, rgb(234, 229, 229) 0%, rgba(113, 206, 13, 0.872) 100%);'>" .
                            "<div style='display: flex;min-width:230px;margin-right:60px;'>" .

                                "<h3 style='font-weight: bold;font-size:17px;margin-left:8px;'>Rank</h3>           &nbsp;&nbsp;
                <h3 style='margin-right: :0px;font-weight: bold;min-width:50px;font-size:17px;'>" .
                            $t_line2->row_num .
                            '</h3>'.


                "
                <h3 style='font-weight: bold;font-size:17px;margin-left:45px;'>Line -</h3>           &nbsp;
                <h3 style='font-weight: bold;font-size:17px;'>" .
                            $magic .
                            "</h3>
                    </div>" .

                            "<div style='display:flex;position: relative;top:1px;padding:0 0 0 0;min-width:28px;height:20px;background:#09ff00;text-align: center;'>
                                <p style='font-size:17px;position: relative;bottom:3px;'
                    class='text-dark'>" .
                            $t_line2->diff_target_percent .
                            '%' .
                            "</p></div>" .

                            "<div style='display: flex;background:linear-gradient(0deg, rgb(199, 195, 195) 0%, rgba(131, 132, 131, 0.872) 100%);
                                    min-width:65px;margin-left:30px;padding: 0 0 0 10px;
                                    position: relative;bottom:2px;
                                    '><h3 style='font-size:17px;color:black;font-weight:900;padding: 3px 0 0 0;'>" . $t_line2->diff_target_percent-$t_line->diff_target_percent
                                . "%" .
                                "</h3> &nbsp;" .

                            "<h3><i class='bi bi-arrow-up' style='color:#09ff00;font-weight:900;font-size:17px;position:relative;bottom:5px;'></i></h3></div>" .

                "</div><br>
                    ";
                    }
                    if ($t_line2->row_num == 6) {
                        foreach ($getLine as $g_line) {
                            if ($t_line2->l_id == $g_line->l_id) {
                                $magic = $g_line->l_name;
                                break;
                            }
                        }

                        echo "
            <div class='bottom_rank' style='padding: 3px 0 0 0;display: flex;margin:auto;width:340px;position: relative;top:-215px;margin-left:435px;height:28px;
            background:linear-gradient(0deg, rgb(234, 229, 229) 0%, rgba(113, 206, 13, 0.872) 100%);'>" .
                            "<div style='display: flex;min-width:230px;margin-right:60px;'>" .

                                "<h3 style='font-weight: bold;font-size:17px;margin-left:8px;'>Rank</h3>           &nbsp;&nbsp;
                <h3 style='margin-right: :0px;font-weight: bold;min-width:50px;font-size:17px;'>" .
                            $t_line2->row_num .
                            '</h3>'.


                "
                <h3 style='font-weight: bold;font-size:17px;margin-left:45px;'>Line -</h3>           &nbsp;
                <h3 style='font-weight: bold;font-size:17px;'>" .
                            $magic .
                            "</h3>
                    </div>" .

                            "<div style='display:flex;position: relative;top:1px;padding:0 0 0 0;min-width:28px;height:20px;background:#ff0000;text-align: center;'>
                                <p style='font-size:17px;position: relative;bottom:3px;'
                    class='text-dark'>" .
                            $t_line2->diff_target_percent .
                            '%' .
                            "</p></div>" .

                            "<div style='display: flex;background:linear-gradient(0deg, rgb(199, 195, 195) 0%, rgba(131, 132, 131, 0.872) 100%);
                                    min-width:65px;margin-left:30px;padding: 0 0 0 10px;
                                    position: relative;bottom:2px;
                                    '><h3 style='font-size:17px;color:black;font-weight:900;padding: 3px 0 0 0;'>" . $t_line->diff_target_percent-$t_line2->diff_target_percent
                                . "%" .
                                "</h3> &nbsp;" .

                            "<h3><i class='bi bi-arrow-down' style='color:red;font-weight:900;font-size:17px;position:relative;bottom:5px;'></i></h3></div>" .

                "</div><br>
                    ";
                    }
                }
            } elseif ($t_line->row_num == 6) {
                foreach ($top_line as $t_line2) {
                    if ($t_line2->row_num == 4 || $t_line2->row_num == 5) {
                        foreach ($getLine as $g_line) {
                            if ($t_line2->l_id == $g_line->l_id) {
                                $magic = $g_line->l_name;
                                break;
                            }
                        }

                        echo "
            <div class='bottom_rank' style='padding: 3px 0 0 0;display: flex;margin:auto;width:340px;position: relative;top:-215px;margin-left:435px;height:28px;
            background:linear-gradient(0deg, rgb(234, 229, 229) 0%, rgba(113, 206, 13, 0.872) 100%);'>" .
                            "<div style='display: flex;min-width:230px;margin-right:60px;'>" .

                                "<h3 style='font-weight: bold;font-size:17px;margin-left:8px;'>Rank</h3>           &nbsp;&nbsp;
                <h3 style='margin-right: :0px;font-weight: bold;min-width:50px;font-size:17px;'>" .
                            $t_line2->row_num .
                            '</h3>'.


                "
                <h3 style='font-weight: bold;font-size:17px;margin-left:45px;'>Line -</h3>           &nbsp;
                <h3 style='font-weight: bold;font-size:17px;'>" .
                            $magic .
                            "</h3>
                    </div>" .

                            "<div style='display:flex;position: relative;top:1px;padding:0 0 0 0;min-width:28px;height:20px;background:#09ff00;text-align: center;'>
                                <p style='font-size:17px;position: relative;bottom:3px;'
                    class='text-dark'>" .
                            $t_line2->diff_target_percent .
                            '%' .
                            "</p></div>" .

                            "<div style='display: flex;background:linear-gradient(0deg, rgb(199, 195, 195) 0%, rgba(131, 132, 131, 0.872) 100%);
                                    min-width:65px;margin-left:30px;padding: 0 0 0 10px;
                                    position: relative;bottom:2px;
                                    '><h3 style='font-size:17px;color:black;font-weight:900;padding: 3px 0 0 0;'>" . $t_line2->diff_target_percent-$t_line->diff_target_percent
                                . "%" .
                                "</h3> &nbsp;" .

                            "<h3><i class='bi bi-arrow-up' style='color:#09ff00;font-weight:900;font-size:17px;position:relative;bottom:5px;'></i></h3></div>" .

                "</div><br>
                    ";
                    }
                    if ($t_line2->row_num == 7) {
                        foreach ($getLine as $g_line) {
                            if ($t_line2->l_id == $g_line->l_id) {
                                $magic = $g_line->l_name;
                                break;
                            }
                        }

                        echo "
            <div class='bottom_rank' style='padding: 3px 0 0 0;display: flex;margin:auto;width:340px;position: relative;top:-215px;margin-left:435px;height:28px;
            background:linear-gradient(0deg, rgb(234, 229, 229) 0%, rgba(113, 206, 13, 0.872) 100%);'>" .
                            "<div style='display: flex;min-width:230px;margin-right:60px;'>" .

                                "<h3 style='font-weight: bold;font-size:17px;margin-left:8px;'>Rank</h3>           &nbsp;&nbsp;
                <h3 style='margin-right: :0px;font-weight: bold;min-width:50px;font-size:17px;'>" .
                            $t_line2->row_num .
                            '</h3>'.


                "
                <h3 style='font-weight: bold;font-size:17px;margin-left:45px;'>Line -</h3>           &nbsp;
                <h3 style='font-weight: bold;font-size:17px;'>" .
                            $magic .
                            "</h3>
                    </div>" .

                            "<div style='display:flex;position: relative;top:1px;padding:0 0 0 0;min-width:28px;height:20px;background:#ff0000;text-align: center;'>
                                <p style='font-size:17px;position: relative;bottom:3px;'
                    class='text-dark'>" .
                            $t_line2->diff_target_percent .
                            '%' .
                            "</p></div>" .

                            "<div style='display: flex;background:linear-gradient(0deg, rgb(199, 195, 195) 0%, rgba(131, 132, 131, 0.872) 100%);
                                    min-width:65px;margin-left:30px;padding: 0 0 0 10px;
                                    position: relative;bottom:2px;
                                    '><h3 style='font-size:17px;color:black;font-weight:900;padding: 3px 0 0 0;'>" . $t_line->diff_target_percent-$t_line2->diff_target_percent
                                . "%" .
                                "</h3> &nbsp;" .

                            "<h3><i class='bi bi-arrow-down' style='color:red;font-weight:900;font-size:17px;position:relative;bottom:5px;'></i></h3></div>" .

                "</div><br>
                    ";
                    }
                }
            } elseif ($t_line->row_num == 7) {
                $next = null;
                foreach ($top_line as $t_line2) {
                    if ($t_line2->row_num == 5 || $t_line2->row_num == 6) {
                        $next = true;
                        foreach ($getLine as $g_line) {
                            if ($t_line2->l_id == $g_line->l_id) {
                                $magic = $g_line->l_name;
                                break;
                            }
                        }

                        echo "
            <div class='bottom_rank' style='padding: 3px 0 0 0;display: flex;margin:auto;width:340px;position: relative;top:-215px;margin-left:435px;height:28px;
            background:linear-gradient(0deg, rgb(234, 229, 229) 0%, rgba(113, 206, 13, 0.872) 100%);'>" .
                            "<div style='display: flex;min-width:230px;margin-right:60px;'>" .

                                "<h3 style='font-weight: bold;font-size:17px;margin-left:8px;'>Rank</h3>           &nbsp;&nbsp;
                <h3 style='margin-right: :0px;font-weight: bold;min-width:50px;font-size:17px;'>" .
                            $t_line2->row_num .
                            '</h3>'.


                "
                <h3 style='font-weight: bold;font-size:17px;margin-left:45px;'>Line -</h3>           &nbsp;
                <h3 style='font-weight: bold;font-size:17px;'>" .
                            $magic .
                            "</h3>
                    </div>" .

                            "<div style='display:flex;position: relative;top:1px;padding:0 0 0 0;min-width:28px;height:20px;background:#09ff00;text-align: center;'>
                                <p style='font-size:17px;position: relative;bottom:3px;'
                    class='text-dark'>" .
                            $t_line2->diff_target_percent .
                            '%' .
                            "</p></div>" .

                            "<div style='display: flex;background:linear-gradient(0deg, rgb(199, 195, 195) 0%, rgba(131, 132, 131, 0.872) 100%);
                                    min-width:65px;margin-left:30px;padding: 0 0 0 10px;
                                    position: relative;bottom:2px;
                                    '><h3 style='font-size:17px;color:black;font-weight:900;padding: 3px 0 0 0;'>" . $t_line2->diff_target_percent-$t_line->diff_target_percent
                                . "%" .
                                "</h3> &nbsp;" .

                            "<h3><i class='bi bi-arrow-up' style='color:#09ff00;font-weight:900;font-size:17px;position:relative;bottom:5px;'></i></h3></div>" .

                "</div><br>
                    ";
                    }
                    if ($t_line2->row_num == 8) {
                        $next = true;
                        foreach ($getLine as $g_line) {
                            if ($t_line2->l_id == $g_line->l_id) {
                                $magic = $g_line->l_name;
                                break;
                            }
                        }

                        echo "
            <div class='bottom_rank' style='padding: 3px 0 0 0;display: flex;margin:auto;width:340px;position: relative;top:-215px;margin-left:435px;height:28px;
            background:linear-gradient(0deg, rgb(234, 229, 229) 0%, rgba(113, 206, 13, 0.872) 100%);'>" .
                            "<div style='display: flex;min-width:230px;margin-right:60px;'>" .

                                "<h3 style='font-weight: bold;font-size:17px;margin-left:8px;'>Rank</h3>           &nbsp;&nbsp;
                <h3 style='margin-right: :0px;font-weight: bold;min-width:50px;font-size:17px;'>" .
                            $t_line2->row_num .
                            '</h3>'.


                "
                <h3 style='font-weight: bold;font-size:17px;margin-left:45px;'>Line -</h3>           &nbsp;
                <h3 style='font-weight: bold;font-size:17px;'>" .
                            $magic .
                            "</h3>
                    </div>" .

                            "<div style='display:flex;position: relative;top:1px;padding:0 0 0 0;min-width:28px;height:20px;background:#ff0000;text-align: center;'>
                                <p style='font-size:17px;position: relative;bottom:3px;'
                    class='text-dark'>" .
                            $t_line2->diff_target_percent .
                            '%' .
                            "</p></div>" .

                            "<div style='display: flex;background:linear-gradient(0deg, rgb(199, 195, 195) 0%, rgba(131, 132, 131, 0.872) 100%);
                                    min-width:65px;margin-left:30px;padding: 0 0 0 10px;
                                    position: relative;bottom:2px;
                                    '><h3 style='font-size:17px;color:black;font-weight:900;padding: 3px 0 0 0;'>" . $t_line->diff_target_percent-$t_line2->diff_target_percent
                                . "%" .
                                "</h3> &nbsp;" .

                            "<h3><i class='bi bi-arrow-down' style='color:red;font-weight:900;font-size:17px;position:relative;bottom:5px;'></i></h3></div>" .

                "</div><br>
                    ";
                    }

                }
            } elseif ($t_line->row_num == 8) {
                foreach ($top_line as $t_line2) {
                    if ($t_line2->row_num == 6  || $t_line2->row_num == 7) {
                        foreach ($getLine as $g_line) {
                            if ($t_line2->l_id == $g_line->l_id) {
                                $magic = $g_line->l_name;
                                break;
                            }
                        }

                        echo "
            <div class='bottom_rank' style='padding: 3px 0 0 0;display: flex;margin:auto;width:340px;position: relative;top:-215px;margin-left:435px;height:28px;
            background:linear-gradient(0deg, rgb(234, 229, 229) 0%, rgba(113, 206, 13, 0.872) 100%);'>" .
                            "<div style='display: flex;min-width:230px;margin-right:60px;'>" .

                                "<h3 style='font-weight: bold;font-size:17px;margin-left:8px;'>Rank</h3>           &nbsp;&nbsp;
                <h3 style='margin-right: :0px;font-weight: bold;min-width:50px;font-size:17px;'>" .
                            $t_line2->row_num .
                            '</h3>'.


                "
                <h3 style='font-weight: bold;font-size:17px;margin-left:45px;'>Line -</h3>           &nbsp;
                <h3 style='font-weight: bold;font-size:17px;'>" .
                            $magic .
                            "</h3>
                    </div>" .

                            "<div style='display:flex;position: relative;top:1px;padding:0 0 0 0;min-width:28px;height:20px;background:#09ff00;text-align: center;'>
                                <p style='font-size:17px;position: relative;bottom:3px;'
                    class='text-dark'>" .
                            $t_line2->diff_target_percent .
                            '%' .
                            "</p></div>" .

                            "<div style='display: flex;background:linear-gradient(0deg, rgb(199, 195, 195) 0%, rgba(131, 132, 131, 0.872) 100%);
                                    min-width:65px;margin-left:30px;padding: 0 0 0 10px;
                                    position: relative;bottom:2px;
                                    '><h3 style='font-size:17px;color:black;font-weight:900;padding: 3px 0 0 0;'>" . $t_line2->diff_target_percent-$t_line->diff_target_percent
                                . "%" .
                                "</h3> &nbsp;" .

                            "<h3><i class='bi bi-arrow-up' style='color:#09ff00;font-weight:900;font-size:17px;position:relative;bottom:5px;'></i></h3></div>" .

                "</div><br>
                    ";
                    }
                    if ($t_line2->row_num == 9) {
                        foreach ($getLine as $g_line) {
                            if ($t_line2->l_id == $g_line->l_id) {
                                $magic = $g_line->l_name;
                                break;
                            }
                        }

                        echo "
            <div class='bottom_rank' style='padding: 3px 0 0 0;display: flex;margin:auto;width:340px;position: relative;top:-215px;margin-left:435px;height:28px;
            background:linear-gradient(0deg, rgb(234, 229, 229) 0%, rgba(113, 206, 13, 0.872) 100%);'>" .
                            "<div style='display: flex;min-width:230px;margin-right:60px;'>" .

                                "<h3 style='font-weight: bold;font-size:17px;margin-left:8px;'>Rank</h3>           &nbsp;&nbsp;
                <h3 style='margin-right: :0px;font-weight: bold;min-width:50px;font-size:17px;'>" .
                            $t_line2->row_num .
                            '</h3>'.


                "
                <h3 style='font-weight: bold;font-size:17px;margin-left:45px;'>Line -</h3>           &nbsp;
                <h3 style='font-weight: bold;font-size:17px;'>" .
                            $magic .
                            "</h3>
                    </div>" .

                            "<div style='display:flex;position: relative;top:1px;padding:0 0 0 0;min-width:28px;height:20px;background:#ff0000;text-align: center;'>
                                <p style='font-size:17px;position: relative;bottom:3px;'
                    class='text-dark'>" .
                            $t_line2->diff_target_percent .
                            '%' .
                            "</p></div>" .

                            "<div style='display: flex;background:linear-gradient(0deg, rgb(199, 195, 195) 0%, rgba(131, 132, 131, 0.872) 100%);
                                    min-width:65px;margin-left:30px;padding: 0 0 0 10px;
                                    position: relative;bottom:2px;
                                    '><h3 style='font-size:17px;color:black;font-weight:900;padding: 3px 0 0 0;'>" . $t_line->diff_target_percent-$t_line2->diff_target_percent
                                . "%" .
                                "</h3> &nbsp;" .

                            "<h3><i class='bi bi-arrow-down' style='color:red;font-weight:900;font-size:17px;position:relative;bottom:5px;'></i></h3></div>" .

                "</div><br>
                    ";
                    }
                }
            } elseif ($t_line->row_num == 9) {
                foreach ($top_line as $t_line2) {
                    if ($t_line2->row_num == 7  || $t_line2->row_num == 8) {
                        foreach ($getLine as $g_line) {
                            if ($t_line2->l_id == $g_line->l_id) {
                                $magic = $g_line->l_name;
                                break;
                            }
                        }

                        echo "
            <div class='bottom_rank' style='padding: 3px 0 0 0;display: flex;margin:auto;width:340px;position: relative;top:-215px;margin-left:435px;height:28px;
            background:linear-gradient(0deg, rgb(234, 229, 229) 0%, rgba(113, 206, 13, 0.872) 100%);'>" .
                            "<div style='display: flex;min-width:230px;margin-right:60px;'>" .

                                "<h3 style='font-weight: bold;font-size:17px;margin-left:8px;'>Rank</h3>           &nbsp;&nbsp;
                <h3 style='margin-right: :0px;font-weight: bold;min-width:50px;font-size:17px;'>" .
                            $t_line2->row_num .
                            '</h3>'.


                "
                <h3 style='font-weight: bold;font-size:17px;margin-left:45px;'>Line -</h3>           &nbsp;
                <h3 style='font-weight: bold;font-size:17px;'>" .
                            $magic .
                            "</h3>
                    </div>" .

                            "<div style='display:flex;position: relative;top:1px;padding:0 0 0 0;min-width:28px;height:20px;background:#09ff00;text-align: center;'>
                                <p style='font-size:17px;position: relative;bottom:3px;'
                    class='text-dark'>" .
                            $t_line2->diff_target_percent .
                            '%' .
                            "</p></div>" .

                            "<div style='display: flex;background:linear-gradient(0deg, rgb(199, 195, 195) 0%, rgba(131, 132, 131, 0.872) 100%);
                                    min-width:65px;margin-left:30px;padding: 0 0 0 10px;
                                    position: relative;bottom:2px;
                                    '><h3 style='font-size:17px;color:black;font-weight:900;padding: 3px 0 0 0;'>" . $t_line2->diff_target_percent-$t_line->diff_target_percent
                                . "%" .
                                "</h3> &nbsp;" .

                            "<h3><i class='bi bi-arrow-up' style='color:#09ff00;font-weight:900;font-size:17px;position:relative;bottom:5px;'></i></h3></div>" .

                "</div><br>
                    ";
                    }
                    if ($t_line2->row_num == 10) {
                        foreach ($getLine as $g_line) {
                            if ($t_line2->l_id == $g_line->l_id) {
                                $magic = $g_line->l_name;
                                break;
                            }
                        }

                        echo "
            <div class='bottom_rank' style='padding: 3px 0 0 0;display: flex;margin:auto;width:340px;position: relative;top:-215px;margin-left:435px;height:28px;
            background:linear-gradient(0deg, rgb(234, 229, 229) 0%, rgba(113, 206, 13, 0.872) 100%);'>" .
                            "<div style='display: flex;min-width:230px;margin-right:60px;'>" .

                                "<h3 style='font-weight: bold;font-size:17px;margin-left:8px;'>Rank</h3>           &nbsp;&nbsp;
                <h3 style='margin-right: :0px;font-weight: bold;min-width:50px;font-size:17px;'>" .
                            $t_line2->row_num .
                            '</h3>'.


                "
                <h3 style='font-weight: bold;font-size:17px;margin-left:45px;'>Line -</h3>           &nbsp;
                <h3 style='font-weight: bold;font-size:17px;'>" .
                            $magic .
                            "</h3>
                    </div>" .

                            "<div style='display:flex;position: relative;top:1px;padding:0 0 0 0;min-width:28px;height:20px;background:#ff0000;text-align: center;'>
                                <p style='font-size:17px;position: relative;bottom:3px;'
                    class='text-dark'>" .
                            $t_line2->diff_target_percent .
                            '%' .
                            "</p></div>" .

                            "<div style='display: flex;background:linear-gradient(0deg, rgb(199, 195, 195) 0%, rgba(131, 132, 131, 0.872) 100%);
                                    min-width:65px;margin-left:30px;padding: 0 0 0 10px;
                                    position: relative;bottom:2px;
                                    '><h3 style='font-size:17px;color:black;font-weight:900;padding: 3px 0 0 0;'>" . $t_line->diff_target_percent-$t_line2->diff_target_percent
                                . "%" .
                                "</h3> &nbsp;" .

                            "<h3><i class='bi bi-arrow-down' style='color:red;font-weight:900;font-size:17px;position:relative;bottom:5px;'></i></h3></div>" .

                "</div><br>
                    ";
                    }

                }
            } elseif ($t_line->row_num == 10) {
                foreach ($top_line as $t_line2) {
                    if ($t_line2->row_num == 8 || $t_line2->row_num == 9) {
                        foreach ($getLine as $g_line) {
                            if ($t_line2->l_id == $g_line->l_id) {
                                $magic = $g_line->l_name;
                                break;
                            }
                        }

                        echo "
            <div class='bottom_rank' style='padding: 3px 0 0 0;display: flex;margin:auto;width:340px;position: relative;top:-215px;margin-left:435px;height:28px;
            background:linear-gradient(0deg, rgb(234, 229, 229) 0%, rgba(113, 206, 13, 0.872) 100%);'>" .
                            "<div style='display: flex;min-width:230px;margin-right:60px;'>" .

                                "<h3 style='font-weight: bold;font-size:17px;margin-left:8px;'>Rank</h3>           &nbsp;&nbsp;
                <h3 style='margin-right: :0px;font-weight: bold;min-width:50px;font-size:17px;'>" .
                            $t_line2->row_num .
                            '</h3>'.


                "
                <h3 style='font-weight: bold;font-size:17px;margin-left:45px;'>Line -</h3>           &nbsp;
                <h3 style='font-weight: bold;font-size:17px;'>" .
                            $magic .
                            "</h3>
                    </div>" .

                            "<div style='display:flex;position: relative;top:1px;padding:0 0 0 0;min-width:28px;height:20px;background:#09ff00;text-align: center;'>
                                <p style='font-size:17px;position: relative;bottom:3px;'
                    class='text-dark'>" .
                            $t_line2->diff_target_percent .
                            '%' .
                            "</p></div>" .

                            "<div style='display: flex;background:linear-gradient(0deg, rgb(199, 195, 195) 0%, rgba(131, 132, 131, 0.872) 100%);
                                    min-width:65px;margin-left:30px;padding: 0 0 0 10px;
                                    position: relative;bottom:2px;
                                    '><h3 style='font-size:17px;color:black;font-weight:900;padding: 3px 0 0 0;'>" . $t_line2->diff_target_percent-$t_line->diff_target_percent
                                . "%" .
                                "</h3> &nbsp;" .

                            "<h3><i class='bi bi-arrow-up' style='color:#09ff00;font-weight:900;font-size:17px;position:relative;bottom:5px;'></i></h3></div>" .

                "</div><br>
                    ";
                    }
                }
            }

        @endphp
    @endif
@endforeach
@endif
@endforeach

</div>
