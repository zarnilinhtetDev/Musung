@extends('layouts.app')

@section('content')
@section('content_2')
<div class="container">
    <div class="container-fluid">
        <h1 class="fw-bold heading-text">Line Detail</h1>
        @if (@$_GET['edit'] != "" && @$_GET['edit'] == "1")
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
        <form action="{{ url('line_detail_post') }}" method="POST">
            <div class="my-4">
                <div class="row g-3 my-2">
                    <div class="col-12 col-md-4">
                        <label>Line Name</label>​
                        <input type="text" class="form-control" name="l_name" placeholder="Name" required />
                    </div>
                    <div class="col-12 col-md-4">
                        <label>Position Name</label>​
                        <input type="number" class="form-control" name="l_pos" placeholder="Number" min="0" required />
                    </div>
                </div>
                <div class="col-12 col-md-6 text-start">
                    <input class="icon-btn-one btn my-2" type="submit" value="Create" name="submit" />
                    <a href="{{ url('member') }}" class="btn-secondary btn my-2">Cancel</a>
                </div>
            </div>
        </form>
        @endif
        <div class="form-group pull-right">
            <input class="form-control" id="myInput" type="text" placeholder="Search">
        </div>
        @php $json=json_decode($responseBody,true); $num = 1; @endphp
        <div style="overflow: auto;max-width:100%;max-height:600px;padding:0.5rem;">
            <table class="table table-striped my-4 tableFixHead results p-0">
                <thead>
                    <tr class="tr-2">
                        <th scope="col" style="border-top-left-radius: 0.8rem;">No.</th>
                        <th scope="col">Line Name</th>
                        <th scope="col">Position</th>
                        <th scope="col">Create Date</th>
                        <th scope="col">Update Date</th>
                        <th scope="col">Edit</th>
                        <th scope="col" style="border-top-right-radius: 0.8rem;">Delete</th>
                    </tr>
                </thead>
                <tbody id="myTable">
                    @for($i=0;$i<count($json);$i++) @php $l_id=$json[$i]['l_id'];
                        $l_name=$json[$i]['l_name'];$l_pos=$json[$i]['l_pos'];
                        $is_delete=$json[$i]['is_delete'];$created_at=$json[$i]['created_at'];
                        $updated_at=$json[$i]['updated_at'] @endphp <tr>
                        <td>{{ $num++ }}</td>
                        <td>{{ $l_name }}</td>
                        <td>{{ $l_pos }}</td>
                        <td>{{ $created_at }}</td>
                        <td>{{ $updated_at }}</td>
                        <td>
                            <a class='btn btn-primary text-white'
                                href="{{ url('/line_detail')}}?edit=1&id={{ $l_id }}&name={{ $l_name }}&pos={{ $l_pos }}"><i
                                    class='fas fa-pencil-alt'></i></a>
                        </td>
                        <td>
                            @if ($is_delete==0)
                            <a class='btn btn-danger text-white' href='{{ url("/line_detail_delete") }}?id={{ $l_id }}'
                                onclick="return confirm('Confirm deleting line?')"><i class="fas fa-trash"></i></a>
                            @elseif($is_delete==1)
                            <a class='btn btn-success text-white' href='{{ url("/line_detail_undo") }}?id={{ $l_id }}'
                                onclick="return confirm('Confirm restoring line?')"><i class="fas fa-undo"></i></a>
                            @endif
                        </td>
                        </tr>

                        @endfor </tbody>
            </table>
        </div>
    </div>
</div>
</div>
@endsection

@endsection
