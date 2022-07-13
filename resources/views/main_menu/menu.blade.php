@extends('layouts.app')

@section('content')
@php
// $hash = Hash::make('1111');
// echo $hash;
@endphp
@section('content_2')

@superadmin
<div class="container">
    <div class="container-fluid">
        <div class="row">
            <div class="col-6 col-md-4 dropdown">
                <button class="dropbtn">Account Management</button>
                <div class="dropdown-content">
                    <a href="{{ url('/member') }}">Member</a>
                </div>
            </div>
            <div class="col-6 col-md-4 dropdown">
                <button class="dropbtn">Production Status</button>
                <div class="dropdown-content">
                    <a href="{{ url('live_dash') }}">Today</a>
                    <a href="{{ url('line_history') }}">History</a>
                </div>
            </div>
            <div class="col-6 col-md-4 dropdown">
                <button class="dropbtn">Line Management</button>
                <div class="dropdown-content">
                    <a href="{{ url('line_entry') }}">Line Entry</a>
                    <a href="{{ url('line_detail') }}">Line Detail</a>
                    <a href="{{ url('line_setting') }}">Line Setting</a>
                </div>
            </div>
            <div class="col-6 col-md-4 dropdown">
                <button class="dropbtn">Report Management</button>
                <div class="dropdown-content">
                    <a href="{{ url('report') }}">Show Report</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsuperadmin


@owner
<div class="container">
    <div class="container-fluid">
        <div class="row">
            <div class="col-6 col-md-4 dropdown">
                <button class="dropbtn">Account Management</button>
                <div class="dropdown-content">
                    <a href="{{ url('/member') }}">Member</a>
                </div>
            </div>
            <div class="col-6 col-md-4 dropdown">
                <button class="dropbtn">Production Status</button>
                <div class="dropdown-content">
                    <a href="{{ url('live_dash') }}">Today</a>
                    <a href="{{ url('line_history') }}">History</a>
                </div>
            </div>
            <div class="col-6 col-md-4 dropdown">
                <button class="dropbtn">Line Management</button>
                <div class="dropdown-content">
                    <a href="{{ url('line_entry') }}">Line Entry</a>
                    <a href="{{ url('line_detail') }}">Line Detail</a>
                    <a href="{{ url('line_setting') }}">Line Setting</a>
                </div>
            </div>
            <div class="col-6 col-md-4 dropdown">
                <button class="dropbtn">Report Management</button>
                <div class="dropdown-content">
                    <a href="{{ url('report') }}">Show Report</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endowner

@admin
<div class="container">
    <div class="container-fluid">
        <div class="row">
            <div class="col-6 col-md-4 dropdown">
                <button class="dropbtn">Account Management</button>
                <div class="dropdown-content">
                    <a href="{{ url('/member') }}">Member</a>
                </div>
            </div>
            <div class="col-6 col-md-4 dropdown">
                <button class="dropbtn">Production Status</button>
                <div class="dropdown-content">
                    <a href="{{ url('live_dash') }}">Today</a>
                    <a href="{{ url('line_history') }}">History</a>
                </div>
            </div>
            <div class="col-6 col-md-4 dropdown">
                <button class="dropbtn">Line Management</button>
                <div class="dropdown-content">
                    <a href="{{ url('line_entry') }}">Line Entry</a>
                    <a href="{{ url('line_detail') }}">Line Detail</a>
                    <a href="{{ url('line_setting') }}">Line Setting</a>
                </div>
            </div>
            <div class="col-6 col-md-4 dropdown">
                <button class="dropbtn">Report Management</button>
                <div class="dropdown-content">
                    <a href="{{ url('report') }}">Show Report</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endadmin

@operator
<div class="container">
    <div class="container-fluid">
        <div class="row">
            <div class="col-6 col-md-4 dropdown">
                <button class="dropbtn">Account Management</button>
                <div class="dropdown-content">
                    <a href="{{ url('/member') }}">Member</a>
                </div>
            </div>
            <div class="col-6 col-md-4 dropdown">
                <button class="dropbtn">Production Status</button>
                <div class="dropdown-content">
                    <a href="{{ url('live_dash') }}">Today</a>
                    <a href="{{ url('line_history') }}">History</a>
                </div>
            </div>
            <div class="col-6 col-md-4 dropdown">
                <button class="dropbtn">Line Management</button>
                <div class="dropdown-content">
                    <a href="{{ url('line_detail') }}">Line Detail</a>
                    <a href="{{ url('line_setting') }}">Line Setting</a>
                </div>
            </div>
            <div class="col-6 col-md-4 dropdown">
                <button class="dropbtn">Report Management</button>
                <div class="dropdown-content">
                    <a href="{{ url('report') }}">Show Report</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endoperator

@line_manager
<script type="text/javascript">
    window.location = "{{url('line_entry')}}";
</script>
@endline_manager

<script>
    // var collapse_div_nav = $("#collapse_div");
    // var percent_dash_wrapper = $("#percent_dash_wrapper");
    // var live_dash_wrapper = $("#live_dash_wrapper");
    // $("#btn_navbar_close").click(function () {
    //     if (
    //         $(collapse_div_nav).hasClass("dis-to-none") &&
    //         $(percent_dash_wrapper).hasClass("dis-to-none")
    //     ) {
    //         $(collapse_div_nav).removeClass("dis-to-none");
    //         $(percent_dash_wrapper).removeClass("dis-to-none");
    //         $(live_dash_wrapper).addClass("col-md-8");
    //     } else {
    //         $(collapse_div_nav).addClass("dis-to-none");
    //         $(percent_dash_wrapper).addClass("dis-to-none");
    //         $(live_dash_wrapper).removeClass("col-md-8");
    //     }
    // });
</script>
@endsection

@endsection