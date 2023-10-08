@extends('layout')
@section('content')
@section('title', 'Welcome')
@include('includes.header')

<div class="continer">
    <div class="mt-2">
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
    <main class="container mt-4">
        <div class="mb-4">
            <h4 class="mb-3">Hello {{ Auth::user()->name }}!</h4>
            <h3>Welcome to StayScape</h3>
        </div>
        <div class="container mt-5">
            <h2>Your Rooms</h2>
            <div class="row mt-3">
                @foreach($rooms as $room)
                <div class="col-lg-4 mb-4">
                    <a href="{{ route('edit.room', $room->id) }}" style="text-decoration: none; color: black;">
                        <div class="card shadow">
                            <img src="{{ Storage::url('public/photos/' . $room->images[0]) }}" class="card-img-top" alt="Room 1">
                            <div class="card-body">
                                <h5 class="card-title">{{ $room->room_name }}</h5>
                                <p class="card-text">{{ $room->location }}</p>
                                <p class="card-text">
                                    Status:
                                    @if ($room->booking == 'Booked')
                                    <span class="badge bg-secondary text-white">Hided</span>
                                    @else
                                    <span class="badge bg-success text-white">Available</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach

                <div class="col-lg-4 mb-4">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5 class="card-title">Create Room</h5>
                            <p class="card-text">Click below to create a new room.</p>
                            <a href="{{ route('create.room') }}" class="btn btn-success">Create Room</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


</div>
@endsection