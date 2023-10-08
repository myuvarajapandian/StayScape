@extends('layout')
@section('content')
@section('title', 'Forgot Password')
<div class="row justify-content-center align-items-center min-vh-100">
    <div class="col-md-6">
        <div class="card shadow-lg p-5">
            <h1 class="text-center mb-4">Reset Password</h1>
            <div class="continer w-50 ms-auto me-auto mt-4 ">
                <div class="mt-3">
                    @if($errors->any())
                    <div class="clo-12">
                        @foreach($errors->all() as $error)
                        <div class="alert alert-danger">{{$error}}</div>
                        @endforeach
                    </div>
                    @endif

                    @if(session()->has('error'))
                    <div class="alert alert-danger">{{session('error')}}</div>
                    @endif

                    @if(session()->has('success'))
                    <div class="alert alert-success">{{session('success')}}</div>
                    @endif
                </div>
            </div>
            <form action="{{ route('reset') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="password" name="cpassword" placeholder="Confirm Password" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-block">Reset</button>
                </div>
            </form>
                <p class="mt-3 text-center">
                    Don't have an account? <a href="{{ route('register') }}">Create Account</a>
                </p>
                <p class="mt-2 text-center">
                    <a href="{{ route('login') }}">Want to login?</a>
                </p>
        </div>
    </div>
</div>
@endsection