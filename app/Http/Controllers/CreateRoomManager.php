<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rooms;
use Illuminate\Support\Facades\Auth;

    // To control all Room creation functions

class CreateRoomManager extends Controller
{
    function roomCreate()
    {
        return view('owner.create');
    }

    function Create(Request $request)
    {
        $request->validate([
            'rname' => 'required',
            'location' => 'required',
            'beds' => 'required|max:2',
            'fsize' => 'required',
            'amenities.*' => 'required|string',
            'address' => 'required',
            'description' => 'required',
            'min_stay' => 'required|max:2',
            'max_stay' => 'required|max:2',
            'rent_amt' => 'required',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif'
        ]);

        $name = Auth::user()->name;
        $email = Auth::user()->email;

        $amenitiesArray = [];
        $imagesArray = [];

        foreach ($request->input('amenities') as $amenity) {
            $amenitiesArray[] = $amenity;
        }
        
        $amenitiesJson = json_encode($amenitiesArray);
        
        foreach ($request->file('photos') as $photo) {
            $Room_imgs = uniqid() . $email . $photo->getClientOriginalExtension();
            $photo->storeAs('public/photos', $Room_imgs);
            
            $imagesArray[] = $Room_imgs;
        }
        $imagesJson = json_encode($imagesArray);


        $data['owner_name'] = $name;
        $data['email'] = $email;
        $data['location'] = $request->location;
        $data['room_name'] = $request->rname;
        $data['no_of_beds'] = $request->beds;
        $data['floor_size'] = $request->fsize;
        $data['amenities'] = $amenitiesJson;
        $data['address'] = $request->address;
        $data['description'] = $request->description;
        $data['min_stay'] = $request->min_stay;
        $data['max_stay'] = $request->max_stay;
        $data['rent'] = $request->rent_amt;
        $data['booking'] = 'Not Booked';
        $data['images'] = $imagesJson;
        $room = Rooms::create($data);
        if (!$room) {
            return redirect(route('owner.index'))->with("error", "creation failed");
        }
        return redirect(route('owner.index'))->with("success", "Registration success");
    }
}
