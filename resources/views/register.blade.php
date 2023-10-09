@extends('layout')
@section('content')
@section('title', 'login')

    <!-- Signup page -->

<div class="container">
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

    <!-- Signup content -->

    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-6">
                <div class="card shadow-lg p-5">
                    <h3 class="card-title text-center mb-4 mt-3">Sign Up</h3>
                    <form action="{{ route('register.post') }}" method="post">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-4">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-4">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" required>
                        </div>
                        <div class="mb-4">
                            <label for="role" class="form-label">Register as</label>
                            <select name="role" class="form-select" id="role" aria-label="Default select example">
                                <option selected value="customer">Customer</option>
                                <option value="house owner">House owner</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="justify-content-end">
                            <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
                        </div>
                        <p class="mt-3 text-center">
                            Already have an account? <a href="{{ route('login') }}">Log in</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection