@extends('layouts.app')

@section('content')

@section('content_2')

<div class="container">
    <h1 class="heading-text">Choose Theme</h1>
    <div class="row container-fluid text-center">
        <div class="col-6 col-md-3">
            <div data-theme="light" class="switch shadow rounded btn" id="switch-1">Light Mode</div>
        </div>
        <div class="col-6 col-md-3">
            <div data-theme="dark" class="switch shadow rounded btn text-white" id="switch-4">Dark Mode</div>
        </div>
        <div class="col-6 col-md-3">
            <div data-theme="gray" class="switch shadow rounded btn text-white" id="switch-2">Gray Mode</div>
        </div>
        <div class="col-6 col-md-3">
            <div data-theme="purple" class="switch shadow rounded btn text-white" id="switch-3">Purple Mode</div>
        </div>
    </div>
</div>
@endsection

@endsection
