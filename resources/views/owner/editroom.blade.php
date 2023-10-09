@extends('layout')
@section('content')
@section('title', 'Welcome' )
@include('includes.header')

    <!-- Owner Edit room page (owner can control all)  -->

<div class="container mb-2">
    <div class="row">
        <div class="col-md-12 p-1" style="background-color: #F8F9FA;">
            <a href="{{ route('owner.index') }}" style="text-decoration: none; color:black"><i class="fa-solid fa-left-long"></i> Back</a>
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

    <!-- Room details page -->

    <div class="row">
        <div class="col-lg-7">
            <div class="container mt-2 mb-2">
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-between">
                            <h1 class="mb-2">{{ $rooms->room_name }}</h1>
                        </div>
                        <p>{{ $rooms->address }}</p>
                        <p>{{ $rooms->location }}</p>
                        <hr class="my-4">
                        <div>
                            <label for="description">
                                <h4 class=" -mb-2"><i class="fa-solid fa-circle-info"></i> <strong>Description</strong></h4>
                            </label>
                            <p>{{ $rooms->description }}</p>
                        </div>
                        <hr class="my-4">
                        <h4 class="mb-4"><i class="fa-solid fa-house-medical"></i> <strong>Facilities</strong></h4>
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
                        <div class=" d-flex justify-content-between">
                            <h3 class="mt-4">
                                <span style="color: #EE2A24;"><strong>Rs. {{ $rooms->rent }} / Day</strong></span>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- image view carousel -->

        <div class="col-lg-5">
            <div class="container mt-4 mb-2">
                <div class="card shadow">
                    <div class="card-body">
                        <div>
                            <h4 class="mb-4"><i class="fa-solid fa-image"></i> Room Images</h4>
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
                        <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#imageModal"><i class="bi bi-folder-plus"></i> Upload images</button>
                    </div>
                </div>
            </div>

            <hr class="my-4">

            <!-- Booking details content -->

            <div class="card shadow">
                <div class="card-header">
                    Booking Details
                </div>
                <div class="card-body">
                    @php
                    $roomsDisplayed = false;
                    @endphp
                    @foreach ($bookings as $booking)
                    @php
                    $roomsDisplayed = true;
                    @endphp
                    @endforeach
                    @if (!$roomsDisplayed)
                    <div class="container" style=" display: flex; flex-direction: column; justify-content: center; align-items: center;">
                        <div class="text-center">
                            <p style="font-size: 24px; color: #84888A;"><strong>Sorry, no rooms are booked.</p>
                        </div>
                    </div>
                    @else
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Customer</th>
                                <th>Check-In Date</th>
                                <th>Check-Out Date</th>
                                <th>Total Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bookings as $booking)
                            <tr>
                                <td>{{ $booking->customer_name }}</td>
                                <td>{{ $booking->check_in }}</td>
                                <td>{{ $booking->check_out }}</td>
                                <td>Rs. {{ $booking->rent_amt }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>

            <hr class="my-4">

            <!-- Edit buttons -->

            <div class="mt-2 mb-2">
                <div class="card shadow">
                    <div class="card-body">
                        <h4><i class="fa-solid fa-pen-to-square"></i> Edit</h4>
                        <hr class="my-4">
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editform"><i class="bi bi-pencil-fill"></i> Update</button>
                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="bi bi-trash-fill"></i> Delete</button>

                        @if($rooms->booking == 'Booked')
                        <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#availableModal"><i class="bi bi-eye-fill"></i> Available</button>
                        @else
                        <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#availableModal"><i class="bi bi-eye-slash-fill"></i> Hide</button>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Image upload modal -->

    <div class="Modals">

        <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="imageModalLabel">Upload Images</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('upload.images', $rooms->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="images" class="form-label">Select Images</label>
                                <input type="file" class="form-control" name="photos[]" id="images" multiple required>
                                <small class="form-text text-muted">Select one or more image files (jpeg, png, jpg, gif).</small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Room delete Modal -->

        <form action="{{ route('delete.room', $rooms->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">Delete Room</h5>
                            <a style="color: black;" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa-solid fa-xmark"></i>
                            </a>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete this room? This action cannot be undone.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!-- Room hide Modal -->

        <form action="{{ route('hide.room', $rooms->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal fade" id="availableModal" tabindex="-1" role="dialog" aria-labelledby="availabelModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="availabelModalLabel">Make Available!</h5>
                            <a style="color: black;" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa-solid fa-xmark"></i>
                            </a>
                        </div>
                        <div class="modal-body">
                            @if($rooms->booking == 'Booking')
                            <span>Are you sure you want to Make this room Available?</span>
                            @else
                            <span>Are you sure you want to Make this room Hide?</span>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!-- Room edit modal -->

        <div class="modal fade" id="editform" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel"><i class="fa-solid fa-door-open"></i> Edit Room</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('update.room', $rooms->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="mb-2">
                                        <label for="room_name" class="mb-2">Room Name</label>
                                        <input type="text" class="form-control" value="{{ $rooms->room_name }}" placeholder="Room Name" name="rname" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-2">
                                        <label for="location" class="mb-2">Location</label>
                                        <input type="text" class="form-control" placeholder="Location" value="{{ $rooms->location }}" name="location" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-2">
                                        <label for="num_of_beds" class="mb-2">Available Beds</label>
                                        <input type="number" class="form-control" placeholder="Available Beds" value="{{ $rooms->no_of_beds }}" name="beds" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-2">
                                        <label for="floor_size" class="mb-2">Floor Size</label>
                                        <input type="text" class="form-control" placeholder="Size as 4 X 4" value="{{ $rooms->floor_size }}" name="fsize" required>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-2">
                                <label for="amenities" class="mb-2">Amenities</label>
                                <div class="row mb-1">
                                    <div class="col-lg-3 d-flex">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" value="WiFi" name="amenities[]" id="Wifi">
                                            <label class="form-check-label" for="Wifi">WiFi</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 d-flex">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" value="Parking" name="amenities[]" id="parking">
                                            <label class="form-check-label" for="parking">Parking</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 d-flex">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" value="Cafe" name="amenities[]" id="Cafe">
                                            <label class="form-check-label" for="Cafe">Cafe</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 d-flex">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" value="Elevator/Lift" name="amenities[]" id="Elevator/Lift">
                                            <label class="form-check-label" for="Elevator/Lift">Elevator/Lift</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-lg-3 d-flex">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" value="Restaurant" name="amenities[]" id="Restaurant">
                                            <label class="form-check-label" for="Restaurant">Restaurant</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 d-flex">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" value="Room Service" name="amenities[]" id="Room Service">
                                            <label class="form-check-label" for="Room Service">Room Service</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 d-flex">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" value="Spa" name="amenities[]" id="Spa">
                                            <label class="form-check-label" for="Spa">Spa</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 d-flex">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" value="Bar" name="amenities[]" id="Bar">
                                            <label class="form-check-label" for="Bar">Bar</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-2">
                                <label for="address" class="mb-2">Address</label>
                                <textarea class="form-control" name="address" placeholder="Add Address" rows="2" required>{{ $rooms->address }}</textarea>
                            </div>

                            <div class="mb-2">
                                <label for="description" class="mb-2">Description</label>
                                <textarea class="form-control" name="description" placeholder="Add Description" rows="2" required>{{ $rooms->description }}</textarea>
                            </div>

                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mb-2">
                                        <label for="min_stay" class="mb-2">Minimum Stay</label>
                                        <input type="number" class="form-control" placeholder="Min stay (in days)" value="{{ $rooms->min_stay }}" name="min_stay" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-2">
                                        <label for="max_stay" class="mb-2">Maximum Stay</label>
                                        <input type="number" class="form-control" placeholder="Max stay (in days)" value="{{ $rooms->max_stay }}" name="max_stay" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-2">
                                        <label for="rent_amt" class="mb-2">Rent Amount</label>
                                        <input type="text" class="form-control" placeholder="Rent per Day" value="{{ $rooms->rent }}" name="rent_amt" required>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="subimt" class="btn btn-primary">Save changes</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('includes.footer')
@endsection