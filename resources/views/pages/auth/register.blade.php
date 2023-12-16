@extends('layouts.auth')

@section('title')
    <title>Register</title>
@endsection

@section('content')
    <div class="card shadow-lg border-0 rounded-lg">
        <div class="card-header">
            <h3 class="text-center font-weight-light my-4">Create Account</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-floating mb-3">
                    <input class="form-control" id="inputName" name="name" type="text" placeholder="Enter your name" value="{{ old('name') }}" />
                    <label for="inputName">Name</label>
                </div>
                <div class="form-floating mb-3">
                    <input class="form-control" id="inputEmail" name="email" type="email"
                        placeholder="name@example.com" value="{{ old('email') }}" />
                    <label for="inputEmail">Email address</label>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-floating mb-3 mb-md-0">
                            <input class="form-control" id="inputPassword" name="password" type="password"
                                placeholder="Create a password" autocomplete="new-password" />
                            <label for="inputPassword">Password</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3 mb-md-0">
                            <input class="form-control" id="inputPasswordConfirm" name="password_confirmation"
                                type="password" placeholder="Confirm password" />
                            <label for="inputPasswordConfirm">Confirm Password</label>
                        </div>
                    </div>
                </div>
                <div class="mt-4 mb-0">
                    <div class="d-grid">
                        <input class="btn btn-primary btn-block" type="submit" value="Create Account">
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer text-center py-3">
            <div class="small"><a href="{{ route('login') }}">Have an account? Go to login</a></div>
        </div>
    </div>
@endsection
