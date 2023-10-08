@extends('layout')
@section('content')
@section('title', 'My Rooms')
@include('includes.usernav')

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

    <div class="container">
        <div class="col-md-12">
            <h3 class="mt-5 mb-3">Your Rooms</h3>
            <div class="row">
                @php
                $roomsDisplayed = false;
                @endphp
                @foreach ($rooms as $room)
                @php
                $roomsDisplayed = true;
                @endphp
                <div class="room-card col-md-4 mb-4">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5 class="card-title">{{ $room->room_name }}</h5>
                            <h6 class="card-text">{{ $room->location }}</h6>
                            <p class="card-text">
                                Availability:
                                <span class="badge text-bg-secondary">{{ $room->check_in }}</span> to <span class="badge text-bg-secondary">{{ $room->check_out }}</span>
                            </p>
                            <p class="card-text">
                                @if($room->status === 'booked')
                                <span class="badge text-bg-success">Booked</span>
                                @else
                                <span class="badge text-bg-danger">Cheked out</span>
                                @endif
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <strong class="card-text">
                                    <span style="color: #EE2A24; font-size: 1.25rem;">Rs. {{ $room->rent_amt }}</span> <span class="badge text-bg-success">paid</span>
                                </strong>
                                <a href="{{ route('checkout.room', $room->id) }}" class="btn btn-primary">Check out</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @if (!$roomsDisplayed)
            <div class="container" style="height: 75vh; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                <div class="col-md-12 text-center">
                    <p style="font-size: 24px; color: #84888A;"><strong>Sorry, no rooms booked.</strong></p>
                </div>
            </div>
            @endif
        </div>
    </div>

</div>

@endsection