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
                    <a href="index.php?link=web_view">Member</a>
                    <a href="index.php?link=web_product">Operator</a>
                    <a class="sidebar-link" href="index.php?link=product_photo">Line Manager</a>
                </div>
            </div>
            <div class="col-6 col-md-4 dropdown">
                <button class="dropbtn">Target Lines</button>
                <div class="dropdown-content">
                    <a href="index.php?link=member&role=all&r_id=0">Today Lines</a>
                    <a href="index.php?link=driver">Line History</a>
                </div>
            </div>
            <div class="col-6 col-md-4 dropdown">
                <button class="dropbtn">Line Management</button>
                <div class="dropdown-content">
                    <a href="#">Line Detail</a>
                    <a href="#">Line Setting</a>
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
