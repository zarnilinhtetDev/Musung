@extends('layouts.app')

@section('content')

@section('content_2')

<div class="row container-fluid">
    <div class="col-12 col-md-6 my-4 bg-white rounded shadow">
        {!! $chart->container() !!}
    </div>
    <div class="col-12 col-md-6 my-4">
        {!! $category_chart->container() !!}
    </div>
</div>
<script src="{{ $chart->cdn() }}"></script>
{{ $chart->script() }}
<script src="{{ $category_chart->cdn() }}"></script>
{{ $category_chart->script() }}
@endsection

@endsection
