@extends('layouts.app')

@section('content')
@section('content_2')
<div class="container">
    <div class="container-fluid">
        <h1 class="fw-bold heading-text">Line Detail</h1>
        <div class="my-4">
            <div class="row g-3 my-2">
                <div class="col-12 col-md-4">
                    <label>Line Name</label>​
                    <input type="text" class="form-control" name="name" placeholder="Name" required />
                    <input class="icon-btn-one btn my-2" type="submit" value="Add" name="submit" />
                </div>
            </div>
        </div>

        <div class="form-group pull-right">
            <input class="form-control" id="myInput" type="text" placeholder="Search">
        </div>
        <div style="overflow: auto;max-width:100%;max-height:600px;padding:0.5rem;">
            <table class="table table-striped my-4 tableFixHead results p-0">
                <thead>
                    <tr class="tr-2">
                        <th scope="col" style="border-top-left-radius: 0.8rem;">No.</th>
                        <th scope="col">Line Name</th>
                        <th scope="col">Create Date</th>
                        <th scope="col">Update Date</th>
                        <th scope="col">Edit</th>
                        <th scope="col" style="border-top-right-radius: 0.8rem;">Delete</th>
                    </tr>
                </thead>
                <tbody id="myTable">
                    <tr>
                        <td>1</td>
                        <td>Line 1</td>
                        <td>2021-01-17</td>
                        <td>-</td>
                        <td><a class='btn btn-primary text-white' href='#'><i class='fas fa-pencil-alt'></i></a>
                        </td>
                        <td>
                            <a class='btn btn-danger text-white' href='#'
                                onclick="return confirm('Confirm deleting member?')"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
@endsection

@endsection
