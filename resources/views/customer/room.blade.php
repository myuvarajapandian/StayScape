@extends('layout')
@section('content')
@section('title', 'Room')
@include('includes.usernav')

<!-- Customer Room view and booking page -->

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

    <!-- Room view Content -->

    <div class="row">
        <div class="col-lg-7">
            <div class="container mt-2 mb-2">
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-between">
                            <h1 class="mb-2">{{ $rooms->room_name }}</h1>
                        </div>
                        <p>{{ $rooms->address }}</p>
                        <p><i class="bi bi-geo-alt-fill"></i> {{ $rooms->location }}</p>
                        <hr class="my-4">
                        <div>
                            <label for="description">
                                <h4 class=" -mb-2"><i class="bi bi-info-circle-fill"></i> <strong>Description</strong></h4>
                            </label>
                            <p>{{ $rooms->description }}</p>
                        </div>
                        <hr class="my-4">
                        <h4 class="mb-4"><i class="bi bi-house-door-fill"></i> <strong>Facilities</strong></h4>
                        <p class="mb-2"><strong>Floor Size:</strong> {{ $rooms->floor_size }}</p>
                        <p class="mb-2"><strong>Number of Beds:</strong> {{ $rooms->no_of_beds }}</p>
                        <p><strong class="">Amenities:</strong></p>
                        <ul>
                            @foreach ($rooms->amenities as $amenity)
                            <li class="mb-1 mt-1">{{ $amenity }}</li>
                            @endforeach
                        </ul>
                        <p class="mb-2"><strong>Minimum Stay:</strong> {{ $rooms->min_stay }} days</p>
                        <p class="mb-2"><strong>Maximum Stay:</strong> {{ $rooms->max_stay }} days</p>
                        <div class="d-flex justify-content-between">
                            <h3 class="mt-4">
                                <strong style="color: #EE2A24;">Rs. {{ $rooms->rent }}<span style="color: black;"> / Night </span></strong>
                            </h3>
                            <button class="btn btn-primary btn-lg align-content-end mb-3" data-bs-toggle="modal" data-bs-target="#roomModal{{ $rooms->id }}">Book Now</button>
                        </div>
                        <hr class="my-4">
                        <h4 class="mb-4"><i class="bi bi-person-fill"></i> <strong>Contact</strong></h4>
                        <div class="row">
                            <p><i class="bi bi-telephone-fill"></i> +91{{ $owner->phone }}</p>
                            <a href="mailto:{{$owner->email }}" style="text-decoration: none; color: black;"><i class="bi bi-envelope-fill"></i> {{$owner->email }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Carousel image view -->

        <div class="col-lg-5">
            <div class="card shadow">
                <div class="card-body">
                    <div>
                        <h4 class="mb-4"><i class="bi bi-image-fill"></i> Room Images</h4>
                    </div>
                    <div id="carouselExampleInterval" class="carousel m-sm-auto m-md-auto slide my-4" data-bs-ride="carousel" style="max-width: 1300px;">
                        <div class="carousel-inner">
                            @foreach ($rooms->images as $key => $image)
                            <div class="carousel-item @if($key === 0) active @endif" data-bs-interval="5000">
                                <img src="{{ Storage::url('public/photos/' . $image) }}" class="d-block w-100" alt="Room Image">
                            </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
            <hr class="my-4">
            <div class="">
                <div>
                    <h4 class="mb-4"><i class="bi bi-house-fill"></i> Booking Info</h4>
                </div>
                <div class="mt-2">
                    <button type="button" class="btn btn-primary mt-2 mb-2" data-bs-toggle="modal" data-bs-target="#bookingDetailsModal">
                        View Booking Details
                    </button>
                    <p class="mt-1">Click the button above to view availability details (if the room is not available for your dates).</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bookings Modal -->

    <div class="modal fade" id="roomModal{{ $rooms->id }}" tabindex="-1" aria-labelledby="roomModalLabel{{ $rooms->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="roomModalLabel{{ $rooms->id }}">Booking</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="card-title">{{ $rooms->room_name }}</h5>
                                <h6 class="card-text">{{ $rooms->location }}</h6>
                                <p class="card-text">
                                    Availability:
                                    <span class="badge bg-success">Available</span>
                                </p>
                                <p class="card-text">
                                    Minimum Stay: {{ $rooms->min_stay }} days
                                </p>
                                <p class="card-text">
                                    Maximum Stay: {{ $rooms->max_stay }} days
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="text-end">
                                    <strong style="color: #EE2A24; font-size: 1.5rem;">{{ $rooms->rent }}</strong> / Night
                                </p>
                            </div>
                        </div>
                        <hr>
                        <form action="{{ route('book.room', $rooms->id) }}" method="post" id="booking-form">
                            @csrf
                            <div class="row">
                                <div class="mb-4 col-lg-6">
                                    <label for="check-in">Check-In Date</label>
                                    <input type="date" class="form-control" name="check_in" id="check-in" required>
                                </div>
                                <div class="mb-4 col-lg-6">
                                    <label for="check-out">Check-Out Date</label>
                                    <input type="date" class="form-control" name="check_out" id="check-out" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-4 col-lg-4" data-rent="{{ $rooms->rent }}">
                                    <label for="rent-amount">Rent Amount</label>
                                    <input type="text" class="form-control" name="rent_amt" id="rent-amount" readonly>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Book Now</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Booking details modal -->

<div class="modal fade" id="bookingDetailsModal" tabindex="-1" aria-labelledby="bookingDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bookingDetailsModalLabel">Booking Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Availability</th>
                            <th>From</th>
                            <th>To</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $booking)
                        <tr>
                            <td>Not Available</td>
                            <td>{{ $booking->check_in }}</td>
                            <td>{{ $booking->check_out }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</div>
@include('includes.footer')
@endsection