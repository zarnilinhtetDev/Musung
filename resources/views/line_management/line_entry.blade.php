<?php
ini_set('memory_limit', '-1');
?>
@extends('layouts.app')

@section('content')
@section('content_2')
<div class="container-fluid">
    @php
    $json_encode = json_encode($responseBody);
    $json_decode = array_reverse(json_decode($json_encode));

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
    $user_id = $d->id;
    $user_name = $d->name;
    $assign_date = $d->assign_date;

    $date_string = date("d.m.Y");

    if($date_string==$assign_date && $user_id == Auth::user()->id){
    $start_time = $s_time;
    $end_time = $e_time;
    $m_target = $main_target;
    $u_id = $user_id;
    $l_id = $line_id;
    $l_name = $line_name;
    $line_visible='yes';
    }
    if($date_string==$assign_date && $user_id != Auth::user()->id || $date_string!=$assign_date){
    $line_visible='no';
    }
    @endphp
    @endforeach

    @if(empty($json_decode))
    <div class="container text-center mt-3">
        <h3 class="fs-2 text-danger fw-bold">Line is not yet opened by OPERATOR, please check later !!</h3>
    </div>
    @elseif(!empty($json_decode))
    @if($line_visible == 'no')
    <div class="container text-center mt-3">
        <h3 class="fs-2 text-danger fw-bold">Line is not yet opened by OPERATOR, please check later !!</h3>
    </div>
    @endif

    @if($line_visible=='yes')
    <div class="container-fluid p-0">
        <div class="container-fluid row p-0 m-0 text-center d-flex align-items-center">
            <div class="col-3 p-0">
                <h1 class="fw-bold">Line Entry</h1>
            </div>
            <div class="col-5 p-0">
                <div id="digital-clock" class="text-white fw-bolder bg-secondary rounded-2 p-1 fs-5 text-center">
                </div>
            </div>
            <div class="col text-center p-1">
                <ul class="horizontal-slide" id="tabs">
                    <li class="span2 span4">
                        <p class="p-1">{{ $date_string }} </p>
                    </li>
                    <li class="span2 span4">
                        <p class="p-1">
                            {{ date('g:iA',strtotime($start_time)) }} - {{ date('g:iA',strtotime($end_time)) }}
                        </p>
                    </li>
                </ul>
            </div>
        </div>
        <script>
            /// Live Clock in line_entry.blade
            function showTime() {
                var date = new Date().toLocaleTimeString(
                    "en-US",
                    Intl.DateTimeFormat().resolvedOptions().timeZone
                );

                document.getElementById("digital-clock").innerHTML = date;
            }
            setInterval(showTime, 1000);

            /// Live Clock in line_entry.blade End
        </script>

        <div id="tabmenu" class="container-fluid my-3 p-0">
            <div class="container-fluid row m-auto p-0 d-flex align-items-center">
                <div class="col border border-secondary text-center m-1 p-1">
                    <h1 class="fs-5 text-center text-secondary m-0 fw-bolder"> {{$l_name}}</h1>
                </div>
                <div class="col border border-secondary text-center m-1 p-1">
                    <h1 class="fs-5 text-center m-0 text-secondary fw-bolder"> @if($u_id == Auth::user()->id)
                        {{ Auth::user()->name }}
                        @endif</h1>
                </div>
                <div class="col-8 text-end">
                    <h1 class="fs-3 fw-bold m-0 border-none"><span style="background-color:#fff !important;">Today
                            main target =
                        </span><span class="text-danger border border-danger p-2 rounded-2">
                            {{ $m_target }}</span></h1>
                </div>
            </div>
            <div id="tab-content">
                <div id="tab1" class="div_1">
                    <div class="row container-fluid p-0 m-0">
                        <div class="col-12 col-md-0 col-lg-8 m-auto p-0">
                            <div style="overflow: auto;max-width:100%;">
                                <table class="table table-striped my-2 tableFixHead results p-0">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Time</th>
                                            <th>Target</th>
                                            <th>Actual Target</th>
                                            <th>Percentage</th>
                                            <th>Data</th>
                                        </tr>
                                    </thead>
                                    <tbody>
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
                                        $actual_target_entry = $d->actual_target_entry;
                                        @endphp
                                        @if($time_name != "temp")
                                        <tr class="line_entry_tr_border">
                                            <td>
                                                <?php echo date('g:i A',strtotime($time_name)); ?>
                                            </td>
                                            <td>
                                                <span id="div_target_{{ $time_id }}">{{ $actual_target_entry }}
                                                </span>
                                            </td>
                                            <td>
                                                @if ($div_actual_target!='')
                                                <span id="new_div_actual_target_{{ $time_id }}">
                                                    {{ $div_actual_target }}
                                                </span>

                                                @elseif($div_actual_target=='')
                                                <input type="hidden" id="actual_target_{{ $time_id }}" />
                                                @endif
                                            </td>
                                            <td>
                                                @if ($div_actual_percent!='')
                                                <span id="new_div_actual_percent_{{ $time_id }}">

                                                </span>

                                                @elseif($div_actual_percent=='')
                                                <input type="hidden" id="actual_percentage_{{ $time_id }}" />
                                                @endif
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-primary w-100"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#LineEntryModal<?php echo $time_id; ?>"
                                                    data-bs-time-id="{{ $time_id }}"
                                                    data-bs-time-name="{{ $time_name }}" id="toggle_btn_{{ $time_id }}">
                                                    Fill
                                                </button>
                                            </td>
                                            <script>
                                                var new_div_target = $("#div_target_{{ $time_id }}").text();
                                                var new_div_actual_target = $("#new_div_actual_target_{{ $time_id }}").text();
                                                var new_div_actual_percent = $("#new_div_actual_percent_{{ $time_id }}");

                                                var new_percent_cal= ((new_div_actual_target /new_div_target) * 100).toFixed(0) + "%";

                                                new_div_actual_percent.text(new_percent_cal);
                                            </script>
                                        </tr>
                                        @endif
                                        <!-- Modal -->
                                        <div class="modal fade" id="LineEntryModal<?php echo $time_id; ?>" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="{{ url('line_entry_post') }}" method="POST">
                                                        <div class="modal-header">
                                                            <h1 class="fw-bold heading-text">
                                                                <?php echo date('g:i A',strtotime($time_name)); ?>
                                                            </h1>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close">
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="container-fluid">
                                                                <div class="row">
                                                                    @foreach($p_detail as $detail)
                                                                    @php $p_detail_id =
                                                                    $detail->p_detail_id;$p_detail_assign_id=
                                                                    $detail->assign_id;$p_detail_l_id=$detail->l_id;
                                                                    $p_detail_p_cat_id
                                                                    =$detail->p_cat_id;$p_detail_p_name
                                                                    =$detail->p_name;$p_detail_qty=$detail->quantity;
                                                                    $p_detail_time_id = $detail->time_id;
                                                                    $p_detail_style_no = $detail->style_no;
                                                                    $div_actual_target_exist =
                                                                    $detail->div_actual_target;
                                                                    $ot_status = $detail->ot_status;
                                                                    @endphp

                                                                    @if($time_id == $p_detail_time_id)

                                                                    <div class="col-12 my-2">
                                                                        <div class="row container-fluid">
                                                                            <div class="col-12 col-md-4 m-auto">
                                                                                <h5 class="fw-bold heading-text">#{{
                                                                                    $p_detail_style_no }}, {{
                                                                                    $p_detail_p_name }}</h5>
                                                                            </div>
                                                                            <div class="col-12 col-md-4">
                                                                                <label>Target</label>
                                                                                <input type="number"
                                                                                    class="form-control" name="target"
                                                                                    value=@foreach($p_detail_2 as $p_2)
                                                                                    @php
                                                                                    $p_2_detail_id=$p_2->p_detail_id;
                                                                                $div_quantity = $p_2->div_quantity;

                                                                                if($p_2_detail_id == $p_detail_id){
                                                                                echo $div_quantity;
                                                                                }
                                                                                @endphp
                                                                                @endforeach
                                                                                readonly />
                                                                            </div>
                                                                            <div class="col-12 col-md-4">
                                                                                <label>Actual</label>
                                                                                <input type="number"
                                                                                    class="form-control"
                                                                                    name="p_detail_actual_target[]"
                                                                                    id="p_detail_actual_target_{{ $time_id }}"
                                                                                    required
                                                                                    value="{{ $div_actual_target_exist }}" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <input type="hidden" name="assign_date"
                                                                        value="{{ $date_string }}" />
                                                                    <input type="hidden" name="line_id"
                                                                        value="{{ $p_detail_l_id }}" />
                                                                    <input type="hidden" name="p_detail_id[]"
                                                                        value="{{ $p_detail_id }}" />
                                                                    @endif
                                                                    @endforeach
                                                                    <input type="hidden" name="time_id"
                                                                        value="{{ $time_id }}" />
                                                                    <input type="hidden"
                                                                        name="div_actual_target_input_{{ $time_id }}"
                                                                        id="div_actual_target_input_{{ $time_id }}" />
                                                                    <input type="hidden"
                                                                        name="div_actual_percent_input_{{ $time_id }}"
                                                                        id="div_actual_percent_input_{{ $time_id }}" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <script>
                                            $("#toggle_btn_<?php echo $time_id; ?>").click(function() {
                                                    var p_detail_number = "<?php echo $time_id; ?>";(p_detail_number);
                                                    calculateSum();
                                                    $(".modal-content #p_detail_actual_target_"+p_detail_number).on(
                                                        "keydown keyup",
                                                        function () {
                                                            calculateSum();
                                                        }
                                                    );
                                                    function calculateSum() {
                                                        var sum = 0;
                                                        var p_detail_number = "<?php echo $time_id; ?>";
                                                        var div_target = parseInt($("#div_target_"+p_detail_number).text());

                                                        //iterate through each textboxes and add the values
                                                        $(".modal-content #p_detail_actual_target_"+p_detail_number).each(function () {
                                                            //add only if the value is number
                                                            if (!isNaN(this.value) && this.value.length != 0) {
                                                                sum += parseFloat(this.value);
                                                                $(this).css("background-color", "#FEFFB0");
                                                            } else if (this.value.length != 0) {
                                                                $(this).css("background-color", "red");
                                                            }
                                            });
                                                       var cal_percent= ((sum / "<?php echo $actual_target_entry; ?>") * 100).toFixed(0) + "%";

                                                        $("#actual_target_"+p_detail_number).val(sum.toFixed(0));
                                                        $("#actual_percentage_" +p_detail_number).val(cal_percent);

                                                        $("#div_actual_target_input_"+p_detail_number).val($("#actual_target_"+p_detail_number).val());
                                                        $("#div_actual_percent_input_"+p_detail_number).val($("#actual_percentage_"+p_detail_number).val());
                                                    }
                                                });
                                        </script>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endif
        </div>

    </div>
</div>

@operator
<script type="text/javascript">
    window.location = "{{url('menu')}}";
</script>
@endoperator
@endsection

@endsection
