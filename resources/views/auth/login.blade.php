@extends('layouts.app')

@section('content')
@php
// $hash = Hash::make('1111');
// echo $hash;
@endphp
<main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
    <div class="container">
        <div class="card login-card">
            <div class="row no-gutters">
                <div class="col-md-5 m-auto">
                    <img src="" alt="company_logo" class="login-card-img img-fluid p-3" id="login-logo" />
                </div>
                <div class=" col-md-7">
                    <div class="card-body">
                        <div class="brand-wrapper">
                            <div class="row">
                                <div class="col-2">
                                    <img src="img/logo_2.png" alt="company_logo" class="logo" />
                                </div>
                                <div class="col m-auto">
                                    <span class="h3 fw-bolder login-heading-text">Musung
                                        Garment</span>
                                </div>
                            </div>
                        </div>
                        <p class="login-card-description">Sign into your account</p>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input id="username" type="text"
                                    class="form-control w-75 @error('username') is-invalid @enderror" name="username"
                                    value="{{ old('username') }}" required autocomplete="username" autofocus>

                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mb-4">
                                <label for="password">Password</label>
                                <input id="password" type="password"
                                    class="form-control w-75 @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn login-btn mb-4">
                                {{ __('Login') }}
                            </button>
                        </form>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{
                                old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn forgot-btn" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            Forgot Password?
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Forgot Password?</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <span class="text-danger">Please contact your administrator to reset your
                                            password.</span>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
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
</main>
@endsection
