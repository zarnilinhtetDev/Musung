@extends('layouts.app')

@section('content')
@section('content_2')

@superadmin

@php $json2=json_decode($responseBody2,true); @endphp
<div class="container-fluid">
    <div class="container-fluid">
        @if (@$_GET['edit'] != "" && @$_GET['edit'] == "1")
        <form action="{{ url('member_put') }}" method="POST">
            <input type="hidden" name="id" value="{{ $_GET['id'] }}" />
            <div class="my-4">
                <h1 class="fw-bold heading-text">Member Edit</h1>
                <div class="d-flex flex-row-reverse">
                    @if ($_GET['is_delete']==0)
                    <a class='btn btn-danger text-white' href='{{ url("/member_delete") }}/{{ $_GET["id"] }}'
                        onclick="return confirm('Confirm deleting member?')">Deactivate User</a>
                    @elseif($_GET['is_delete']==1)
                    <a class='btn btn-success text-white' href='{{ url("/member_undo") }}/{{ $_GET["id"] }}'
                        onclick="return confirm('Confirm restoring member?')">Activate User</a>
                    @endif
                </div>
                <div class="row g-3 my-2">
                    <div class="col-12 col-md-4">
                        <label>Name</label>​
                        <input type="text" class="form-control" name="name" placeholder="Name"
                            value="{{ $_GET['name'] }}" required />
                    </div>
                    <div class="col-12 col-md-4">
                        <label>Username</label>
                        <input type="text" class="form-control" autocapitalize="none" name="username"
                            placeholder="Username" value="{{ $_GET['u_name'] }}" required />
                    </div>
                    <div class="col-12 col-md-4">
                        <label>Password</label>
                        <div class="row container-fluid p-0 m-0">
                            <div class="col-6" id="password-div" style="display: none;">
                                <input type="text" class="form-control" name="password2" id="password2"
                                    placeholder="Password" />
                            </div>
                            <div class="col-6">
                                <button type="button" onclick=toggleMe()>Toggle me!</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-3 my-2">
                    <div class="col-12 col-md-4">
                        <label>Email</label>
                        <input type="text" class="form-control" name="email" placeholder="Email"
                            value="{{ $_GET['email'] }}" />
                    </div>
                    <div class="col-12 col-md-4">
                        <label>Role</label>​
                        <select class="form-control" name="role">
                            <option value="{{ $_GET['role'] }}">
                                @if ($_GET['role']==0) Admin
                                @elseif ($_GET['role']==1) Operator
                                @elseif ($_GET['role']==2) Line Manager
                                @endif</option>
                            <option value="98">Owner</option>
                            <option value="0">Admin</option>
                            <option value="1">Operator</option>
                            <option value="2">Line Manager</option>
                            <option value="97">Viewer</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-4">
                        <label>Line Name</label>​
                        <select class="form-control" name="line">
                            <option value="{{ $_GET['line'] }}">
                                @for($i = 0; $i < count($json2); $i++) @php
                                    $l_id=$json2[$i]['l_id'];$l_name=$json2[$i]['l_name']; @endphp
                                    @if($l_id==$_GET['line']) {{ $l_name }} @endif @endfor</option>
                                    @for($i = 0; $i < count($json2); $i++) @php $l_id=$json2[$i]['l_id'];
                                        $l_name=$json2[$i]['l_name']; @endphp <option value="{{ $l_id }}">{{
                                        $l_name }}
                            </option> @endfor
                        </select>
                    </div>
                </div>
                <div class="row g-3 my-2">
                    <div class="col-12 col-md-4">
                        <label>Note</label>
                        <textarea class="form-control" name="note" placeholder="Note" id="comment"
                            maxlength="150">{{ $_GET['remark'] }}</textarea> <span id="characterLeft"></span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 m-auto text-center">
                <input class="icon-btn-one btn my-2" type="submit" value="Update Account" name="submit" />
                <a href="{{ url('member') }}" class="btn-secondary btn my-2">Cancel</a>
            </div>
        </form>
        @endif

        <h1 class="fw-bold heading-text">Member</h1>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModal2Label"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <form action="{{ url('member_post') }}" method="GET">
                            <div class="my-4">
                                <h1 class="fw-bold heading-text">Member Registration</h1>
                                <div class="row g-3 my-2">
                                    <div class="col-12 col-md-4">
                                        <label>Name</label>​
                                        <input type="text" class="form-control" name="name" placeholder="Name"
                                            required />
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
                                        <input type="text" class="form-control" name="email" placeholder="Email" />
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label>Role</label>​
                                        <select class="form-control" name="role" required>
                                            <option> </option>
                                            <option value="98">Owner</option>
                                            <option value="0">Admin</option>
                                            <option value="1">Operator</option>
                                            <option value="2">Line Manager</option>
                                            <option value="97">Viewer</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label>Line Name</label>​
                                        <select class="form-control" name="line">
                                            <option> </option>
                                            @for($i = 0; $i < count($json2); $i++) @php $l_id=$json2[$i]['l_id'];
                                                $l_name=$json2[$i]['l_name']; @endphp <option value="{{ $l_id }}">{{
                                                $l_name }} @endfor
                                                </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row g-3 my-2">
                                    <div class="col-12 col-md-4">
                                        <label>Note</label>
                                        <textarea class="form-control" name="note" placeholder="Note" id="comment"
                                            maxlength="150"></textarea> <span id="characterLeft"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 m-auto text-center">
                                <input class="icon-btn-one btn my-2" type="submit" value="Create Account"
                                    name="submit" />
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
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
                            <a href="#">Owner List</a>
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
                        <li class="span2">
                            <a href="#">Viewer List</a>
                        </li>
                    </ul>
                </div>
                <div class="col text-center my-2 m-auto">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn w-75 custom-btn-theme" data-bs-toggle="modal"
                        data-bs-target="#exampleModal2">
                        Create New Member
                    </button>
                </div>
            </div>

            <div class="form-group pull-right mt-3">
                <input class="form-control" id="myInput" type="text" placeholder="Search">
            </div>

            @php
            $json = json_decode($responseBody,true);
            $num = 1;
            @endphp
            <div id="tab-content">
                <div id="tab1" class="div_1">
                    <div style="overflow: auto;max-width:100%;max-height:600px;">
                        <table class="table table-striped my-4 tableFixHead results p-0 text-center">
                            <thead>
                                <tr class="tr-2">
                                    <th scope="col">No.</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Line Name</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Remark</th>
                                    <th scope="col">Create Date</th>
                                    <th scope="col">Update Date</th>
                                    <th scope="col">Edit</th>
                                </tr>
                            </thead>
                            <tbody id="myTable">

                                @for($i=0;$i<count($json);$i++) @php $u_id=$json[$i]['id']; $name=$json[$i]['name'];
                                    $u_name=$json[$i]['username']; $p_word=$json[$i]['password'];
                                    $email=$json[$i]['email']; $remark=$json[$i]['remark']; $role=$json[$i]['role'];
                                    $line=$json[$i]['line_id']; $status=$json[$i]['active_status'];
                                    $is_delete=$json[$i]['is_delete']; $created_at=$json[$i]['created_at'];
                                    $updated_at=$json[$i]['updated_at']; @endphp <tr>
                                    <td>{{ $num++ }}</td>
                                    <td>
                                        @if ($status==0)
                                        <span><i class="fas fa-circle text-success"></i></span>
                                        @elseif($status==1)
                                        <span><i class="fas fa-circle text-danger"></i></span>
                                        @endif
                                    </td>
                                    <td>{{ $name }}</td>
                                    <td>
                                        @if ($role==0)
                                        <span>Admin</span>
                                        @elseif($role==1)
                                        <span>Operator</span>
                                        @elseif($role==2)
                                        <span>Line Manager</span>
                                        @elseif($role==97)
                                        <span>Viewer</span>
                                        @elseif($role==98)
                                        <span>Owner</span>
                                        @endif
                                    </td>
                                    <td>
                                        @for($j=0;$j<count($json2);$j++) @php $l_id=$json2[$j]['l_id'];
                                            $l_name=$json2[$j]['l_name']; @endphp @if($line==$l_id) {{ $l_name }} @endif
                                            @endfor</td>
                                    <td>{{ $u_name }}</td>
                                    <td>{{ $email }}</td>
                                    <td>{{ $remark }}</td>
                                    <td>{{ $created_at }}</td>
                                    <td>{{ $updated_at }}</td>
                                    <td>
                                        <a class='btn custom-btn-theme text-white'
                                            href="{{ url('/member')}}?edit=1&id={{ $u_id
                                        }}&name={{ $name }}&u_name={{ $u_name }}&email={{ $email }}&remark={{ $remark }}&role={{ $role }}&line={{ $line }}&status={{ $status }}&is_delete={{ $is_delete }}"><i
                                                class='fas fa-pencil-alt'></i></a>
                                    </td>
                                    </tr>
                                    @endfor
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
                                    <th scope="col">Status</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Remark</th>
                                    <th scope="col">Create Date</th>
                                    <th scope="col">Update Date</th>
                                    <th scope="col">Edit</th>
                                </tr>
                            </thead>
                            <tbody id="myTable">
                                @for($i=0;$i<count($json);$i++) @php $u_id=$json[$i]['id']; $name=$json[$i]['name'];
                                    $u_name=$json[$i]['username']; $p_word=$json[$i]['password'];
                                    $email=$json[$i]['email']; $remark=$json[$i]['remark']; $role=$json[$i]['role'];
                                    $line=$json[$i]['line_id']; $status=$json[$i]['active_status'];
                                    $is_delete=$json[$i]['is_delete']; $created_at=$json[$i]['created_at'];
                                    $updated_at=$json[$i]['updated_at']; @endphp @if($role==98) <tr>
                                    <td>{{ $num++ }}</td>
                                    <td>
                                        @if ($status==0)
                                        <span><i class="fas fa-circle text-success"></i></span>
                                        @elseif($status==1)
                                        <span><i class="fas fa-circle text-danger"></i></span>
                                        @endif
                                    </td>
                                    <td>{{ $name }}</td>
                                    <td>
                                        @if($role=98)
                                        <span>Owner</span>
                                        @endif
                                    </td>
                                    <td>{{ $u_name }}</td>
                                    <td>{{ $email }}</td>
                                    <td>{{ $remark }}</td>
                                    <td>{{ $created_at }}</td>
                                    <td>{{ $updated_at }}</td>
                                    <td>
                                        <a class='btn custom-btn-theme text-white'
                                            href="{{ url('/member')}}?edit=1&id={{ $u_id
                                        }}&name={{ $name }}&u_name={{ $u_name }}&p_word={{ $p_word }}&email={{ $email }}&remark={{ $remark }}&role={{ $role }}&line={{ $line }}&status={{ $status }}&is_delete={{ $is_delete }}"><i
                                                class='fas fa-pencil-alt'></i></a>
                                    </td>
                                    </tr>
                                    @endif
                                    @endfor
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
                                    <th scope="col">Status</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Remark</th>
                                    <th scope="col">Create Date</th>
                                    <th scope="col">Update Date</th>
                                    <th scope="col">Edit</th>
                                </tr>
                            </thead>
                            <tbody id="myTable">
                                @for($i=0;$i<count($json);$i++) @php $u_id=$json[$i]['id']; $name=$json[$i]['name'];
                                    $u_name=$json[$i]['username']; $p_word=$json[$i]['password'];
                                    $email=$json[$i]['email']; $remark=$json[$i]['remark']; $role=$json[$i]['role'];
                                    $line=$json[$i]['line_id']; $status=$json[$i]['active_status'];
                                    $is_delete=$json[$i]['is_delete']; $created_at=$json[$i]['created_at'];
                                    $updated_at=$json[$i]['updated_at']; @endphp @if($role==0) <tr>
                                    <td>{{ $num++ }}</td>
                                    <td>
                                        @if ($status==0)
                                        <span><i class="fas fa-circle text-success"></i></span>
                                        @elseif($status==1)
                                        <span><i class="fas fa-circle text-danger"></i></span>
                                        @endif
                                    </td>
                                    <td>{{ $name }}</td>
                                    <td>
                                        @if ($role==0)
                                        <span>Admin</span>
                                        @endif
                                    </td>
                                    <td>{{ $u_name }}</td>
                                    <td>{{ $email }}</td>
                                    <td>{{ $remark }}</td>
                                    <td>{{ $created_at }}</td>
                                    <td>{{ $updated_at }}</td>
                                    <td>
                                        <a class='btn custom-btn-theme text-white'
                                            href="{{ url('/member')}}?edit=1&id={{ $u_id
                                        }}&name={{ $name }}&u_name={{ $u_name }}&p_word={{ $p_word }}&email={{ $email }}&remark={{ $remark }}&role={{ $role }}&line={{ $line }}&status={{ $status }}&is_delete={{ $is_delete }}"><i
                                                class='fas fa-pencil-alt'></i></a>
                                    </td>
                                    </tr>
                                    @endif
                                    @endfor
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
                                    <th scope="col">Status</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Line Name</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Remark</th>
                                    <th scope="col">Create Date</th>
                                    <th scope="col">Update Date</th>
                                    <th scope="col">Edit</th>
                                </tr>
                            </thead>
                            <tbody id="myTable">
                                @for($i=0;$i<count($json);$i++) @php $u_id=$json[$i]['id']; $name=$json[$i]['name'];
                                    $u_name=$json[$i]['username']; $p_word=$json[$i]['password'];
                                    $email=$json[$i]['email']; $remark=$json[$i]['remark']; $role=$json[$i]['role'];
                                    $line=$json[$i]['line_id']; $status=$json[$i]['active_status'];
                                    $is_delete=$json[$i]['is_delete']; $created_at=$json[$i]['created_at'];
                                    $updated_at=$json[$i]['updated_at']; @endphp @if($role==1) <tr>
                                    <td>{{ $num++ }}</td>
                                    <td>
                                        @if ($status==0)
                                        <span><i class="fas fa-circle text-success"></i></span>
                                        @elseif($status==1)
                                        <span><i class="fas fa-circle text-danger"></i></span>
                                        @endif
                                    </td>
                                    <td>{{ $name }}</td>
                                    <td>
                                        @if($role==1)
                                        <span>Operator</span>
                                        @endif
                                    </td>
                                    <td>
                                        @for($j=0;$j<count($json2);$j++) @php $l_id=$json2[$j]['l_id'];
                                            $l_name=$json2[$j]['l_name']; @endphp @if($line==$l_id) {{ $l_name }} @endif
                                            @endfor</td>
                                    <td>{{ $u_name }}</td>
                                    <td>{{ $email }}</td>
                                    <td>{{ $remark }}</td>
                                    <td>{{ $created_at }}</td>
                                    <td>{{ $updated_at }}</td>
                                    <td>
                                        <a class='btn custom-btn-theme text-white'
                                            href="{{ url('/member')}}?edit=1&id={{ $u_id
                                        }}&name={{ $name }}&u_name={{ $u_name }}&p_word={{ $p_word }}&email={{ $email }}&remark={{ $remark }}&role={{ $role }}&line={{ $line }}&status={{ $status }}&is_delete={{ $is_delete }}"><i
                                                class='fas fa-pencil-alt'></i></a>
                                    </td>
                                    </tr>
                                    @endif
                                    @endfor
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
                                    <th scope="col">Status</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Line Name</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Remark</th>
                                    <th scope="col">Create Date</th>
                                    <th scope="col">Update Date</th>
                                    <th scope="col">Edit</th>
                                </tr>
                            </thead>
                            <tbody id="myTable">
                                @for($i=0;$i<count($json);$i++) @php $u_id=$json[$i]['id']; $name=$json[$i]['name'];
                                    $u_name=$json[$i]['username']; $p_word=$json[$i]['password'];
                                    $email=$json[$i]['email']; $remark=$json[$i]['remark']; $role=$json[$i]['role'];
                                    $line=$json[$i]['line_id']; $status=$json[$i]['active_status'];
                                    $is_delete=$json[$i]['is_delete']; $created_at=$json[$i]['created_at'];
                                    $updated_at=$json[$i]['updated_at']; @endphp @if($role==2) <tr>
                                    <td>{{ $num++ }}</td>
                                    <td>
                                        @if ($status==0)
                                        <span><i class="fas fa-circle text-success"></i></span>
                                        @elseif($status==1)
                                        <span><i class="fas fa-circle text-danger"></i></span>
                                        @endif
                                    </td>
                                    <td>{{ $name }}</td>
                                    <td>
                                        @if($role==2)
                                        <span>Line Manager</span>
                                        @endif
                                    </td>
                                    <td>
                                        @for($j=0;$j<count($json2);$j++) @php $l_id=$json2[$j]['l_id'];
                                            $l_name=$json2[$j]['l_name']; @endphp @if($line==$l_id) {{ $l_name }} @endif
                                            @endfor</td>
                                    <td>{{ $u_name }}</td>
                                    <td>{{ $email }}</td>
                                    <td>{{ $remark }}</td>
                                    <td>{{ $created_at }}</td>
                                    <td>{{ $updated_at }}</td>
                                    <td>
                                        <a class='btn custom-btn-theme text-white'
                                            href="{{ url('/member')}}?edit=1&id={{ $u_id
                                        }}&name={{ $name }}&u_name={{ $u_name }}&p_word={{ $p_word }}&email={{ $email }}&remark={{ $remark }}&role={{ $role }}&line={{ $line }}&status={{ $status }}&is_delete={{ $is_delete }}"><i
                                                class='fas fa-pencil-alt'></i></a>
                                    </td>
                                    </tr>
                                    @endif
                                    @endfor
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
                                    <th scope="col">Status</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Line Name</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Remark</th>
                                    <th scope="col">Create Date</th>
                                    <th scope="col">Update Date</th>
                                    <th scope="col">Edit</th>
                                </tr>
                            </thead>
                            <tbody id="myTable">
                                @for($i=0;$i<count($json);$i++) @php $u_id=$json[$i]['id']; $name=$json[$i]['name'];
                                    $u_name=$json[$i]['username']; $p_word=$json[$i]['password'];
                                    $email=$json[$i]['email']; $remark=$json[$i]['remark']; $role=$json[$i]['role'];
                                    $line=$json[$i]['line_id']; $status=$json[$i]['active_status'];
                                    $is_delete=$json[$i]['is_delete']; $created_at=$json[$i]['created_at'];
                                    $updated_at=$json[$i]['updated_at']; @endphp @if($role==97) <tr>
                                    <td>{{ $num++ }}</td>
                                    <td>
                                        @if ($status==0)
                                        <span><i class="fas fa-circle text-success"></i></span>
                                        @elseif($status==1)
                                        <span><i class="fas fa-circle text-danger"></i></span>
                                        @endif
                                    </td>
                                    <td>{{ $name }}</td>
                                    <td>
                                        @if($role==97)
                                        <span>Viewer</span>
                                        @endif
                                    </td>
                                    <td>
                                        @for($j=0;$j<count($json2);$j++) @php $l_id=$json2[$j]['l_id'];
                                            $l_name=$json2[$j]['l_name']; @endphp @if($line==$l_id) {{ $l_name }} @endif
                                            @endfor</td>
                                    <td>{{ $u_name }}</td>
                                    <td>{{ $email }}</td>
                                    <td>{{ $remark }}</td>
                                    <td>{{ $created_at }}</td>
                                    <td>{{ $updated_at }}</td>
                                    <td>
                                        <a class='btn custom-btn-theme text-white'
                                            href="{{ url('/member')}}?edit=1&id={{ $u_id
                                        }}&name={{ $name }}&u_name={{ $u_name }}&p_word={{ $p_word }}&email={{ $email }}&remark={{ $remark }}&role={{ $role }}&line={{ $line }}&status={{ $status }}&is_delete={{ $is_delete }}"><i
                                                class='fas fa-pencil-alt'></i></a>
                                    </td>
                                    </tr>
                                    @endif
                                    @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsuperadmin

