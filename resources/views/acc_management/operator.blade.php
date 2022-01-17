@extends('layouts.app')

@section('content')
@section('content_2')
<div class="container">
    <div class="container-fluid">
        <h1 class="fw-bold heading-text">Operator</h1>
        <div class="my-4">
            <div class="row g-3 my-2">
                <div class="col-12 col-md-4">
                    <label>Name</label>​
                    <input type="text" class="form-control" name="name" placeholder="Name" required />
                </div>
                <div class=" col-12 col-md-4">
                    <label>Username</label>
                    <input type="text" class="form-control" autocapitalize="none" name="username" placeholder="Username"
                        required />
                </div>
                <div class="col-12 col-md-4">
                    <label>Password</label>
                    <input type="text" class="form-control" name="password" placeholder="Password" required />
                </div>
            </div>
            <div class="row g-3 my-2">
                <div class="col-12 col-md-4">
                    <label>Email</label>
                    <input type="text" class="form-control" name="email" placeholder="Email" required />
                </div>
                <div class="col-12 col-md-4">
                    <label>Note</label>
                    <textarea class="form-control" name="note" placeholder="Note"></textarea>
                </div>
            </div>
            <div class="col-12 col-md-6 m-auto text-center">
                <input class="icon-btn-one btn my-2" type="submit" value="Update Account" name="submit" />
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
                        <th scope="col">Name</th>
                        <th scope="col">Role</th>
                        <th scope="col">User Name</th>
                        <th scope="col">Password</th>
                        <th scope="col">Email</th>
                        <th scope="col">Remark</th>
                        <th scope="col">Create Date</th>
                        <th scope="col">Update Date</th>
                        <th scope="col">Edit</th>
                        <th scope="col" style="border-top-right-radius: 0.8rem;">Delete</th>
                    </tr>
                </thead>
                <tbody id="myTable">
                    <tr>
                        <td>1</td>
                        <td>User 1</td>
                        <td>Operator</td>
                        <td>user1</td>
                        <td>password</td>
                        <td>test@gmail.com</td>
                        <td>Remark</td>
                        <td>2021-01-17</td>
                        <td>-</td>
                        <td><a class='btn btn-primary text-white' href='#'><i class='fas fa-pencil-alt'></i></a></td>
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
@endsection

@endsection
