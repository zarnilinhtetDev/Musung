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
        <h1 class="fw-bold heading-text">Line Entry</h1>

        <div class="container-fluid row p-0 m-0">
            <div class="col-12 col-md-4 my-3 p-0">
                <ul class="horizontal-slide" id="tabs">
                    <li class="span2">
                        <p>Date - {{ $date_string }} </p>
                    </li>
                    <li class="span2">
                        <p>{{ $start_time }} - {{ $end_time }}</p>
                    </li>
                </ul>
            </div>
            <div class="col text-center text-md-start">
                <div class="row m-0 p-0">
                    <div class="col-4">
                        <div id="digital-clock" class="text-white bg-secondary rounded-2 p-2 fs-5 text-center">
                        </div>
                    </div>
                    <div class="col">
                        <h1 class="fs-3 fw-bolder">Target = <span class="text-white bg-danger p-2 rounded-2">
                                {{ $m_target }}</span></h1>
                    </div>
                </div>
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
            <ul class="horizontal-slide" id="nav">
                <li class="span2">
                    <a href="#" class="active"> {{$l_name}}</a>
                </li>
                <li class="span3 bg-primary">
                    <p> @if($u_id == Auth::user()->id)
                        {{ Auth::user()->name }}
                        @endif</p>
                </li>
            </ul>
            <div id="tab-content">
                <div id="tab1" class="div_1">
                    <div class="row container-fluid p-0 m-0">
                        <div class="col-12 col-md-6 m-auto p-0">
                            <div style="overflow: auto;max-width:100%;max-height:550px;">
                                <table class="table table-striped my-2 tableFixHead results p-0">
                                    <thead>
                                        <tr>
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
                                        <tr>
                                            <td>{{ $time_name }}</td>
                                            <td><span id="div_target_{{ $time_id }}">{{ $actual_target_entry }}</span>
                                            </td>
                                            <td>
                                                @if ($div_actual_target!='')
                                                {{ $div_actual_target }}
                                                @elseif($div_actual_target=='')
                                                <span id="actual_target_{{ $time_id }}"></span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($div_actual_percent!='')
                                                {{ $div_actual_percent }} %
                                                @elseif($div_actual_percent=='') <span
                                                    id="actual_percentage_{{ $time_id }}"></span>
                                                @endif
                                            </td>
                                            <td> <button type="button" class="btn btn-primary w-75"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#LineEntryModal<?php echo $time_id; ?>"
                                                    data-bs-time-id="{{ $time_id }}"
                                                    data-bs-time-name="{{ $time_name }}" id="toggle_btn_{{ $time_id }}">
                                                    Fill
                                                </button>
                                            </td>
                                        </tr>
                                        <!-- Modal -->
                                        <div class="modal fade" id="LineEntryModal<?php echo $time_id; ?>" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="{{ url('line_entry_post') }}" method="POST">
                                                        <div class="modal-header">
                                                            <h1 class="fw-bold heading-text">{{ $time_name }}</h1>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
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
                                                                    @endphp

                                                                    @if($time_id == $p_detail_time_id)

                                                                    <div class="col-12 my-2">
                                                                        <div class="row container-fluid">
                                                                            <div class="col-12 col-md-4 m-auto">
                                                                                <h5 class="fw-bold heading-text">{{
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
                                                                                    placeholder="0" required />
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

                                                        $("#actual_target_"+p_detail_number).html(sum.toFixed(0));
                                                        $("#actual_percentage_" +p_detail_number).text(cal_percent);

                                                        $("#div_actual_target_input_"+p_detail_number).val($("#actual_target_"+p_detail_number).text());
                                                        $("#div_actual_percent_input_"+p_detail_number).val($("#actual_percentage_"+p_detail_number).text());
                                                    }
                                                });
                                        </script>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            {{-- <div class=" row container-fluid p-0 m-0">
                                <div class="col">Time</div>
                                <div class="col-2"></div>
                                <div class="col">Target</div>
                                <div class="col">Actual</div>
                            </div> --}}
                            {{-- <form action="{{ url('line_entry_post') }}" action="POST">

                                {{-- @for($i=0;$i<count($json);$i++) @php $data_id=$json[$i]['data_id'];
                                    $status=$json[$i]['status'];
                                    $time_name=$json[$i]['time_name'];$line_name=$json[$i]['line_name'];
                                    $target=$json[$i]['target']; $actual=$json[$i]['actual_target'];
                                    $time_id=$json[$i]['time_id']; $line_id=$json[$i]['line_id']; @endphp
                                    @if($status=='0' ) <div class="row container-fluid p-0 my-2">
                                    <div class="col">
                                        <input class="btn btn-secondary text-center text-white fw-bold w-100"
                                            type="text" value="{{ $time_name }}" readonly />
                                    </div>
                                    <div class="col-2 text-center m-auto">
                                        <span class="fw-bolder">=</span>
                                    </div>
                                    <div class="col">
                                        <input type="number" class="form-control text-center" value="{{ $actual }}"
                                            style="background-color:#607a9f !important; color:#fff;" readonly />
                                    </div>
                                    <div class="col">
                                        <input class="btn text-center text-dark fw-bold w-100"
                                            style="background-color:#ececec;" type="text" value="{{ $target }}"
                                            readonly />
                                    </div> --}}
                                    {{--
                        </div> --}}

                        {{-- @endif --}}

                        {{-- @if($status=='1')
                        <input type="hidden" name="status_one" value="1" />
                        <input type="hidden" name="data_id_one" value="{{ $data_id }}" />
                        <input type="hidden" name="time_id_one" value="{{ $time_id }}" />
                        <div class="row container-fluid p-0 my-2">
                            <div class="col">
                                <input class="btn btn-secondary text-center text-white fw-bold w-100" type="text"
                                    value="{{ $time_name }}" name="time_one" id="last-input" readonly />
                            </div>
                            <div class="col-2 text-center m-auto">
                                <span class="fw-bolder">=</span>
                            </div>
                            <div class="col">
                                <input class="input-numeric-one form-control text-center" type="number"
                                    style="background: #6ec33c !important;color:#fff;" name="actual_one" name="actual"
                                    value="{{ $actual }}" readonly />
                            </div>
                            <div class="col">
                                <input class="btn text-center text-dark fw-bold w-100" style="background-color:#ececec;"
                                    type="text" value="{{ $target }}" name="target_one" readonly />
                            </div>
                        </div>
                        @endif --}}

                        {{-- @if($status=='2')
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />
                        <input type="hidden" name="line_id" value="{{ $line_id }}" />
                        <input type="hidden" name="time_id" value="{{ $time_id }}" />
                        <input type="hidden" name="status" value="{{ $status }}" />
                        <input type="hidden" name="data_id" value="{{ $data_id }}" />
                        <div class="row container-fluid p-0 my-2">
                            <div class="col">
                                <input class="btn btn-secondary text-center text-white fw-bold w-100" type="text"
                                    value="{{ $time_name }}" name="time" id="last-input" readonly />
                            </div>
                            <div class="col-2 text-center m-auto">
                                <span class="fw-bolder">=</span>
                            </div>
                            <div class="col">
                                <input class="input-numeric form-control text-center" type="number" name="actual"
                                    style="background: #6ec33c !important;color:#fff;" placeholder="Number" readonly />
                            </div>
                            <div class="col">
                                <input class="btn text-center text-dark fw-bold w-100" style="background-color:#ececec;"
                                    type="text" value="100" name="target" readonly />
                            </div>
                        </div>
                        @endif --}}
                        {{-- @endfor --}}
                        {{-- <input type="hidden" id="add-time" name="add_time" /> --}}
                        {{--
                    </div>
                    <div class="col-12 col-md-6 p-0 m-auto">
                        <div id="numeric">
                            <table class="table-numeric">
                                <tbody>
                                    <tr>
                                        <td><button type="button" class="key" data-key="1">1</button>
                                        </td>
                                        <td><button type="button" class="key" data-key="2">2</button>
                                        </td>
                                        <td><button type="button" class="key" data-key="3">3</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><button type="button" class="key" data-key="4">4</button>
                                        </td>
                                        <td><button type="button" class="key" data-key="5">5</button>
                                        </td>
                                        <td><button type="button" class="key" data-key="6">6</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><button type="button" class="key" data-key="7">7</button>
                                        </td>
                                        <td><button type="button" class="key" data-key="8">8</button>
                                        </td>
                                        <td><button type="button" class="key" data-key="9">9</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><button type="button" class="key-del" disabled>Del</button>
                                        </td>
                                        <td><button type="button" class="key" data-key="0">0</button>
                                        </td>
                                        <td><button type="button" class="key-clear" disabled>Clear</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div id="numeric_one" style="display:none;">
                            <table class="table-numeric">
                                <tbody>
                                    <tr>
                                        <td><button type="button" class="key-one" data-key="1">1</button></td>
                                        <td><button type="button" class="key-one" data-key="2">2</button></td>
                                        <td><button type="button" class="key-one" data-key="3">3</button></td>
                                    </tr>
                                    <tr>
                                        <td><button type="button" class="key-one" data-key="4">4</button></td>
                                        <td><button type="button" class="key-one" data-key="5">5</button></td>
                                        <td><button type="button" class="key-one" data-key="6">6</button></td>
                                    </tr>
                                    <tr>
                                        <td><button type="button" class="key-one" data-key="7">7</button></td>
                                        <td><button type="button" class="key-one" data-key="8">8</button></td>
                                        <td><button type="button" class="key-one" data-key="9">9</button></td>
                                    </tr>
                                    <tr>
                                        <td><button type="button" class="key-del-one" disabled>Del</button></td>
                                        <td><button type="button" class="key-one" data-key="0">0</button></td>
                                        <td><button type="button" class="key-clear-one" disabled>Clear</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center my-4">
                            <input class="icon-btn-one btn my-2 w-50" type="submit" value="Save" name="submit" />
                        </div>
                    </div>
                    </form> --}}
                </div>
            </div>
        </div>
    </div>
    @endif
    @endif


</div>

@operator
<script type="text/javascript">
    window.location = "{{url('menu')}}";
</script>
@endoperator
@endsection

@endsection