@owner

@php $json2=json_decode($responseBody2,true); @endphp
<div class="container-fluid">
    <div class="container-fluid">
        @if (@$_GET['edit'] != "" && @$_GET['edit'] == "1")
        <form action="{{ url('member_put') }}" method="POST">
            <input type="hidden" name="id" value="{{ $_GET['id'] }}" />
            <div class="my-4">
                <h1 class="fw-bold heading-text">Member Edit</h1>
                <div class="d-flex flex-row-reverse">
                    @if ($_GET['is_delete']==0)
                    <a class='btn btn-danger text-white' href='{{ url("/member_delete") }}/{{ $_GET["id"] }}'
                        onclick="return confirm('Confirm deleting member?')">Deactivate User</a>
                    @elseif($_GET['is_delete']==1)
                    <a class='btn btn-success text-white' href='{{ url("/member_undo") }}/{{ $_GET["id"] }}'
                        onclick="return confirm('Confirm restoring member?')">Activate User</a>
                    @endif
                </div>
                <div class="row g-3 my-2">
                    <div class="col-12 col-md-4">
                        <label>Name</label>​
                        <input type="text" class="form-control" name="name" placeholder="Name"
                            value="{{ $_GET['name'] }}" required />
                    </div>
                    <div class="col-12 col-md-4">
                        <label>Username</label>
                        <input type="text" class="form-control" autocapitalize="none" name="username"
                            placeholder="Username" value="{{ $_GET['u_name'] }}" required />
                    </div>
                    <div class="col-12 col-md-4">
                        <label>Password</label>
                        <div class="row container-fluid p-0 m-0">
                            <div class="col-6" id="password-div" style="display: none;">
                                <input type="text" class="form-control" name="password2" id="password2"
                                    placeholder="Password" />
                            </div>
                            <div class="col-6">
                                <button type="button" onclick=toggleMe()>Toggle me!</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-3 my-2">
                    <div class="col-12 col-md-4">
                        <label>Email</label>
                        <input type="text" class="form-control" name="email" placeholder="Email"
                            value="{{ $_GET['email'] }}" />
                    </div>
                    <div class="col-12 col-md-4">
                        <label>Role</label>​
                        <select class="form-control" name="role">
                            <option value="{{ $_GET['role'] }}">
                                @if ($_GET['role']==0) Admin
                                @elseif ($_GET['role']==1) Operator
                                @elseif ($_GET['role']==2) Line Manager
                                @endif</option>
                            <option value="98">Owner</option>
                            <option value="0">Admin</option>
                            <option value="1">Operator</option>
                            <option value="2">Line Manager</option>
                            <option value="97">Viewer</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-4">
                        <label>Line Name</label>​
                        <select class="form-control" name="line">
                            <option value="{{ $_GET['line'] }}">
                                @for($i = 0; $i < count($json2); $i++) @php
                                    $l_id=$json2[$i]['l_id'];$l_name=$json2[$i]['l_name']; @endphp
                                    @if($l_id==$_GET['line']) {{ $l_name }} @endif @endfor</option>
                                    @for($i = 0; $i < count($json2); $i++) @php $l_id=$json2[$i]['l_id'];
                                        $l_name=$json2[$i]['l_name']; @endphp <option value="{{ $l_id }}">{{
                                        $l_name }}
                            </option> @endfor
                        </select>
                    </div>
                </div>
                <div class="row g-3 my-2">
                    <div class="col-12 col-md-4">
                        <label>Note</label>
                        <textarea class="form-control" name="note" placeholder="Note" id="comment"
                            maxlength="150">{{ $_GET['remark'] }}</textarea> <span id="characterLeft"></span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 m-auto text-center">
                <input class="icon-btn-one btn my-2" type="submit" value="Update Account" name="submit" />
                <a href="{{ url('member') }}" class="btn-secondary btn my-2">Cancel</a>
            </div>
        </form>
        @endif

        <h1 class="fw-bold heading-text">Member</h1>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModal2Label"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <form action="{{ url('member_post') }}" method="GET">
                            <div class="my-4">
                                <h1 class="fw-bold heading-text">Member Registration</h1>
                                <div class="row g-3 my-2">
                                    <div class="col-12 col-md-4">
                                        <label>Name</label>​
                                        <input type="text" class="form-control" name="name" placeholder="Name"
                                            required />
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
                                        <input type="text" class="form-control" name="email" placeholder="Email" />
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label>Role</label>​
                                        <select class="form-control" name="role" required>
                                            <option> </option>
                                            <option value="98">Owner</option>
                                            <option value="0">Admin</option>
                                            <option value="1">Operator</option>
                                            <option value="2">Line Manager</option>
                                            <option value="97">Viewer</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label>Line Name</label>​
                                        <select class="form-control" name="line">
                                            <option> </option>
                                            @for($i = 0; $i < count($json2); $i++) @php $l_id=$json2[$i]['l_id'];
                                                $l_name=$json2[$i]['l_name']; @endphp <option value="{{ $l_id }}">{{
                                                $l_name }} @endfor
                                                </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row g-3 my-2">
                                    <div class="col-12 col-md-4">
                                        <label>Note</label>
                                        <textarea class="form-control" name="note" placeholder="Note" id="comment"
                                            maxlength="150"></textarea> <span id="characterLeft"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 m-auto text-center">
                                <input class="icon-btn-one btn my-2" type="submit" value="Create Account"
                                    name="submit" />
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
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
                            <a href="#">Owner List</a>
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
                        <li class="span2">
                            <a href="#">Viewer List</a>
                        </li>
                    </ul>
                </div>
                <div class="col text-center my-2 m-auto">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn w-75 custom-btn-theme" data-bs-toggle="modal"
                        data-bs-target="#exampleModal2">
                        Create New Member
                    </button>
                </div>
            </div>

            <div class="form-group pull-right mt-3">
                <input class="form-control" id="myInput" type="text" placeholder="Search">
            </div>

            @php
            $json = json_decode($responseBody,true);
            $num = 1;
            @endphp
            <div id="tab-content">
                <div id="tab1" class="div_1">
                    <div style="overflow: auto;max-width:100%;max-height:600px;">
                        <table class="table table-striped my-4 tableFixHead results p-0 text-center">
                            <thead>
                                <tr class="tr-2">
                                    <th scope="col">No.</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Line Name</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Remark</th>
                                    <th scope="col">Create Date</th>
                                    <th scope="col">Update Date</th>
                                    <th scope="col">Edit</th>
                                </tr>
                            </thead>
                            <tbody id="myTable">

                                @for($i=0;$i<count($json);$i++) @php $u_id=$json[$i]['id']; $name=$json[$i]['name'];
                                    $u_name=$json[$i]['username']; $p_word=$json[$i]['password'];
                                    $email=$json[$i]['email']; $remark=$json[$i]['remark']; $role=$json[$i]['role'];
                                    $line=$json[$i]['line_id']; $status=$json[$i]['active_status'];
                                    $is_delete=$json[$i]['is_delete']; $created_at=$json[$i]['created_at'];
                                    $updated_at=$json[$i]['updated_at']; @endphp <tr>
                                    <td>{{ $num++ }}</td>
                                    <td>
                                        @if ($status==0)
                                        <span><i class="fas fa-circle text-success"></i></span>
                                        @elseif($status==1)
                                        <span><i class="fas fa-circle text-danger"></i></span>
                                        @endif
                                    </td>
                                    <td>{{ $name }}</td>
                                    <td>
                                        @if ($role==0)
                                        <span>Admin</span>
                                        @elseif($role==1)
                                        <span>Operator</span>
                                        @elseif($role==2)
                                        <span>Line Manager</span>
                                        @elseif($role==97)
                                        <span>Viewer</span>
                                        @elseif($role==98)
                                        <span>Owner</span>
                                        @endif
                                    </td>
                                    <td>
                                        @for($j=0;$j<count($json2);$j++) @php $l_id=$json2[$j]['l_id'];
                                            $l_name=$json2[$j]['l_name']; @endphp @if($line==$l_id) {{ $l_name }} @endif
                                            @endfor</td>
                                    <td>{{ $u_name }}</td>
                                    <td>{{ $email }}</td>
                                    <td>{{ $remark }}</td>
                                    <td>{{ $created_at }}</td>
                                    <td>{{ $updated_at }}</td>
                                    <td>
                                        <a class='btn custom-btn-theme text-white'
                                            href="{{ url('/member')}}?edit=1&id={{ $u_id
                                        }}&name={{ $name }}&u_name={{ $u_name }}&email={{ $email }}&remark={{ $remark }}&role={{ $role }}&line={{ $line }}&status={{ $status }}&is_delete={{ $is_delete }}"><i
                                                class='fas fa-pencil-alt'></i></a>
                                    </td>
                                    </tr>
                                    @endfor
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
                                    <th scope="col">Status</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Remark</th>
                                    <th scope="col">Create Date</th>
                                    <th scope="col">Update Date</th>
                                    <th scope="col">Edit</th>
                                </tr>
                            </thead>
                            <tbody id="myTable">
                                @for($i=0;$i<count($json);$i++) @php $u_id=$json[$i]['id']; $name=$json[$i]['name'];
                                    $u_name=$json[$i]['username']; $p_word=$json[$i]['password'];
                                    $email=$json[$i]['email']; $remark=$json[$i]['remark']; $role=$json[$i]['role'];
                                    $line=$json[$i]['line_id']; $status=$json[$i]['active_status'];
                                    $is_delete=$json[$i]['is_delete']; $created_at=$json[$i]['created_at'];
                                    $updated_at=$json[$i]['updated_at']; @endphp @if($role==98) <tr>
                                    <td>{{ $num++ }}</td>
                                    <td>
                                        @if ($status==0)
                                        <span><i class="fas fa-circle text-success"></i></span>
                                        @elseif($status==1)
                                        <span><i class="fas fa-circle text-danger"></i></span>
                                        @endif
                                    </td>
                                    <td>{{ $name }}</td>
                                    <td>
                                        @if($role=98)
                                        <span>Owner</span>
                                        @endif
                                    </td>
                                    <td>{{ $u_name }}</td>
                                    <td>{{ $email }}</td>
                                    <td>{{ $remark }}</td>
                                    <td>{{ $created_at }}</td>
                                    <td>{{ $updated_at }}</td>
                                    <td>
                                        <a class='btn custom-btn-theme text-white'
                                            href="{{ url('/member')}}?edit=1&id={{ $u_id
                                        }}&name={{ $name }}&u_name={{ $u_name }}&p_word={{ $p_word }}&email={{ $email }}&remark={{ $remark }}&role={{ $role }}&line={{ $line }}&status={{ $status }}&is_delete={{ $is_delete }}"><i
                                                class='fas fa-pencil-alt'></i></a>
                                    </td>
                                    </tr>
                                    @endif
                                    @endfor
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
                                    <th scope="col">Status</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Remark</th>
                                    <th scope="col">Create Date</th>
                                    <th scope="col">Update Date</th>
                                    <th scope="col">Edit</th>
                                </tr>
                            </thead>
                            <tbody id="myTable">
                                @for($i=0;$i<count($json);$i++) @php $u_id=$json[$i]['id']; $name=$json[$i]['name'];
                                    $u_name=$json[$i]['username']; $p_word=$json[$i]['password'];
                                    $email=$json[$i]['email']; $remark=$json[$i]['remark']; $role=$json[$i]['role'];
                                    $line=$json[$i]['line_id']; $status=$json[$i]['active_status'];
                                    $is_delete=$json[$i]['is_delete']; $created_at=$json[$i]['created_at'];
                                    $updated_at=$json[$i]['updated_at']; @endphp @if($role==0) <tr>
                                    <td>{{ $num++ }}</td>
                                    <td>
                                        @if ($status==0)
                                        <span><i class="fas fa-circle text-success"></i></span>
                                        @elseif($status==1)
                                        <span><i class="fas fa-circle text-danger"></i></span>
                                        @endif
                                    </td>
                                    <td>{{ $name }}</td>
                                    <td>
                                        @if ($role==0)
                                        <span>Admin</span>
                                        @endif
                                    </td>
                                    <td>{{ $u_name }}</td>
                                    <td>{{ $email }}</td>
                                    <td>{{ $remark }}</td>
                                    <td>{{ $created_at }}</td>
                                    <td>{{ $updated_at }}</td>
                                    <td>
                                        <a class='btn custom-btn-theme text-white'
                                            href="{{ url('/member')}}?edit=1&id={{ $u_id
                                        }}&name={{ $name }}&u_name={{ $u_name }}&p_word={{ $p_word }}&email={{ $email }}&remark={{ $remark }}&role={{ $role }}&line={{ $line }}&status={{ $status }}&is_delete={{ $is_delete }}"><i
                                                class='fas fa-pencil-alt'></i></a>
                                    </td>
                                    </tr>
                                    @endif
                                    @endfor
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
                                    <th scope="col">Status</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Line Name</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Remark</th>
                                    <th scope="col">Create Date</th>
                                    <th scope="col">Update Date</th>
                                    <th scope="col">Edit</th>
                                </tr>
                            </thead>
                            <tbody id="myTable">
                                @for($i=0;$i<count($json);$i++) @php $u_id=$json[$i]['id']; $name=$json[$i]['name'];
                                    $u_name=$json[$i]['username']; $p_word=$json[$i]['password'];
                                    $email=$json[$i]['email']; $remark=$json[$i]['remark']; $role=$json[$i]['role'];
                                    $line=$json[$i]['line_id']; $status=$json[$i]['active_status'];
                                    $is_delete=$json[$i]['is_delete']; $created_at=$json[$i]['created_at'];
                                    $updated_at=$json[$i]['updated_at']; @endphp @if($role==1) <tr>
                                    <td>{{ $num++ }}</td>
                                    <td>
                                        @if ($status==0)
                                        <span><i class="fas fa-circle text-success"></i></span>
                                        @elseif($status==1)
                                        <span><i class="fas fa-circle text-danger"></i></span>
                                        @endif
                                    </td>
                                    <td>{{ $name }}</td>
                                    <td>
                                        @if($role==1)
                                        <span>Operator</span>
                                        @endif
                                    </td>
                                    <td>
                                        @for($j=0;$j<count($json2);$j++) @php $l_id=$json2[$j]['l_id'];
                                            $l_name=$json2[$j]['l_name']; @endphp @if($line==$l_id) {{ $l_name }} @endif
                                            @endfor</td>
                                    <td>{{ $u_name }}</td>
                                    <td>{{ $email }}</td>
                                    <td>{{ $remark }}</td>
                                    <td>{{ $created_at }}</td>
                                    <td>{{ $updated_at }}</td>
                                    <td>
                                        <a class='btn custom-btn-theme text-white'
                                            href="{{ url('/member')}}?edit=1&id={{ $u_id
                                        }}&name={{ $name }}&u_name={{ $u_name }}&p_word={{ $p_word }}&email={{ $email }}&remark={{ $remark }}&role={{ $role }}&line={{ $line }}&status={{ $status }}&is_delete={{ $is_delete }}"><i
                                                class='fas fa-pencil-alt'></i></a>
                                    </td>
                                    </tr>
                                    @endif
                                    @endfor
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
                                    <th scope="col">Status</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Line Name</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Remark</th>
                                    <th scope="col">Create Date</th>
                                    <th scope="col">Update Date</th>
                                    <th scope="col">Edit</th>
                                </tr>
                            </thead>
                            <tbody id="myTable">
                                @for($i=0;$i<count($json);$i++) @php $u_id=$json[$i]['id']; $name=$json[$i]['name'];
                                    $u_name=$json[$i]['username']; $p_word=$json[$i]['password'];
                                    $email=$json[$i]['email']; $remark=$json[$i]['remark']; $role=$json[$i]['role'];
                                    $line=$json[$i]['line_id']; $status=$json[$i]['active_status'];
                                    $is_delete=$json[$i]['is_delete']; $created_at=$json[$i]['created_at'];
                                    $updated_at=$json[$i]['updated_at']; @endphp @if($role==2) <tr>
                                    <td>{{ $num++ }}</td>
                                    <td>
                                        @if ($status==0)
                                        <span><i class="fas fa-circle text-success"></i></span>
                                        @elseif($status==1)
                                        <span><i class="fas fa-circle text-danger"></i></span>
                                        @endif
                                    </td>
                                    <td>{{ $name }}</td>
                                    <td>
                                        @if($role==2)
                                        <span>Line Manager</span>
                                        @endif
                                    </td>
                                    <td>
                                        @for($j=0;$j<count($json2);$j++) @php $l_id=$json2[$j]['l_id'];
                                            $l_name=$json2[$j]['l_name']; @endphp @if($line==$l_id) {{ $l_name }} @endif
                                            @endfor</td>
                                    <td>{{ $u_name }}</td>
                                    <td>{{ $email }}</td>
                                    <td>{{ $remark }}</td>
                                    <td>{{ $created_at }}</td>
                                    <td>{{ $updated_at }}</td>
                                    <td>
                                        <a class='btn custom-btn-theme text-white'
                                            href="{{ url('/member')}}?edit=1&id={{ $u_id
                                        }}&name={{ $name }}&u_name={{ $u_name }}&p_word={{ $p_word }}&email={{ $email }}&remark={{ $remark }}&role={{ $role }}&line={{ $line }}&status={{ $status }}&is_delete={{ $is_delete }}"><i
                                                class='fas fa-pencil-alt'></i></a>
                                    </td>
                                    </tr>
                                    @endif
                                    @endfor
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
                                    <th scope="col">Status</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Line Name</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Remark</th>
                                    <th scope="col">Create Date</th>
                                    <th scope="col">Update Date</th>
                                    <th scope="col">Edit</th>
                                </tr>
                            </thead>
                            <tbody id="myTable">
                                @for($i=0;$i<count($json);$i++) @php $u_id=$json[$i]['id']; $name=$json[$i]['name'];
                                    $u_name=$json[$i]['username']; $p_word=$json[$i]['password'];
                                    $email=$json[$i]['email']; $remark=$json[$i]['remark']; $role=$json[$i]['role'];
                                    $line=$json[$i]['line_id']; $status=$json[$i]['active_status'];
                                    $is_delete=$json[$i]['is_delete']; $created_at=$json[$i]['created_at'];
                                    $updated_at=$json[$i]['updated_at']; @endphp @if($role==97) <tr>
                                    <td>{{ $num++ }}</td>
                                    <td>
                                        @if ($status==0)
                                        <span><i class="fas fa-circle text-success"></i></span>
                                        @elseif($status==1)
                                        <span><i class="fas fa-circle text-danger"></i></span>
                                        @endif
                                    </td>
                                    <td>{{ $name }}</td>
                                    <td>
                                        @if($role==97)
                                        <span>Viewer</span>
                                        @endif
                                    </td>
                                    <td>
                                        @for($j=0;$j<count($json2);$j++) @php $l_id=$json2[$j]['l_id'];
                                            $l_name=$json2[$j]['l_name']; @endphp @if($line==$l_id) {{ $l_name }} @endif
                                            @endfor</td>
                                    <td>{{ $u_name }}</td>
                                    <td>{{ $email }}</td>
                                    <td>{{ $remark }}</td>
                                    <td>{{ $created_at }}</td>
                                    <td>{{ $updated_at }}</td>
                                    <td>
                                        <a class='btn custom-btn-theme text-white'
                                            href="{{ url('/member')}}?edit=1&id={{ $u_id
                                        }}&name={{ $name }}&u_name={{ $u_name }}&p_word={{ $p_word }}&email={{ $email }}&remark={{ $remark }}&role={{ $role }}&line={{ $line }}&status={{ $status }}&is_delete={{ $is_delete }}"><i
                                                class='fas fa-pencil-alt'></i></a>
                                    </td>
                                    </tr>
                                    @endif
                                    @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endowner

