@extends('layouts.app')

@section('content')
@section('content_2')

@php
$date_string = date("d.m.Y");
$json = json_decode(json_encode($line),true); ///Line DB
@endphp

<div class="container-fluid">
    <h1 class="fw-bold heading-text">Daily Production Detail</h1>
    <div class="container-fluid">
        <div class="row">
            <div class="col-4">
                <ul class="list-group scroll-vertical-ul">
                    @for($i=0; $i<count($json);$i++) @php $l_id=$json[$i]['l_id']; $l_name=$json[$i]['l_name'];
                        $l_is_delete=$json[$i]['is_delete']; $l_status=$json[$i]['a_status']; $l_pos=$json[$i]['l_pos'];
                        @endphp <li class="list-group-item open" data-id="{{ $l_id }}">
                        {{ $l_name }}
                        </li>
                        @endfor
                </ul>
            </div>
            <div class="col" id="ajax_load_div">

            </div>
        </div>

        <script>
            $(function() {
$(".open").on('click', function(e) {
e.preventDefault(); // in chase you change to a link or button
var id = $(this).data('id');
$.ajax({
type: "POST",
url: "{{ url('daily_prod') }}",
data: {
line_id: id,
},       cache: false,
success: function(result) {
//  console.log(result);
$("#ajax_load_div").html(result);
},
error: function(result) {
console.log(result);
alert('error');
}
});
});
});
        </script>
    </div>
</div>

@endsection
@endsection
