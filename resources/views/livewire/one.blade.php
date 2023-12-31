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

                            <h1 class='text-center' style="color:#0070C0;position: relative;left:265px;top:-25px;width:250px;
                                                    font-size:48px;font-weight:bold;">
                                Line-{{ $g_line_name }}</h1>

                            {{-- @if ($g_line_name == 'Mini')
                            <h1 class='text-center' style="font-weight: bold;border-style: solid;color:black;padding: 13.2px 10px 13.2px 10px;position: relative;left:99px;top:10px;font-size:58px;width:130px;
                        background:#e6f0ff;">
                                {{ $g_line_name }}</h1>
                            @elseif($g_line_name != 'Mini')
                            <h1 class='text-center' style="font-weight: bold;border-style: solid;color:black;padding: 0 10px 0 10px;position: relative;left:99px;top:10px;font-size:80px;width:130px;
                        background:#e6f0ff;">
                                {{ $g_line_name }}</h1>
                            @endif --}}

                            @endif
                        </td>
                </tbody>
            </table>





            <div class="float-container">
                <div class="float-child">
                    <div class='left_head' style=''>
                        <h3>
                        </h3>
                    </div>
                    <table class="text-center table table-bordered table-sm border-white left_table" style="">
                        <tr class="">
                            <td style="height:60px;background: #E9E9E9;">
                                <span
                                    style="font-size:24px;font-weight:bold;position:relative;top:7px;left:20px;color:black;"
                                    class="">
                                    Target
                                </span>
                            </td>
                        </tr>


                        <tr>
                            <td></td>
                        </tr>


                        <tr class="">
                            <td style="height:60px; background: #E9E9E9;" class="">
                                <span style="font-size:24px;font-weight:bold;position:relative;top:7px;color:black;"
                                    class="">Production</span>
                            </td>
                        </tr>
                        </tr>


                        <tr>
                            <td></td>
                        </tr>


                        <tr class="text-light" style="background-color: #2980B9;">
                            <td style="height:60px;" id="percent_val" class="">
                                <span style="font-size:24px;font-weight:bold;position:relative;top:7px;" class="">
                                    Percentage
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>


                {{-- Total percentage by msn--}}
                <div class="float-child">
                    @foreach($target_total as $t_1_total)

                    <div class='present_head' style=''>
                        <h3 style="font-size: 28px;padding: 0 0 0 0;" class="text-light">
                            Present</h3>
                    </div>

                    <table class="w-100 text-center table table-bordered table-sm border-white present_table"
                        id="total_table" style="">
                        <tr class="text-light">
                            <td style="height:60px;background: #E9E9E9">
                                <span style="font-size:24px;">
                                </span>
                            </td>
                        </tr>


                        <tr>
                            <td></td>
                        </tr>


                        <tr class="text-light">
                            <td style="height:60px;background: #E9E9E9;" class="">
                                <span style="font-size:24px;" class=""></span>
                            </td>
                        </tr>
                        </tr>


                        <tr>
                            <td></td>
                        </tr>


                        <tr class="text-light" style="background-color: #2980B9;">
                            <td style="height:60px;" class="">
                                <span style="font-size:24px;" class=""></span>
                                <span id="present_third_value" style="display: none"></span>
                            </td>
                        </tr>
                    </table>

                    @foreach ($actual_target_total as $a_total)

                    @if ($g_line_id == $a_total->line_id)

                    {{-- kmk --}}
                    <table class="w-100 text-center table table-bordered table-sm border-white present_table"
                        id="total_table" style="">
                        <tr class="">
                            <td style="height:60px;background: #E9E9E9">
                                <span style="font-size:31px;position:relative;top:3px;color:black;"
                                    class="right_table_text1 fw-bold t_1_total_{{ $t_1_total->line_id }}">
                                    {{ $a_total->total_div_target }}
                                </span>
                            </td>
                        </tr>


                        <tr>
                            <td></td>
                        </tr>


                        <tr class="">
                            <td style="height:60px;background: #E9E9E9;"
                                class="fw-bold td_a_total1_{{ $t_1_total->line_id }}">
                                <span style="font-size:31px;position:relative;top:3px;color:black;"
                                    class="right_table_text2 a_total1_{{ $t_1_total->line_id }}">{{
                                    $a_total->total_actual_target }}</span>
                            </td>
                        </tr>
                        </tr>


                        <tr>
                            <td></td>
                        </tr>


                        <tr class="">
                            <td style="height:60px;" class="fw-bold td_t_percent1_{{ $t_1_total->line_id }}">
                                <span style="font-size:31px;position:relative;top:3px;"
                                    class="right_table_text3 t_percent1_{{ $t_1_total->line_id }}"></span>

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
                                        td_a_percent.css('color', 'white');

                                        // td_t_percent.css('background-color','rgba(255,0,0,0.8)');
                                        td_a_percent.css('background', '#2980B9');
                                        percent_name.css('background', '#2980B9');

                                        line_column.addClass('bounce');
                                        line_column.css('background-color', '#FF0000');

                                        present_third_value.text("red");
                                    }
                                    if (parseInt(t_percent_span.text()) > 80) {
                                        td_t_percent.css('color', 'black');
                                        td_a_percent.css('color', 'white');

                                        // td_t_percent.css({'background-color':'#FF8000','color':'#fff'});
                                        td_a_percent.css({'background': '#2980B9',});
                                        percent_name.css('background', '#2980B9');

                                        line_column.addClass('bounce');
                                        line_column.css('background-color', '#FF8000');

                                        present_third_value.text("orange");
                                    }
                                    if (parseInt(t_percent_span.text()) >= 100) {
                                        td_t_percent.css('color', 'black');
                                        td_a_percent.css('color', 'white');

                                        // td_t_percent.css({'background-color':'rgba(30,113,0,1)','color':'#fff'});
                                        td_a_percent.css({'background': '#2980B9',});
                                        percent_name.css('background', '#2980B9');

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
            </div>


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



            @if ($one_time === $static_hour || $one_time > (int) date('H') || $one_time < 8) <td class="confuse3"
                id="{{ $t_div_target->time_name }}">
                {{-- ************************ <table class="w-100 text-center table table-bordered m-0" border="1">
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
                    style="width: 100px;position: relative;right:450px;top:-71.7px;" id="ranking_table">
                    <tbody>
                        <tr>
                            <td style="vertical-align: middle;">
                                {{--
                            <td style="vertical-align: middle;"
                                class="t_line_{{ $t_line->row_num }} t_line_count fw-bold">
                                ******************************** --}}
                                <h3 style="font-size: 72px;color:#000;font-weight: bold;
                                    width: 810px;">Rank
                                </h3>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:10px;vertical-align: middle;min-width:220px;height:120px;"
                                class="t_line t_line_count">
                                <span>
                                    <h3 class="text-light" style="font-size: 50px;font-weight: bold;">
                                    </h3>
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>

                @foreach ($top_line as $t_line)
                @if ($g_line_id == $t_line->l_id)
                <div class="m-auto text-start text-center k_rank_head" style="" id="ranking_table">
                    <div>
                        <div>
                            <div style="vertical-align: middle;">
                                {{-- <div style="vertical-align: middle;"
                                    class="t_line_{{ $t_line->row_num }} t_line_count fw-bold">
                                    ******************************** --}}
                                    <h3 style="font-size: 72px;color:#000;font-weight:bold;
                                    width: 810px;">Rank
                                        {{ $t_line->row_num }}
                                    </h3>

                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- zn --}}

                    <div class="t_line_{{ $t_line->row_num }} t_line_count k_main_percent" style="">
                        <span class="input_row_num_{{ $t_line->row_num }} input_row_num" style="display:none;">
                            <h3>{{ $t_line->row_num }}</h3>
                        </span>
                        <span>
                            <h3 class="text-light total_percent1_{{ $g_line_id }}"
                                style="font-size: 72px;font-weight: bold;background-color: rgb(0, 128, 0);">
                                <span class="tt_percent1_{{ $g_line_id }}"></span>

                                <span id="d_total_percentage" style="display: none"></span>
                            </h3>

                        </span>
                    </div>


                    @php
                    $lis = array();
                    foreach ($getLine as $g_line) {
                    array_push($lis, $g_line);
                    }
                    @endphp


                    <script>
                        window.addEventListener('additionalInit10', event => {
        var line_counter = "<?php echo count($lis); ?>";

        var r = document.getElementById("ranking_table");
        r.style.display = "none";

        // update total percentage data by zn
        var t_1_total = parseInt($('.t_1_total_{{ $t_1_total->line_id }}').text().replace(/,/g, ''));
        var a_total = parseInt($('.a_total1_{{ $t_1_total->line_id }}').text().replace(/,/g, ''));
        var t_percent_span = $('.tt_percent1_{{ $g_line_id }}');
        var td_t_percent = $('.total_percent1_{{ $g_line_id }}');
        var td_a_percent = $('.td_t_percent1_{{ $t_1_total->line_id }}');
        var g_line = $('.line_name_{{ $t_1_total->line_id }}');
        var tr_line = $(".tr_line_{{ $t_1_total->line_id }}");
        var item_name = $(".item_name_{{ $t_1_total->line_id }}");
        var g_main_target = $("#g_main_target_{{ $t_1_total->line_id }}");
        var line_column = $(".line_column_{{ $t_1_total->line_id }}");
        var percent_name = $("#percent_val");


        var present_third_value = $("#d_total_percentage");

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

        t_percent_span.append('%');

        }
        }
        // end

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
                'background': '#008000',
                'color': '#000'
            });
        }
        if (top_2 != '') {
            $('.t_line_' + top_2).css({
                'background-color': '#008000',
                'color': '#000'
            });
        }
        if (top_3 != '') {
            $('.t_line_' + top_3).css({
                'background-color': '#008000',
                'color': '#000'
            });
        }


        if (line_counter == 2){
            $(".t_line_" + 2).css({
            'background': '#ED1C24',
            'color': '#000'
        });
        }
        if (line_counter == 3){
            $(".t_line_" + 3).css({
            'background': '#ED1C24',
            'color': '#000'
        });
        }
        if (line_counter == 4){
            $(".t_line_" + 4).css({
            'background': '#ED1C24',
            'color': '#000'
        });
        }
        if (line_counter == 5){
            $(".t_line_" + 5).css({
            'background': '#ED1C24',
            'color': '#000'
        });
        }
        if (line_counter == 6){
            $(".t_line_" + 6).css({
            'background': '#ED1C24',
            'color': '#000'
        });
        }
        if (line_counter == 7){
            $(".t_line_" + 7).css({
            'background': '#ED1C24',
            'color': '#000'
        });
        }
        if (line_counter == 8){
            $(".t_line_" + 8).css({
            'background': '#ED1C24',
            'color': '#000'
        });
        }
        if (line_counter == 9){
            $(".t_line_" + 9).css({
            'background': '#ED1C24',
            'color': '#000'
        });
        }


        $(".t_line_" + 10).css({
            'background': '#ED1C24',
            'color': '#000'
        });
    });
                    </script>
                    {{-- <script>
                        window.addEventListener('additionalInit10', event => {
                                                // var t = document.getElementById("total_table");
                                                // t.style.display = "none";

                                                var t_1_total = parseInt($('.t_1_total_{{ $t_1_total->line_id }}').text().replace(/,/g, ''));
                                                var a_total = parseInt($('.a_total1_{{ $t_1_total->line_id }}').text().replace(/,/g, ''));
                                                var t_percent_span = $('.tt_percent1_{{ $g_line_id }}');
                                                var td_t_percent = $('.total_percent1_{{ $g_line_id }}');
                                                var td_a_percent = $('.td_t_percent1_{{ $t_1_total->line_id }}');
                                                var g_line = $('.line_name_{{ $t_1_total->line_id }}');
                                                var tr_line = $(".tr_line_{{ $t_1_total->line_id }}");
                                                var item_name = $(".item_name_{{ $t_1_total->line_id }}");
                                                var g_main_target = $("#g_main_target_{{ $t_1_total->line_id }}");
                                                var line_column = $(".line_column_{{ $t_1_total->line_id }}");
                                                var percent_name = $("#percent_val");


                                                var present_third_value = $("#d_total_percentage");



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

                                                        t_percent_span.append('%');

                                                    }
                                                }
                                            });
                    </script> --}}

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
                                        {{--
                                    <tr style="border-bottom: 1px #000">******************************** --}}
                                        <td class="item_name_{{ $g_line_id }}" colspan="0" style="display: none;">
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
                            <table class="w-100 text-center table m-0 totalTable table-bordered table-sm border-white"
                                id="tcurrent_table" style="height:0;position:relative;right:1132px;top:204.7px;">

                                <h3 class="text-light" style="
    height:60px;min-width:120px;font-size:24px;position: relative;right:1001px;top:135.1px;color:white;text-align:center;min-width:130px;
    background: #EA6153;
                font-size: 24px;padding: 14px 0 0 0;" id="tcurrent_head">
                                    Daily</h3>
                                @if(isset($actual_target_total))


                                {{-- kmk --}}
                                <tr id="tcurrent1">
                                    <td style="height: 60px;background: #E9E9E9;font-size:38px;min-width:130px;"><span
                                            class="text-light">

                                        </span>
                                    </td>
                                </tr>

                                <tr id="tcurrent2">
                                    <td></td>
                                </tr>

                                <tr class="text-light" id="tcurrent3">
                                    <td style="height: 60px;background:#E9E9E9;font-size:38px;min-width:130px;"
                                        class="">
                                        <span class=""></span>
                                    </td>
                                </tr>

                                <tr id="tcurrent4">
                                    <td></td>
                                </tr>

                                <tr class="text-light" id="tcurrent5">
                                    <td style="height: 60px;min-width:120px;background:#2980B9;font-size:38px;min-width:130px;"
                                        class="">
                                        <span class=""></span>
                                    </td>
                                </tr>



                                @foreach ($actual_target_total as $a_total)
                                @if ($g_line_id == $a_total->line_id)
                                <table
                                    class="w-100 text-center table m-0 totalTable table-bordered table-sm border-white right_table">
                                    <h3 class="rank_heading text-light" style="font-size: 24px;min-width:130px;">
                                        Daily</h3>
                                    <tr class="">
                                        <td style="height: 60px;background: #E9E9E9;color:black;min-width:130px;"><span
                                                class="right_table_text1 fw-bold t_2_total_{{ $t_2_total->line_id }}">
                                                @if($g_ot_main_target
                                                !=
                                                '') {{ number_format($g_main_target + $g_ot_main_target) }}
                                                @else {{ number_format($g_main_target) }}
                                                @endif
                                            </span>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td></td>
                                    </tr>


                                    <tr class="">
                                        <td style="height:60px;background:#E9E9E9;color:black;min-width:130px;"
                                            class="fw-bold td_a_total_{{ $t_2_total->line_id }}">
                                            <span class="right_table_text2 a_total_{{ $t_2_total->line_id }}">{{
                                                $a_total->total_actual_target }}</span>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td></td>
                                    </tr>


                                    <tr class="text-light">
                                        <td style="height:60px;min-width:120px;min-width:130px;"
                                            class="fw-bold td_t_percent_{{ $t_2_total->line_id }}">
                                            <span class="right_table_text3 t_percent_{{ $t_2_total->line_id }}"></span>
                                        </td>
                                    </tr>
                                    <script>
                                        window.addEventListener('additionalInit10', event => {

                                var tb = document.getElementById("tcurrent_table");
                                var th = document.getElementById("tcurrent_head");
                                var t1 = document.getElementById("tcurrent1");
                                var t2 = document.getElementById("tcurrent2");
                                var t3 = document.getElementById("tcurrent3");
                                var t4 = document.getElementById("tcurrent4");
                                var t5 = document.getElementById("tcurrent5");
                                tb.style.display = "none";
                                th.style.display = "none";
                                t1.style.display = "none";
                                t2.style.display = "none";
                                t3.style.display = "none";
                                t4.style.display = "none";
                                t5.style.display = "none";

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
                                            td_a_percent.css('color', 'white');

                                            // td_t_percent.css('background-color','rgba(255,0,0,0.8)');
                                            td_a_percent.css('background', '#2980B9');
                                            line_column.addClass('bounce');
                                            line_column.css('background-color', 'red');
                                        }

                                        if (present_third_value_color == "orange") {
                                            td_t_percent.css('color', 'black');
                                            td_a_percent.css('color', 'white');

                                            // td_t_percent.css({'background-color':'#FF8000','color':'#fff'});
                                            td_a_percent.css({'background': '#2980B9',});
                                            line_column.addClass('bounce');
                                            line_column.css('background-color', '#FF8000');
                                        }

                                        if (present_third_value_color == "green") {
                                            td_t_percent.css('color', 'black');
                                            td_a_percent.css('color', 'white');

                                            // td_t_percent.css({'background-color':'rgba(30,113,0,1)','color':'#fff'});
                                            td_a_percent.css({'background': '#2980B9',});
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
    echo "<div style='margin-top:-500px;'></div>";
    foreach ($top_line as $t_line2) {
    if ($t_line2->row_num == 2 || $t_line2->row_num == 3 || $t_line2->row_num == 4) {
    foreach ($getLine as $g_line) {
    if ($t_line2->l_id == $g_line->l_id) {
    $magic = $g_line->l_name;
    break;
    }
    }

    echo "
    <div class='bottom_rank' style='padding: 10px 0 0 0;display: flex;margin:auto;width:410px;position: relative;top:30px;margin-left:478px;height:50px;
            border: solid 1.7px;'>" .
        "<div style='display: flex;min-width:270px;margin-right:5px;margin-left:5px;'>" .

            "<h3 style='color:black;font-weight: bold;font-size:24px;margin-left:8px;'>Rank</h3> &nbsp;&nbsp;
            <h3 style='margin-right:0px;font-weight: bold;min-width:50px;font-size:24px;color:black;'>" .
                $t_line2->row_num .
                '</h3>'.


            "
            <h3 style='font-weight: bold;font-size:24px;margin-left:10px;color:#0070C0;
                            position:relative;right:5px;
                '>Line</h3> &nbsp;&nbsp;
            <h3 style='font-weight: bold;font-size:24px;color:#0070C0;
                            position:relative;right:5px;'>" .
                $magic .
                "</h3>
        </div>" .

        "<h3 style='
                                    min-width:55px;min-height:28px;text-align:center;
                                    position: relative;bottom:3px;right:24.7px;
                                    font-size:24px;color:#ED3334;font-weight:bold;padding: 3px 0 0 7px;'>" . "-" .
            $t_line->diff_target_percent-$t_line2->diff_target_percent
            . "%" .
            "</h3> &nbsp;" .

        "<div style='margin-left:18px;display:flex;position: relative;bottom:2px;right:27px;
                            padding:0 0 0 0;min-width:70px;height:33px;background:#ED3334;text-align: center;
                            justify-content:center;'>
            <p style='font-size:24px;position: relative;bottom:3px;font-weight:bold;' class='text-light'>" .
                $t_line2->diff_target_percent .
                '%' .
                "</p>
        </div>" .

        "</div><br>
    ";
    }
    }
    } elseif ($t_line->row_num == 2) {
    foreach ($top_line as $t_line2) {
    if ($t_line2->row_num == 1) {
    echo "<div style='margin-top:-500px;'></div>";
    foreach ($getLine as $g_line) {
    if ($t_line2->l_id == $g_line->l_id) {
    $magic = $g_line->l_name;
    break;
    }
    }

    echo "
    <div class='bottom_rank' style='padding: 10px 0 0 0;display: flex;margin:auto;width:410px;position: relative;top:30px;margin-left:478px;height:50px;
            border: solid 1.7px;'>" .
        "<div style='display: flex;min-width:270px;margin-right:5px;margin-left:5px;'>" .

            "<h3 style='color:black;font-weight: bold;font-size:24px;margin-left:8px;'>Rank</h3> &nbsp;&nbsp;
            <h3 style='margin-right:0px;font-weight: bold;min-width:50px;font-size:24px;color:black;'>" .
                $t_line2->row_num .
                '</h3>'.


            "
            <h3 style='font-weight: bold;font-size:24px;margin-left:10px;color:#0070C0;
                            position:relative;right:5px;
                '>Line</h3> &nbsp;&nbsp;
            <h3 style='font-weight: bold;font-size:24px;color:#0070C0;
                            position:relative;right:5px;'>" .
                $magic .
                "</h3>
        </div>" .

        "<h3 style='
                                    min-width:55px;min-height:28px;text-align:center;
                                    position: relative;bottom:3px;right:24.7px;
                                    font-size:24px;color:#008000;font-weight:bold;padding: 3px 0 0 7px;'>" . "+" .
            $t_line2->diff_target_percent-$t_line->diff_target_percent
            . "%" .
            "</h3> &nbsp;" .

        "<div style='margin-left:18px;display:flex;position: relative;bottom:2px;right:27px;
                            padding:0 0 0 0;min-width:70px;height:33px;background:#008000;text-align: center;
                            justify-content:center;'>
            <p style='font-size:24px;position: relative;bottom:3px;font-weight:bold;' class='text-light'>" .
                $t_line2->diff_target_percent .
                '%' .
                "</p>
        </div>" .

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
    <div class='bottom_rank' style='padding: 10px 0 0 0;display: flex;margin:auto;width:410px;position: relative;top:30px;margin-left:478px;height:50px;
            border: solid 1.7px;'>" .
        "<div style='display: flex;min-width:270px;margin-right:5px;margin-left:5px;'>" .

            "<h3 style='color:black;font-weight: bold;font-size:24px;margin-left:8px;'>Rank</h3> &nbsp;&nbsp;
            <h3 style='margin-right:0px;font-weight: bold;min-width:50px;font-size:24px;color:black;'>" .
                $t_line2->row_num .
                '</h3>'.


            "
            <h3 style='font-weight: bold;font-size:24px;margin-left:10px;color:#0070C0;
                            position:relative;right:5px;
                '>Line</h3> &nbsp;&nbsp;
            <h3 style='font-weight: bold;font-size:24px;color:#0070C0;
                            position:relative;right:5px;'>" .
                $magic .
                "</h3>
        </div>" .

        "<h3 style='
                                    min-width:55px;min-height:28px;text-align:center;
                                    position: relative;bottom:3px;right:24.7px;
                                    font-size:24px;color:#ED3334;font-weight:bold;padding: 3px 0 0 7px;'>" . "-" .
            $t_line->diff_target_percent-$t_line2->diff_target_percent
            . "%" .
            "</h3> &nbsp;" .

        "<div style='margin-left:18px;display:flex;position: relative;bottom:2px;right:27px;
                            padding:0 0 0 0;min-width:70px;height:33px;background:#ED3334;text-align: center;
                            justify-content:center;'>
            <p style='font-size:24px;position: relative;bottom:3px;font-weight:bold;' class='text-light'>" .
                $t_line2->diff_target_percent .
                '%' .
                "</p>
        </div>" .

        "</div><br>
    ";
    }
    }
    } elseif ($t_line->row_num == 3) {
    echo "<div style='margin-top:-500px;'></div>";
    foreach ($top_line as $t_line2) {
    if ($t_line2->row_num == 1 || $t_line2->row_num == 2) {
    foreach ($getLine as $g_line) {
    if ($t_line2->l_id == $g_line->l_id) {
    $magic = $g_line->l_name;
    break;
    }
    }

    echo "
    <div class='bottom_rank' style='padding: 10px 0 0 0;display: flex;margin:auto;width:410px;position: relative;top:30px;margin-left:478px;height:50px;
            border: solid 1.7px;'>" .
        "<div style='display: flex;min-width:270px;margin-right:5px;margin-left:5px;'>" .

            "<h3 style='color:black;font-weight: bold;font-size:24px;margin-left:8px;'>Rank</h3> &nbsp;&nbsp;
            <h3 style='margin-right:0px;font-weight: bold;min-width:50px;font-size:24px;color:black;'>" .
                $t_line2->row_num .
                '</h3>'.


            "
            <h3 style='font-weight: bold;font-size:24px;margin-left:10px;color:#0070C0;
                            position:relative;right:5px;
                '>Line</h3> &nbsp;&nbsp;
            <h3 style='font-weight: bold;font-size:24px;color:#0070C0;
                            position:relative;right:5px;'>" .
                $magic .
                "</h3>
        </div>" .

        "<h3 style='
                                    min-width:55px;min-height:28px;text-align:center;
                                    position: relative;bottom:3px;right:24.7px;
                                    font-size:24px;color:#008000;font-weight:bold;padding: 3px 0 0 7px;'>" . "+" .
            $t_line2->diff_target_percent-$t_line->diff_target_percent
            . "%" .
            "</h3> &nbsp;" .

        "<div style='margin-left:18px;display:flex;position: relative;bottom:2px;right:27px;
                            padding:0 0 0 0;min-width:70px;height:33px;background:#008000;text-align: center;
                            justify-content:center;'>
            <p style='font-size:24px;position: relative;bottom:3px;font-weight:bold;' class='text-light'>" .
                $t_line2->diff_target_percent .
                '%' .
                "</p>
        </div>" .

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
    <div class='bottom_rank' style='padding: 10px 0 0 0;display: flex;margin:auto;width:410px;position: relative;top:30px;margin-left:478px;height:50px;
            border: solid 1.7px;'>" .
        "<div style='display: flex;min-width:270px;margin-right:5px;margin-left:5px;'>" .

            "<h3 style='color:black;font-weight: bold;font-size:24px;margin-left:8px;'>Rank</h3> &nbsp;&nbsp;
            <h3 style='margin-right:0px;font-weight: bold;min-width:50px;font-size:24px;color:black;'>" .
                $t_line2->row_num .
                '</h3>'.


            "
            <h3 style='font-weight: bold;font-size:24px;margin-left:10px;color:#0070C0;
                            position:relative;right:5px;
                '>Line</h3> &nbsp;&nbsp;
            <h3 style='font-weight: bold;font-size:24px;color:#0070C0;
                            position:relative;right:5px;'>" .
                $magic .
                "</h3>
        </div>" .

        "<h3 style='
                                    min-width:55px;min-height:28px;text-align:center;
                                    position: relative;bottom:3px;right:24.7px;
                                    font-size:24px;color:#ED3334;font-weight:bold;padding: 3px 0 0 7px;'>" . "-" .
            $t_line->diff_target_percent-$t_line2->diff_target_percent
            . "%" .
            "</h3> &nbsp;" .

        "<div style='margin-left:18px;display:flex;position: relative;bottom:2px;right:27px;
                            padding:0 0 0 0;min-width:70px;height:33px;background:#ED3334;text-align: center;
                            justify-content:center;'>
            <p style='font-size:24px;position: relative;bottom:3px;font-weight:bold;' class='text-light'>" .
                $t_line2->diff_target_percent .
                '%' .
                "</p>
        </div>" .

        "</div><br>
    ";
    }
    }
    } elseif ($t_line->row_num == 4) {
    echo "<div style='margin-top:-500px;'></div>";
    foreach ($top_line as $t_line2) {
    if ($t_line2->row_num == 2 || $t_line2->row_num == 3) {
    foreach ($getLine as $g_line) {
    if ($t_line2->l_id == $g_line->l_id) {
    $magic = $g_line->l_name;
    break;
    }
    }

    echo "
    <div class='bottom_rank' style='padding: 10px 0 0 0;display: flex;margin:auto;width:410px;position: relative;top:30px;margin-left:478px;height:50px;
            border: solid 1.7px;'>" .
        "<div style='display: flex;min-width:270px;margin-right:5px;margin-left:5px;'>" .

            "<h3 style='color:black;font-weight: bold;font-size:24px;margin-left:8px;'>Rank</h3> &nbsp;&nbsp;
            <h3 style='margin-right:0px;font-weight: bold;min-width:50px;font-size:24px;color:black;'>" .
                $t_line2->row_num .
                '</h3>'.


            "
            <h3 style='font-weight: bold;font-size:24px;margin-left:10px;color:#0070C0;
                            position:relative;right:5px;
                '>Line</h3> &nbsp;&nbsp;
            <h3 style='font-weight: bold;font-size:24px;color:#0070C0;
                            position:relative;right:5px;'>" .
                $magic .
                "</h3>
        </div>" .

        "<h3 style='
                                    min-width:55px;min-height:28px;text-align:center;
                                    position: relative;bottom:3px;right:24.7px;
                                    font-size:24px;color:#008000;font-weight:bold;padding: 3px 0 0 7px;'>" . "+" .
            $t_line2->diff_target_percent-$t_line->diff_target_percent
            . "%" .
            "</h3> &nbsp;" .

        "<div style='margin-left:18px;display:flex;position: relative;bottom:2px;right:27px;
                            padding:0 0 0 0;min-width:70px;height:33px;background:#008000;text-align: center;
                            justify-content:center;'>
            <p style='font-size:24px;position: relative;bottom:3px;font-weight:bold;' class='text-light'>" .
                $t_line2->diff_target_percent .
                '%' .
                "</p>
        </div>" .

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
    <div class='bottom_rank' style='padding: 10px 0 0 0;display: flex;margin:auto;width:410px;position: relative;top:30px;margin-left:478px;height:50px;
            border: solid 1.7px;'>" .
        "<div style='display: flex;min-width:270px;margin-right:5px;margin-left:5px;'>" .

            "<h3 style='color:black;font-weight: bold;font-size:24px;margin-left:8px;'>Rank</h3> &nbsp;&nbsp;
            <h3 style='margin-right:0px;font-weight: bold;min-width:50px;font-size:24px;color:black;'>" .
                $t_line2->row_num .
                '</h3>'.


            "
            <h3 style='font-weight: bold;font-size:24px;margin-left:10px;color:#0070C0;
                            position:relative;right:5px;
                '>Line</h3> &nbsp;&nbsp;
            <h3 style='font-weight: bold;font-size:24px;color:#0070C0;
                            position:relative;right:5px;'>" .
                $magic .
                "</h3>
        </div>" .

        "<h3 style='
                                    min-width:55px;min-height:28px;text-align:center;
                                    position: relative;bottom:3px;right:24.7px;
                                    font-size:24px;color:#ED3334;font-weight:bold;padding: 3px 0 0 7px;'>" . "-" .
            $t_line->diff_target_percent-$t_line2->diff_target_percent
            . "%" .
            "</h3> &nbsp;" .

        "<div style='margin-left:18px;display:flex;position: relative;bottom:2px;right:27px;
                            padding:0 0 0 0;min-width:70px;height:33px;background:#ED3334;text-align: center;
                            justify-content:center;'>
            <p style='font-size:24px;position: relative;bottom:3px;font-weight:bold;' class='text-light'>" .
                $t_line2->diff_target_percent .
                '%' .
                "</p>
        </div>" .

        "</div><br>
    ";
    }
    }
    } elseif ($t_line->row_num == 5) {
    echo "<div style='margin-top:-500px;'></div>";
    foreach ($top_line as $t_line2) {
    if ($t_line2->row_num == 3 || $t_line2->row_num == 4) {
    foreach ($getLine as $g_line) {
    if ($t_line2->l_id == $g_line->l_id) {
    $magic = $g_line->l_name;
    break;
    }
    }

    echo "
    <div class='bottom_rank' style='padding: 10px 0 0 0;display: flex;margin:auto;width:410px;position: relative;top:30px;margin-left:478px;height:50px;
            border: solid 1.7px;'>" .
        "<div style='display: flex;min-width:270px;margin-right:5px;margin-left:5px;'>" .

            "<h3 style='color:black;font-weight: bold;font-size:24px;margin-left:8px;'>Rank</h3> &nbsp;&nbsp;
            <h3 style='margin-right:0px;font-weight: bold;min-width:50px;font-size:24px;color:black;'>" .
                $t_line2->row_num .
                '</h3>'.


            "
            <h3 style='font-weight: bold;font-size:24px;margin-left:10px;color:#0070C0;
                            position:relative;right:5px;
                '>Line</h3> &nbsp;&nbsp;
            <h3 style='font-weight: bold;font-size:24px;color:#0070C0;
                            position:relative;right:5px;'>" .
                $magic .
                "</h3>
        </div>" .

        "<h3 style='
                                    min-width:55px;min-height:28px;text-align:center;
                                    position: relative;bottom:3px;right:24.7px;
                                    font-size:24px;color:#008000;font-weight:bold;padding: 3px 0 0 7px;'>" . "+" .
            $t_line2->diff_target_percent-$t_line->diff_target_percent
            . "%" .
            "</h3> &nbsp;" .

        "<div style='margin-left:18px;display:flex;position: relative;bottom:2px;right:27px;
                            padding:0 0 0 0;min-width:70px;height:33px;background:#008000;text-align: center;
                            justify-content:center;'>
            <p style='font-size:24px;position: relative;bottom:3px;font-weight:bold;' class='text-light'>" .
                $t_line2->diff_target_percent .
                '%' .
                "</p>
        </div>" .

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
    <div class='bottom_rank' style='padding: 10px 0 0 0;display: flex;margin:auto;width:410px;position: relative;top:30px;margin-left:478px;height:50px;
            border: solid 1.7px;'>" .
        "<div style='display: flex;min-width:270px;margin-right:5px;margin-left:5px;'>" .

            "<h3 style='color:black;font-weight: bold;font-size:24px;margin-left:8px;'>Rank</h3> &nbsp;&nbsp;
            <h3 style='margin-right:0px;font-weight: bold;min-width:50px;font-size:24px;color:black;'>" .
                $t_line2->row_num .
                '</h3>'.


            "
            <h3 style='font-weight: bold;font-size:24px;margin-left:10px;color:#0070C0;
                            position:relative;right:5px;
                '>Line</h3> &nbsp;&nbsp;
            <h3 style='font-weight: bold;font-size:24px;color:#0070C0;
                            position:relative;right:5px;'>" .
                $magic .
                "</h3>
        </div>" .

        "<h3 style='
                                    min-width:55px;min-height:28px;text-align:center;
                                    position: relative;bottom:3px;right:24.7px;
                                    font-size:24px;color:#ED3334;font-weight:bold;padding: 3px 0 0 7px;'>" . "-" .
            $t_line->diff_target_percent-$t_line2->diff_target_percent
            . "%" .
            "</h3> &nbsp;" .

        "<div style='margin-left:18px;display:flex;position: relative;bottom:2px;right:27px;
                            padding:0 0 0 0;min-width:70px;height:33px;background:#ED3334;text-align: center;
                            justify-content:center;'>
            <p style='font-size:24px;position: relative;bottom:3px;font-weight:bold;' class='text-light'>" .
                $t_line2->diff_target_percent .
                '%' .
                "</p>
        </div>" .

        "</div><br>
    ";
    }
    }
    } elseif ($t_line->row_num == 6) {
    echo "<div style='margin-top:-500px;'></div>";
    foreach ($top_line as $t_line2) {
    if ($t_line2->row_num == 4 || $t_line2->row_num == 5) {
    foreach ($getLine as $g_line) {
    if ($t_line2->l_id == $g_line->l_id) {
    $magic = $g_line->l_name;
    break;
    }
    }

    echo "
    <div class='bottom_rank' style='padding: 10px 0 0 0;display: flex;margin:auto;width:410px;position: relative;top:30px;margin-left:478px;height:50px;
            border: solid 1.7px;'>" .
        "<div style='display: flex;min-width:270px;margin-right:5px;margin-left:5px;'>" .

            "<h3 style='color:black;font-weight: bold;font-size:24px;margin-left:8px;'>Rank</h3> &nbsp;&nbsp;
            <h3 style='margin-right:0px;font-weight: bold;min-width:50px;font-size:24px;color:black;'>" .
                $t_line2->row_num .
                '</h3>'.


            "
            <h3 style='font-weight: bold;font-size:24px;margin-left:10px;color:#0070C0;
                            position:relative;right:5px;
                '>Line</h3> &nbsp;&nbsp;
            <h3 style='font-weight: bold;font-size:24px;color:#0070C0;
                            position:relative;right:5px;'>" .
                $magic .
                "</h3>
        </div>" .

        "<h3 style='
                                    min-width:55px;min-height:28px;text-align:center;
                                    position: relative;bottom:3px;right:24.7px;
                                    font-size:24px;color:#008000;font-weight:bold;padding: 3px 0 0 7px;'>" . "+" .
            $t_line2->diff_target_percent-$t_line->diff_target_percent
            . "%" .
            "</h3> &nbsp;" .

        "<div style='margin-left:18px;display:flex;position: relative;bottom:2px;right:27px;
                            padding:0 0 0 0;min-width:70px;height:33px;background:#008000;text-align: center;
                            justify-content:center;'>
            <p style='font-size:24px;position: relative;bottom:3px;font-weight:bold;' class='text-light'>" .
                $t_line2->diff_target_percent .
                '%' .
                "</p>
        </div>" .

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
    <div class='bottom_rank' style='padding: 10px 0 0 0;display: flex;margin:auto;width:410px;position: relative;top:30px;margin-left:478px;height:50px;
            border: solid 1.7px;'>" .
        "<div style='display: flex;min-width:270px;margin-right:5px;margin-left:5px;'>" .

            "<h3 style='color:black;font-weight: bold;font-size:24px;margin-left:8px;'>Rank</h3> &nbsp;&nbsp;
            <h3 style='margin-right:0px;font-weight: bold;min-width:50px;font-size:24px;color:black;'>" .
                $t_line2->row_num .
                '</h3>'.


            "
            <h3 style='font-weight: bold;font-size:24px;margin-left:10px;color:#0070C0;
                            position:relative;right:5px;
                '>Line</h3> &nbsp;&nbsp;
            <h3 style='font-weight: bold;font-size:24px;color:#0070C0;
                            position:relative;right:5px;'>" .
                $magic .
                "</h3>
        </div>" .

        "<h3 style='
                                    min-width:55px;min-height:28px;text-align:center;
                                    position: relative;bottom:3px;right:24.7px;
                                    font-size:24px;color:#ED3334;font-weight:bold;padding: 3px 0 0 7px;'>" . "-" .
            $t_line->diff_target_percent-$t_line2->diff_target_percent
            . "%" .
            "</h3> &nbsp;" .

        "<div style='margin-left:18px;display:flex;position: relative;bottom:2px;right:27px;
                            padding:0 0 0 0;min-width:70px;height:33px;background:#ED3334;text-align: center;
                            justify-content:center;'>
            <p style='font-size:24px;position: relative;bottom:3px;font-weight:bold;' class='text-light'>" .
                $t_line2->diff_target_percent .
                '%' .
                "</p>
        </div>" .

        "</div><br>
    ";
    }
    }
    } elseif ($t_line->row_num == 7) {
    echo "<div style='margin-top:-500px;'></div>";
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
    <div class='bottom_rank' style='padding: 10px 0 0 0;display: flex;margin:auto;width:410px;position: relative;top:30px;margin-left:478px;height:50px;
            border: solid 1.7px;'>" .
        "<div style='display: flex;min-width:270px;margin-right:5px;margin-left:5px;'>" .

            "<h3 style='color:black;font-weight: bold;font-size:24px;margin-left:8px;'>Rank</h3> &nbsp;&nbsp;
            <h3 style='margin-right:0px;font-weight: bold;min-width:50px;font-size:24px;color:black;'>" .
                $t_line2->row_num .
                '</h3>'.


            "
            <h3 style='font-weight: bold;font-size:24px;margin-left:10px;color:#0070C0;
                            position:relative;right:5px;
                '>Line</h3> &nbsp;&nbsp;
            <h3 style='font-weight: bold;font-size:24px;color:#0070C0;
                            position:relative;right:5px;'>" .
                $magic .
                "</h3>
        </div>" .

        "<h3 style='
                                    min-width:55px;min-height:28px;text-align:center;
                                    position: relative;bottom:3px;right:24.7px;
                                    font-size:24px;color:#008000;font-weight:bold;padding: 3px 0 0 7px;'>" . "+" .
            $t_line2->diff_target_percent-$t_line->diff_target_percent
            . "%" .
            "</h3> &nbsp;" .

        "<div style='margin-left:18px;display:flex;position: relative;bottom:2px;right:27px;
                            padding:0 0 0 0;min-width:70px;height:33px;background:#008000;text-align: center;
                            justify-content:center;'>
            <p style='font-size:24px;position: relative;bottom:3px;font-weight:bold;' class='text-light'>" .
                $t_line2->diff_target_percent .
                '%' .
                "</p>
        </div>" .

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
    <div class='bottom_rank' style='padding: 10px 0 0 0;display: flex;margin:auto;width:410px;position: relative;top:30px;margin-left:478px;height:50px;
            border: solid 1.7px;'>" .
        "<div style='display: flex;min-width:270px;margin-right:5px;margin-left:5px;'>" .

            "<h3 style='color:black;font-weight: bold;font-size:24px;margin-left:8px;'>Rank</h3> &nbsp;&nbsp;
            <h3 style='margin-right:0px;font-weight: bold;min-width:50px;font-size:24px;color:black;'>" .
                $t_line2->row_num .
                '</h3>'.


            "
            <h3 style='font-weight: bold;font-size:24px;margin-left:10px;color:#0070C0;
                            position:relative;right:5px;
                '>Line</h3> &nbsp;&nbsp;
            <h3 style='font-weight: bold;font-size:24px;color:#0070C0;
                            position:relative;right:5px;'>" .
                $magic .
                "</h3>
        </div>" .

        "<h3 style='
                                    min-width:55px;min-height:28px;text-align:center;
                                    position: relative;bottom:3px;right:24.7px;
                                    font-size:24px;color:#ED3334;font-weight:bold;padding: 3px 0 0 7px;'>" . "-" .
            $t_line->diff_target_percent-$t_line2->diff_target_percent
            . "%" .
            "</h3> &nbsp;" .

        "<div style='margin-left:18px;display:flex;position: relative;bottom:2px;right:27px;
                            padding:0 0 0 0;min-width:70px;height:33px;background:#ED3334;text-align: center;
                            justify-content:center;'>
            <p style='font-size:24px;position: relative;bottom:3px;font-weight:bold;' class='text-light'>" .
                $t_line2->diff_target_percent .
                '%' .
                "</p>
        </div>" .

        "</div><br>
    ";
    }

    }
    } elseif ($t_line->row_num == 8) {
    echo "<div style='margin-top:-500px;'></div>";
    foreach ($top_line as $t_line2) {
    if ($t_line2->row_num == 6 || $t_line2->row_num == 7) {
    foreach ($getLine as $g_line) {
    if ($t_line2->l_id == $g_line->l_id) {
    $magic = $g_line->l_name;
    break;
    }
    }

    echo "
    <div class='bottom_rank' style='padding: 10px 0 0 0;display: flex;margin:auto;width:410px;position: relative;top:30px;margin-left:478px;height:50px;
            border: solid 1.7px;'>" .
        "<div style='display: flex;min-width:270px;margin-right:5px;margin-left:5px;'>" .

            "<h3 style='color:black;font-weight: bold;font-size:24px;margin-left:8px;'>Rank</h3> &nbsp;&nbsp;
            <h3 style='margin-right:0px;font-weight: bold;min-width:50px;font-size:24px;color:black;'>" .
                $t_line2->row_num .
                '</h3>'.


            "
            <h3 style='font-weight: bold;font-size:24px;margin-left:10px;color:#0070C0;
                            position:relative;right:5px;
                '>Line</h3> &nbsp;&nbsp;
            <h3 style='font-weight: bold;font-size:24px;color:#0070C0;
                            position:relative;right:5px;'>" .
                $magic .
                "</h3>
        </div>" .

        "<h3 style='
                                    min-width:55px;min-height:28px;text-align:center;
                                    position: relative;bottom:3px;right:24.7px;
                                    font-size:24px;color:#008000;font-weight:bold;padding: 3px 0 0 7px;'>" . "+" .
            $t_line2->diff_target_percent-$t_line->diff_target_percent
            . "%" .
            "</h3> &nbsp;" .

        "<div style='margin-left:18px;display:flex;position: relative;bottom:2px;right:27px;
                            padding:0 0 0 0;min-width:70px;height:33px;background:#008000;text-align: center;
                            justify-content:center;'>
            <p style='font-size:24px;position: relative;bottom:3px;font-weight:bold;' class='text-light'>" .
                $t_line2->diff_target_percent .
                '%' .
                "</p>
        </div>" .

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
    <div class='bottom_rank' style='padding: 10px 0 0 0;display: flex;margin:auto;width:410px;position: relative;top:30px;margin-left:478px;height:50px;
            border: solid 1.7px;'>" .
        "<div style='display: flex;min-width:270px;margin-right:5px;margin-left:5px;'>" .

            "<h3 style='color:black;font-weight: bold;font-size:24px;margin-left:8px;'>Rank</h3> &nbsp;&nbsp;
            <h3 style='margin-right:0px;font-weight: bold;min-width:50px;font-size:24px;color:black;'>" .
                $t_line2->row_num .
                '</h3>'.


            "
            <h3 style='font-weight: bold;font-size:24px;margin-left:10px;color:#0070C0;
                            position:relative;right:5px;
                '>Line</h3> &nbsp;&nbsp;
            <h3 style='font-weight: bold;font-size:24px;color:#0070C0;
                            position:relative;right:5px;'>" .
                $magic .
                "</h3>
        </div>" .

        "<h3 style='
                                    min-width:55px;min-height:28px;text-align:center;
                                    position: relative;bottom:3px;right:24.7px;
                                    font-size:24px;color:#ED3334;font-weight:bold;padding: 3px 0 0 7px;'>" . "-" .
            $t_line->diff_target_percent-$t_line2->diff_target_percent
            . "%" .
            "</h3> &nbsp;" .

        "<div style='margin-left:18px;display:flex;position: relative;bottom:2px;right:27px;
                            padding:0 0 0 0;min-width:70px;height:33px;background:#ED3334;text-align: center;
                            justify-content:center;'>
            <p style='font-size:24px;position: relative;bottom:3px;font-weight:bold;' class='text-light'>" .
                $t_line2->diff_target_percent .
                '%' .
                "</p>
        </div>" .

        "</div><br>
    ";
    }
    }
    } elseif ($t_line->row_num == 9) {
    echo "<div style='margin-top:-500px;'></div>";
    foreach ($top_line as $t_line2) {
    if ($t_line2->row_num == 7 || $t_line2->row_num == 8) {
    foreach ($getLine as $g_line) {
    if ($t_line2->l_id == $g_line->l_id) {
    $magic = $g_line->l_name;
    break;
    }
    }

    echo "
    <div class='bottom_rank' style='padding: 10px 0 0 0;display: flex;margin:auto;width:410px;position: relative;top:30px;margin-left:478px;height:50px;
            border: solid 1.7px;'>" .
        "<div style='display: flex;min-width:270px;margin-right:5px;margin-left:5px;'>" .

            "<h3 style='color:black;font-weight: bold;font-size:24px;margin-left:8px;'>Rank</h3> &nbsp;&nbsp;
            <h3 style='margin-right:0px;font-weight: bold;min-width:50px;font-size:24px;color:black;'>" .
                $t_line2->row_num .
                '</h3>'.


            "
            <h3 style='font-weight: bold;font-size:24px;margin-left:10px;color:#0070C0;
                            position:relative;right:5px;
                '>Line</h3> &nbsp;&nbsp;
            <h3 style='font-weight: bold;font-size:24px;color:#0070C0;
                            position:relative;right:5px;'>" .
                $magic .
                "</h3>
        </div>" .

        "<h3 style='
                                    min-width:55px;min-height:28px;text-align:center;
                                    position: relative;bottom:3px;right:24.7px;
                                    font-size:24px;color:#008000;font-weight:bold;padding: 3px 0 0 7px;'>" . "+" .
            $t_line2->diff_target_percent-$t_line->diff_target_percent
            . "%" .
            "</h3> &nbsp;" .

        "<div style='margin-left:18px;display:flex;position: relative;bottom:2px;right:27px;
                            padding:0 0 0 0;min-width:70px;height:33px;background:#008000;text-align: center;
                            justify-content:center;'>
            <p style='font-size:24px;position: relative;bottom:3px;font-weight:bold;' class='text-light'>" .
                $t_line2->diff_target_percent .
                '%' .
                "</p>
        </div>" .

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
    <div class='bottom_rank' style='padding: 10px 0 0 0;display: flex;margin:auto;width:410px;position: relative;top:30px;margin-left:478px;height:50px;
            border: solid 1.7px;'>" .
        "<div style='display: flex;min-width:270px;margin-right:5px;margin-left:5px;'>" .

            "<h3 style='color:black;font-weight: bold;font-size:24px;margin-left:8px;'>Rank</h3> &nbsp;&nbsp;
            <h3 style='margin-right:0px;font-weight: bold;min-width:50px;font-size:24px;color:black;'>" .
                $t_line2->row_num .
                '</h3>'.


            "
            <h3 style='font-weight: bold;font-size:24px;margin-left:10px;color:#0070C0;
                            position:relative;right:5px;
                '>Line</h3> &nbsp;&nbsp;
            <h3 style='font-weight: bold;font-size:24px;color:#0070C0;
                            position:relative;right:5px;'>" .
                $magic .
                "</h3>
        </div>" .

        "<h3 style='
                                    min-width:55px;min-height:28px;text-align:center;
                                    position: relative;bottom:3px;right:24.7px;
                                    font-size:24px;color:#ED3334;font-weight:bold;padding: 3px 0 0 7px;'>" . "-" .
            $t_line->diff_target_percent-$t_line2->diff_target_percent
            . "%" .
            "</h3> &nbsp;" .

        "<div style='margin-left:18px;display:flex;position: relative;bottom:2px;right:27px;
                            padding:0 0 0 0;min-width:70px;height:33px;background:#ED3334;text-align: center;
                            justify-content:center;'>
            <p style='font-size:24px;position: relative;bottom:3px;font-weight:bold;' class='text-light'>" .
                $t_line2->diff_target_percent .
                '%' .
                "</p>
        </div>" .

        "</div><br>
    ";
    }

    }
    } elseif ($t_line->row_num == 10) {
    echo "<div style='margin-top:-500px;'></div>";
    foreach ($top_line as $t_line2) {
    if ($t_line2->row_num == 7 || $t_line2->row_num == 8 || $t_line2->row_num == 9) {
    foreach ($getLine as $g_line) {
    if ($t_line2->l_id == $g_line->l_id) {
    $magic = $g_line->l_name;
    break;
    }
    }

    echo "
    <div class='bottom_rank' style='padding: 10px 0 0 0;display: flex;margin:auto;width:410px;position: relative;top:30px;margin-left:478px;height:50px;
            border: solid 1.7px;'>" .
        "<div style='display: flex;min-width:270px;margin-right:5px;margin-left:5px;'>" .

            "<h3 style='color:black;font-weight: bold;font-size:24px;margin-left:8px;'>Rank</h3> &nbsp;&nbsp;
            <h3 style='margin-right:0px;font-weight: bold;min-width:50px;font-size:24px;color:black;'>" .
                $t_line2->row_num .
                '</h3>'.


            "
            <h3 style='font-weight: bold;font-size:24px;margin-left:10px;color:#0070C0;
                            position:relative;right:5px;
                '>Line</h3> &nbsp;&nbsp;
            <h3 style='font-weight: bold;font-size:24px;color:#0070C0;
                            position:relative;right:5px;'>" .
                $magic .
                "</h3>
        </div>" .

        "<h3 style='
                                    min-width:55px;min-height:28px;text-align:center;
                                    position: relative;bottom:3px;right:24.7px;
                                    font-size:24px;color:#008000;font-weight:bold;padding: 3px 0 0 7px;'>" . "+" .
            $t_line2->diff_target_percent-$t_line->diff_target_percent
            . "%" .
            "</h3> &nbsp;" .

        "<div style='margin-left:18px;display:flex;position: relative;bottom:2px;right:27px;
                            padding:0 0 0 0;min-width:70px;height:33px;background:#008000;text-align: center;
                            justify-content:center;'>
            <p style='font-size:24px;position: relative;bottom:3px;font-weight:bold;' class='text-light'>" .
                $t_line2->diff_target_percent .
                '%' .
                "</p>
        </div>" .

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

    {{-- <script>
        location.reload(true);
    </script> --}}

</div>
