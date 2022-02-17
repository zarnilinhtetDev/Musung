@extends('layouts.app')

@section('content')
@section('content_2')
<div class="container">
    <div class="container-fluid">
        @error('error')
        <p class="text-danger fw-bold text-center my-3">{{ $message }}</p>
        @enderror

        @error('success')
        <p class="text-success fw-bold text-center my-3">{{ $message }}</p>
        @enderror

        <h1 class="fw-bold heading-text">Line Detail</h1>
        @if (@$_GET['edit'] != "" && @$_GET['edit'] == "1")
        <div class="d-flex flex-row-reverse">
            @if (@$_GET['is_delete']==0)
            <a class='btn btn-danger text-white' href='{{ url("/line_detail_delete") }}?id={{ $_GET["id"] }}'
                onclick="return confirm('Confirm deleting line?')">Deactivate Line</a>
            @elseif(@$_GET['is_delete']==1)
            <a class='btn btn-success text-white' href='{{ url("/line_detail_undo") }}?id={{ $_GET["id"] }}'
                onclick="return confirm('Confirm restoring line?')">Activate Line</a>
            @endif

        </div>
        <form action="{{ url('line_detail_put') }}" method="POST">

            <input type="hidden" name="l_id" value="{{ @$_GET['id'] }}">
            <div class="my-4">
                <div class="row g-3 my-2">
                    <div class="col-12 col-md-4">
                        <label>Line Name</label>​
                        <input type="text" class="form-control" name="l_name" placeholder="Name"
                            value="{{ $_GET['name'] }}" required />
                    </div>
                    <div class="col-12 col-md-4">
                        <label>Position Name</label>​
                        <input type="number" class="form-control" name="l_pos" placeholder="Number" min="0"
                            value="{{ $_GET['pos'] }}" required />
                    </div>
                </div>
                <div class="col-12 col-md-6 text-start">
                    <input class="icon-btn-one btn my-2" type="submit" value="Update" name="submit" />
                    <a href="{{ url('line_detail') }}" class="btn-secondary btn my-2">Cancel</a>
                </div>
            </div>
        </form>
        @endif
        @if (@$_GET['edit'] == "" )
        <!-- Button trigger modal -->
        <div class="my-2">
            <button type="button" class="btn custom-btn-theme" data-bs-toggle="modal" data-bs-target="#LineDetail">
                Create New Line
            </button>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="LineDetail" tabindex="-1" aria-labelledby="LineDetailLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <h1 class="fw-bold heading-text">New Line</h1>
                        <form action="{{ url('line_detail_post') }}" method="POST">
                            <div class="my-4">
                                <div class="row g-3 my-2">
                                    <div class="col-12 col-md-4">
                                        <label>Line Name</label>​
                                        <input type="text" class="form-control" name="l_name" placeholder="Name"
                                            required />
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label>Position Name</label>​
                                        <input type="number" class="form-control" name="l_pos" placeholder="Number"
                                            min="0" required />
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 text-start">
                                    <input class="icon-btn-one btn my-2" type="submit" value="Create" name="submit" />
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <div class="form-group pull-right">
            <input class="form-control" id="myInput" type="text" placeholder="Search">
        </div>
        @php $json=json_decode($responseBody,true); $num = 1;
        @endphp
        <div style="overflow: auto;max-width:100%;max-height:600px;padding:0.5rem;">
            <table class="table table-striped my-4 tableFixHead results p-0">
                <thead>
                    <tr class="tr-2">
                        <th scope="col" style="border-top-left-radius: 0.8rem;">No.</th>
                        <th scope="col">Status</th>
                        <th scope="col">Line Name</th>
                        <th scope="col">Position</th>
                        <th scope="col">Create Date</th>
                        <th scope="col">Update Date</th>
                        <th scope="col">Edit</th>
                    </tr>
                </thead>
                <tbody id="myTable">
                    @php $count = count($json); @endphp
                    @if($count<=0) <tr>
                        <td colspan="7" class="text-center">No data</td>
                        </tr>
                        @endif
                        @if ($count > 0)
                        @for($i=0;$i<count($json);$i++) @php $l_id=$json[$i]['l_id'];
                            $l_name=$json[$i]['l_name'];$l_pos=$json[$i]['l_pos'];
                            $is_delete=$json[$i]['is_delete'];$created_at=date('Y-m-d h:i:s',
                            strtotime($json[$i]['created_at'])); $updated_at=$json[$i]['updated_at']; @endphp <tr>
                            <td>{{ $num++ }}</td>
                            <td>
                                @if($is_delete==0)
                                <span class="text-success">Active</span>
                                @elseif($is_delete==1)
                                <span class="text-danger">Deactive</span>
                                @endif
                            </td>
                            <td>{{ $l_name }}</td>
                            <td>{{ $l_pos }}</td>
                            <td>{{ $created_at }}</td>
                            <td>
                                @if($updated_at=="")

                                @else
                                {{ date('Y-m-d h:i:s', strtotime($updated_at)) }}
                                @endif
                            </td>
                            <td>
                                <a class='btn custom-btn-theme text-white'
                                    href="{{ url('/line_detail')}}?edit=1&id={{ $l_id }}&name={{ $l_name }}&pos={{ $l_pos }}&is_delete={{ $is_delete }}"><i
                                        class='fas fa-pencil-alt'></i></a>
                            </td>
                            </tr>
                            @endfor
                            @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
@endsection

@endsection
