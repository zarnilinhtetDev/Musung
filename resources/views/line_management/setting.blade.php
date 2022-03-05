@extends('layouts.app')

@section('content')
@section('content_2')

@admin
@php $json = json_decode($responseBody,true); ///Line DB
$json2 = json_decode(json_encode($responseBody2),true); ////User DB
$num = 1;
@endphp
<div class="container">
    <div class="container-fluid">
        <h1 class="fw-bold heading-text">Line Setting</h1>
        <div class="my-4">
            <div class="row my-2">
                @for($i=0;$i<count($json);$i++) @php $l_id=$json[$i]['l_id']; $l_name=$json[$i]['l_name'];
                    $is_delete=$json[$i]['is_delete'];$a_status=$json[$i]['a_status']; @endphp <div
                    class="col-6 col-md-3 text-center my-2">
                    @if ($a_status==1)
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-success w-75" data-bs-toggle="modal"
                        data-bs-target="#LineModalActive<?php echo $l_id; ?>" data-bs-l-id-active="{{ $l_id }}"
                        data-bs-l-name-active="{{ $l_name }}" data-bs-l-status-active="{{ $a_status }}"
                        id="line_setting_btn">
                        {{$l_name}}
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="LineModalActive<?php echo $l_id;?>" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body text-start">
                                    <form action="" method="POST">
                                        <input type="hidden" name="l_id" id="l_id_setting_active" value="{{ $l_id }}">
                                        @for($k=0;$k<count($json);$k++) @php $new_l_id=$json[$k]['l_id'];
                                            $l_name=$json[$k]['l_name']; @endphp @if ($new_l_id==$l_id) <div
                                            class="mt-2 mb-4">
                                            <h1 class="fw-bold heading-text">{{ $l_name }}</h1>
                                </div> @endif @endfor
                                <div class="row g-3 my-2">
                                    <div class="col-12 col-md-4 mt-0">
                                        <label>Over Time (minute)</label>​
                                        <input type="number" class="form-control" name="over_time_minute"
                                            placeholder="100" required />
                                    </div>
                                    <div class=" col-12 col-md-4 mt-0">
                                        <label>Over Time Target</label>
                                        <input type="number" class="form-control" name="over_time_target"
                                            placeholder="100" required />
                                    </div>
                                </div>
                                <div style="overflow: auto;max-width:100%;max-height:600px;padding:0.5rem;">
                                    <table class="table" id="dynamic_field_2">
                                        <tr class="setting-tr-2">
                                            <td>
                                                <label>Category</label>
                                                <livewire:select-box-setting2 />
                                            </td>
                                            <td>
                                                <label>Product Name</label>
                                                <input type="text" class="form-control" id="p_name" name="p_name[]"
                                                    placeholder="Musung Shirt" required />
                                            </td>
                                            <td>
                                                <label>Target</label>
                                                <input type="number" class="form-control" id="setting_target"
                                                    name="category_target[]" placeholder="Target" required />
                                            </td>
                                            <td>
                                                <br />
                                                <button type="button" name="add" id="add_product_detail_2"
                                                    class="btn btn-success"><i
                                                        class="fas fa-plus-square fa-lg"></i></button>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-12 col-md-4">
                                    <input class="icon-btn-one btn my-2" type="submit" value="Add" name="submit" />
                                </div>
                                </form>
                                <script>
                                    $("#line_assign_overtime_post").submit(function(e) {
                    e.preventDefault();

                    // Get NON-INPUT table cell data
                    var box_2 = {};
                    var boxes_2 = [];
                        $('#dynamic_field_2 .setting-tr-2').each(function() {
                            var category_select = $('#category_select', this).val();
                            var p_name = $('#p_name', this).val();
                            var category_target = $('#setting_target', this).val();
                    box_2 = {
                        category_select: category_select,
                        p_name: p_name,
                        category_target: category_target
                    }
                    boxes_2.push(box_2);
                        });

                    // Get all INPUT form data and organize as array
                    var formData_2 = $(this).serializeArray();

                    // // Encode with JSON
                    var subArray_2 = JSON.stringify(boxes_2);

                    // // Add to formData array
                    formData_2.push({name: 'sub', value: subArray_2});
                console.log(formData_2);
                    // Submit with AJAX
                    // $.ajax({
                    //     type: "POST",
                    //     url: "{{ url('line_assign_post') }}",
                    //     data: formData,
                    //     type: 'post',
                    //     success: function(data) {
                    //         location.reload();
                    //     }
                    // });
                });
                                </script>

                                <div style="overflow: auto;max-width:100%;max-height:600px;padding:0.5rem;">
                                    <h1 class="fw-bold heading-text fs-4">Line Details</h1>
                                    <table class="table table-striped my-2  tableFixHead results p-0">
                                        <thead>
                                            <tr class="tr-2">
                                                <th scope="col">No.</th>
                                                <th scope="col">Line Manager Name</th>
                                                <th scope="col">Target</th>
                                                <th scope="col">Total Working Hour(s)</th>
                                                <th scope="col">Starting Time</th>
                                                <th scope="col">Lunch Time</th>
                                                <th scope="col">Ending Time</th>
                                                <th scope="col">Working
                                                    Progress by (minute)</th>
                                            </tr>
                                        </thead>
                                        <tbody id="myTable">
                                            <!-- line_assign_2 is from LineAssignController -->
                                            @foreach ($line_assign_2 as $l_2)
                                            @php
                                            $a_id=$l_2->assign_id;
                                            $a_line_id=$l_2->l_id;
                                            $a_line_status=$l_2->a_status;
                                            $a_line_user_id=$l_2->user_id;
                                            $a_main_target=$l_2->main_target;
                                            $a_s_time=$l_2->s_time;
                                            $a_e_time=$l_2->e_time;
                                            $a_lunch_s_time = $l_2->lunch_s_time;
                                            $a_lunch_e_time = $l_2->lunch_e_time;
                                            $a_work_min=$l_2->cal_work_min;
                                            $a_work_hr=$l_2->t_work_hr;
                                            $a_created_at=$l_2->created_at;
                                            $a_updated_at=$l_2->updated_at;
                                            $u_name = $l_2->name;
                                            @endphp

                                            @if ($a_line_id==$l_id)
                                            <tr>
                                                <td>{{ $num++ }}</td>
                                                <td>{{ $u_name }}</td>
                                                <td>{{ $a_main_target }}</td>
                                                <td>{{ $a_work_hr }}</td>
                                                <td>{{ $a_s_time }}</td>
                                                <td>{{ $a_lunch_s_time }} - {{ $a_lunch_e_time }}</td>
                                                <td>{{ $a_e_time }}</td>
                                                <td>{{ $a_work_min }}</td>
                                            </tr>
                                            @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div style="overflow: auto;max-width:100%;max-height:550px;padding:0.5rem;">
                                    <h1 class="fw-bold heading-text fs-4">Over Time Details
                                    </h1>
                                    <table class="table table-striped my-2 tableFixHead results p-0">
                                        <thead>
                                            <tr class="tr-2">
                                                <th scope="col">
                                                    No.</th>
                                                <th scope="col">Over Time (minute)</th>
                                                <th scope="col">
                                                    Over Time Target</th>
                                                <th>Create Date</th>
                                                <th>Update Date</th>
                                            </tr>
                                        </thead>
                                        @php $number = 1; @endphp
                                        <tbody id="myTable">
                                            @foreach($overTime as $ot)
                                            @if ($ot->l_id==$l_id)
                                            <tr>
                                                <td>{{ $number++ }}</td>
                                                <td>{{ $ot->ot_min }}</td>
                                                <td>{{ $ot->ot_target }}</td>
                                                <td>{{ $ot->created_at }}</td>
                                                <td>{{ $ot->updated_at }}</td>
                                            </tr>
                                            @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div style="overflow: auto;max-width:100%;max-height:550px;padding:0.5rem;">
                                    <h1 class="fw-bold heading-text fs-4">Product Details
                                    </h1>
                                    <table class="table table-striped my-2 tableFixHead results p-0">
                                        <thead>
                                            <tr class="tr-2">
                                                <th scope="col">
                                                    No.</th>
                                                <th scope="col">Product Name</th>
                                                <th scope="col">Category Name</th>
                                                <th>Quantity</th>
                                            </tr>
                                        </thead>
                                        @php $number = 1; @endphp
                                        <tbody id="myTable">
                                            @foreach($p_detail as $p)
                                            @if ($p->l_id==$l_id)
                                            <tr>
                                                <td>{{ $number++ }}</td>
                                                <td>{{ $p->p_name }}</td>
                                                <td>{{ $p->p_cat_id }}</td>
                                                <td>{{ $p->quantity }}</td>
                                            </tr>
                                            @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-12 col-md-6 m-auto text-center">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            @elseif($a_status==0)
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-secondary w-75" data-bs-toggle="modal" data-bs-target="#LineModal"
                data-bs-l-id="{{ $l_id }}" data-bs-l-name="{{ $l_name }}" id="line_setting_btn">
                {{$l_name}}
            </button>
            @endif

        </div>
        @endfor
    </div>
    <!-- Modal -->
    <div class="modal fade" id="LineModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body text-start">
                    {{-- <form action="{{ url('line_assign_post') }}" method="POST" id="line_assign_post"> --}}
                        <form method="POST" id="line_assign_post">
                            <input type="hidden" name="l_id" id="l_id_2">
                            <input type="hidden" id="s_time" />
                            <input type="hidden" id="e_time" />

                            <div class="mt-2 mb-4">
                                <h1 class="fw-bold heading-text" id="l_setting_name_2"></h1>
                            </div>
                            <div class="row g-3 my-2">
                                <div class="col-12 col-md-4 mt-0">
                                    <label>Line Manager</label>​
                                    <select class="form-control" name="l_manager" required>
                                        <option> </option>
                                        @for($i=0;$i<count($json2);$i++) @php $u_id=$json2[$i]['id'];
                                            $u_name=$json2[$i]['name'];$u_role=$json2[$i]['role']; @endphp
                                            @if($u_role==2) <option value="{{$u_id}}">
                                            {{$u_name}}
                                            </option> @endif @endfor
                                    </select>
                                </div>
                                {{-- <div class="col-12 col-md-4 mt-0">
                                    <label>Target</label>
                                    <input type="text" class="form-control" name="target" placeholder="100" required />
                                </div> --}}
                                <div class="col-12 col-md-4 mt-0">
                                    <label>Total Working Hour(s)</label>
                                    <input type="text" class="form-control" name="work_hour" placeholder="7 Hours"
                                        id="work_hour" required readonly />
                                </div>
                            </div>
                            <div class="row g-3 my-2">
                                <div class="col-12 col-md-4 mt-0">
                                    <label>Starting Time</label>​<br />
                                    <input type="time" class="form-control" id="start_time" name="start_time" step="300"
                                        required>
                                </div>
                                <div class="col-12 col-md-4 mt-0">
                                    <label>Lunch Time</label>​<br />
                                    <div class="row">
                                        <div class="col-6">
                                            <input type="time" class="form-control" name="lunch_start" step="300"
                                                required>
                                        </div>
                                        <div class="col-6">
                                            <input type="time" class="form-control" name="lunch_end" step="300"
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 mt-0">
                                    <label>Ending Time</label>​<br />
                                    <input type="time" class="form-control" id="end_time" name="end_time" step="300"
                                        required>
                                </div>
                            </div>
                            <div class="row g-3 my-2">
                                <div class="col-12 col-md-4 mt-0">
                                    <label>Work Progress by (minute)</label>​
                                    <input type="number" class="form-control" name="progress" placeholder="30"
                                        required />
                                </div>
                            </div>
                </div>

                <div class="row g-3 my-2 mx-2">
                    <div class="col-12 col-md-4">
                        <label>Add Category</label>​
                        <input type="text" class="form-control" name="new_category_name" id="new_category_name"
                            placeholder="Type Here" />
                    </div>
                    <div class="col">
                        <br />
                        <button class="btn custom-btn-theme w-25" id="new_category_btn">Add New Category</button>
                    </div>
                </div>
                <script>
                    $("#new_category_btn").click(function(e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "{{ url('create_category') }}",
        data: {
            cat_name: $("#new_category_name").val(),
        },
        success: function(result) {
            console.log(result);
            alert('Category Added');
        },
        error: function(result) {
            alert('Error creating category');
        }
    });
});
                </script>
                <div class="row g-3 my-2">
                    <div style="overflow: auto;max-width:100%;max-height:600px;padding:0.5rem;">
                        <table class="table" id="dynamic_field">
                            <tr class="setting-tr">
                                <td>
                                    <label>Category</label>
                                    <livewire:select-box-setting />
                                </td>
                                <td>
                                    <label>Product Name</label>
                                    <input type="text" class="form-control" id="p_name" name="p_name[]"
                                        placeholder="Musung Shirt" required />
                                </td>
                                <td>
                                    <label>Target</label>
                                    <input type="number" class="form-control" id="setting_target"
                                        name="category_target[]" placeholder="Target" required />
                                </td>
                                <td>
                                    <br />
                                    <button type="button" name="add" id="add_product_detail" class="btn btn-success"><i
                                            class="fas fa-plus-square fa-lg"></i></button>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="col-12 col-md-6 m-auto text-center">
                    <input class="icon-btn-one btn my-2" type="submit" value="Submit" name="submit" />
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
                </form>
                <script>
                    $("#line_assign_post").submit(function(e) {
    e.preventDefault();

    // Get NON-INPUT table cell data
    var box = {};
    var boxes = [];
        $('#dynamic_field .setting-tr').each(function() {
            var category_select = $('#category_select', this).val();
            var p_name = $('#p_name', this).val();
            var category_target = $('#setting_target', this).val();
    box = {
        category_select: category_select,
        p_name: p_name,
        category_target: category_target
    }
    boxes.push(box);
        });

    // Get all INPUT form data and organize as array
    var formData = $(this).serializeArray();

    // // Encode with JSON
    var subArray = JSON.stringify(boxes);

    // // Add to formData array
    formData.push({name: 'sub', value: subArray});
console.log(formData);
    // Submit with AJAX
    $.ajax({
        type: "POST",
        url: "{{ url('line_assign_post') }}",
        data: formData,
        type: 'post',
        success: function(data) {
            location.reload();
        }
    });
});
                </script>
            </div>
        </div>
    </div>
