@extends('layout')
@section('content')
@section('title', 'Welcome!')
@include('includes.usernav')

    <!-- Customer Welcom Page -->

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

    <div class="mb-4">
        <h4 class="mb-3">Hello {{ Auth::user()->name }}!</h4>
        <h3>Welcome to StayScape</h3>
    </div>

    <!-- Location search -->

    <div class="continer w-50">
        <form action="#" method="post" class="d-flex" role="search" id="location-search-form">
            @csrf
            <input class="form-control me-2" type="search" placeholder="Location" aria-label="Search" id="location-input">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
    </div>

    <!-- Available Rooms -->

    <div class="container">
        <div class="col-md-12">
            <h3 class="mt-5 mb-3"><i class="bi bi-house-check-fill"></i> Available Rooms</h3>
            <div class="row">
                @php
                $roomsDisplayed = false;
                @endphp
                @foreach ($rooms as $room)
                @if($room->booking == 'Not Booked')
                @php
                $roomsDisplayed = true;
                @endphp
                <div class="room-card col-md-3 mb-4" data-location="{{ $room->location }}">
                    <a href="{{ route('view.room', $room->id) }}" style="text-decoration: none; color: black;">
                        <div class="card shadow">
                            <img src="{{ Storage::url('public/photos/' . $room->images[0]) }}" alt="Room Image" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">{{ $room->room_name }}</h5>
                                <h6 class="card-text" style="color: #84888A;"><i class="bi bi-geo-alt-fill"></i> {{ $room->location }}</h6>
                                <p class="card-text">
                                    @for ($i = 0; $i < 3 && $i < count($room->amenities); $i++)
                                        <span>{{ $room->amenities[$i] }}</span>
                                        @endfor
                                </p>
                                <p class="card-text">
                                    Availability:
                                    @if ($room->booking == 'Not Booked')
                                    <span class="badge bg-success">Available</span>
                                    @else
                                    <span class="badge bg-danger">Not Available</span>
                                    @endif
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <strong class="card-text">
                                        <span style="color: #EE2A24; font-size: 1.25rem;"><i class="bi bi-currency-rupee"></i>{{ $room->rent }}</span> / Night
                                    </strong>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                @endif
                @endforeach
            </div>

            <!-- This content will display while no rooms available -->

            @if (!$roomsDisplayed)
            <div class="container" style="height: 75vh; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                <div class="col-md-12 text-center">
                    <p style="font-size: 24px; color: #84888A;"><strong>Sorry, no rooms are available. <i class="fa-solid fa-house"> Add Room</i></strong></p>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection