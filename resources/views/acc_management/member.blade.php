@extends('layouts.app')

@section('content')
@section('content_2')
<div class="container">
    <div class="container-fluid">
        <h1 class="fw-bold heading-text">Member</h1>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModal2Label"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="my-4">
                            <h1 class="fw-bold heading-text">Member Registration</h1>
                            <div class="row g-3 my-2">
                                <div class="col-12 col-md-4">
                                    <label>Name</label>​
                                    <input type="text" class="form-control" name="name" placeholder="Name" required />
                                </div>
                                <div class=" col-12 col-md-4">
                                    <label>Username</label>
                                    <input type="text" class="form-control" autocapitalize="none" name="username"
                                        placeholder="Username" required />
                                </div>
                                <div class="col-12 col-md-4">
                                    <label>Password</label>
                                    <input type="text" class="form-control" name="password" placeholder="Password"
                                        required />
                                </div>
                            </div>
                            <div class="row g-3 my-2">
                                <div class="col-12 col-md-4">
                                    <label>Email</label>
                                    <input type="text" class="form-control" name="email" placeholder="Email" required />
                                </div>
                                <div class="col-12 col-md-4">
                                    <label>Role</label>​
                                    <select class="form-control" name="type">
                                        <option> </option>
                                        <option value="0">Admin</option>
                                        <option value="1">Operator</option>
                                        <option value="2">Line Manager</option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-4">
                                    <label>Line Name</label>​
                                    <select class="form-control" name="type">
                                        <option> </option>
                                        <option value="0">Line 1</option>
                                        <option value="1">Line 2</option>
                                        <option value="2">Line 3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row g-3 my-2">
                                <div class="col-12 col-md-4">
                                    <label>Note</label>
                                    <textarea class="form-control" name="note" placeholder="Note"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 m-auto text-center">
                            <input class="icon-btn-one btn my-2" type="submit" value="Create Account" name="submit" />
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="tabmenu" class="container-fluid my-3 p-0">
            <div class="row p-0">
                <div class="col-12 col-md-8">
                    <ul class="horizontal-slide" style="width:100%;overflow-x:scroll;" id="nav">
                        <li class="span2">
                            <a href="#" class="active">All Member List</a>
                        </li>
                        <li class="span2">
                            <a href="#">Admin List</a>
                        </li>
                        <li class="span2">
                            <a href="#">Operator List</a>
                        </li>
                        <li class="span2">
                            <a href="#">Line Manager List</a>
                        </li>
                    </ul>
                </div>
                <div class="col text-center my-2 m-auto">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary w-75" data-bs-toggle="modal"
                        data-bs-target="#exampleModal2">
                        Create New Member
                    </button>
                </div>
            </div>

            <div class="form-group pull-right mt-3">
                <input class="form-control" id="myInput" type="text" placeholder="Search">
            </div>
            <div id="tab-content">
                <div id="tab1" class="div_1">
                    <div style="overflow: auto;max-width:100%;max-height:600px;">
                        <table class="table table-striped my-4 tableFixHead results p-0">
                            <thead>
                                <tr class="tr-2">
                                    <th scope="col">No.</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Line Name</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Password</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Remark</th>
                                    <th scope="col">Create Date</th>
                                    <th scope="col">Update Date</th>
                                    <th scope="col">Edit</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody id="myTable">
                                <tr>
                                    <td>1</td>
                                    <td>User 1</td>
                                    <td>Admin</td>
                                    <td>-</td>
                                    <td>user1</td>
                                    <td>password</td>
                                    <td>test@gmail.com</td>
                                    <td>Remark</td>
                                    <td>2021-01-17</td>
                                    <td>-</td>
                                    <td><a class='btn btn-primary text-white' href='#'><i
                                                class='fas fa-pencil-alt'></i></a></td>
                                    <td>
                                        <a class='btn btn-danger text-white' href='#'
                                            onclick="return confirm('Confirm deleting member?')"><i
                                                class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="tab2" class="div_1">
                    <div style="overflow: auto;max-width:100%;max-height:600px;">
                        <table class="table table-striped my-4 tableFixHead results p-0">
                            <thead>
                                <tr class="tr-2">
                                    <th scope="col">No.</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Password</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Remark</th>
                                    <th scope="col">Create Date</th>
                                    <th scope="col">Update Date</th>
                                    <th scope="col">Edit</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody id="myTable">
                                <tr>
                                    <td>1</td>
                                    <td>User 1</td>
                                    <td>Admin</td>
                                    <td>user1</td>
                                    <td>password</td>
                                    <td>test@gmail.com</td>
                                    <td>Remark</td>
                                    <td>2021-01-17</td>
                                    <td>-</td>
                                    <td><a class='btn btn-primary text-white' href='#'><i
                                                class='fas fa-pencil-alt'></i></a></td>
                                    <td>
                                        <a class='btn btn-danger text-white' href='#'
                                            onclick="return confirm('Confirm deleting member?')"><i
                                                class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="tab3" class="div_1">
                    <div style="overflow: auto;max-width:100%;max-height:600px;">
                        <table class="table table-striped my-4 tableFixHead results p-0">
                            <thead>
                                <tr class="tr-2">
                                    <th scope="col">No.</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Password</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Remark</th>
                                    <th scope="col">Create Date</th>
                                    <th scope="col">Update Date</th>
                                    <th scope="col">Edit</th>
                                    <th scope="col">Delete</th>
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
                                    <td><a class='btn btn-primary text-white' href='#'><i
                                                class='fas fa-pencil-alt'></i></a></td>
                                    <td>
                                        <a class='btn btn-danger text-white' href='#'
                                            onclick="return confirm('Confirm deleting member?')"><i
                                                class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="tab4" class="div_1">
                    <div style="overflow: auto;max-width:100%;max-height:600px;">
                        <table class="table table-striped my-4 tableFixHead results p-0">
                            <thead>
                                <tr class="tr-2">
                                    <th scope="col">No.</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Line Name</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Password</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Remark</th>
                                    <th scope="col">Create Date</th>
                                    <th scope="col">Update Date</th>
                                    <th scope="col">Edit</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody id="myTable">
                                <tr>
                                    <td>1</td>
                                    <td>User 1</td>
                                    <td>Line Manager</td>
                                    <td>Line 1</td>
                                    <td>user1</td>
                                    <td>password</td>
                                    <td>test@gmail.com</td>
                                    <td>Remark</td>
                                    <td>2021-01-17</td>
                                    <td>-</td>
                                    <td><a class='btn btn-primary text-white' href='#'><i
                                                class='fas fa-pencil-alt'></i></a></td>
                                    <td>
                                        <a class='btn btn-danger text-white' href='#'
                                            onclick="return confirm('Confirm deleting member?')"><i
                                                class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@endsection
