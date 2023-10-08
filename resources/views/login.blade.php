@extends('layout')
@section('content')
@section('title', 'login')
<div class="row justify-content-center align-items-center min-vh-100">
    <div class="col-md-6">
        <div class="card shadow-lg p-5">
            <h1 class="text-center mb-4">Login</h1>
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
            <form action="{{ route('login.post') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label" for="remember">Remember Me</label>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </div>
                <p class="mt-3 text-center">
                    Don't have an account? <a href="{{ route('register') }}">Create Account</a>
                </p>
                <p class="mt-2 text-center">
                    <a href="{{ route('forgot') }}">Forgot Password?</a>
                </p>
            </form>
        </div>
    </div>
</div>
@endsection