@extends('layouts.app')

@section('content')
@section('content_2')
<div class="container">
    <div class="container-fluid">
        <h1 class="fw-bold heading-text">Line Manager</h1>

        <div class="form-group pull-right">
            <input class="form-control" id="myInput" type="text" placeholder="Search">
        </div>
        <div style="overflow: auto;max-width:100%;max-height:600px;padding:0.5rem;">
            <table class="table table-striped my-4 tableFixHead results p-0">
                <thead>
                    <tr class="tr-2">
                        <th scope="col" style="border-top-left-radius: 0.8rem;">No.</th>
                        <th scope="col">Name</th>
                        <th scope="col">Line Name</th>
                        <th scope="col" style="border-top-right-radius: 0.8rem;">Remark</th>
                    </tr>
                </thead>
                <tbody id="myTable">
                    <tr>
                        <td>1</td>
                        <td>User 1</td>
                        <td>Line 1</td>
                        <td>-</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@endsection
