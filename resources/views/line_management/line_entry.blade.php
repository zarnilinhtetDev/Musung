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
    $p_detail_id=$d->p_detail_id;
    $p_cat_id=$d->p_cat_id;
    $p_name=$d->p_name;
    $qty = $d->quantity;
    $actual_target=$d->actual_target_entry;
    $user_id = $d->id;
    $user_name = $d->name;
    @endphp
    @endforeach
    <div class="container-fluid p-0">
        <h1 class="fw-bold heading-text">Line Entry</h1>

        <div class="container-fluid row p-0 m-0">
            <div class="col-12 col-md-6 my-3 p-0">
                <ul class="horizontal-slide" id="tabs">
                    <li class="span2">
                        <p>Date -
                            @php
                            $date_string = date("d.m.y"); echo $date_string;
                            @endphp
                        </p>
                    </li>
                    <li class="span2">
                        <p>{{ $s_time }} - {{ $e_time }}</p>
                    </li>
                </ul>
            </div>
            <div class="col text-center text-md-start m-auto">
                <h1 class="fs-3 fw-bolder">Target = <span class="text-white bg-danger p-2 rounded-2">{{ $main_target
                        }}</span></h1>
            </div>
        </div>

        <div id="tabmenu" class="container-fluid my-3 p-0">
            <ul class="horizontal-slide" id="nav">
                <li class="span2">
                    <a href="#" class="active"> @if($user_id == Auth::user()->id)
                        {{ $line_name }}
                        @endif</a>
                </li>
                <li class="span3 bg-primary">
                    <p> @if($user_id == Auth::user()->id)
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
                                            <th>Category</th>
                                            <th>Target</th>
                                            <th>Actual Target</th>
                                            <th>Percentage</th>
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
                                        $p_detail_id=$d->p_detail_id;
                                        $p_cat_id=$d->p_cat_id;
                                        $p_name=$d->p_name;
                                        $qty = $d->quantity;
                                        $actual_target=$d->actual_target_entry;
                                        $user_id = $d->id;
                                        $user_name = $d->name;
                                        @endphp
                                        <tr>
                                            <td>{{ $time_name }}</td>
                                            <td>{{ $category }}</td>
                                            <td>{{ $time_name }}</td>
                                            <td>{{ $time_name }}</td>
                                            <td>{{ $time_name }}</td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                            {{-- <div class="row container-fluid p-0 m-0">
                                <div class="col">Time</div>
                                <div class="col-2"></div>
                                <div class="col">Target</div>
                                <div class="col">Actual</div>
                            </div> --}}
                            <form action="{{ url('line_entry_post') }}" action="POST">

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
                    </div>
                    <div class="col-12 col-md-6 p-0 m-auto">
                        <div id="numeric">
                            <table class="table-numeric">
                                <tbody>
                                    <tr>
                                        <td><button type="button" class="key" data-key="1">1</button></td>
                                        <td><button type="button" class="key" data-key="2">2</button></td>
                                        <td><button type="button" class="key" data-key="3">3</button></td>
                                    </tr>
                                    <tr>
                                        <td><button type="button" class="key" data-key="4">4</button></td>
                                        <td><button type="button" class="key" data-key="5">5</button></td>
                                        <td><button type="button" class="key" data-key="6">6</button></td>
                                    </tr>
                                    <tr>
                                        <td><button type="button" class="key" data-key="7">7</button></td>
                                        <td><button type="button" class="key" data-key="8">8</button></td>
                                        <td><button type="button" class="key" data-key="9">9</button></td>
                                    </tr>
                                    <tr>
                                        <td><button type="button" class="key-del" disabled>Del</button></td>
                                        <td><button type="button" class="key" data-key="0">0</button></td>
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
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@endsection
