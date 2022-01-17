@extends('layouts.app')

@section('content')
@extends('layouts.navbar_sidebar')
@section('content_2')
<div class="container">
    <div class="container-fluid">
        <h1 class="fw-bold heading-text">Line History</h1>
        <div class="my-4">
            <div class="row g-3 my-2">
                <div class="col-5">
                    <div class="input-group date" id="datepicker">
                        <input type="text" class="form-control" id="date" />
                        <span class="input-group-append">
                            <span class="input-group-text bg-light d-block">
                                <i class="fa fa-calendar"></i>
                            </span>
                        </span>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@endsection
