@extends('layout')
@section('content')
@section('title', 'Create')
@include('includes.header')

<!-- Owner Create Room page -->

<div class="continer">
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

    <!-- Room creation form -->

    <div class=" shadow-sm p-4 mt-3">
        <div class="card-body">
            <h4 class="card-title text-left mb-5 mt-3"> <i class="fa-solid fa-door-open"></i> Create Room</h4>
            <form action="{{ route('create') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-8">
                        <div class="mb-2">
                            <label for="room_name" class="mb-2">Room Name</label>
                            <input type="text" class="form-control" placeholder="Room Name" name="rname" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-2">
                            <label for="location" class="mb-2">Location</label>
                            <input type="text" class="form-control" placeholder="Location" name="location" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-2">
                            <label for="num_of_beds" class="mb-2">Available Beds</label>
                            <input type="number" class="form-control" placeholder="Available Beds" name="beds" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-2">
                            <label for="floor_size" class="mb-2">Floor Size</label>
                            <input type="text" class="form-control" placeholder="Size as 4 X 4" name="fsize" required>
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
                    <textarea class="form-control" name="address" placeholder="Add Address" rows="2" required></textarea>
                </div>

                <div class="mb-2">
                    <label for="description" class="mb-2">Description</label>
                    <textarea class="form-control" name="description" placeholder="Add Description" rows="2" required></textarea>
                </div>

                <div class="row">
                    <div class="col-lg-4">
                        <div class="mb-2">
                            <label for="min_stay" class="mb-2">Minimum Stay</label>
                            <input type="number" class="form-control" placeholder="Min stay (in days)" name="min_stay" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-2">
                            <label for="max_stay" class="mb-2">Maximum Stay</label>
                            <input type="number" class="form-control" placeholder="Max stay (in days)" name="max_stay" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-2">
                            <label for="rent_amount" class="mb-2">Rent Amount</label>
                            <input type="text" class="form-control" placeholder="Rent per Day" name="rent_amt" required>
                        </div>
                    </div>
                </div>

                <div class="mb-2">
                    <label for="photos" class="mb-2">Upload Photos</label>
                    <input type="file" class="form-control" name="photos[]" multiple accept="image/*">
                </div>

                <div class="d-flex justify-content-end mt-3">
                    <button type="submit" class="btn btn-primary btn-block"><i class="fa-solid fa-square-plus"></i> Create Room</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection