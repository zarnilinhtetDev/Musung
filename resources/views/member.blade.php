@extends('layouts.app')

@section('content')
@extends('layouts.navbar_sidebar')
@section('content_2')
<div class="container">
    <div class="container-fluid">
        <h1 class="fw-bold heading-text">Member</h1>
        <div class="my-4">
            <div class="row g-3 my-2">
                <div class="col-12 col-md-6">
                    <label>Name</label>​
                    <input type="text" class="form-control" name="name" placeholder="Name" required />
                </div>
                <div class=" col-12 col-md-6">
                    <label>Username</label>
                    <input type="text" class="form-control" autocapitalize="none" name="username" placeholder="Username"
                        required />
                </div>
            </div>
            <div class="row g-3 my-2">
                <div class="col-12 col-md-6">
                    <label>Password</label>
                    <input type="text" class="form-control" name="password" placeholder="Password" required />
                </div>
                <div class="col-12 col-md-6">
                    <label>Role</label>​
                    <select class="form-control" name="type">
                        <option> </option>
                        <option value="0">Admin</option>
                        <option value="1">Operator</option>
                        <option value="2">Line Manager</option>
                    </select>
                </div>
            </div>
            <div class="row g-3 my-2">
                <div class="col-12 col-md-6">
                    <label>Note</label>
                    <textarea class="form-control" name="note" placeholder="Note"></textarea>
                </div>
            </div>
            <div class="col-12 col-md-6 m-auto text-center">
                <input class="icon-btn-one btn my-2" type="submit" value="Create Account" name="submit" />
            </div>
        </div>
    </div>
</div>
@endsection

@endsection
