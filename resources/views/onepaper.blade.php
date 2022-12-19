@extends('layouts.app2')
@section('content')
@section('content_2')

<head>
    {{-- <img src="{{asset('img/logo_2.png')}}"> --}}
    <script src="{{ asset('js/custom_js.js') }}" defer></script>
    <script src="{{ asset('js/clock.js') }}" defer></script>
    <script src="{{ asset('js/jquery_numpad.js') }}" defer></script>
    <script src="{{ asset('js/theme_setting.js') }}" defer></script>

    <link href="{{ asset('css/jquery_numpad.css') }}" rel="stylesheet" defer>
    <link href="{{ asset('css/clock.css') }}" rel="stylesheet" defer>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" defer>
    <link rel="shortcut icon" href="{{URL::asset('img/logo_2.png')}}" defer>
</head>

<div style="height: 40px"></div>



<div class="container-fluid">

    @php $date_string = date("d.m.Y");
    $date_string_for_export_pdf = date("Y_m_d", strtotime($date_string)); @endphp
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



    <div style="height: 70px"></div>



    {{-- <div class="col-12 col-md-8" id="live_dash_wrapper"> --}}
        @livewire('one', ['line_id' => $line_id,
        'line_assign_id' => $line_assign_id,
        'line_date' => $line_date
        ])
        {{-- </div> --}}


    @endsection

    @endsection
