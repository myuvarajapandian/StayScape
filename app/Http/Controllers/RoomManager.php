<?php

namespace App\Http\Controllers;

use App\Models\bookedRooms;
use App\Models\Rooms;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RoomManager extends Controller
{
    function roomview($room_id)
    {
        $rooms = Rooms::find($room_id);
        $owner = User::where('email', $rooms->email)->first();
        $bookings = bookedRooms::where('roomid', $room_id)->get();
        
        return view('customer.room', compact('rooms', 'owner', 'bookings'));
    }
    
    function editroom($room_id)
    {
        $rooms = Rooms::find($room_id);
        $owner = User::where('email', $rooms->email)->first();
        $bookings = bookedRooms::where('roomid', $room_id)->get();

        return view('owner.editroom', compact('rooms', 'owner', 'bookings'));
    }

    public function roomUpdate(Request $request, $room_id)
    {
        $request->validate([
            'rname' => 'required',
            'location' => 'required',
            'beds' => 'required|integer|min:1',
            'fsize' => 'required',
            'amenities' => 'required|array',
            'address' => 'required',
            'description' => 'required',
            'min_stay' => 'required|integer|min:1',
            'max_stay' => 'required|integer|min:1|max:30',
            'rent_amt' => 'required',
        ]);
        
        $amenitiesJson = json_encode($request->input('amenities'));

        $room = Rooms::find($room_id);
        
        if (!$room) {
            return redirect()->route('edit.room', $room_id)->with('error', 'Room not found');
        }

        $room->update([
            'room_name' => $request->input('rname'),
            'location' => $request->input('location'),
            'no_of_beds' => $request->input('beds'),
            'floor_size' => $request->input('fsize'),
            'amenities' => $amenitiesJson,
            'address' => $request->input('address'),
            'description' => $request->input('description'),
            'min_stay' => $request->input('min_stay'),
            'max_stay' => $request->input('max_stay'),
            'rent' => $request->input('rent_amt'),
        ]);

        return redirect()->route('edit.room', $room_id)->with('success', 'Room updated successfully');
    }
    
    public function imgUpdate(Request $request, $room_id){
        $request->validate([
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif',
        ]);
        
        $room = Rooms::find($room_id);
        $email = Auth::user()->email;
        $imagesArray = [];

        if(!$room->images == Null)
        foreach ($room->images as $existingImage) {
            $imagePath = storage_path('app/public/photos/' . $existingImage);
    
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $Room_imgs = uniqid() . $email . '.' . $photo->getClientOriginalExtension();
                $photo->storeAs('public/photos', $Room_imgs);

                $imagesArray[] = $Room_imgs;
            }
        }
        
        $imagesJson = json_encode($imagesArray);
        
        $room->Update([
            'images' => $imagesJson,
        ]);
        return redirect()->route('edit.room', $room_id)->with('success', 'Images updated successfully');
    }
    
    public function deleteRoom($room_id)
    {
        $room = Rooms::find($room_id);
        $room->delete();

        return redirect(route('owner.index'))->with('success', 'Room deleted successfully.');
    }

    public function roomHide($room_id)
    {
        $room = Rooms::find($room_id);

        if ($room->booking === 'Not Booked') {
            $room->booking = 'Booked';
        } else {
            $room->booking = 'Not Booked';
        }
        $room->save();

        if ($room->booking === 'Not Booked') {
            return redirect()->back()->with('success', 'Room has been Visible.');
        }
        return redirect()->back()->with('success', 'Room has been marked as hide.');
    }
}