</div>

@endadmin


@operator
@php $json = json_decode($responseBody,true); ///Line DB
$json2 = json_decode(json_encode($responseBody2),true); ////User DB
$num = 1;
@endphp
<div class="container">
    <div class="container-fluid">
        <h1 class="fw-bold heading-text">Line Setting</h1>
        <div class="my-4">
            <div class="row my-2">
                @for($i=0;$i<count($json);$i++) @php $l_id=$json[$i]['l_id']; $l_name=$json[$i]['l_name'];
                    $is_delete=$json[$i]['is_delete'];$a_status=$json[$i]['a_status']; @endphp <div
                    class="col-6 col-md-3 text-center my-2">
                    @if ($a_status==1)
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-success w-75" data-bs-toggle="modal"
                        data-bs-target="#LineModalActive<?php echo $l_id; ?>" data-bs-l-id-active="{{ $l_id }}"
                        data-bs-l-name-active="{{ $l_name }}" data-bs-l-status-active="{{ $a_status }}"
                        id="line_setting_btn">
                        {{$l_name}}
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="LineModalActive<?php echo $l_id;?>" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body text-start">
                                    <form action="" method="POST">
                                        <input type="hidden" name="l_id" id="l_id_setting_active" value="{{ $l_id }}">
                                        @for($k=0;$k<count($json);$k++) @php $new_l_id=$json[$k]['l_id'];
                                            $l_name=$json[$k]['l_name']; @endphp @if ($new_l_id==$l_id) <div
                                            class="mt-2 mb-4">
                                            <h1 class="fw-bold heading-text">{{ $l_name }}</h1>
                                </div> @endif @endfor
                                <div class="row g-3 my-2">
                                    <div class="col-12 col-md-4 mt-0">
                                        <label>Over Time (minute)</label>​
                                        <input type="number" class="form-control" name="over_time_minute"
                                            placeholder="100" required />
                                    </div>
                                    <div class=" col-12 col-md-4 mt-0">
                                        <label>Over Time Target</label>
                                        <input type="number" class="form-control" name="over_time_target"
                                            placeholder="100" required />
                                    </div>
                                </div>
                                <div style="overflow: auto;max-width:100%;max-height:600px;padding:0.5rem;">
                                    <table class="table" id="dynamic_field_2">
                                        <tr class="setting-tr-2">
                                            <td>
                                                <label>Category</label>
                                                <livewire:select-box-setting2 />
                                            </td>
                                            <td>
                                                <label>Product Name</label>
                                                <input type="text" class="form-control" id="p_name" name="p_name[]"
                                                    placeholder="Musung Shirt" required />
                                            </td>
                                            <td>
                                                <label>Target</label>
                                                <input type="number" class="form-control" id="setting_target"
                                                    name="category_target[]" placeholder="Target" required />
                                            </td>
                                            <td>
                                                <br />
                                                <button type="button" name="add" id="add_product_detail_2"
                                                    class="btn btn-success"><i
                                                        class="fas fa-plus-square fa-lg"></i></button>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-12 col-md-4">
                                    <input class="icon-btn-one btn my-2" type="submit" value="Add" name="submit" />
                                </div>
                                </form>
                                <script>
                                    $("#line_assign_overtime_post").submit(function(e) {
                    e.preventDefault();

                    // Get NON-INPUT table cell data
                    var box_2 = {};
                    var boxes_2 = [];
                        $('#dynamic_field_2 .setting-tr-2').each(function() {
                            var category_select = $('#category_select', this).val();
                            var p_name = $('#p_name', this).val();
                            var category_target = $('#setting_target', this).val();
                    box_2 = {
                        category_select: category_select,
                        p_name: p_name,
                        category_target: category_target
                    }
                    boxes_2.push(box_2);
                        });

                    // Get all INPUT form data and organize as array
                    var formData_2 = $(this).serializeArray();

                    // // Encode with JSON
                    var subArray_2 = JSON.stringify(boxes_2);

                    // // Add to formData array
                    formData_2.push({name: 'sub', value: subArray_2});
                console.log(formData_2);
                    // Submit with AJAX
                    // $.ajax({
                    //     type: "POST",
                    //     url: "{{ url('line_assign_post') }}",
                    //     data: formData,
                    //     type: 'post',
                    //     success: function(data) {
                    //         location.reload();
                    //     }
                    // });
                });
                                </script>

                                <div style="overflow: auto;max-width:100%;max-height:600px;padding:0.5rem;">
                                    <h1 class="fw-bold heading-text fs-4">Line Details</h1>
                                    <table class="table table-striped my-2  tableFixHead results p-0">
                                        <thead>
                                            <tr class="tr-2">
                                                <th scope="col">No.</th>
                                                <th scope="col">Line Manager Name</th>
                                                <th scope="col">Target</th>
                                                <th scope="col">Total Working Hour(s)</th>
                                                <th scope="col">Starting Time</th>
                                                <th scope="col">Lunch Time</th>
                                                <th scope="col">Ending Time</th>
                                                <th scope="col">Working
                                                    Progress by (minute)</th>
                                            </tr>
                                        </thead>
                                        <tbody id="myTable">
                                            <!-- line_assign_2 is from LineAssignController -->
                                            @foreach ($line_assign_2 as $l_2)
                                            @php
                                            $a_id=$l_2->assign_id;
                                            $a_line_id=$l_2->l_id;
                                            $a_line_status=$l_2->a_status;
                                            $a_line_user_id=$l_2->user_id;
                                            $a_main_target=$l_2->main_target;
                                            $a_s_time=$l_2->s_time;
                                            $a_e_time=$l_2->e_time;
                                            $a_lunch_s_time = $l_2->lunch_s_time;
                                            $a_lunch_e_time = $l_2->lunch_e_time;
                                            $a_work_min=$l_2->cal_work_min;
                                            $a_work_hr=$l_2->t_work_hr;
                                            $a_created_at=$l_2->created_at;
                                            $a_updated_at=$l_2->updated_at;
                                            $u_name = $l_2->name;
                                            @endphp

                                            @if ($a_line_id==$l_id)
                                            <tr>
                                                <td>{{ $num++ }}</td>
                                                <td>{{ $u_name }}</td>
                                                <td>{{ $a_main_target }}</td>
                                                <td>{{ $a_work_hr }}</td>
                                                <td>{{ $a_s_time }}</td>
                                                <td>{{ $a_lunch_s_time }} - {{ $a_lunch_e_time }}</td>
                                                <td>{{ $a_e_time }}</td>
                                                <td>{{ $a_work_min }}</td>
                                            </tr>
                                            @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div style="overflow: auto;max-width:100%;max-height:550px;padding:0.5rem;">
                                    <h1 class="fw-bold heading-text fs-4">Over Time Details
                                    </h1>
                                    <table class="table table-striped my-2 tableFixHead results p-0">
                                        <thead>
                                            <tr class="tr-2">
                                                <th scope="col">
                                                    No.</th>
                                                <th scope="col">Over Time (minute)</th>
                                                <th scope="col">
                                                    Over Time Target</th>
                                                <th>Create Date</th>
                                                <th>Update Date</th>
                                            </tr>
                                        </thead>
                                        @php $number = 1; @endphp
                                        <tbody id="myTable">
                                            @foreach($overTime as $ot)
                                            @if ($ot->l_id==$l_id)
                                            <tr>
                                                <td>{{ $number++ }}</td>
                                                <td>{{ $ot->ot_min }}</td>
                                                <td>{{ $ot->ot_target }}</td>
                                                <td>{{ $ot->created_at }}</td>
                                                <td>{{ $ot->updated_at }}</td>
                                            </tr>
                                            @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div style="overflow: auto;max-width:100%;max-height:550px;padding:0.5rem;">
                                    <h1 class="fw-bold heading-text fs-4">Product Details
                                    </h1>
                                    <table class="table table-striped my-2 tableFixHead results p-0">
                                        <thead>
                                            <tr class="tr-2">
                                                <th scope="col">
                                                    No.</th>
                                                <th scope="col">Product Name</th>
                                                <th scope="col">Category Name</th>
                                                <th>Quantity</th>
                                            </tr>
                                        </thead>
                                        @php $number = 1; @endphp
                                        <tbody id="myTable">
                                            @foreach($p_detail as $p)
                                            @if ($p->l_id==$l_id)
                                            <tr>
                                                <td>{{ $number++ }}</td>
                                                <td>{{ $p->p_name }}</td>
                                                <td>{{ $p->p_cat_id }}</td>
                                                <td>{{ $p->quantity }}</td>
                                            </tr>
                                            @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-12 col-md-6 m-auto text-center">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            @elseif($a_status==0)
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-secondary w-75" data-bs-toggle="modal" data-bs-target="#LineModal"
                data-bs-l-id="{{ $l_id }}" data-bs-l-name="{{ $l_name }}" id="line_setting_btn">
                {{$l_name}}
            </button>
            @endif

        </div>
        @endfor
    </div>
    <!-- Modal -->
    <div class="modal fade" id="LineModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body text-start">
                    {{-- <form action="{{ url('line_assign_post') }}" method="POST" id="line_assign_post"> --}}
                        <form method="POST" id="line_assign_post">
                            <input type="hidden" name="l_id" id="l_id_2">
                            <input type="hidden" id="s_time" />
                            <input type="hidden" id="e_time" />

                            <div class="mt-2 mb-4">
                                <h1 class="fw-bold heading-text" id="l_setting_name_2"></h1>
                            </div>
                            <div class="row g-3 my-2">
                                <div class="col-12 col-md-4 mt-0">
                                    <label>Line Manager</label>​
                                    <select class="form-control" name="l_manager" required>
                                        <option> </option>
                                        @for($i=0;$i<count($json2);$i++) @php $u_id=$json2[$i]['id'];
                                            $u_name=$json2[$i]['name'];$u_role=$json2[$i]['role']; @endphp
                                            @if($u_role==2) <option value="{{$u_id}}">
                                            {{$u_name}}
                                            </option> @endif @endfor
                                    </select>
                                </div>
                                {{-- <div class="col-12 col-md-4 mt-0">
                                    <label>Target</label>
                                    <input type="text" class="form-control" name="target" placeholder="100" required />
                                </div> --}}
                                <div class="col-12 col-md-4 mt-0">
                                    <label>Total Working Hour(s)</label>
                                    <input type="text" class="form-control" name="work_hour" placeholder="7 Hours"
                                        id="work_hour" required readonly />
                                </div>
                            </div>
                            <div class="row g-3 my-2">
                                <div class="col-12 col-md-4 mt-0">
                                    <label>Starting Time</label>​<br />
                                    <input type="time" class="form-control" id="start_time" name="start_time" step="300"
                                        required>
                                </div>
                                <div class="col-12 col-md-4 mt-0">
                                    <label>Lunch Time</label>​<br />
                                    <div class="row">
                                        <div class="col-6">
                                            <input type="time" class="form-control" name="lunch_start" step="300"
                                                required>
                                        </div>
                                        <div class="col-6">
                                            <input type="time" class="form-control" name="lunch_end" step="300"
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 mt-0">
                                    <label>Ending Time</label>​<br />
                                    <input type="time" class="form-control" id="end_time" name="end_time" step="300"
                                        required>
                                </div>
                            </div>
                            <div class="row g-3 my-2">
                                <div class="col-12 col-md-4 mt-0">
                                    <label>Work Progress by (minute)</label>​
                                    <input type="number" class="form-control" name="progress" placeholder="30"
                                        required />
                                </div>
                            </div>
                </div>

                <div class="row g-3 my-2 mx-2">
                    <div class="col-12 col-md-4">
                        <label>Add Category</label>​
                        <input type="text" class="form-control" name="new_category_name" id="new_category_name"
                            placeholder="Type Here" />
                    </div>
                    <div class="col">
                        <br />
                        <button class="btn custom-btn-theme w-25" id="new_category_btn">Add New Category</button>
                    </div>
                </div>
                <script>
                    $("#new_category_btn").click(function(e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "{{ url('create_category') }}",
        data: {
            cat_name: $("#new_category_name").val(),
        },
        success: function(result) {
            console.log(result);
            alert('Category Added');
        },
        error: function(result) {
            alert('Error creating category');
        }
    });
});
                </script>
                <div class="row g-3 my-2">
                    <div style="overflow: auto;max-width:100%;max-height:600px;padding:0.5rem;">
                        <table class="table" id="dynamic_field">
                            <tr class="setting-tr">
                                <td>
                                    <label>Category</label>
                                    <livewire:select-box-setting />
                                </td>
                                <td>
                                    <label>Product Name</label>
                                    <input type="text" class="form-control" id="p_name" name="p_name[]"
                                        placeholder="Musung Shirt" required />
                                </td>
                                <td>
                                    <label>Target</label>
                                    <input type="number" class="form-control" id="setting_target"
                                        name="category_target[]" placeholder="Target" required />
                                </td>
                                <td>
                                    <br />
                                    <button type="button" name="add" id="add_product_detail" class="btn btn-success"><i
                                            class="fas fa-plus-square fa-lg"></i></button>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="col-12 col-md-6 m-auto text-center">
                    <input class="icon-btn-one btn my-2" type="submit" value="Submit" name="submit" />
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
                </form>
                <script>
                    $("#line_assign_post").submit(function(e) {
    e.preventDefault();

    // Get NON-INPUT table cell data
    var box = {};
    var boxes = [];
        $('#dynamic_field .setting-tr').each(function() {
            var category_select = $('#category_select', this).val();
            var p_name = $('#p_name', this).val();
            var category_target = $('#setting_target', this).val();
    box = {
        category_select: category_select,
        p_name: p_name,
        category_target: category_target
    }
    boxes.push(box);
        });

    // Get all INPUT form data and organize as array
    var formData = $(this).serializeArray();

    // // Encode with JSON
    var subArray = JSON.stringify(boxes);

    // // Add to formData array
    formData.push({name: 'sub', value: subArray});
console.log(formData);
    // Submit with AJAX
    $.ajax({
        type: "POST",
        url: "{{ url('line_assign_post') }}",
        data: formData,
        type: 'post',
        success: function(data) {
            location.reload();
        }
    });
});
                </script>
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
@endsection

@endsection
