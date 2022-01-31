@extends('layouts.app')

@section('content')
@section('content_2')
@php $json = json_decode($responseBody,true); ///Line DB
$json2 = json_decode($responseBody2,true); ////User DB
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
                                    <div class="mt-2 mb-4">
                                        <h1 class="fw-bold heading-text" id="l_setting_name_active"></h1>
                                    </div>
                                    <form action="{{ url('line_assign_overtime_post') }}" method="POST">
                                        <input type="text" name="l_id" id="l_id_setting_active">
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
                                            <div class="col-12 col-md-4">
                                                <input class="icon-btn-one btn my-2" type="submit" value="Add"
                                                    name="submit" />
                                            </div>
                                        </div>
                                    </form>

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
                                                $a_work_min=$l_2->work_min;
                                                $a_work_hr=$l_2->work_hr;
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
                                            @foreach($overTime as $ot)
                                            <tbody id="myTable">
                                                <tr>
                                                    <td>{{ $number++ }}</td>
                                                    <td>{{ $ot->ot_min }}</td>
                                                    <td>{{ $ot->ot_target }}</td>
                                                    <td>{{ $ot->created_at }}</td>
                                                    <td>{{ $ot->updated_at }}</td>
                                                </tr>
                                            </tbody>
                                            @endforeach
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
                    <script>
                        var LineModalActive = document.getElementById(
                            "LineModalActive<?php echo $l_id; ?>"
                            );
                                LineModalActive.addEventListener("show.bs.modal", function (event) {
                                // Button that triggered the modal
                                var button = event.relatedTarget;
                                // Extract info from data-bs-* attributes
                                var l_id_active = button.getAttribute("data-bs-l-id-active");
                                var l_name_active = button.getAttribute("data-bs-l-name-active");
                                var l_status_active = button.getAttribute("data-bs-l-status-active");

                                var l_id_setting_active = document.getElementById("l_id_setting_active");
                                var l_setting_name_active = document.getElementById("l_setting_name_active");

                                l_id_setting_active.value = l_id_active;
                                l_setting_name_active.innerHTML = l_name_active;
                                });
                    </script>
                    @elseif($a_status==0)
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-secondary w-75" data-bs-toggle="modal"
                        data-bs-target="#LineModal" data-bs-l-id="{{ $l_id }}" data-bs-l-name="{{ $l_name }}"
                        id="line_setting_btn">
                        {{$l_name}}
                    </button>
                    @endif

            </div>
            @endfor
        </div>
        <!-- Modal -->
        <div class="modal fade" id="LineModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body text-start">
                        <form action="{{ url('line_assign_post') }}" method="POST">
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
                                <div class=" col-12 col-md-4 mt-0">
                                    <label>Target</label>
                                    <input type="text" class="form-control" name="target" placeholder="100" required />
                                </div>
                                <div class="col-12 col-md-4 mt-0">
                                    <label>Total Working Hour(s)</label>
                                    <input type="text" class="form-control" name="work_hour" placeholder="7 Hours"
                                        id="work_hour" required readonly />
                                </div>
                            </div>
                            <div class="row g-3 my-2">
                                <div class="col-12 col-md-4 mt-0">
                                    <label>Starting Time</label>​<br />
                                    <input type="time" class="form-control" id="start_time" name="start_time" required>
                                </div>
                                <div class="col-12 col-md-4 mt-0">
                                    <label>Lunch Time</label>​<br />
                                    <div class="row">
                                        <div class="col-6">
                                            <input type="time" class="form-control" name="lunch_start" required>
                                        </div>
                                        <div class="col-6">
                                            <input type="time" class="form-control" name="lunch_end" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 mt-0">
                                    <label>Ending Time</label>​<br />
                                    <input type="time" class="form-control" id="end_time" name="end_time" required>
                                </div>
                            </div>
                            <div class="row g-3 my-2">
                                <div class="col-12 col-md-4 mt-0">
                                    <label>Work Progress by (minute)</label>​
                                    <input type="number" class="form-control" name="progress" placeholder="30"
                                        required />
                                </div>
                            </div>
                            <div class="row g-3 my-2">
                                <div class="customer_records">
                                    <input name="customer_name" type="text" value="name">
                                    <input name="customer_age" type="number" value="age">
                                    <input name="customer_email" type="email" value="email">

                                    <a class="extra-fields-customer" href="#">Add More Customer</a>
                                </div>

                                <div class="customer_records_dynamic m-0"></div>
                            </div>
                            <div class="col-12 col-md-6 m-auto text-center">
                                <input class="icon-btn-one btn my-2" type="submit" value="Submit" name="submit" />
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3 text-center">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-success w-75" data-bs-toggle="modal" data-bs-target="#exampleModal2">
                Line 2
            </button>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModal2Label"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="mt-2 mb-4">
                            <h1 class="fw-bold heading-text">Line 1 Assign <span class="text-success">(Already
                                    Assigned)</span></h1>
                        </div>
                        <div class="my-4">
                            <div class="row g-3 my-2">
                                <div class="col-12 col-md-4 mt-0">
                                    <label>Over Time (minute)</label>​
                                    <input type="text" class="form-control" name="target" placeholder="30" required />
                                </div>
                                <div class=" col-12 col-md-4 mt-0">
                                    <label>Over Time Target</label>
                                    <input type="text" class="form-control" name="target" placeholder="100" required />
                                </div>
                                <div class="col-12 col-md-4">
                                    <input class="icon-btn-one btn my-2" type="submit" value="Submit" name="submit" />
                                </div>
                            </div>

                        </div>

                        <div style="overflow: auto;max-width:100%;max-height:550px;padding:0.5rem;">
                            <h1 class="fw-bold heading-text fs-4">Over Time Details
                            </h1>
                            <table class="table table-striped my-2  tableFixHead results p-0">
                                <thead>
                                    <tr class="tr-2">
                                        <th scope="col" style="border-top-left-radius: 0.8rem;">
                                            No.</th>
                                        <th scope="col">Over Time (minute)</th>
                                        <th scope="col" style="border-top-right-radius: 0.8rem;">
                                            Over Time
                                            Target</th>
                                    </tr>
                                </thead>
                                <tbody id="myTable">
                                    <tr>
                                        <td>1</td>
                                        <td>30</td>
                                        <td>100</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>30</td>
                                        <td>50</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-12 col-md-6 m-auto text-center">
                            <button type="button" class="btn btn-secondary w-75" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@endsection
