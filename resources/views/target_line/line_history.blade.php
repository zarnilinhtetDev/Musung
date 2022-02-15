@extends('layouts.app')

@section('content')

@section('content_2')

<div class="container-fluid">
    <h1 class="fw-bold heading-text">Line History</h1>
    <div class="my-4">
        <div class="row g-3 my-2">
            <div class="col-12 col-md-4">
                <label for="date">Select Date</label>
                <input type="date" class="form-control" id="date" />
                <input class="icon-btn-one btn my-2" type="button" value="Search" name="btn_history_submit"
                    id="btn_history_submit" />
            </div>
        </div>
    </div>
    <div id="ajax_load_div"></div>
</div>
<script>
    $("#btn_history_submit").click(function(e) {
e.preventDefault();
$.ajax({
type: "POST",
url: "{{ url('history') }}",
data: {
date_name: $("#date").val(),
},
success: function(result) {
$("#ajax_load_div").html(result);
},
error: function(result) {
    alert('error');
}
});
});
</script>
@endsection

@endsection