@admin

@php $json2=json_decode($responseBody2,true); @endphp
<div class="container-fluid">
    <div class="container-fluid">
        @if (@$_GET['edit'] != "" && @$_GET['edit'] == "1")
        <form action="{{ url('member_put') }}" method="POST">
            <input type="hidden" name="id" value="{{ $_GET['id'] }}" />
            <div class="my-4">
                <h1 class="fw-bold heading-text">Member Edit</h1>
                <div class="d-flex flex-row-reverse">
                    @if ($_GET['is_delete']==0)
                    <a class='btn btn-danger text-white' href='{{ url("/member_delete") }}/{{ $_GET["id"] }}'
                        onclick="return confirm('Confirm deleting member?')">Deactivate User</a>
                    @elseif($_GET['is_delete']==1)
                    <a class='btn btn-success text-white' href='{{ url("/member_undo") }}/{{ $_GET["id"] }}'
                        onclick="return confirm('Confirm restoring member?')">Activate User</a>
                    @endif
                </div>
                <div class="row g-3 my-2">
                    <div class="col-12 col-md-4">
                        <label>Name</label>​
                        <input type="text" class="form-control" name="name" placeholder="Name"
                            value="{{ $_GET['name'] }}" required />
                    </div>
                    <div class="col-12 col-md-4">
                        <label>Username</label>
                        <input type="text" class="form-control" autocapitalize="none" name="username"
                            placeholder="Username" value="{{ $_GET['u_name'] }}" required />
                    </div>
                    <div class="col-12 col-md-4">
                        <label>Password</label>
                        <div class="row container-fluid p-0 m-0">
                            <div class="col-6" id="password-div" style="display: none;">
                                <input type="text" class="form-control" name="password2" id="password2"
                                    placeholder="Password" />
                            </div>
                            <div class="col-6">
                                <button type="button" onclick=toggleMe()>Toggle me!</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-3 my-2">
                    <div class="col-12 col-md-4">
                        <label>Email</label>
                        <input type="text" class="form-control" name="email" placeholder="Email"
                            value="{{ $_GET['email'] }}" />
                    </div>
                    <div class="col-12 col-md-4">
                        <label>Role</label>​
                        <select class="form-control" name="role">
                            <option value="{{ $_GET['role'] }}">
                                @if ($_GET['role']==0) Admin
                                @elseif ($_GET['role']==1) Operator
                                @elseif ($_GET['role']==2) Line Manager
                                @endif</option>
                            <option value="0">Admin</option>
                            <option value="1">Operator</option>
                            <option value="2">Line Manager</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-4">
                        <label>Line Name</label>​
                        <select class="form-control" name="line">
                            <option value="{{ $_GET['line'] }}">
                                @for($i = 0; $i < count($json2); $i++) @php
                                    $l_id=$json2[$i]['l_id'];$l_name=$json2[$i]['l_name']; @endphp
                                    @if($l_id==$_GET['line']) {{ $l_name }} @endif @endfor</option>
                                    @for($i = 0; $i < count($json2); $i++) @php $l_id=$json2[$i]['l_id'];
                                        $l_name=$json2[$i]['l_name']; @endphp <option value="{{ $l_id }}">{{
                                        $l_name }}
                            </option> @endfor
                        </select>
                    </div>
                </div>
                <div class="row g-3 my-2">
                    <div class="col-12 col-md-4">
                        <label>Note</label>
                        <textarea class="form-control" name="note" placeholder="Note" id="comment"
                            maxlength="150">{{ $_GET['remark'] }}</textarea> <span id="characterLeft"></span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 m-auto text-center">
                <input class="icon-btn-one btn my-2" type="submit" value="Update Account" name="submit" />
                <a href="{{ url('member') }}" class="btn-secondary btn my-2">Cancel</a>
            </div>
        </form>
        @endif

        <h1 class="fw-bold heading-text">Member</h1>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModal2Label"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <form action="{{ url('member_post') }}" method="GET">
                            <div class="my-4">
                                <h1 class="fw-bold heading-text">Member Registration</h1>
                                <div class="row g-3 my-2">
                                    <div class="col-12 col-md-4">
                                        <label>Name</label>​
                                        <input type="text" class="form-control" name="name" placeholder="Name"
                                            required />
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
                                        <input type="text" class="form-control" name="email" placeholder="Email" />
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label>Role</label>​
                                        <select class="form-control" name="role" required>
                                            <option> </option>
                                            <option value="0">Admin</option>
                                            <option value="1">Operator</option>
                                            <option value="2">Line Manager</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label>Line Name</label>​
                                        <select class="form-control" name="line">
                                            <option> </option>
                                            @for($i = 0; $i < count($json2); $i++) @php $l_id=$json2[$i]['l_id'];
                                                $l_name=$json2[$i]['l_name']; @endphp <option value="{{ $l_id }}">{{
                                                $l_name }} @endfor
                                                </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row g-3 my-2">
                                    <div class="col-12 col-md-4">
                                        <label>Note</label>
                                        <textarea class="form-control" name="note" placeholder="Note" id="comment"
                                            maxlength="150"></textarea> <span id="characterLeft"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 m-auto text-center">
                                <input class="icon-btn-one btn my-2" type="submit" value="Create Account"
                                    name="submit" />
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
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
                        <li class="span2">
                            <a href="#">Viewer List</a>
                        </li>
                    </ul>
                </div>
                <div class="col text-center my-2 m-auto">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn w-75 custom-btn-theme" data-bs-toggle="modal"
                        data-bs-target="#exampleModal2">
                        Create New Member
                    </button>
                </div>
            </div>

            <div class="form-group pull-right mt-3">
                <input class="form-control" id="myInput" type="text" placeholder="Search">
            </div>

            @php
            $json = json_decode($responseBody,true);
            $num = 1;
            @endphp
            <div id="tab-content">
                <div id="tab1" class="div_1">
                    <div style="overflow: auto;max-width:100%;max-height:600px;">
                        <table class="table table-striped my-4 tableFixHead results p-0 text-center">
                            <thead>
                                <tr class="tr-2">
                                    <th scope="col">No.</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Line Name</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Remark</th>
                                    <th scope="col">Create Date</th>
                                    <th scope="col">Update Date</th>
                                    <th scope="col">Edit</th>
                                </tr>
                            </thead>
                            <tbody id="myTable">

                                @for($i=0;$i<count($json);$i++) @php $u_id=$json[$i]['id']; $name=$json[$i]['name'];
                                    $u_name=$json[$i]['username']; $p_word=$json[$i]['password'];
                                    $email=$json[$i]['email']; $remark=$json[$i]['remark']; $role=$json[$i]['role'];
                                    $line=$json[$i]['line_id']; $status=$json[$i]['active_status'];
                                    $is_delete=$json[$i]['is_delete']; $created_at=$json[$i]['created_at'];
                                    $updated_at=$json[$i]['updated_at']; @endphp @if($role!=98) <tr>
                                    <td>{{ $num++ }}</td>
                                    <td>
                                        @if ($status==0)
                                        <span><i class="fas fa-circle text-success"></i></span>
                                        @elseif($status==1)
                                        <span><i class="fas fa-circle text-danger"></i></span>
                                        @endif
                                    </td>
                                    <td>{{ $name }}</td>
                                    <td>
                                        @if ($role==0)
                                        <span>Admin</span>
                                        @elseif($role==1)
                                        <span>Operator</span>
                                        @elseif($role==2)
                                        <span>Line Manager</span>
                                        @elseif($role==97)
                                        <span>Viewer</span>
                                        @endif
                                    </td>
                                    <td>
                                        @for($j=0;$j<count($json2);$j++) @php $l_id=$json2[$j]['l_id'];
                                            $l_name=$json2[$j]['l_name']; @endphp @if($line==$l_id) {{ $l_name }} @endif
                                            @endfor</td>
                                    <td>{{ $u_name }}</td>
                                    <td>{{ $email }}</td>
                                    <td>{{ $remark }}</td>
                                    <td>{{ $created_at }}</td>
                                    <td>{{ $updated_at }}</td>
                                    <td>
                                        <a class='btn custom-btn-theme text-white'
                                            href="{{ url('/member')}}?edit=1&id={{ $u_id
                                        }}&name={{ $name }}&u_name={{ $u_name }}&email={{ $email }}&remark={{ $remark }}&role={{ $role }}&line={{ $line }}&status={{ $status }}&is_delete={{ $is_delete }}"><i
                                                class='fas fa-pencil-alt'></i></a>
                                    </td>
                                    </tr>
                                    @endif
                                    @endfor
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
                                    <th scope="col">Status</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Remark</th>
                                    <th scope="col">Create Date</th>
                                    <th scope="col">Update Date</th>
                                    <th scope="col">Edit</th>
                                </tr>
                            </thead>
                            <tbody id="myTable">
                                @for($i=0;$i<count($json);$i++) @php $u_id=$json[$i]['id']; $name=$json[$i]['name'];
                                    $u_name=$json[$i]['username']; $p_word=$json[$i]['password'];
                                    $email=$json[$i]['email']; $remark=$json[$i]['remark']; $role=$json[$i]['role'];
                                    $line=$json[$i]['line_id']; $status=$json[$i]['active_status'];
                                    $is_delete=$json[$i]['is_delete']; $created_at=$json[$i]['created_at'];
                                    $updated_at=$json[$i]['updated_at']; @endphp @if($role==0) <tr>
                                    <td>{{ $num++ }}</td>
                                    <td>
                                        @if ($status==0)
                                        <span><i class="fas fa-circle text-success"></i></span>
                                        @elseif($status==1)
                                        <span><i class="fas fa-circle text-danger"></i></span>
                                        @endif
                                    </td>
                                    <td>{{ $name }}</td>
                                    <td>
                                        @if ($role==0)
                                        <span>Admin</span>
                                        @elseif($role==1)
                                        <span>Operator</span>
                                        @elseif($role=2)
                                        <span>Line Manager</span>
                                        @endif
                                    </td>
                                    <td>{{ $u_name }}</td>
                                    <td>{{ $email }}</td>
                                    <td>{{ $remark }}</td>
                                    <td>{{ $created_at }}</td>
                                    <td>{{ $updated_at }}</td>
                                    <td>
                                        <a class='btn custom-btn-theme text-white'
                                            href="{{ url('/member')}}?edit=1&id={{ $u_id
                                        }}&name={{ $name }}&u_name={{ $u_name }}&p_word={{ $p_word }}&email={{ $email }}&remark={{ $remark }}&role={{ $role }}&line={{ $line }}&status={{ $status }}&is_delete={{ $is_delete }}"><i
                                                class='fas fa-pencil-alt'></i></a>
                                    </td>
                                    </tr>
                                    @endif
                                    @endfor
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
                                    <th scope="col">Status</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Remark</th>
                                    <th scope="col">Create Date</th>
                                    <th scope="col">Update Date</th>
                                    <th scope="col">Edit</th>
                                </tr>
                            </thead>
                            <tbody id="myTable">
                                @for($i=0;$i<count($json);$i++) @php $u_id=$json[$i]['id']; $name=$json[$i]['name'];
                                    $u_name=$json[$i]['username']; $p_word=$json[$i]['password'];
                                    $email=$json[$i]['email']; $remark=$json[$i]['remark']; $role=$json[$i]['role'];
                                    $line=$json[$i]['line_id']; $status=$json[$i]['active_status'];
                                    $is_delete=$json[$i]['is_delete']; $created_at=$json[$i]['created_at'];
                                    $updated_at=$json[$i]['updated_at']; @endphp @if($role==1) <tr>
                                    <td>{{ $num++ }}</td>
                                    <td>
                                        @if ($status==0)
                                        <span><i class="fas fa-circle text-success"></i></span>
                                        @elseif($status==1)
                                        <span><i class="fas fa-circle text-danger"></i></span>
                                        @endif
                                    </td>
                                    <td>{{ $name }}</td>
                                    <td>
                                        @if ($role==0)
                                        <span>Admin</span>
                                        @elseif($role==1)
                                        <span>Operator</span>
                                        @elseif($role=2)
                                        <span>Line Manager</span>
                                        @endif
                                    </td>
                                    <td>{{ $u_name }}</td>
                                    <td>{{ $email }}</td>
                                    <td>{{ $remark }}</td>
                                    <td>{{ $created_at }}</td>
                                    <td>{{ $updated_at }}</td>
                                    <td>
                                        <a class='btn custom-btn-theme text-white'
                                            href="{{ url('/member')}}?edit=1&id={{ $u_id
                                        }}&name={{ $name }}&u_name={{ $u_name }}&p_word={{ $p_word }}&email={{ $email }}&remark={{ $remark }}&role={{ $role }}&line={{ $line }}&status={{ $status }}&is_delete={{ $is_delete }}"><i
                                                class='fas fa-pencil-alt'></i></a>
                                    </td>
                                    </tr>
                                    @endif
                                    @endfor
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
                                    <th scope="col">Status</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Line Name</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Remark</th>
                                    <th scope="col">Create Date</th>
                                    <th scope="col">Update Date</th>
                                    <th scope="col">Edit</th>
                                </tr>
                            </thead>
                            <tbody id="myTable">
                                @for($i=0;$i<count($json);$i++) @php $u_id=$json[$i]['id']; $name=$json[$i]['name'];
                                    $u_name=$json[$i]['username']; $p_word=$json[$i]['password'];
                                    $email=$json[$i]['email']; $remark=$json[$i]['remark']; $role=$json[$i]['role'];
                                    $line=$json[$i]['line_id']; $status=$json[$i]['active_status'];
                                    $is_delete=$json[$i]['is_delete']; $created_at=$json[$i]['created_at'];
                                    $updated_at=$json[$i]['updated_at']; @endphp @if($role==2) <tr>
                                    <td>{{ $num++ }}</td>
                                    <td>
                                        @if ($status==0)
                                        <span><i class="fas fa-circle text-success"></i></span>
                                        @elseif($status==1)
                                        <span><i class="fas fa-circle text-danger"></i></span>
                                        @endif
                                    </td>
                                    <td>{{ $name }}</td>
                                    <td>
                                        @if ($role==0)
                                        <span>Admin</span>
                                        @elseif($role==1)
                                        <span>Operator</span>
                                        @elseif($role=2)
                                        <span>Line Manager</span>
                                        @endif
                                    </td>
                                    <td>
                                        @for($j=0;$j<count($json2);$j++) @php $l_id=$json2[$j]['l_id'];
                                            $l_name=$json2[$j]['l_name']; @endphp @if($line==$l_id) {{ $l_name }} @endif
                                            @endfor</td>
                                    <td>{{ $u_name }}</td>
                                    <td>{{ $email }}</td>
                                    <td>{{ $remark }}</td>
                                    <td>{{ $created_at }}</td>
                                    <td>{{ $updated_at }}</td>
                                    <td>
                                        <a class='btn custom-btn-theme text-white'
                                            href="{{ url('/member')}}?edit=1&id={{ $u_id
                                        }}&name={{ $name }}&u_name={{ $u_name }}&p_word={{ $p_word }}&email={{ $email }}&remark={{ $remark }}&role={{ $role }}&line={{ $line }}&status={{ $status }}&is_delete={{ $is_delete }}"><i
                                                class='fas fa-pencil-alt'></i></a>
                                    </td>
                                    </tr>
                                    @endif
                                    @endfor
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
                                    <th scope="col">Status</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Line Name</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Remark</th>
                                    <th scope="col">Create Date</th>
                                    <th scope="col">Update Date</th>
                                    <th scope="col">Edit</th>
                                </tr>
                            </thead>
                            <tbody id="myTable">
                                @for($i=0;$i<count($json);$i++) @php $u_id=$json[$i]['id']; $name=$json[$i]['name'];
                                    $u_name=$json[$i]['username']; $p_word=$json[$i]['password'];
                                    $email=$json[$i]['email']; $remark=$json[$i]['remark']; $role=$json[$i]['role'];
                                    $line=$json[$i]['line_id']; $status=$json[$i]['active_status'];
                                    $is_delete=$json[$i]['is_delete']; $created_at=$json[$i]['created_at'];
                                    $updated_at=$json[$i]['updated_at']; @endphp @if($role==97) <tr>
                                    <td>{{ $num++ }}</td>
                                    <td>
                                        @if ($status==0)
                                        <span><i class="fas fa-circle text-success"></i></span>
                                        @elseif($status==1)
                                        <span><i class="fas fa-circle text-danger"></i></span>
                                        @endif
                                    </td>
                                    <td>{{ $name }}</td>
                                    <td>
                                        @if($role=97)
                                        <span>Line Manager</span>
                                        @endif
                                    </td>
                                    <td>
                                        @for($j=0;$j<count($json2);$j++) @php $l_id=$json2[$j]['l_id'];
                                            $l_name=$json2[$j]['l_name']; @endphp @if($line==$l_id) {{ $l_name }} @endif
                                            @endfor</td>
                                    <td>{{ $u_name }}</td>
                                    <td>{{ $email }}</td>
                                    <td>{{ $remark }}</td>
                                    <td>{{ $created_at }}</td>
                                    <td>{{ $updated_at }}</td>
                                    <td>
                                        <a class='btn custom-btn-theme text-white'
                                            href="{{ url('/member')}}?edit=1&id={{ $u_id
                                        }}&name={{ $name }}&u_name={{ $u_name }}&p_word={{ $p_word }}&email={{ $email }}&remark={{ $remark }}&role={{ $role }}&line={{ $line }}&status={{ $status }}&is_delete={{ $is_delete }}"><i
                                                class='fas fa-pencil-alt'></i></a>
                                    </td>
                                    </tr>
                                    @endif
                                    @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endadmin

