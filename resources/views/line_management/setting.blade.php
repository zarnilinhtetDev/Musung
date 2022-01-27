@extends('layouts.app')

@section('content')
@section('content_2')
@php $json = json_decode($responseBody,true);
$json2 = json_decode($responseBody2,true); @endphp
<div class="container">
    <div class="container-fluid">
        <h1 class="fw-bold heading-text">Line Setting</h1>
        <div class="my-4">
            <div class="row my-2">
                @for($i=0;$i<count($json);$i++) @php $l_id=$json[$i]['l_id']; $l_name=$json[$i]['l_name'];
                    $is_delete=$json[$i]['is_delete']; @endphp <div class="col-6 col-md-3 text-center">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-secondary w-75" data-bs-toggle="modal"
                        data-bs-target="#LineModal" data-bs-l-id="{{ $l_id }}" data-bs-l-name="{{ $l_name }}"
                        id="line_setting_btn">
                        {{$l_name}}
                    </button>
            </div>
            @endfor

            <!-- Modal -->
            <div class="modal fade" id="LineModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <input type="hidden" name="l_id" id="l_id">
                            <div class="mt-2 mb-4">
                                <h1 class="fw-bold heading-text" id="l_setting_name"></h1>
                            </div>
                            <div class="row g-3 my-2">
                                <div class="col-12 col-md-4 mt-0">
                                    <label>Line Manager</label>​
                                    <select class="form-control" name="type" required>
                                        <option> </option>
                                        @for($i=0;$i<count($json2);$i++) @php $u_id=$json2[$i]['id'];
                                            $u_name=$json2[$i]['name']; @endphp <option value="{{$u_id}}">{{$u_name}}
                                            </option> @endfor
                                    </select>
                                </div>
                                <div class=" col-12 col-md-4 mt-0">
                                    <label>Target</label>
                                    <input type="text" class="form-control" name="target" placeholder="100" required />
                                </div>
                                <div class="col-12 col-md-4 mt-0">
                                    <label>Total Working Hour(s)</label>
                                    <input type="text" class="form-control" name="password" placeholder="7 Hours"
                                        required />
                                </div>
                            </div>
                            <div class="row g-3 my-2">
                                <div class="col-12 col-md-4 mt-0">
                                    <label>Starting Time</label>​<br />
                                    <input type="time" class="form-control" id="appt" name="appt" required>
                                </div>
                                <div class="col-12 col-md-4 mt-0">
                                    <label>Lunch Time</label>​<br />
                                    <div class="row">
                                        <div class="col-6">
                                            <input type="time" class="form-control" id="appt" name="appt" required>
                                        </div>
                                        <div class="col-6">
                                            <input type="time" class="form-control" id="appt" name="appt" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 mt-0">
                                    <label>Ending Time</label>​<br />
                                    <input type="time" class="form-control" id="appt" name="appt" required>
                                </div>
                            </div>
                            <div class="row g-3 my-2">
                                <div class="col-12 col-md-4 mt-0">
                                    <label>Work Progress by (minute)</label>​
                                    <input type="text" class="form-control" name="password" placeholder="30" required />
                                </div>
                            </div>
                            <div class="col-12 col-md-6 m-auto text-center">
                                <input class="icon-btn-one btn my-2" type="submit" value="Submit" name="submit" />
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class=" col-6 col-md-3 text-center">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-success w-75" data-bs-toggle="modal"
                    data-bs-target="#exampleModal2">
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
                                        <input type="text" class="form-control" name="target" placeholder="30"
                                            required />
                                    </div>
                                    <div class=" col-12 col-md-4 mt-0">
                                        <label>Over Time Target</label>
                                        <input type="text" class="form-control" name="target" placeholder="100"
                                            required />
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <input class="icon-btn-one btn my-2" type="submit" value="Submit"
                                            name="submit" />
                                    </div>
                                </div>

                            </div>
                            <div style="overflow: auto;max-width:100%;max-height:600px;padding:0.5rem;">
                                <h1 class="fw-bold heading-text fs-4">Line Details</h1>
                                <table class="table table-striped my-2  tableFixHead results p-0">
                                    <thead>
                                        <tr class="tr-2">
                                            <th scope="col" style="border-top-left-radius: 0.8rem;">No.</th>
                                            <th scope="col">Line Manager Name</th>
                                            <th scope="col">Target</th>
                                            <th scope="col">Total Working Hour(s)</th>
                                            <th scope="col">Starting Time</th>
                                            <th scope="col">Lunch Time</th>
                                            <th scope="col">Ending Time</th>
                                            <th scope="col" style="border-top-right-radius: 0.8rem;">Working
                                                Progress by (minute)</th>
                                        </tr>
                                    </thead>
                                    <tbody id="myTable">
                                        <tr>
                                            <td>1</td>
                                            <td>Line Manager 1</td>
                                            <td>100</td>
                                            <td>7</td>
                                            <td>7:00 AM</td>
                                            <td>12:00 - 12:30</td>
                                            <td>2:00 PM</td>
                                            <td>30</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div style="overflow: auto;max-width:100%;max-height:550px;padding:0.5rem;">
                                <h1 class="fw-bold heading-text fs-4">Over Time Details</h1>
                                <table class="table table-striped my-2  tableFixHead results p-0">
                                    <thead>
                                        <tr class="tr-2">
                                            <th scope="col" style="border-top-left-radius: 0.8rem;">No.</th>
                                            <th scope="col">Over Time (minute)</th>
                                            <th scope="col" style="border-top-right-radius: 0.8rem;">Over Time
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
                                <button type="button" class="btn btn-secondary w-75"
                                    data-bs-dismiss="modal">Close</button>
                            </div>
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
