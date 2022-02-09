@extends('layouts.app')

@section('content')

@section('content_2')

<div class="container">

    <livewire:live-dash />
    <div class="container-fluid">
        <h1 class="fw-bold heading-text">Line History</h1>
        <div class="my-4">
            <div class="row g-3 my-2">
                <div class="col-12 col-md-4">
                    <label for="date">Select Date</label>
                    <input type="date" class="form-control" id="date" />
                    <input class="icon-btn-one btn my-2" type="submit" value="Search" name="submit" />
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@endsection
