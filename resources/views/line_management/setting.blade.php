@extends('layouts.app')

@section('content')
@section('content_2')

@superadmin

@php $json = json_decode($responseBody,true); ///Line DB
$json2 = json_decode(json_encode($responseBody2),true); ////User DB
$num = 1;
@endphp
<div class="container">
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
                                @for($k=0;$k<count($json);$k++) @php $new_l_id=$json[$k]['l_id'];
                                    $l_name=$json[$k]['l_name']; @endphp @if ($new_l_id==$l_id) <div class="mt-2 mb-4">
                                    <h1 class="fw-bold heading-text">{{ $l_name }}</h1>
                            </div> @endif @endfor
                            <form id="line_assign_overtime_post_<?php echo $l_id; ?>">
                                <input type="hidden" name="l_id" id="l_id_setting_active" value="{{ $l_id }}">

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
                                                <label>Buyer</label>
                                                <livewire:select-box-setting2 />
                                            </td>
                                            <td>
                                                <label>Style No.#</label>
                                                <input type="text" class="form-control" id="style_name"
                                                    name="style_name[]" placeholder="#0000" required />
                                            </td>
                                            <td>
                                                <label>Item Name</label>
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
                                    <input class="icon-btn-one btn my-2" type="submit" value="Add" />
                                </div>

                            </form>
                            <script>
                                $("#line_assign_overtime_post_<?php echo $l_id; ?>").submit(function(e) {
                    e.preventDefault();

                    // Get NON-INPUT table cell data
                    var box_2 = {};
                    var boxes_2 = [];
                        $('#dynamic_field_2 .setting-tr-2').each(function() {
                            var category_select = $('#category_select', this).val();
                            var style_no = $('#style_name', this).val();
                            var p_name = $('#p_name', this).val();
                            var category_target = $('#setting_target', this).val();
                    box_2 = {
                        category_select: category_select,
                        style_no : style_no,
                        p_name: p_name,
                        category_target: category_target,
                        l_id : '<?php echo $l_id; ?>'
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
                    $.ajax({
                        type: "POST",
                        url: "{{ url('line_assign_overtime_post') }}",
                        data: formData_2,
                        success: function(data) {
                            // console.log(data);
                            location.reload();
                        }
                    });
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
                                            <td id="a_work_hr_{{ $a_line_id }}"></td>
                                            <td>{{ $a_s_time }}</td>
                                            <td>{{ $a_lunch_s_time }} - {{ $a_lunch_e_time }}</td>
                                            <td>{{ $a_e_time }}</td>
                                            <td>{{ $a_work_min }}</td>
                                        </tr>
                                        <script>
                                            var a_work_hr_ = $("#a_work_hr_{{ $a_line_id }}");
                                            var a_work_hr_val = "<?php echo $a_work_hr; ?>";

                                            a_work_hr_val_split = a_work_hr_val.split(':');


                                            if(a_work_hr_val_split[1] == 0){
                                                a_work_hr_.text(a_work_hr_val_split[0]+'  hr');
                                            }
                                            if(a_work_hr_val_split[1] != 0){
                                                a_work_hr_.text(a_work_hr_val_split[0]+'  hr '+a_work_hr_val_split[1]+'  min');
                                            }
                                        </script>
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
                                    <tbody id="myTable">
                                        @php $number = 1; @endphp
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
                                            <th scope="col">Buyer Name</th>
                                            <th scope="col">Product Name</th>
                                            <th>Quantity</th>
                                        </tr>
                                    </thead>
                                    @php $number = 1; @endphp
                                    <tbody id="myTable">
                                        @foreach($p_detail as $p)
                                        @if ($p->l_id==$l_id)
                                        <tr>
                                            <td>{{ $number++ }}</td>
                                            <td>{{ $p->buyer_name }}</td>
                                            <td>{{ $p->p_name }}</td>
                                            <td>{{ $p->quantity }}</td>
                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-12 col-md-6 m-auto text-center">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
                                        $u_name=$json2[$i]['name'];$u_role=$json2[$i]['role']; @endphp @if($u_role==2)
                                        <option value="{{$u_id}}">
                                        {{$u_name}}
                                        </option> @endif @endfor
                                </select>
                            </div>
                            <div class="col-12 col-md-4 mt-0">
                                <br />
                                <input type="button" class="btn btn-secondary" value="Autofill Time" id="time_type_1">
                            </div>
                            <input type="hidden" class="form-control" name="work_hour" placeholder="7 Hours"
                                id="work_hour" required readonly />
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
                                        <input type="time" class="form-control" name="lunch_start" id="lunch_start"
                                            step="300" required>
                                    </div>
                                    <div class="col-6">
                                        <input type="time" class="form-control" name="lunch_end" id="lunch_end"
                                            step="300" required>
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
                                <input type="number" class="form-control" name="progress" id="progress" placeholder="30"
                                    required />
                            </div>
                        </div>
            </div>


            <script>
                $("#time_type_1").click(function () {
                    var start_time = $("#start_time");
                    var end_time = $("#end_time");
                    var lunch_start = $("#lunch_start");
                    var lunch_end = $("#lunch_end");
                    var progress = $("#progress");

                    start_time.val("07:30");
                    end_time.val("18:00");
                    lunch_start.val("11:30");
                    lunch_end.val("12:00");
                    progress.val("60");
                });
            </script>
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
                                <label>Buyer</label>
                                <livewire:select-box-setting />
                            </td>
                            <td>
                                <label>Style No.#</label>
                                <input type="text" class="form-control" id="style_name" name="style_name[]"
                                    placeholder="#0000" required />
                            </td>
                            <td>
                                <label>Item Name</label>
                                <input type="text" class="form-control" id="p_name" name="p_name[]"
                                    placeholder="Musung Shirt" required />
                            </td>
                            <td>
                                <label>Target</label>
                                <input type="number" class="form-control" id="setting_target" name="category_target[]"
                                    placeholder="Target" required />
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
            var style_no = $('#style_name', this).val();
            var p_name = $('#p_name', this).val();
            var category_target = $('#setting_target', this).val();
    box = {
        category_select: category_select,
        style_no : style_no,
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
// console.log(formData);
    // Submit with AJAX
    $.ajax({
        type: "POST",
        url: "/line_assign_post",
        data: formData,
        success: function(data) {
            // console.log(data);
            location.reload();
        }
    });
});
            </script>
        </div>
    </div>
</div>

@if($line_assign_detail)<h1 class="fw-bold heading-text my-4 fs-3">Assigned Line Details</h1>
<table class="table table-striped my-4 tableFixHead results p-0 text-center">
    <thead>
        <tr class="tr-2">
            <th scope="col">No.</th>
            <th scope="col">Line Name</th>
            <th scope="col">Line Manager Name</th>
            <th scope="col">Target</th>
            <th scope="col">Total Working Hour(s)</th>
            <th scope="col">Starting Time</th>
            <th scope="col">Lunch Time</th>
            <th scope="col">Ending Time</th>
            <th scope="col">Delete</th>
        </tr>
    </thead>
    <tbody id="myTable">
        @php
        $num_count =1;
        @endphp

        @foreach($line_assign_detail as $l_assign)

        @php
        $l_a_id = $l_assign->assign_id; $l_l_id = $l_assign->l_id; $l_l_name=$l_assign->l_name;$l_assign_date =
        $l_assign->assign_date;
        $l_a_status=$l_assign->a_status; $l_u_id = $l_assign->user_id; $l_u_name = $l_assign->name;
        $l_main_target=$l_assign->main_target;$l_s_time=$l_assign->s_time;$l_e_time=$l_assign->e_time;$l_lunch_s_time=$l_assign->lunch_s_time;$l_lunch_e_time=$l_assign->lunch_e_time;
        $l_work_hr=$l_assign->t_work_hr; @endphp
        <tr>
            <td>{{ $num_count++ }}</td>
            <td>{{ $l_l_name }}</td>
            <td>{{ $l_u_name }}</td>
            <td>{{ $l_main_target }}</td>
            <td id="l_work_hr_{{ $l_l_id }}">{{ $l_work_hr }}</td>
            <td>{{ $l_s_time }}</td>
            <td>{{ $l_lunch_s_time }} - {{ $l_lunch_e_time }}</td>
            <td>{{ $l_e_time }}</td>
            <td>
                <a class='btn btn-danger text-white' href='{{ url("/delete_assign_line") }}/{{ $l_a_id }}/{{ $l_l_id }}'
                    onclick="return confirm('Confirm deleting Line Assign?')">Delete</a>
            </td>
        </tr>
        <script>
            var l_work_hr = $("#l_work_hr_{{ $l_l_id }}");
            var l_work_hr_val = "<?php echo $l_work_hr; ?>";

            l_work_hr_val_split = l_work_hr_val.split(':');


            if(l_work_hr_val_split[1] == 0){
                l_work_hr.text(l_work_hr_val_split[0]+'  hr');
            }
            if(l_work_hr_val_split[1] != 0){
                l_work_hr.text(l_work_hr_val_split[0]+'  hr '+l_work_hr_val_split[1]+'  min');
            }
        </script>
        @endforeach

    </tbody>
</table>
<h1 class="fw-bold heading-text my-4 fs-3">Line Manager</h1>
<ul class="horizontal-slide my-4" style="width:100%;overflow-x:scroll;" id="nav">
    <?php

foreach($l_manager_list as $l_list){
    $user_id = $l_list->user_id;
    $user_name = $l_list->name;
    $line_id = $l_list->l_id;
    $assign_id = $l_list->assign_id;
    ?>
    <li class="list-group-item span2 open2 vertical_<?php echo $user_id; ?>" data-l-id="<?php echo $line_id; ?>"
        data-user-id="<?php echo $user_id; ?>" data-assign-id="<?php echo $assign_id; ?>">
        <?php
            echo $user_name;
            ?>
    </li>
    <?php
}
?>
</ul>
<div id="ajax_load_div_2" class="my-2">
</div>

<script>
    $(function() {
    $(".open2").on('click', function(e) {
        e.preventDefault(); // in chase you change to a link or button

        var line_id = $(this).data('l-id');
        var user_id = $(this).data('user-id');
        var assign_id = $(this).data('assign-id');

        $(".open2").removeClass('changeClass');
        $(".vertical_" + user_id).toggleClass("changeClass");

        $.ajax({
            type: "POST",
            url: "/setting_post_2",
            data: {
                line_id: line_id,
                user_id: user_id,
                assign_id: assign_id,
            },
            cache: false,
            success: function(result2) {
                // console.log(result2);
                $("#ajax_load_div_2").html(result2);
            },
            error: function(result2) {
                console.log(result2);
                alert('error');
            }
        });
    });
});
</script>
@endif
@endsuperadmin

@owner


@php $json = json_decode($responseBody,true); ///Line DB
$json2 = json_decode(json_encode($responseBody2),true); ////User DB
$num = 1;
@endphp
<div class="container">
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
                                @for($k=0;$k<count($json);$k++) @php $new_l_id=$json[$k]['l_id'];
                                    $l_name=$json[$k]['l_name']; @endphp @if ($new_l_id==$l_id) <div class="mt-2 mb-4">
                                    <h1 class="fw-bold heading-text">{{ $l_name }}</h1>
                            </div> @endif @endfor
                            <form id="line_assign_overtime_post_<?php echo $l_id; ?>">
                                <input type="hidden" name="l_id" id="l_id_setting_active" value="{{ $l_id }}">

                                <div class="row g-3 my-2">
                                    <div class="col-12 col-md-4 mt-0">
                                        <label>Over Time (minute)</label>​
                                        <input type="number" class="form-control" name="over_time_minute"
                                            placeholder="100" required />
                                    </div>
                                </div>
                                <div style="overflow: auto;max-width:100%;max-height:600px;padding:0.5rem;">
                                    <table class="table" id="dynamic_field_<?php echo $l_id; ?>">
                                        <tr class="setting-tr-2">
                                            <td>
                                                <label>Buyer</label>
                                                <div>
                                                    <select
                                                        class="livesearch form-control category_select_<?php echo $l_id; ?>"
                                                        name="category[]" id="category_select_<?php echo $l_id; ?>">
                                                        <option value=''>-- Select buyer --</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <label>Style No.#</label>
                                                <input type="text" class="form-control" id="style_name"
                                                    name="style_name[]" placeholder="#0000" required />
                                            </td>
                                            <td>
                                                <label>Item Name</label>
                                                <div>
                                                    <select class="livesearch2 form-control p_name_<?php echo $l_id; ?>"
                                                        name="p_name[]" id="p_name_<?php echo $l_id; ?>">
                                                        <option value=''>-- Select item name --</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <label>Target</label>
                                                <input type="number" class="form-control" id="setting_target"
                                                    name="category_target[]" placeholder="Target" required />
                                            </td>
                                            <td>
                                                <br />
                                                <button type="button" name="add"
                                                    id="add_product_detail_<?php echo $l_id; ?>"
                                                    class="btn btn-success"><i
                                                        class="fas fa-plus-square fa-lg"></i></button>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-12 col-md-4">
                                    <input class="icon-btn-one btn my-2" type="submit" value="Add" />
                                </div>

                            </form>
                            <script>
                                $("#line_assign_overtime_post_<?php echo $l_id; ?>").submit(function(e) {
                    e.preventDefault();

                    // Get NON-INPUT table cell data
                    var box_2 = {};
                    var boxes_2 = [];
                        $('#dynamic_field_<?php echo $l_id; ?> .setting-tr-2').each(function() {
                            var category_select = $('#category_select_<?php echo $l_id; ?>', this).val();
                            var style_no = $('#style_name', this).val();
                            var p_name = $('#p_name_<?php echo $l_id; ?>', this).val();
                            var category_target = $('#setting_target', this).val();
                    box_2 = {
                        category_select: category_select,
                        style_no : style_no,
                        p_name: p_name,
                        category_target: category_target,
                        l_id : '<?php echo $l_id; ?>'
                    }
                    boxes_2.push(box_2);
                        });

                        // console.log(boxes_2);

                    // Get all INPUT form data and organize as array
                    var formData_2 = $(this).serializeArray();

                    // // Encode with JSON
                    var subArray_2 = JSON.stringify(boxes_2);

                    // // Add to formData array
                    formData_2.push({name: 'sub', value: subArray_2});
                console.log(formData_2);
                    // Submit with AJAX
                    $.ajax({
                        type: "POST",
                        url: "/line_assign_overtime_post",
                        data: formData_2,
                        success: function(data) {
                            // console.log(data);
                            location.reload();
                        }
                    });
                });
                            </script>

                            <script>
                                var i = 1;
                                $('#add_product_detail_<?php echo $l_id; ?>').click(function() {
i++;
$("#dynamic_field_<?php echo $l_id; ?>").append('<tr class="setting-tr-2" id="row' + i + '"><td><label>Buyer</label><div><select class="livesearch form-control category_select_<?php echo $l_id; ?>'+ i + '" name="category[]" id="category_select_<?php echo $l_id; ?>" required><option value="">-- Select buyer --</option></select></div></td> <td><label>Style No.#</label><input type="text" class="form-control" id="style_name" name="style_name[]" placeholder="#0000" required /></td><td> <label>Item Name</label><div></div><select class="livesearch2 form-control p_name_<?php echo $l_id; ?>'+i+'" name="p_name[]" id="p_name_<?php echo $l_id; ?>"><option value="">-- Select item name --</option></select></div></td><td><label>Target</label><input type="number" class="form-control" name="category_target[]" id="setting_target" placeholder="Target" required /></td><td><br/><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button></td></tr>');

$('.category_select_<?php echo $l_id; ?>' + i).select2({
dropdownParent: $('#LineModalActive<?php echo $l_id;?>'),
tags:true,
ajax: {
url: "/buyer_search",
type: "GET",
dataType: 'json',
delay: 0,
data: function (params) {
return {
search: params.term // search term
};
},
processResults: function (response) {
return {
results: response
};
},
cache: true
}
            });

$('.p_name_<?php echo $l_id; ?>' + i).select2({
dropdownParent: $('#LineModalActive<?php echo $l_id;?>'),
tags:true,
ajax: {
url: "/item_search",
type: "GET",
dataType: 'json',
delay: 0,
data: function (params) {
return {
search: params.term // search term
};
},
processResults: function (response) {
return {
results: response
};
},
cache: true
}
            });
                                });


                            </script>

                            <script type="text/javascript">
                                $('.category_select_<?php echo $l_id; ?>').select2({
dropdownParent: $('#LineModalActive<?php echo $l_id;?>'),
tags:true,
ajax: {
url: "/buyer_search",
type: "GET",
dataType: 'json',
delay: 0,
data: function (params) {
return {
search: params.term // search term
};
},
processResults: function (response) {
return {
results: response
};
},
cache: true
}
});

                            </script>
                            <script type="text/javascript">
                                $('.p_name_<?php echo $l_id; ?>').select2({
                dropdownParent: $('#LineModalActive<?php echo $l_id;?>'),
                tags:true,
                ajax: {
                url: "/item_search",
                type: "GET",
                dataType: 'json',
                delay: 0,
                data: function (params) {
                return {
                search: params.term // search term
                };
                },
                processResults: function (response) {
                return {
                results: response
                };
                },
                cache: true
                }
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
                                            <td id="a_work_hr_{{ $a_line_id }}"></td>
                                            <td>{{ $a_s_time }}</td>
                                            <td>{{ $a_lunch_s_time }} - {{ $a_lunch_e_time }}</td>
                                            <td>{{ $a_e_time }}</td>
                                            <td>{{ $a_work_min }}</td>
                                        </tr>
                                        <script>
                                            var a_work_hr_ = $("#a_work_hr_{{ $a_line_id }}");
                                            var a_work_hr_val = "<?php echo $a_work_hr; ?>";

                                            a_work_hr_val_split = a_work_hr_val.split(':');


                                            if(a_work_hr_val_split[1] == 0){
                                                a_work_hr_.text(a_work_hr_val_split[0]+'  hr');
                                            }
                                            if(a_work_hr_val_split[1] != 0){
                                                a_work_hr_.text(a_work_hr_val_split[0]+'  hr '+a_work_hr_val_split[1]+'  min');
                                            }
                                        </script>
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
                                            <th scope="col">Buyer Name</th>
                                            <th scope="col">Product Name</th>
                                            <th>Quantity</th>
                                        </tr>
                                    </thead>
                                    @php $number = 1; @endphp
                                    <tbody id="myTable">
                                        @foreach($p_detail as $p)
                                        @if ($p->l_id==$l_id)
                                        <tr>
                                            <td>{{ $number++ }}</td>
                                            <td>{{ $p->buyer_name }}</td>
                                            <td>{{ $p->p_name }}</td>
                                            <td>{{ $p->quantity }}</td>
                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-12 col-md-6 m-auto text-center">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
<div class="modal fade" id="LineModal" aria-labelledby="exampleModalLabel" aria-hidden="true"
    aria-labelledby="exampleModalToggleLabel" style="overflow:hidden;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body text-start">
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
                                    $u_name=$json2[$i]['name'];$u_role=$json2[$i]['role']; @endphp @if($u_role==2)
                                    <option value="{{$u_id}}">
                                    {{$u_name}}
                                    </option> @endif @endfor
                            </select>
                        </div>
                        <div class="col-12 col-md-4 mt-0">
                            <br />
                            <input type="button" class="btn btn-secondary" value="Autofill Time" id="time_type_1">
                        </div>
                        <input type="hidden" class="form-control" name="work_hour" placeholder="7 Hours" id="work_hour"
                            required readonly />
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
                                    <input type="time" class="form-control" name="lunch_start" id="lunch_start"
                                        step="300" required>
                                </div>
                                <div class="col-6">
                                    <input type="time" class="form-control" name="lunch_end" id="lunch_end" step="300"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 mt-0">
                            <label>Ending Time</label>​<br />
                            <input type="time" class="form-control" id="end_time" name="end_time" step="300" required>
                        </div>
                    </div>
                    <div class="row g-3 my-2">
                        <div class="col-12 col-md-4 mt-0">
                            <label>Work Progress by (minute)</label>​
                            <input type="number" class="form-control" name="progress" id="progress" placeholder="30"
                                required />
                        </div>
                    </div>
            </div>

            <script>
                $("#time_type_1").click(function () {
                    var start_time = $("#start_time");
                    var end_time = $("#end_time");
                    var lunch_start = $("#lunch_start");
                    var lunch_end = $("#lunch_end");
                    var progress = $("#progress");

                    start_time.val("07:30");
                    end_time.val("18:00");
                    lunch_start.val("11:30");
                    lunch_end.val("12:00");
                    progress.val("60");
                });
            </script>
            <script>
                $("#new_category_btn").click(function(e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "{{ url('create_buyer') }}",
        data: {
            buyer_name: $("#new_buyer_name").val(),
        },
        success: function(result) {
            alert('Buyer Added');
        },
        error: function(result) {
            alert('Error creating buyer');
        }
    });
});
            </script>
            <div class="row g-3 my-2">
                <div style="overflow: auto;max-width:100%;max-height:600px;padding:0.5rem;">
                    <table class="table" id="dynamic_field">
                        <tr class="setting-tr">
                            <td>
                                <label>Buyer</label>
                                <div>
                                    <select class="livesearch form-control category_select" name="category[]"
                                        id="category_select">
                                        <option value=''>-- Select buyer --</option>
                                    </select>
                                </div>
                            </td>
                            <td>
                                <label>Style No.#</label>
                                <input type="text" class="form-control" id="style_name" name="style_name[]"
                                    placeholder="#0000" required />
                            </td>
                            <td>
                                <label>Item Name</label>
                                <div>
                                    <select class="livesearch2 form-control p_name" name="p_name[]" id="p_name">
                                        <option value=''>-- Select item name --</option>
                                    </select>
                                </div>
                            </td>
                            <td>
                                <label>Target</label>
                                <input type="number" class="form-control" id="setting_target" name="category_target[]"
                                    placeholder="Target" required />
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
            var style_no = $('#style_name', this).val();
            var p_name = $('#p_name', this).val();
            var category_target = $('#setting_target', this).val();
    box = {
        category_select: category_select,
        style_no : style_no,
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
// console.log(formData);
    // Submit with AJAX
    $.ajax({
        type: "POST",
        url: "/line_assign_post",
        data: formData,
        success: function(data) {
            // console.log(data);
            location.reload();
        }
    });
});
            </script>

            <script>
                var i = 1;
$("#add_product_detail").click(function () {
i++;
$("#dynamic_field").append('<tr class="setting-tr" id="row' + i + '"><td><label>Buyer</label><div><select class="livesearch form-control category_select_'+ i + '" name="category[]" id="category_select" required><option value="">-- Select buyer --</option></select></div></td> <td><label>Style No.#</label><input type="text" class="form-control" id="style_name" name="style_name[]" placeholder="#0000" required /></td><td> <label>Item Name</label><div></div><select class="livesearch2 form-control p_name_'+i+'" name="p_name[]" id="p_name"><option value="">-- Select item name --</option></select></div></td><td><label>Target</label><input type="number" class="form-control" name="category_target[]" id="setting_target" placeholder="Target" required /></td><td><br/><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button></td></tr>');



$('.category_select_' + i).select2({
dropdownParent: $('#LineModal'),
tags:true,
ajax: {
url: "/buyer_search",
type: "GET",
dataType: 'json',
delay: 0,
data: function (params) {
return {
search: params.term // search term
};
},
processResults: function (response) {
return {
results: response
};
},
cache: true
}
            });

$('.p_name_' + i).select2({
dropdownParent: $('#LineModal'),
tags:true,
ajax: {
url: "/item_search",
type: "GET",
dataType: 'json',
delay: 0,
data: function (params) {
return {
search: params.term // search term
};
},
processResults: function (response) {
return {
results: response
};
},
cache: true
}
            });

});

            </script>
            <script type="text/javascript">
                $('.p_name').select2({
dropdownParent: $('#LineModal'),
tags:true,
ajax: {
url: "/item_search",
type: "GET",
dataType: 'json',
delay: 0,
data: function (params) {
return {
search: params.term // search term
};
},
processResults: function (response) {
return {
results: response
};
},
cache: true
}
            });
            </script>

            <script type="text/javascript">
                $('.category_select').select2({
dropdownParent: $('#LineModal'),
tags:true,
ajax: {
url: "/buyer_search",
type: "GET",
dataType: 'json',
delay: 0,
data: function (params) {
return {
search: params.term // search term
};
},
processResults: function (response) {
return {
results: response
};
},
cache: true
}
            });

            </script>



        </div>
    </div>
</div>

@if($line_assign_detail)<h1 class="fw-bold heading-text my-4 fs-3">Assigned Line Details</h1>
<table class="table table-striped my-4 tableFixHead results p-0 text-center">
    <thead>
        <tr class="tr-2">
            <th scope="col">No.</th>
            <th scope="col">Line Name</th>
            <th scope="col">Line Manager Name</th>
            <th scope="col">Target</th>
            <th scope="col">Total Working Hour(s)</th>
            <th scope="col">Starting Time</th>
            <th scope="col">Lunch Time</th>
            <th scope="col">Ending Time</th>
            <th scope="col">Delete</th>
        </tr>
    </thead>
    <tbody id="myTable">
        @php
        $num_count =1;
        @endphp

        @foreach($line_assign_detail as $l_assign)

        @php
        $l_a_id = $l_assign->assign_id; $l_l_id = $l_assign->l_id;
        $l_l_name=$l_assign->l_name;$l_assign_date =
        $l_assign->assign_date;
        $l_a_status=$l_assign->a_status; $l_u_id = $l_assign->user_id; $l_u_name = $l_assign->name;
        $l_main_target=$l_assign->main_target;$l_s_time=$l_assign->s_time;$l_e_time=$l_assign->e_time;$l_lunch_s_time=$l_assign->lunch_s_time;$l_lunch_e_time=$l_assign->lunch_e_time;
        $l_work_hr=$l_assign->t_work_hr; @endphp
        <tr>
            <td>{{ $num_count++ }}</td>
            <td>{{ $l_l_name }}</td>
            <td>{{ $l_u_name }}</td>
            <td>{{ $l_main_target }}</td>
            <td id="l_work_hr_{{ $l_l_id }}">{{ $l_work_hr }}</td>
            <td>{{ $l_s_time }}</td>
            <td>{{ $l_lunch_s_time }} - {{ $l_lunch_e_time }}</td>
            <td>{{ $l_e_time }}</td>
            <td>
                <a class='btn btn-danger text-white' href='{{ url("/delete_assign_line") }}/{{ $l_a_id }}/{{ $l_l_id }}'
                    onclick="return confirm('Confirm deleting Line Assign?')">Delete</a>
            </td>
        </tr>
        <script>
            var l_work_hr = $("#l_work_hr_{{ $l_l_id }}");
            var l_work_hr_val = "<?php echo $l_work_hr; ?>";

            l_work_hr_val_split = l_work_hr_val.split(':');


            if(l_work_hr_val_split[1] == 0){
                l_work_hr.text(l_work_hr_val_split[0]+'  hr');
            }
            if(l_work_hr_val_split[1] != 0){
                l_work_hr.text(l_work_hr_val_split[0]+'  hr '+l_work_hr_val_split[1]+'  min');
            }
        </script>
        @endforeach

    </tbody>
</table>

@endif

{{-- Add Line Manger list for Line_Entry Here --}}

{{-- Add item_list and buyer_list CRUD Here --}}

<div class="row">
    <div class="col-6">
        <div class="container-fluid p-0">
            <form id="item_post">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#itemModal">
                    Add Item
                </button>

                <!-- Modal -->
                <div class="modal fade" id="itemModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add New Item</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div style="overflow: auto;max-width:100%;max-height:600px;padding:0.5rem;">
                                    <table class="table">
                                        <tr class="">
                                            <td>
                                                <label>Item Name</label>
                                                <input type="text" class="form-control" id="item_name" name="item_name"
                                                    placeholder="#0000" required />
                                            </td>
                                            <td>
                                                <label>Remark</label>
                                                <textarea class="form-control" name="item_remark" placeholder="Note"
                                                    id="item_remark" maxlength="150"></textarea>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <input type="submit" name="btn_item_submit" class="btn btn-primary" value="Save">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div style="overflow: auto;max-width:100%;max-height:600px;padding:0.5rem;">
                <table class="table tableFixHead2 text-center">
                    <thead>
                        <tr>
                            <th>Item Name</th>
                            <th>Remark</th>
                            <th>Edit</th>
                            {{-- <th>Delete</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($item_list as $item)
                        <tr>
                            <td>{{ $item->item_name }}</td>
                            <td>{{ $item->remark }}</td>
                            <td>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#itemEditModal_{{ $item->item_id }}">
                                    Edit
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="itemEditModal_{{ $item->item_id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form action="{{ url('item_edit') }}" method="POST">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    @foreach($item_list as $item_edit)
                                                    @if($item_edit->item_id == $item->item_id)
                                                    <form id="item_edit_post">
                                                        <input type="hidden" name="item_id"
                                                            value="{{ $item_edit->item_id }}">
                                                        <h5 class="fw-bold heading-text">{{
                                                            $item->item_name }}
                                                        </h5>
                                                        <div
                                                            style="overflow: auto;max-width:100%;max-height:600px;padding:0.5rem;">
                                                            <table class="table">
                                                                <tr class="">
                                                                    <td>
                                                                        <label>Item Name</label>
                                                                        <input type="text" class="form-control"
                                                                            id="item_name" name="item_name"
                                                                            placeholder="#0000"
                                                                            value="{{ $item_edit->item_name }}" />
                                                                    </td>
                                                                    <td>
                                                                        <label>Remark</label>
                                                                        <textarea class="form-control"
                                                                            name="item_remark" placeholder="Note"
                                                                            id="item_remark"
                                                                            maxlength="150">{{ $item_edit->remark }}</textarea>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </form>
                                                    @endif
                                                    @endforeach
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <input class="icon-btn-one btn my-2" type="submit" value="Submit"
                                                        name="submit" />
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


        <script>
            $("#item_post").submit(function(e) {
                    e.preventDefault();

                    // Get all INPUT form data and organize as array
                    var formData_3 = $(this).serializeArray();
                    // Submit with AJAX
                    $.ajax({
                        type: "POST",
                        url: "{{ url('item_post') }}",
                        data: formData_3,
                        success: function(data) {
                            // console.log(data);
                            location.reload();
                        }
                    });
                });
        </script>
    </div>
    <div class="col-6">
        <form id="buyer_post">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#buyerModal">
                Add Buyer
            </button>

            <!-- Modal -->
            <div class="modal fade" id="buyerModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New Buyer</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div style="overflow: auto;max-width:100%;max-height:600px;padding:0.5rem;">
                                <table class="table">
                                    <tr class="">
                                        <td>
                                            <label>Buyer Name</label>
                                            <input type="text" class="form-control" id="buyer_name" name="buyer_name"
                                                placeholder="#0000" required />
                                        </td>
                                        <td>
                                            <label>Remark</label>
                                            <textarea class="form-control" name="buyer_remark" placeholder="Note"
                                                id="buyer_remark" maxlength="150"></textarea>
                                        </td>

                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" name="btn_buyer_submit" class="btn btn-primary" value="Save">
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div style="overflow: auto;max-width:100%;max-height:600px;padding:0.5rem;">
            <table class="table tableFixHead2 text-center">
                <thead>
                    <tr>
                        <th>Buyer Name</th>
                        <th>Remark</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($buyer_list as $buyer)
                    <tr>
                        <td>{{ $buyer->buyer_name }}</td>
                        <td>{{ $buyer->remark }}</td>
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#buyerEditModal_{{ $buyer->buyer_id }}">
                                Edit
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="buyerEditModal_{{ $buyer->buyer_id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="{{ url('buyer_edit') }}" method="POST">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                @foreach($buyer_list as $buyer_edit)
                                                @if($buyer_edit->buyer_id == $buyer->buyer_id)
                                                <form id="buyer_edit_post">
                                                    <input type="hidden" name="buyer_id"
                                                        value="{{ $buyer_edit->buyer_id }}">
                                                    <h5 class="fw-bold heading-text">{{
                                                        $buyer_edit->buyer_name }}
                                                    </h5>
                                                    <div
                                                        style="overflow: auto;max-width:100%;max-height:600px;padding:0.5rem;">
                                                        <table class="table">
                                                            <tr class="">
                                                                <td>
                                                                    <label>Buyer Name</label>
                                                                    <input type="text" class="form-control"
                                                                        id="buyer_name" name="buyer_name"
                                                                        placeholder="#0000"
                                                                        value="{{ $buyer_edit->buyer_name }}" />
                                                                </td>
                                                                <td>
                                                                    <label>Remark</label>
                                                                    <textarea class="form-control" name="buyer_remark"
                                                                        placeholder="Note" id="buyer_remark"
                                                                        maxlength="150">{{ $buyer_edit->remark }}</textarea>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </form>
                                                @endif
                                                @endforeach
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <input class="icon-btn-one btn my-2" type="submit" value="Submit"
                                                    name="submit" />
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <script>
            $("#buyer_post").submit(function(e) {
                    e.preventDefault();

                    // Get all INPUT form data and organize as array
                    var formData_4 = $(this).serializeArray();

                    // Submit with AJAX
                    $.ajax({
                        type: "POST",
                        url: "{{ url('buyer_post') }}",
                        data: formData_4,
                        success: function(data) {
                            // console.log(data);
                            location.reload();
                        }
                    });
                });
        </script>
    </div>
</div>

{{-- ///Item and Buyer CRUD here --}}
@endowner

@admin
@php $json = json_decode($responseBody,true); ///Line DB
$json2 = json_decode(json_encode($responseBody2),true); ////User DB
$num = 1;
@endphp
<div class="container">
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
                                @for($k=0;$k<count($json);$k++) @php $new_l_id=$json[$k]['l_id'];
                                    $l_name=$json[$k]['l_name']; @endphp @if ($new_l_id==$l_id) <div class="mt-2 mb-4">
                                    <h1 class="fw-bold heading-text">{{ $l_name }}</h1>
                            </div> @endif @endfor
                            <form id="line_assign_overtime_post_<?php echo $l_id; ?>">
                                <input type="hidden" name="l_id" id="l_id_setting_active" value="{{ $l_id }}">

                                <div class="row g-3 my-2">
                                    <div class="col-12 col-md-4 mt-0">
                                        <label>Over Time (minute)</label>​
                                        <input type="number" class="form-control" name="over_time_minute"
                                            placeholder="100" required />
                                    </div>
                                </div>
                                <div style="overflow: auto;max-width:100%;max-height:600px;padding:0.5rem;">
                                    <table class="table" id="dynamic_field_<?php echo $l_id; ?>">
                                        <tr class="setting-tr-2">
                                            <td>
                                                <label>Buyer</label>
                                                <div>
                                                    <select
                                                        class="livesearch form-control category_select_<?php echo $l_id; ?>"
                                                        name="category[]" id="category_select_<?php echo $l_id; ?>">
                                                        <option value=''>-- Select buyer --</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <label>Style No.#</label>
                                                <input type="text" class="form-control" id="style_name"
                                                    name="style_name[]" placeholder="#0000" required />
                                            </td>
                                            <td>
                                                <label>Item Name</label>
                                                <div>
                                                    <select class="livesearch2 form-control p_name_<?php echo $l_id; ?>"
                                                        name="p_name[]" id="p_name_<?php echo $l_id; ?>">
                                                        <option value=''>-- Select item name --</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <label>Target</label>
                                                <input type="number" class="form-control" id="setting_target"
                                                    name="category_target[]" placeholder="Target" required />
                                            </td>
                                            <td>
                                                <br />
                                                <button type="button" name="add"
                                                    id="add_product_detail_<?php echo $l_id; ?>"
                                                    class="btn btn-success"><i
                                                        class="fas fa-plus-square fa-lg"></i></button>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-12 col-md-4">
                                    <input class="icon-btn-one btn my-2" type="submit" value="Add" />
                                </div>

                            </form>
                            <script>
                                $("#line_assign_overtime_post_<?php echo $l_id; ?>").submit(function(e) {
                    e.preventDefault();

                    // Get NON-INPUT table cell data
                    var box_2 = {};
                    var boxes_2 = [];
                        $('#dynamic_field_<?php echo $l_id; ?> .setting-tr-2').each(function() {
                            var category_select = $('#category_select_<?php echo $l_id; ?>', this).val();
                            var style_no = $('#style_name', this).val();
                            var p_name = $('#p_name_<?php echo $l_id; ?>', this).val();
                            var category_target = $('#setting_target', this).val();
                    box_2 = {
                        category_select: category_select,
                        style_no : style_no,
                        p_name: p_name,
                        category_target: category_target,
                        l_id : '<?php echo $l_id; ?>'
                    }
                    boxes_2.push(box_2);
                        });

                        // console.log(boxes_2);

                    // Get all INPUT form data and organize as array
                    var formData_2 = $(this).serializeArray();

                    // // Encode with JSON
                    var subArray_2 = JSON.stringify(boxes_2);

                    // // Add to formData array
                    formData_2.push({name: 'sub', value: subArray_2});
                console.log(formData_2);
                    // Submit with AJAX
                    $.ajax({
                        type: "POST",
                        url: "/line_assign_overtime_post",
                        data: formData_2,
                        success: function(data) {
                            // console.log(data);
                            location.reload();
                        }
                    });
                });
                            </script>

                            <script>
                                var i = 1;
                                $('#add_product_detail_<?php echo $l_id; ?>').click(function() {
i++;
$("#dynamic_field_<?php echo $l_id; ?>").append('<tr class="setting-tr-2" id="row' + i + '"><td><label>Buyer</label><div><select class="livesearch form-control category_select_<?php echo $l_id; ?>'+ i + '" name="category[]" id="category_select_<?php echo $l_id; ?>" required><option value="">-- Select buyer --</option></select></div></td> <td><label>Style No.#</label><input type="text" class="form-control" id="style_name" name="style_name[]" placeholder="#0000" required /></td><td> <label>Item Name</label><div></div><select class="livesearch2 form-control p_name_<?php echo $l_id; ?>'+i+'" name="p_name[]" id="p_name_<?php echo $l_id; ?>"><option value="">-- Select item name --</option></select></div></td><td><label>Target</label><input type="number" class="form-control" name="category_target[]" id="setting_target" placeholder="Target" required /></td><td><br/><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button></td></tr>');

$('.category_select_<?php echo $l_id; ?>' + i).select2({
dropdownParent: $('#LineModalActive<?php echo $l_id;?>'),
tags:true,
ajax: {
url: "/buyer_search",
type: "GET",
dataType: 'json',
delay: 0,
data: function (params) {
return {
search: params.term // search term
};
},
processResults: function (response) {
return {
results: response
};
},
cache: true
}
            });

$('.p_name_<?php echo $l_id; ?>' + i).select2({
dropdownParent: $('#LineModalActive<?php echo $l_id;?>'),
tags:true,
ajax: {
url: "/item_search",
type: "GET",
dataType: 'json',
delay: 0,
data: function (params) {
return {
search: params.term // search term
};
},
processResults: function (response) {
return {
results: response
};
},
cache: true
}
            });
                                });


                            </script>

                            <script type="text/javascript">
                                $('.category_select_<?php echo $l_id; ?>').select2({
dropdownParent: $('#LineModalActive<?php echo $l_id;?>'),
tags:true,
ajax: {
url: "/buyer_search",
type: "GET",
dataType: 'json',
delay: 0,
data: function (params) {
return {
search: params.term // search term
};
},
processResults: function (response) {
return {
results: response
};
},
cache: true
}
});

                            </script>
                            <script type="text/javascript">
                                $('.p_name_<?php echo $l_id; ?>').select2({
                dropdownParent: $('#LineModalActive<?php echo $l_id;?>'),
                tags:true,
                ajax: {
                url: "/item_search",
                type: "GET",
                dataType: 'json',
                delay: 0,
                data: function (params) {
                return {
                search: params.term // search term
                };
                },
                processResults: function (response) {
                return {
                results: response
                };
                },
                cache: true
                }
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
                                            <td id="a_work_hr_{{ $a_line_id }}"></td>
                                            <td> {{ date('g:i A',strtotime($a_s_time)) }}</td>
                                            <td>{{ date('g:i A',strtotime($a_lunch_s_time)) }} - {{ date('g:i
                                                A',strtotime($a_lunch_e_time)) }}</td>
                                            <td>{{ date('g:i A',strtotime($a_e_time)) }}</td>
                                            <td>{{ $a_work_min }}</td>
                                        </tr>
                                        <script>
                                            var a_work_hr_ = $("#a_work_hr_{{ $a_line_id }}");
                                            var a_work_hr_val = "<?php echo $a_work_hr; ?>";

                                            a_work_hr_val_split = a_work_hr_val.split(':');


                                            if(a_work_hr_val_split[1] == 0){
                                                a_work_hr_.text(a_work_hr_val_split[0]+'  hr');
                                            }
                                            if(a_work_hr_val_split[1] != 0){
                                                a_work_hr_.text(a_work_hr_val_split[0]+'  hr '+a_work_hr_val_split[1]+'  min');
                                            }
                                        </script>
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
                                            <th scope="col">Buyer Name</th>
                                            <th scope="col">Product Name</th>
                                            <th>Quantity</th>
                                        </tr>
                                    </thead>
                                    @php $number = 1; @endphp
                                    <tbody id="myTable">
                                        @foreach($p_detail as $p)
                                        @if ($p->l_id==$l_id)
                                        <tr>
                                            <td>{{ $number++ }}</td>
                                            <td>{{ $p->buyer_name }}</td>
                                            <td>{{ $p->p_name }}</td>
                                            <td>{{ $p->quantity }}</td>
                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-12 col-md-6 m-auto text-center">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
<div class="modal fade" id="LineModal" aria-labelledby="exampleModalLabel" aria-hidden="true"
    aria-labelledby="exampleModalToggleLabel" style="overflow:hidden;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body text-start">
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
                                    $u_name=$json2[$i]['name'];$u_role=$json2[$i]['role']; @endphp @if($u_role==2)
                                    <option value="{{$u_id}}">
                                    {{$u_name}}
                                    </option> @endif @endfor
                            </select>
                        </div>
                        <div class="col-12 col-md-4 mt-0">
                            <br />
                            <input type="button" class="btn btn-secondary" value="Autofill Time" id="time_type_1">
                        </div>
                        <input type="hidden" class="form-control" name="work_hour" placeholder="7 Hours" id="work_hour"
                            required readonly />
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
                                    <input type="time" class="form-control" name="lunch_start" id="lunch_start"
                                        step="300" required>
                                </div>
                                <div class="col-6">
                                    <input type="time" class="form-control" name="lunch_end" id="lunch_end" step="300"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 mt-0">
                            <label>Ending Time</label>​<br />
                            <input type="time" class="form-control" id="end_time" name="end_time" step="300" required>
                        </div>
                    </div>
                    <div class="row g-3 my-2">
                        <div class="col-12 col-md-4 mt-0">
                            <label>Work Progress by (minute)</label>​
                            <input type="number" class="form-control" name="progress" id="progress" placeholder="30"
                                required />
                        </div>
                    </div>
            </div>

            <script>
                $("#time_type_1").click(function () {
                    var start_time = $("#start_time");
                    var end_time = $("#end_time");
                    var lunch_start = $("#lunch_start");
                    var lunch_end = $("#lunch_end");
                    var progress = $("#progress");

                    start_time.val("07:30");
                    end_time.val("18:00");
                    lunch_start.val("11:30");
                    lunch_end.val("12:00");
                    progress.val("60");
                });
            </script>
            <script>
                $("#new_category_btn").click(function(e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "{{ url('create_buyer') }}",
        data: {
            buyer_name: $("#new_buyer_name").val(),
        },
        success: function(result) {
            alert('Buyer Added');
        },
        error: function(result) {
            alert('Error creating buyer');
        }
    });
});
            </script>
            <div class="row g-3 my-2">
                <div style="overflow: auto;max-width:100%;max-height:600px;padding:0.5rem;">
                    <table class="table" id="dynamic_field">
                        <tr class="setting-tr">
                            <td>
                                <label>Buyer</label>
                                <div>
                                    <select class="livesearch form-control category_select" name="category[]"
                                        id="category_select">
                                        <option value=''>-- Select buyer --</option>
                                    </select>
                                </div>
                            </td>
                            <td>
                                <label>Style No.#</label>
                                <input type="text" class="form-control" id="style_name" name="style_name[]"
                                    placeholder="#0000" required />
                            </td>
                            <td>
                                <label>Item Name</label>
                                <div>
                                    <select class="livesearch2 form-control p_name" name="p_name[]" id="p_name">
                                        <option value=''>-- Select item name --</option>
                                    </select>
                                </div>
                            </td>
                            <td>
                                <label>Target</label>
                                <input type="number" class="form-control" id="setting_target" name="category_target[]"
                                    placeholder="Target" required />
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
            var style_no = $('#style_name', this).val();
            var p_name = $('#p_name', this).val();
            var category_target = $('#setting_target', this).val();
    box = {
        category_select: category_select,
        style_no : style_no,
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
// console.log(formData);
    // Submit with AJAX
    $.ajax({
        type: "POST",
        url: "/line_assign_post",
        data: formData,
        success: function(data) {
            // console.log(data);
            location.reload();
        }
    });
});
            </script>

            <script>
                var i = 1;
$("#add_product_detail").click(function () {
i++;
$("#dynamic_field").append('<tr class="setting-tr" id="row' + i + '"><td><label>Buyer</label><div><select class="livesearch form-control category_select_'+ i + '" name="category[]" id="category_select" required><option value="">-- Select buyer --</option></select></div></td> <td><label>Style No.#</label><input type="text" class="form-control" id="style_name" name="style_name[]" placeholder="#0000" required /></td><td> <label>Item Name</label><div></div><select class="livesearch2 form-control p_name_'+i+'" name="p_name[]" id="p_name"><option value="">-- Select item name --</option></select></div></td><td><label>Target</label><input type="number" class="form-control" name="category_target[]" id="setting_target" placeholder="Target" required /></td><td><br/><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button></td></tr>');



$('.category_select_' + i).select2({
dropdownParent: $('#LineModal'),
tags:true,
ajax: {
url: "/buyer_search",
type: "GET",
dataType: 'json',
delay: 0,
data: function (params) {
return {
search: params.term // search term
};
},
processResults: function (response) {
return {
results: response
};
},
cache: true
}
            });

$('.p_name_' + i).select2({
dropdownParent: $('#LineModal'),
tags:true,
ajax: {
url: "/item_search",
type: "GET",
dataType: 'json',
delay: 0,
data: function (params) {
return {
search: params.term // search term
};
},
processResults: function (response) {
return {
results: response
};
},
cache: true
}
            });

});

            </script>
            <script type="text/javascript">
                $('.p_name').select2({
dropdownParent: $('#LineModal'),
tags:true,
ajax: {
url: "/item_search",
type: "GET",
dataType: 'json',
delay: 0,
data: function (params) {
return {
search: params.term // search term
};
},
processResults: function (response) {
return {
results: response
};
},
cache: true
}
            });
            </script>

            <script type="text/javascript">
                $('.category_select').select2({
dropdownParent: $('#LineModal'),
tags:true,
ajax: {
url: "/buyer_search",
type: "GET",
dataType: 'json',
delay: 0,
data: function (params) {
return {
search: params.term // search term
};
},
processResults: function (response) {
return {
results: response
};
},
cache: true
}
            });

            </script>



        </div>
    </div>
</div>

@if($line_assign_detail)<h1 class="fw-bold heading-text my-4 fs-3">Assigned Line Details</h1>
<table class="table table-striped my-4 tableFixHead results p-0 text-center">
    <thead>
        <tr class="tr-2">
            <th scope="col">No.</th>
            <th scope="col">Line Name</th>
            <th scope="col">Line Manager Name</th>
            <th scope="col">Target</th>
            <th scope="col">Total Working Hour(s)</th>
            <th scope="col">Starting Time</th>
            <th scope="col">Lunch Time</th>
            <th scope="col">Ending Time</th>
            <th scope="col">Delete</th>
        </tr>
    </thead>
    <tbody id="myTable">
        @php
        $num_count =1;
        @endphp

        @foreach($line_assign_detail as $l_assign)

        @php
        $l_a_id = $l_assign->assign_id; $l_l_id = $l_assign->l_id;
        $l_l_name=$l_assign->l_name;$l_assign_date =
        $l_assign->assign_date;
        $l_a_status=$l_assign->a_status; $l_u_id = $l_assign->user_id; $l_u_name = $l_assign->name;
        $l_main_target=$l_assign->main_target;$l_s_time=$l_assign->s_time;$l_e_time=$l_assign->e_time;$l_lunch_s_time=$l_assign->lunch_s_time;$l_lunch_e_time=$l_assign->lunch_e_time;
        $l_work_hr=$l_assign->t_work_hr; @endphp
        <tr>
            <td>{{ $num_count++ }}</td>
            <td>{{ $l_l_name }}</td>
            <td>{{ $l_u_name }}</td>
            <td>{{ $l_main_target }}</td>
            <td id="l_work_hr_{{ $l_l_id }}"></td>
            <td>{{ date('g:i A',strtotime($l_s_time)) }}</td>
            <td>{{ date('g:i A',strtotime($l_lunch_s_time)) }} - {{ date('g:i A',strtotime($l_lunch_e_time)) }}</td>
            <td>{{ date('g:i A',strtotime($l_e_time)) }}</td>
            <td>
                <a class='btn btn-danger text-white' href='{{ url("/delete_assign_line") }}/{{ $l_a_id }}/{{ $l_l_id }}'
                    onclick="return confirm('Confirm deleting Line Assign?')">Delete</a>
            </td>
        </tr>
        <script>
            var l_work_hr = $("#l_work_hr_{{ $l_l_id }}");
            var l_work_hr_val = "<?php echo $l_work_hr; ?>";

            l_work_hr_val_split = l_work_hr_val.split(':');


            if(l_work_hr_val_split[1] == 0){
                l_work_hr.text(l_work_hr_val_split[0]+'  hr');
            }
            if(l_work_hr_val_split[1] != 0){
                l_work_hr.text(l_work_hr_val_split[0]+'  hr '+l_work_hr_val_split[1]+'  min');
            }
        </script>
        @endforeach

    </tbody>
</table>

@endif

{{-- Add Line Manger list for Line_Entry Here --}}

{{-- Add item_list and buyer_list CRUD Here --}}

<div class="row">
    <div class="col-6">
        <div class="container-fluid p-0">
            <form id="item_post">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#itemModal">
                    Add Item
                </button>

                <!-- Modal -->
                <div class="modal fade" id="itemModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add New Item</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div style="overflow: auto;max-width:100%;max-height:600px;padding:0.5rem;">
                                    <table class="table">
                                        <tr class="">
                                            <td>
                                                <label>Item Name</label>
                                                <input type="text" class="form-control" id="item_name" name="item_name"
                                                    placeholder="#0000" required />
                                            </td>
                                            <td>
                                                <label>Remark</label>
                                                <textarea class="form-control" name="item_remark" placeholder="Note"
                                                    id="item_remark" maxlength="150"></textarea>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <input type="submit" name="btn_item_submit" class="btn btn-primary" value="Save">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div style="overflow: auto;max-width:100%;max-height:600px;padding:0.5rem;">
                <table class="table tableFixHead2 text-center">
                    <thead>
                        <tr>
                            <th>Item Name</th>
                            <th>Remark</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($item_list as $item)
                        <tr>
                            <td>{{ $item->item_name }}</td>
                            <td>{{ $item->remark }}</td>
                            <td>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#itemEditModal_{{ $item->item_id }}">
                                    Edit
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="itemEditModal_{{ $item->item_id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form action="{{ url('item_edit') }}" method="POST">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    @foreach($item_list as $item_edit)
                                                    @if($item_edit->item_id == $item->item_id)
                                                    <form id="item_edit_post">
                                                        <input type="hidden" name="item_id"
                                                            value="{{ $item_edit->item_id }}">
                                                        <h5 class="fw-bold heading-text">{{
                                                            $item->item_name }}
                                                        </h5>
                                                        <div
                                                            style="overflow: auto;max-width:100%;max-height:600px;padding:0.5rem;">
                                                            <table class="table">
                                                                <tr class="">
                                                                    <td>
                                                                        <label>Item Name</label>
                                                                        <input type="text" class="form-control"
                                                                            id="item_name" name="item_name"
                                                                            placeholder="#0000"
                                                                            value="{{ $item_edit->item_name }}" />
                                                                    </td>
                                                                    <td>
                                                                        <label>Remark</label>
                                                                        <textarea class="form-control"
                                                                            name="item_remark" placeholder="Note"
                                                                            id="item_remark"
                                                                            maxlength="150">{{ $item_edit->remark }}</textarea>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </form>
                                                    @endif
                                                    @endforeach
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <input class="icon-btn-one btn my-2" type="submit" value="Submit"
                                                        name="submit" />
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


        <script>
            $("#item_post").submit(function(e) {
                    e.preventDefault();

                    // Get all INPUT form data and organize as array
                    var formData_3 = $(this).serializeArray();
                    // Submit with AJAX
                    $.ajax({
                        type: "POST",
                        url: "{{ url('item_post') }}",
                        data: formData_3,
                        success: function(data) {
                            // console.log(data);
                            location.reload();
                        }
                    });
                });
        </script>
    </div>
    <div class="col-6">
        <form id="buyer_post">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#buyerModal">
                Add Buyer
            </button>

            <!-- Modal -->
            <div class="modal fade" id="buyerModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New Buyer</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div style="overflow: auto;max-width:100%;max-height:600px;padding:0.5rem;">
                                <table class="table">
                                    <tr class="">
                                        <td>
                                            <label>Buyer Name</label>
                                            <input type="text" class="form-control" id="buyer_name" name="buyer_name"
                                                placeholder="#0000" required />
                                        </td>
                                        <td>
                                            <label>Remark</label>
                                            <textarea class="form-control" name="buyer_remark" placeholder="Note"
                                                id="buyer_remark" maxlength="150"></textarea>
                                        </td>

                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" name="btn_buyer_submit" class="btn btn-primary" value="Save">
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div style="overflow: auto;max-width:100%;max-height:600px;padding:0.5rem;">
            <table class="table tableFixHead2 text-center">
                <thead>
                    <tr>
                        <th>Buyer Name</th>
                        <th>Remark</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($buyer_list as $buyer)
                    <tr>
                        <td>{{ $buyer->buyer_name }}</td>
                        <td>{{ $buyer->remark }}</td>
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#buyerEditModal_{{ $buyer->buyer_id }}">
                                Edit
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="buyerEditModal_{{ $buyer->buyer_id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="{{ url('buyer_edit') }}" method="POST">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                @foreach($buyer_list as $buyer_edit)
                                                @if($buyer_edit->buyer_id == $buyer->buyer_id)
                                                <form id="buyer_edit_post">
                                                    <input type="hidden" name="buyer_id"
                                                        value="{{ $buyer_edit->buyer_id }}">
                                                    <h5 class="fw-bold heading-text">{{
                                                        $buyer_edit->buyer_name }}
                                                    </h5>
                                                    <div
                                                        style="overflow: auto;max-width:100%;max-height:600px;padding:0.5rem;">
                                                        <table class="table">
                                                            <tr class="">
                                                                <td>
                                                                    <label>Buyer Name</label>
                                                                    <input type="text" class="form-control"
                                                                        id="buyer_name" name="buyer_name"
                                                                        placeholder="#0000"
                                                                        value="{{ $buyer_edit->buyer_name }}" />
                                                                </td>
                                                                <td>
                                                                    <label>Remark</label>
                                                                    <textarea class="form-control" name="buyer_remark"
                                                                        placeholder="Note" id="buyer_remark"
                                                                        maxlength="150">{{ $buyer_edit->remark }}</textarea>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </form>
                                                @endif
                                                @endforeach
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <input class="icon-btn-one btn my-2" type="submit" value="Submit"
                                                    name="submit" />
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <script>
            $("#buyer_post").submit(function(e) {
                    e.preventDefault();

                    // Get all INPUT form data and organize as array
                    var formData_4 = $(this).serializeArray();

                    // Submit with AJAX
                    $.ajax({
                        type: "POST",
                        url: "{{ url('buyer_post') }}",
                        data: formData_4,
                        success: function(data) {
                            // console.log(data);
                            location.reload();
                        }
                    });
                });
        </script>
    </div>
</div>

{{-- ///Item and Buyer CRUD here --}}
@endadmin


@operator

@php $json = json_decode($responseBody,true); ///Line DB
$json2 = json_decode(json_encode($responseBody2),true); ////User DB
$num = 1;
@endphp
<div class="container">
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
                                @for($k=0;$k<count($json);$k++) @php $new_l_id=$json[$k]['l_id'];
                                    $l_name=$json[$k]['l_name']; @endphp @if ($new_l_id==$l_id) <div class="mt-2 mb-4">
                                    <h1 class="fw-bold heading-text">{{ $l_name }}</h1>
                            </div> @endif @endfor
                            <form id="line_assign_overtime_post_<?php echo $l_id; ?>">
                                <input type="hidden" name="l_id" id="l_id_setting_active" value="{{ $l_id }}">

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
                                    <table class="table" id="dynamic_field_<?php echo $l_id; ?>">
                                        <tr class="setting-tr-2">
                                            <td>
                                                <label>Buyer</label>
                                                <div>
                                                    <select
                                                        class="livesearch form-control category_select_<?php echo $l_id; ?>"
                                                        name="category[]" id="category_select_<?php echo $l_id; ?>">
                                                        <option value=''>-- Select buyer --</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <label>Style No.#</label>
                                                <input type="text" class="form-control" id="style_name"
                                                    name="style_name[]" placeholder="#0000" required />
                                            </td>
                                            <td>
                                                <label>Item Name</label>
                                                <div>
                                                    <select class="livesearch2 form-control p_name_<?php echo $l_id; ?>"
                                                        name="p_name[]" id="p_name_<?php echo $l_id; ?>">
                                                        <option value=''>-- Select item name --</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <label>Target</label>
                                                <input type="number" class="form-control" id="setting_target"
                                                    name="category_target[]" placeholder="Target" required />
                                            </td>
                                            <td>
                                                <br />
                                                <button type="button" name="add"
                                                    id="add_product_detail_<?php echo $l_id; ?>"
                                                    class="btn btn-success"><i
                                                        class="fas fa-plus-square fa-lg"></i></button>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-12 col-md-4">
                                    <input class="icon-btn-one btn my-2" type="submit" value="Add" />
                                </div>

                            </form>
                            <script>
                                $("#line_assign_overtime_post_<?php echo $l_id; ?>").submit(function(e) {
                    e.preventDefault();

                    // Get NON-INPUT table cell data
                    var box_2 = {};
                    var boxes_2 = [];
                        $('#dynamic_field_<?php echo $l_id; ?> .setting-tr-2').each(function() {
                            var category_select = $('#category_select_<?php echo $l_id; ?>', this).val();
                            var style_no = $('#style_name', this).val();
                            var p_name = $('#p_name_<?php echo $l_id; ?>', this).val();
                            var category_target = $('#setting_target', this).val();
                    box_2 = {
                        category_select: category_select,
                        style_no : style_no,
                        p_name: p_name,
                        category_target: category_target,
                        l_id : '<?php echo $l_id; ?>'
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
                    $.ajax({
                        type: "POST",
                        url: "{{ url('line_assign_overtime_post') }}",
                        data: formData_2,
                        success: function(data) {
                            // console.log(data);
                            location.reload();
                        }
                    });
                });
                            </script>

                            <script>
                                var i = 1;
    $('#add_product_detail_<?php echo $l_id; ?>').click(function() {
i++;
$("#dynamic_field_<?php echo $l_id; ?>").append('<tr class="setting-tr-2" id="row' + i + '"><td><label>Buyer</label><div><select class="livesearch form-control category_select_<?php echo $l_id; ?>'+ i + '" name="category[]" id="category_select_<?php echo $l_id; ?>" required><option value="">-- Select buyer --</option></select></div></td> <td><label>Style No.#</label><input type="text" class="form-control" id="style_name" name="style_name[]" placeholder="#0000" required /></td><td> <label>Item Name</label><div></div><select class="livesearch2 form-control p_name_<?php echo $l_id; ?>'+i+'" name="p_name[]" id="p_name_<?php echo $l_id; ?>"><option value="">-- Select item name --</option></select></div></td><td><label>Target</label><input type="number" class="form-control" name="category_target[]" id="setting_target" placeholder="Target" required /></td><td><br/><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button></td></tr>');

$('.category_select_<?php echo $l_id; ?>' + i).select2({
dropdownParent: $('#LineModalActive<?php echo $l_id;?>'),
tags:true,
ajax: {
url: "/buyer_search",
type: "GET",
dataType: 'json',
delay: 0,
data: function (params) {
return {
search: params.term // search term
};
},
processResults: function (response) {
return {
results: response
};
},
cache: true
}
});

$('.p_name_<?php echo $l_id; ?>' + i).select2({
dropdownParent: $('#LineModalActive<?php echo $l_id;?>'),
tags:true,
ajax: {
url: "/item_search",
type: "GET",
dataType: 'json',
delay: 0,
data: function (params) {
return {
search: params.term // search term
};
},
processResults: function (response) {
return {
results: response
};
},
cache: true
}
});
    });


                            </script>
                            <script type="text/javascript">
                                $('.category_select_<?php echo $l_id; ?>').select2({
dropdownParent: $('#LineModalActive<?php echo $l_id;?>'),
tags:true,
ajax: {
url: "/buyer_search",
type: "GET",
dataType: 'json',
delay: 0,
data: function (params) {
return {
search: params.term // search term
};
},
processResults: function (response) {
return {
results: response
};
},
cache: true
}
});

                            </script>
                            <script type="text/javascript">
                                $('.p_name_<?php echo $l_id; ?>').select2({
                dropdownParent: $('#LineModalActive<?php echo $l_id;?>'),
                tags:true,
                ajax: {
                url: "/item_search",
                type: "GET",
                dataType: 'json',
                delay: 0,
                data: function (params) {
                return {
                search: params.term // search term
                };
                },
                processResults: function (response) {
                return {
                results: response
                };
                },
                cache: true
                }
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
                                            <td id="a_work_hr_{{ $a_line_id }}">{{ $a_work_hr }}</td>
                                            <td>{{ $a_s_time }}</td>
                                            <td>{{ $a_lunch_s_time }} - {{ $a_lunch_e_time }}</td>
                                            <td>{{ $a_e_time }}</td>
                                            <td>{{ $a_work_min }}</td>
                                        </tr>
                                        <script>
                                            var a_work_hr_ = $("#a_work_hr_{{ $a_line_id }}");
                                            var a_work_hr_val = "<?php echo $a_work_hr; ?>";

                                            a_work_hr_val_split = a_work_hr_val.split(':');


                                            if(a_work_hr_val_split[1] == 0){
                                                a_work_hr_.text(a_work_hr_val_split[0]+'  hr');
                                            }
                                            if(a_work_hr_val_split[1] != 0){
                                                a_work_hr_.text(a_work_hr_val_split[0]+'  hr '+a_work_hr_val_split[1]+'  min');
                                            }
                                        </script>
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
                                            <td>{{ $p->buyer_name }}</td>
                                            <td>{{ $p->p_name }}</td>
                                            <td>{{ $p->quantity }}</td>
                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-12 col-md-6 m-auto text-center">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
                                    $u_name=$json2[$i]['name'];$u_role=$json2[$i]['role']; @endphp @if($u_role==2)
                                    <option value="{{$u_id}}">
                                    {{$u_name}}
                                    </option> @endif @endfor
                            </select>
                        </div>
                        <div class="col-12 col-md-4 mt-0">
                            <br />
                            <input type="button" class="btn btn-secondary" value="Autofill Time" id="time_type_1">
                        </div>
                        <input type="hidden" class="form-control" name="work_hour" placeholder="7 Hours" id="work_hour"
                            required readonly />
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
                                    <input type="time" class="form-control" name="lunch_start" id="lunch_start"
                                        step="300" required>
                                </div>
                                <div class="col-6">
                                    <input type="time" class="form-control" name="lunch_end" id="lunch_end" step="300"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 mt-0">
                            <label>Ending Time</label>​<br />
                            <input type="time" class="form-control" id="end_time" name="end_time" step="300" required>
                        </div>
                    </div>
                    <div class="row g-3 my-2">
                        <div class="col-12 col-md-4 mt-0">
                            <label>Work Progress by (minute)</label>​
                            <input type="number" class="form-control" name="progress" id="progress" placeholder="30"
                                required />
                        </div>
                    </div>
            </div>


            <script>
                $("#time_type_1").click(function () {
                    var start_time = $("#start_time");
                    var end_time = $("#end_time");
                    var lunch_start = $("#lunch_start");
                    var lunch_end = $("#lunch_end");
                    var progress = $("#progress");

                    start_time.val("07:30");
                    end_time.val("18:00");
                    lunch_start.val("11:30");
                    lunch_end.val("12:00");
                    progress.val("60");
                });
            </script>
            <script>
                $("#new_category_btn").click(function(e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "{{ url('create_buyer') }}",
        data: {
            buyer_name: $("#new_buyer_name").val(),
        },
        success: function(result) {
            alert('Buyer Added');
        },
        error: function(result) {
            alert('Error creating buyer');
        }
    });
});
            </script>
            <div class="row g-3 my-2">
                <div style="overflow: auto;max-width:100%;max-height:600px;padding:0.5rem;">
                    <table class="table" id="dynamic_field">
                        <tr class="setting-tr">
                            <td>
                                <label>Buyer</label>
                                <div>
                                    <select class="livesearch form-control category_select" name="category[]"
                                        id="category_select">
                                        <option value=''>-- Select buyer --</option>
                                    </select>
                                </div>
                            </td>
                            <td>
                                <label>Style No.#</label>
                                <input type="text" class="form-control" id="style_name" name="style_name[]"
                                    placeholder="#0000" required />
                            </td>
                            <td>
                                <label>Item Name</label>
                                <div>
                                    <select class="livesearch2 form-control p_name" name="p_name[]" id="p_name">
                                        <option value=''>-- Select item name --</option>
                                    </select>
                                </div>
                            </td>
                            <td>
                                <label>Target</label>
                                <input type="number" class="form-control" id="setting_target" name="category_target[]"
                                    placeholder="Target" required />
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
            var style_no = $('#style_name', this).val();
            var p_name = $('#p_name', this).val();
            var category_target = $('#setting_target', this).val();
    box = {
        category_select: category_select,
        style_no : style_no,
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
// console.log(formData);
    // Submit with AJAX
    $.ajax({
        type: "POST",
        url: "/line_assign_post",
        data: formData,
        success: function(data) {
            // console.log(data);
            location.reload();
        }
    });
});
            </script>
            <script>
                var i = 1;
$("#add_product_detail").click(function () {
i++;
$("#dynamic_field").append('<tr class="setting-tr" id="row' + i + '"><td><label>Buyer</label><div><select class="livesearch form-control category_select_'+ i + '" name="category[]" id="category_select" required><option value="">-- Select buyer --</option></select></div></td> <td><label>Style No.#</label><input type="text" class="form-control" id="style_name" name="style_name[]" placeholder="#0000" required /></td><td> <label>Item Name</label><div></div><select class="livesearch2 form-control p_name_'+i+'" name="p_name[]" id="p_name"><option value="">-- Select item name --</option></select></div></td><td><label>Target</label><input type="number" class="form-control" name="category_target[]" id="setting_target" placeholder="Target" required /></td><td><br/><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button></td></tr>');



$('.category_select_' + i).select2({
dropdownParent: $('#LineModal'),
tags:true,
ajax: {
url: "/buyer_search",
type: "GET",
dataType: 'json',
delay: 0,
data: function (params) {
return {
search: params.term // search term
};
},
processResults: function (response) {
return {
results: response
};
},
cache: true
}
            });

$('.p_name_' + i).select2({
dropdownParent: $('#LineModal'),
tags:true,
ajax: {
url: "/item_search",
type: "GET",
dataType: 'json',
delay: 0,
data: function (params) {
return {
search: params.term // search term
};
},
processResults: function (response) {
return {
results: response
};
},
cache: true
}
            });

});

            </script>
            <script type="text/javascript">
                $('.p_name').select2({
dropdownParent: $('#LineModal'),
tags:true,
ajax: {
url: "/item_search",
type: "GET",
dataType: 'json',
delay: 0,
data: function (params) {
return {
search: params.term // search term
};
},
processResults: function (response) {
return {
results: response
};
},
cache: true
}
            });
            </script>

            <script type="text/javascript">
                $('.category_select').select2({
dropdownParent: $('#LineModal'),
tags:true,
ajax: {
url: "/buyer_search",
type: "GET",
dataType: 'json',
delay: 0,
data: function (params) {
return {
search: params.term // search term
};
},
processResults: function (response) {
return {
results: response
};
},
cache: true
}
            });

            </script>
        </div>
    </div>
</div>

@if($line_assign_detail)<h1 class="fw-bold heading-text my-4 fs-3">Assigned Line Details</h1>
<table class="table table-striped my-4 tableFixHead results p-0 text-center">
    <thead>
        <tr class="tr-2">
            <th scope="col">No.</th>
            <th scope="col">Line Name</th>
            <th scope="col">Line Manager Name</th>
            <th scope="col">Target</th>
            <th scope="col">Total Working Hour(s)</th>
            <th scope="col">Starting Time</th>
            <th scope="col">Lunch Time</th>
            <th scope="col">Ending Time</th>
            <th scope="col">Delete</th>
        </tr>
    </thead>
    <tbody id="myTable">
        @php
        $num_count =1;
        @endphp

        @foreach($line_assign_detail as $l_assign)

        @php
        $l_a_id = $l_assign->assign_id; $l_l_id = $l_assign->l_id;
        $l_l_name=$l_assign->l_name;$l_assign_date =
        $l_assign->assign_date;
        $l_a_status=$l_assign->a_status; $l_u_id = $l_assign->user_id; $l_u_name = $l_assign->name;
        $l_main_target=$l_assign->main_target;$l_s_time=$l_assign->s_time;$l_e_time=$l_assign->e_time;$l_lunch_s_time=$l_assign->lunch_s_time;$l_lunch_e_time=$l_assign->lunch_e_time;
        $l_work_hr=$l_assign->t_work_hr; @endphp
        <tr>
            <td>{{ $num_count++ }}</td>
            <td>{{ $l_l_name }}</td>
            <td>{{ $l_u_name }}</td>
            <td>{{ $l_main_target }}</td>
            <td id="l_work_hr_{{ $l_l_id }}">{{ $l_work_hr }}</td>
            <td>{{ $l_s_time }}</td>
            <td>{{ $l_lunch_s_time }} - {{ $l_lunch_e_time }}</td>
            <td>{{ $l_e_time }}</td>
            <td>
                <a class='btn btn-danger text-white' href='{{ url("/delete_assign_line") }}/{{ $l_a_id }}/{{ $l_l_id }}'
                    onclick="return confirm('Confirm deleting Line Assign?')">Delete</a>
            </td>
        </tr>
        <script>
            var l_work_hr = $("#l_work_hr_{{ $l_l_id }}");
            var l_work_hr_val = "<?php echo $l_work_hr; ?>";

            l_work_hr_val_split = l_work_hr_val.split(':');


            if(l_work_hr_val_split[1] == 0){
                l_work_hr.text(l_work_hr_val_split[0]+'  hr');
            }
            if(l_work_hr_val_split[1] != 0){
                l_work_hr.text(l_work_hr_val_split[0]+'  hr '+l_work_hr_val_split[1]+'  min');
            }
        </script>
        @endforeach

    </tbody>
</table>
@endif

{{-- Add Line Manger list for Line_Entry Here --}}

{{-- Add item_list and buyer_list CRUD Here --}}

<div class="row">
    <div class="col-6">
        <div class="container-fluid p-0">
            <form id="item_post">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#itemModal">
                    Add Item
                </button>

                <!-- Modal -->
                <div class="modal fade" id="itemModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add New Item</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div style="overflow: auto;max-width:100%;max-height:600px;padding:0.5rem;">
                                    <table class="table">
                                        <tr class="">
                                            <td>
                                                <label>Item Name</label>
                                                <input type="text" class="form-control" id="item_name" name="item_name"
                                                    placeholder="#0000" required />
                                            </td>
                                            <td>
                                                <label>Remark</label>
                                                <textarea class="form-control" name="item_remark" placeholder="Note"
                                                    id="item_remark" maxlength="150"></textarea>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <input type="submit" name="btn_item_submit" class="btn btn-primary" value="Save">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div style="overflow: auto;max-width:100%;max-height:600px;padding:0.5rem;">
                <table class="table tableFixHead2 text-center">
                    <thead>
                        <tr>
                            <th>Item Name</th>
                            <th>Remark</th>
                            <th>Edit</th>
                            {{-- <th>Delete</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($item_list as $item)
                        <tr>
                            <td>{{ $item->item_name }}</td>
                            <td>{{ $item->remark }}</td>
                            <td>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#itemEditModal_{{ $item->item_id }}">
                                    Edit
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="itemEditModal_{{ $item->item_id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form action="{{ url('item_edit') }}" method="POST">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    @foreach($item_list as $item_edit)
                                                    @if($item_edit->item_id == $item->item_id)
                                                    <form id="item_edit_post">
                                                        <input type="hidden" name="item_id"
                                                            value="{{ $item_edit->item_id }}">
                                                        <h5 class="fw-bold heading-text">{{
                                                            $item->item_name }}
                                                        </h5>
                                                        <div
                                                            style="overflow: auto;max-width:100%;max-height:600px;padding:0.5rem;">
                                                            <table class="table">
                                                                <tr class="">
                                                                    <td>
                                                                        <label>Item Name</label>
                                                                        <input type="text" class="form-control"
                                                                            id="item_name" name="item_name"
                                                                            placeholder="#0000"
                                                                            value="{{ $item_edit->item_name }}" />
                                                                    </td>
                                                                    <td>
                                                                        <label>Remark</label>
                                                                        <textarea class="form-control"
                                                                            name="item_remark" placeholder="Note"
                                                                            id="item_remark"
                                                                            maxlength="150">{{ $item_edit->remark }}</textarea>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </form>
                                                    @endif
                                                    @endforeach
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <input class="icon-btn-one btn my-2" type="submit" value="Submit"
                                                        name="submit" />
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


        <script>
            $("#item_post").submit(function(e) {
                    e.preventDefault();

                    // Get all INPUT form data and organize as array
                    var formData_3 = $(this).serializeArray();
                    // Submit with AJAX
                    $.ajax({
                        type: "POST",
                        url: "{{ url('item_post') }}",
                        data: formData_3,
                        success: function(data) {
                            // console.log(data);
                            location.reload();
                        }
                    });
                });
        </script>
    </div>
    <div class="col-6">
        <form id="buyer_post">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#buyerModal">
                Add Buyer
            </button>

            <!-- Modal -->
            <div class="modal fade" id="buyerModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New Buyer</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div style="overflow: auto;max-width:100%;max-height:600px;padding:0.5rem;">
                                <table class="table">
                                    <tr class="">
                                        <td>
                                            <label>Buyer Name</label>
                                            <input type="text" class="form-control" id="buyer_name" name="buyer_name"
                                                placeholder="#0000" required />
                                        </td>
                                        <td>
                                            <label>Remark</label>
                                            <textarea class="form-control" name="buyer_remark" placeholder="Note"
                                                id="buyer_remark" maxlength="150"></textarea>
                                        </td>

                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" name="btn_buyer_submit" class="btn btn-primary" value="Save">
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div style="overflow: auto;max-width:100%;max-height:600px;padding:0.5rem;">
            <table class="table tableFixHead2 text-center">
                <thead>
                    <tr>
                        <th>Buyer Name</th>
                        <th>Remark</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($buyer_list as $buyer)
                    <tr>
                        <td>{{ $buyer->buyer_name }}</td>
                        <td>{{ $buyer->remark }}</td>
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#buyerEditModal_{{ $buyer->buyer_id }}">
                                Edit
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="buyerEditModal_{{ $buyer->buyer_id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="{{ url('buyer_edit') }}" method="POST">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                @foreach($buyer_list as $buyer_edit)
                                                @if($buyer_edit->buyer_id == $buyer->buyer_id)
                                                <form id="buyer_edit_post">
                                                    <input type="hidden" name="buyer_id"
                                                        value="{{ $buyer_edit->buyer_id }}">
                                                    <h5 class="fw-bold heading-text">{{
                                                        $buyer_edit->buyer_name }}
                                                    </h5>
                                                    <div
                                                        style="overflow: auto;max-width:100%;max-height:600px;padding:0.5rem;">
                                                        <table class="table">
                                                            <tr class="">
                                                                <td>
                                                                    <label>Buyer Name</label>
                                                                    <input type="text" class="form-control"
                                                                        id="buyer_name" name="buyer_name"
                                                                        placeholder="#0000"
                                                                        value="{{ $buyer_edit->buyer_name }}" />
                                                                </td>
                                                                <td>
                                                                    <label>Remark</label>
                                                                    <textarea class="form-control" name="buyer_remark"
                                                                        placeholder="Note" id="buyer_remark"
                                                                        maxlength="150">{{ $buyer_edit->remark }}</textarea>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </form>
                                                @endif
                                                @endforeach
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <input class="icon-btn-one btn my-2" type="submit" value="Submit"
                                                    name="submit" />
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <script>
            $("#buyer_post").submit(function(e) {
                    e.preventDefault();

                    // Get all INPUT form data and organize as array
                    var formData_4 = $(this).serializeArray();

                    // Submit with AJAX
                    $.ajax({
                        type: "POST",
                        url: "{{ url('buyer_post') }}",
                        data: formData_4,
                        success: function(data) {
                            // console.log(data);
                            location.reload();
                        }
                    });
                });
        </script>
    </div>
</div>

{{-- ///Item and Buyer CRUD here --}}
@endoperator

@line_manager
<script type="text/javascript">
    window.location = "{{url('line_entry')}}";
</script>
@endline_manager
@endsection

@endsection
