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

    // $date_string = date("d.m.Y");

    @endphp
    @endforeach
    @php $date_string = date("d.m.Y"); @endphp
    <div class="container-fluid">
        <ul class="horizontal-slide" style="" id="tabs">
            <li class="span2 bg-transparent">
                <input class="icon-btn-one btn my-2" type="submit" value="Date - {{ $date_string }}" />
            </li>
            <li class="span2 bg-transparent">
                <input class="icon-btn-one icon-btn-one-2 btn my-2" type="submit" value="Export to Excel"
                    name="submit" />
            </li>
        </ul>
    </div>
    <div class="row container-fluid p-0 my-3 mx-auto">
        <livewire:dash1 />
        <div class="col-12 col-md-4 p-sm-0 p-md-auto my-sm-2 my-md-0 top-3">
            <livewire:dash-chart />
        </div>
    </div>
    <div class="container-fluid p-0 my-3">
        <div class="row">
            <livewire:dash2 />
            <livewire:dash3 />
        </div>
    </div>
</div>
@endsection

@endsection
