@extends('layout')
@section('content')
@section('title', 'Profile')
@include('includes.usernav')
<div class="container mb-2">
    <div class="row">
        <div class="col-md-12 p-1" style="background-color: #F8F9FA;">
            <a href="{{ route('customer.index') }}" style="text-decoration: none; color:black"><i class="fa-solid fa-left-long"></i> Back</a>
        </div>
    </div>

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

    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="mt-4">
                            <div class="profile-info">
                                <h1>
                                    <i class="fas fa-user"></i> {{ $user->name }}
                                </h1>
                                <p class="mt-3">
                                    <strong><i class="fas fa-envelope"></i> Email:</strong> {{ $user->email }}
                                </p>
                                <p class="mt-1">
                                    <strong><i class="fas fa-user-tag"></i> Role:</strong> {{ $user->user_role }}
                                </p>
                                <p class="mt-1">
                                    <strong><i class="fas fa-phone"></i> Phone:</strong> {{ $user->phone }}
                                </p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="profile-about">
                                <h4><i class="fas fa-info-circle"></i> About Me:</h4>
                                <p>{{ $user->about }}</p>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="mt-2">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProfileModal">Edit Profile</button>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#removeAccountModal">Remove Account</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('edit.customer')}}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="editName" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" value="{{ $user->name }}" placeholder="User's Name">
                        </div>
                        <div class="mb-3">
                            <label for="editPhone" class="form-label">Phone</label>
                            <input type="tel" class="form-control" value="{{ $user->phone }}" name="phone" placeholder="+1234567890">
                        </div>
                        <div class="mb-">
                            <label for="address" class="mb-2">About</label>
                            <textarea class="form-control" name="about" placeholder="Add Address" rows="2" required>{{ $user->about }}</textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="removeAccountModal" tabindex="-1" role="dialog" aria-labelledby="removeAccountModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="removeAccountModalLabel">Remove Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to remove your account? This action cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form method="POST" action="{{ route('customer.remove') }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Remove Account</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection