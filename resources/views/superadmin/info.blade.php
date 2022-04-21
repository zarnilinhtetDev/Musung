@extends('layouts.app')

@section('content')
@section('content_2')
<div class="container-fluid">
    <h1 class="fw-bold heading-text">SuperAdmin</h1>
</div>
@php $u_detail_decode = json_decode($user_detail,true);

print_r($u_detail_decode); @endphp

@if

@endif
<form action="/superadmin_post" method="POST">
    <input type="text" name="name" placeholder="Name" required />
    <input type="text" name="username" placeholder="Username" required />
    <input type="password" name="password" placeholder="Password" required />
    <input type="hidden" name="role" value="99" />
    <input type="submit" value="Create">
</form>
@endsection
@endsection
