@extends('layouts.app')

@section('content')
@php
// $hash = Hash::make('1111');
// echo $hash;
@endphp
@section('content_2')
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
                <button class="dropbtn">Target Lines</button>
                <div class="dropdown-content">
                    <a href="{{ url('live_dash') }}">Today Lines</a>
                    <a href="{{ url('line_history') }}">Line History</a>
                </div>
            </div>
            <div class="col-6 col-md-4 dropdown">
                <button class="dropbtn">Line Management</button>
                <div class="dropdown-content">
                    <a href="{{ url('line_entry') }}">Line Entry</a>
                    <a href="{{ url('line_detail') }}">Line Detail</a>
                    <a href="{{ url('line_manager_detail') }}">Line Manager Detail</a>
                    <a href="{{ url('line_setting') }}">Line Setting</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endadmin

@line_manager
<script type="text/javascript">
    window.location = "{{url('line_entry')}}";
</script>
@endline_manager
@endsection

@endsection