@operator

@php $json2=json_decode($responseBody2,true); @endphp
<div class="container-fluid">
    <div class="container-fluid">
        @if (@$_GET['edit'] != "" && @$_GET['edit'] == "1")
        <form action="{{ url('member_put') }}" method="POST">
            <input type="hidden" name="id" value="{{ $_GET['id'] }}" />
            <div class="my-4">
                <h1 class="fw-bold heading-text">Member Edit</h1>
                <div class="d-flex flex-row-reverse">
                    @if ($_GET['is_delete']==0)
                    <a class='btn btn-danger text-white' href='{{ url("/member_delete") }}/{{ $_GET["id"] }}'
                        onclick="return confirm('Confirm deleting member?')">Deactivate User</a>
                    @elseif($_GET['is_delete']==1)
                    <a class='btn btn-success text-white' href='{{ url("/member_undo") }}/{{ $_GET["id"] }}'
                        onclick="return confirm('Confirm restoring member?')">Activate User</a>
                    @endif
                </div>
                <div class="row g-3 my-2">
                    <div class="col-12 col-md-4">
                        <label>Name</label>​
                        <input type="text" class="form-control" name="name" placeholder="Name"
                            value="{{ $_GET['name'] }}" required />
                    </div>
                    <div class="col-12 col-md-4">
                        <label>Username</label>
                        <input type="text" class="form-control" autocapitalize="none" name="username"
                            placeholder="Username" value="{{ $_GET['u_name'] }}" required />
                    </div>
                    <div class="col-12 col-md-4">
                        <label>Password</label>
                        <div class="row container-fluid p-0 m-0">
                            <div class="col-6" id="password-div" style="display: none;">
                                <input type="text" class="form-control" name="password2" id="password2"
                                    placeholder="Password" />
                            </div>
                            <div class="col-6">
                                <button type="button" onclick=toggleMe()>Toggle me!</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-3 my-2">
                    <div class="col-12 col-md-4">
                        <label>Email</label>
                        <input type="text" class="form-control" name="email" placeholder="Email"
                            value="{{ $_GET['email'] }}" />
                    </div>
                    <div class="col-12 col-md-4">
                        <label>Role</label>​
                        <select class="form-control" name="role">
                            <option value="{{ $_GET['role'] }}">
                                @if ($_GET['role']==0) Admin
                                @elseif ($_GET['role']==1) Operator
                                @elseif ($_GET['role']==2) Line Manager
                                @endif</option>
                            <option value="0">Admin</option>
                            <option value="1">Operator</option>
                            <option value="2">Line Manager</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-4">
                        <label>Line Name</label>​
                        <select class="form-control" name="line">
                            <option value="{{ $_GET['line'] }}">
                                @for($i = 0; $i < count($json2); $i++) @php
                                    $l_id=$json2[$i]['l_id'];$l_name=$json2[$i]['l_name']; @endphp
                                    @if($l_id==$_GET['line']) {{ $l_name }} @endif @endfor</option>
                                    @for($i = 0; $i < count($json2); $i++) @php $l_id=$json2[$i]['l_id'];
                                        $l_name=$json2[$i]['l_name']; @endphp <option value="{{ $l_id }}">{{
                                        $l_name }}
                            </option> @endfor
                        </select>
                    </div>
                </div>
                <div class="row g-3 my-2">
                    <div class="col-12 col-md-4">
                        <label>Note</label>
                        <textarea class="form-control" name="note" placeholder="Note" id="comment"
                            maxlength="150">{{ $_GET['remark'] }}</textarea> <span id="characterLeft"></span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 m-auto text-center">
                <input class="icon-btn-one btn my-2" type="submit" value="Update Account" name="submit" />
                <a href="{{ url('member') }}" class="btn-secondary btn my-2">Cancel</a>
            </div>
        </form>
        @endif

        <h1 class="fw-bold heading-text">Member</h1>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModal2Label"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <form action="{{ url('member_post') }}" method="GET">
                            <div class="my-4">
                                <h1 class="fw-bold heading-text">Member Registration</h1>
                                <div class="row g-3 my-2">
                                    <div class="col-12 col-md-4">
                                        <label>Name</label>​
                                        <input type="text" class="form-control" name="name" placeholder="Name"
                                            required />
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
                                        <input type="text" class="form-control" name="email" placeholder="Email" />
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label>Role</label>​
                                        <select class="form-control" name="role" required>
                                            <option> </option>
                                            <option value="0">Admin</option>
                                            <option value="1">Operator</option>
                                            <option value="2">Line Manager</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label>Line Name</label>​
                                        <select class="form-control" name="line">
                                            <option> </option>
                                            @for($i = 0; $i < count($json2); $i++) @php $l_id=$json2[$i]['l_id'];
                                                $l_name=$json2[$i]['l_name']; @endphp <option value="{{ $l_id }}">{{
                                                $l_name }} @endfor
                                                </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row g-3 my-2">
                                    <div class="col-12 col-md-4">
                                        <label>Note</label>
                                        <textarea class="form-control" name="note" placeholder="Note" id="comment"
                                            maxlength="150"></textarea> <span id="characterLeft"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 m-auto text-center">
                                <input class="icon-btn-one btn my-2" type="submit" value="Create Account"
                                    name="submit" />
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
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
                        <li class="span2">
                            <a href="#">Operator List</a>
                        </li>
                        <li class="span2">
                            <a href="#">Line Manager List</a>
                        </li>
                        <li class="span2">
                            <a href="#">Viewer List</a>
                        </li>
                    </ul>
                </div>
                <div class="col text-center my-2 m-auto">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn w-75 custom-btn-theme" data-bs-toggle="modal"
                        data-bs-target="#exampleModal2">
                        Create New Member
                    </button>
                </div>
            </div>

            <div class="form-group pull-right mt-3">
                <input class="form-control" id="myInput" type="text" placeholder="Search">
            </div>

            @php
            $json = json_decode($responseBody,true);
            $num = 1;
            @endphp
            <div id="tab-content">
                <div id="tab1" class="div_1">
                    <div style="overflow: auto;max-width:100%;max-height:600px;">
                        <table class="table table-striped my-4 tableFixHead results p-0 text-center">
                            <thead>
                                <tr class="tr-2">
                                    <th scope="col">No.</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Line Name</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Remark</th>
                                    <th scope="col">Create Date</th>
                                    <th scope="col">Update Date</th>
                                    <th scope="col">Edit</th>
                                </tr>
                            </thead>
                            <tbody id="myTable">

                                @for($i=0;$i<count($json);$i++) @php $u_id=$json[$i]['id']; $name=$json[$i]['name'];
                                    $u_name=$json[$i]['username']; $p_word=$json[$i]['password'];
                                    $email=$json[$i]['email']; $remark=$json[$i]['remark']; $role=$json[$i]['role'];
                                    $line=$json[$i]['line_id']; $status=$json[$i]['active_status'];
                                    $is_delete=$json[$i]['is_delete']; $created_at=$json[$i]['created_at'];
                                    $updated_at=$json[$i]['updated_at']; @endphp @if($role!=0 && $role!=98) <tr>
                                    <td>{{ $num++ }}</td>
                                    <td>
                                        @if ($status==0)
                                        <span><i class="fas fa-circle text-success"></i></span>
                                        @elseif($status==1)
                                        <span><i class="fas fa-circle text-danger"></i></span>
                                        @endif
                                    </td>
                                    <td>{{ $name }}</td>
                                    <td>
                                        @if($role==1)
                                        <span>Operator</span>
                                        @elseif($role==2)
                                        <span>Line Manager</span>
                                        @elseif($role==97)
                                        <span>Viewer</span>
                                        @endif
                                    </td>
                                    <td>
                                        @for($j=0;$j<count($json2);$j++) @php $l_id=$json2[$j]['l_id'];
                                            $l_name=$json2[$j]['l_name']; @endphp @if($line==$l_id) {{ $l_name }} @endif
                                            @endfor</td>
                                    <td>{{ $u_name }}</td>
                                    <td>{{ $email }}</td>
                                    <td>{{ $remark }}</td>
                                    <td>{{ $created_at }}</td>
                                    <td>{{ $updated_at }}</td>
                                    <td>
                                        <a class='btn custom-btn-theme text-white'
                                            href="{{ url('/member')}}?edit=1&id={{ $u_id
                                        }}&name={{ $name }}&u_name={{ $u_name }}&email={{ $email }}&remark={{ $remark }}&role={{ $role }}&line={{ $line }}&status={{ $status }}&is_delete={{ $is_delete }}"><i
                                                class='fas fa-pencil-alt'></i></a>
                                    </td>
                                    </tr>
                                    @endif
                                    @endfor
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
                                    <th scope="col">Status</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Remark</th>
                                    <th scope="col">Create Date</th>
                                    <th scope="col">Update Date</th>
                                    <th scope="col">Edit</th>
                                </tr>
                            </thead>
                            <tbody id="myTable">
                                @for($i=0;$i<count($json);$i++) @php $u_id=$json[$i]['id']; $name=$json[$i]['name'];
                                    $u_name=$json[$i]['username']; $p_word=$json[$i]['password'];
                                    $email=$json[$i]['email']; $remark=$json[$i]['remark']; $role=$json[$i]['role'];
                                    $line=$json[$i]['line_id']; $status=$json[$i]['active_status'];
                                    $is_delete=$json[$i]['is_delete']; $created_at=$json[$i]['created_at'];
                                    $updated_at=$json[$i]['updated_at']; @endphp @if($role==1) <tr>
                                    <td>{{ $num++ }}</td>
                                    <td>
                                        @if ($status==0)
                                        <span><i class="fas fa-circle text-success"></i></span>
                                        @elseif($status==1)
                                        <span><i class="fas fa-circle text-danger"></i></span>
                                        @endif
                                    </td>
                                    <td>{{ $name }}</td>
                                    <td>
                                        @if($role==1)
                                        <span>Operator</span>
                                        @endif
                                    </td>
                                    <td>{{ $u_name }}</td>
                                    <td>{{ $email }}</td>
                                    <td>{{ $remark }}</td>
                                    <td>{{ $created_at }}</td>
                                    <td>{{ $updated_at }}</td>
                                    <td>
                                        <a class='btn custom-btn-theme text-white'
                                            href="{{ url('/member')}}?edit=1&id={{ $u_id
                                        }}&name={{ $name }}&u_name={{ $u_name }}&p_word={{ $p_word }}&email={{ $email }}&remark={{ $remark }}&role={{ $role }}&line={{ $line }}&status={{ $status }}&is_delete={{ $is_delete }}"><i
                                                class='fas fa-pencil-alt'></i></a>
                                    </td>
                                    </tr>
                                    @endif
                                    @endfor
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
                                    <th scope="col">Status</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Remark</th>
                                    <th scope="col">Create Date</th>
                                    <th scope="col">Update Date</th>
                                    <th scope="col">Edit</th>
                                </tr>
                            </thead>
                            <tbody id="myTable">
                                @for($i=0;$i<count($json);$i++) @php $u_id=$json[$i]['id']; $name=$json[$i]['name'];
                                    $u_name=$json[$i]['username']; $p_word=$json[$i]['password'];
                                    $email=$json[$i]['email']; $remark=$json[$i]['remark']; $role=$json[$i]['role'];
                                    $line=$json[$i]['line_id']; $status=$json[$i]['active_status'];
                                    $is_delete=$json[$i]['is_delete']; $created_at=$json[$i]['created_at'];
                                    $updated_at=$json[$i]['updated_at']; @endphp @if($role==2) <tr>
                                    <td>{{ $num++ }}</td>
                                    <td>
                                        @if ($status==0)
                                        <span><i class="fas fa-circle text-success"></i></span>
                                        @elseif($status==1)
                                        <span><i class="fas fa-circle text-danger"></i></span>
                                        @endif
                                    </td>
                                    <td>{{ $name }}</td>
                                    <td>
                                        @if($role=2)
                                        <span>Line Manager</span>
                                        @endif
                                    </td>
                                    <td>{{ $u_name }}</td>
                                    <td>{{ $email }}</td>
                                    <td>{{ $remark }}</td>
                                    <td>{{ $created_at }}</td>
                                    <td>{{ $updated_at }}</td>
                                    <td>
                                        <a class='btn custom-btn-theme text-white'
                                            href="{{ url('/member')}}?edit=1&id={{ $u_id
                                        }}&name={{ $name }}&u_name={{ $u_name }}&p_word={{ $p_word }}&email={{ $email }}&remark={{ $remark }}&role={{ $role }}&line={{ $line }}&status={{ $status }}&is_delete={{ $is_delete }}"><i
                                                class='fas fa-pencil-alt'></i></a>
                                    </td>
                                    </tr>
                                    @endif
                                    @endfor
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
                                    <th scope="col">Status</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Line Name</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Remark</th>
                                    <th scope="col">Create Date</th>
                                    <th scope="col">Update Date</th>
                                    <th scope="col">Edit</th>
                                </tr>
                            </thead>
                            <tbody id="myTable">
                                @for($i=0;$i<count($json);$i++) @php $u_id=$json[$i]['id']; $name=$json[$i]['name'];
                                    $u_name=$json[$i]['username']; $p_word=$json[$i]['password'];
                                    $email=$json[$i]['email']; $remark=$json[$i]['remark']; $role=$json[$i]['role'];
                                    $line=$json[$i]['line_id']; $status=$json[$i]['active_status'];
                                    $is_delete=$json[$i]['is_delete']; $created_at=$json[$i]['created_at'];
                                    $updated_at=$json[$i]['updated_at']; @endphp @if($role==97) <tr>
                                    <td>{{ $num++ }}</td>
                                    <td>
                                        @if ($status==0)
                                        <span><i class="fas fa-circle text-success"></i></span>
                                        @elseif($status==1)
                                        <span><i class="fas fa-circle text-danger"></i></span>
                                        @endif
                                    </td>
                                    <td>{{ $name }}</td>
                                    <td>
                                        @if($role=97)
                                        <span>Viewer</span>
                                        @endif
                                    </td>
                                    <td>
                                        @for($j=0;$j<count($json2);$j++) @php $l_id=$json2[$j]['l_id'];
                                            $l_name=$json2[$j]['l_name']; @endphp @if($line==$l_id) {{ $l_name }} @endif
                                            @endfor</td>
                                    <td>{{ $u_name }}</td>
                                    <td>{{ $email }}</td>
                                    <td>{{ $remark }}</td>
                                    <td>{{ $created_at }}</td>
                                    <td>{{ $updated_at }}</td>
                                    <td>
                                        <a class='btn custom-btn-theme text-white'
                                            href="{{ url('/member')}}?edit=1&id={{ $u_id
                                        }}&name={{ $name }}&u_name={{ $u_name }}&p_word={{ $p_word }}&email={{ $email }}&remark={{ $remark }}&role={{ $role }}&line={{ $line }}&status={{ $status }}&is_delete={{ $is_delete }}"><i
                                                class='fas fa-pencil-alt'></i></a>
                                    </td>
                                    </tr>
                                    @endif
                                    @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
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
