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

    @endphp
    @endforeach
    @php $date_string = date("d.m.Y");
    $date_string_for_export_pdf = date("Y_m_d", strtotime($date_string)); @endphp

    {{-- <div class="row container-fluid pt-4 m-0">
        <div
            class="col-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start text-center text-md-start mb-2 mb-lg-0">
            <h2 class="m-0 fw-bold fs-2 date_string">{{ $date_string }}</h2>
        </div>
        <div class="col-12 col-md-7 my-auto text-center justify-content-center justify-content-md-start text-md-start p-0"
            id="clock">
            <p class="unit">
                <span id="hours"></span>
                <span class="unit2">:</span>
                <span id="minutes"></span>
                <span class="unit2">:</span>
                <span id="seconds"></span>
                <span id="ampm"></span>
            </p>
            <span class="unit2">:</span>
            <p class="unit" id="minutes"></p>
            <span class="unit2">:</span>
            <p class="unit" id="seconds"></p>
            <p class="unit" id="ampm"></p>
        </div>
    </div> --}}

    <div class="row container-fluid pt-4">
        <div class="col-12 col-md-6 m-auto">
            <ul class="horizontal-slide" style="" id="tabs">
                <li class="span2 bg-transparent">
                    <h2 class="m-0 fw-bold">Date - {{ $date_string }}</h2>
                </li>
            </ul>
        </div>
        <div class="col-12 col-md-6 my-auto text-center text-md-start p-0">
            <div>
                <h2 class="m-0 fw-bold" id="digital-clock-2"></h2>
            </div>
            <script>
                /// Live Clock in line_entry.blade
                function showTime() {
                    var date = new Date().toLocaleTimeString(
                        "en-US",
                        Intl.DateTimeFormat().resolvedOptions().timeZone
                    );
                    document.getElementById("digital-clock-2").innerHTML = date;
                }
                setInterval(showTime, 1000);
                /// Live Clock in line_entry.blade End
            </script>
        </div>
    </div>


    <div id="history_div">
        <div class="row container-fluid p-0 my-3 mx-auto">
            <div class="col-12 col-md-8" id="live_dash_wrapper">
                <livewire:dash1 />
            </div>
            <div class="col-12 col-md-4 p-sm-0 p-md-2 my-sm-2 my-md-0 top-3" id="percent_dash_wrapper">
                <livewire:dash-chart />
            </div>

        </div>
        <div class="container-fluid p-0 my-3">
            <div class="row">
                {{--
                <livewire:dash2 />
                <livewire:dash3 /> --}}
            </div>
        </div>
    </div>
</div>

@endsection

@endsection
