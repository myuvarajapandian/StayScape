<?php

namespace App\Http\Controllers;

use App\Models\bookedRooms;
use App\Models\Rooms;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class bookingManager extends Controller
{
    public function bookroom(Request $request, $room_id)
    {
        $room = Rooms::find($room_id);
        $user = Auth::user();

        $request->validate([
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'rent_amt' => 'required',
        ]);

        if (!$room) {
            return redirect()->route('room.index')->with('error', 'Room not found');
        }

        $checkInDate = Carbon::parse($request->check_in);
        $checkOutDate = Carbon::parse($request->check_out);

        $overlappingBookings = bookedRooms::where('roomid', $room->id)
            ->where(function ($query) use ($checkInDate, $checkOutDate) {
                $query->whereBetween('check_in', [$checkInDate, $checkOutDate])
                    ->orWhereBetween('check_out', [$checkInDate, $checkOutDate]);
            })
            ->first();

        if ($overlappingBookings) {
            return redirect()->back()->with('error', 'Room is already booked for the selected dates');
        }

        $numOfBookedDays = $checkOutDate->diffInDays($checkInDate) + 1;

        if ($numOfBookedDays > $room->max_stay) {
            return redirect()->back()->with('error', 'selected dates exceeds the Maximum Stay');
        }

        $data['roomid'] = $room->id;
        $data['room_name'] = $room->room_name;
        $data['customer_name'] = $user->name;
        $data['owner_name'] = $room->owner_name;
        $data['email'] = $user->email;
        $data['location'] = $room->location;
        $data['check_in'] = $request->check_in;
        $data['check_out'] = $request->check_out;
        $data['rent_amt'] = $request->rent_amt;
        $data['status'] = 'booked';
        $data['image'] = $room->images[0];
        $booking = bookedRooms::create($data);

        if (!$booking) {
            return redirect(route('view.room', $room->id))->with('error', 'Booking failed!');
        }
        return redirect(route('view.room', $room->id))->with('success', 'Room booked successfully');
    }

    public function myrooms()
    {

        $user = Auth::user();
        $rooms = bookedRooms::where('email', $user->email)->get();

        $roomImages = [];
        // Loop through the booked rooms and fetch their images
        foreach ($rooms as $bookedRoom) {
            $room = Rooms::find($bookedRoom->roomid);
            $roomImages[$bookedRoom->roomid] = $room->images;
        }

        return view('customer.myrooms', compact('rooms', 'roomImages'));
    }



    public function checkout($booking_id)
    {
        $booking = bookedRooms::find($booking_id);

        if (!$booking) {
            return redirect()->back()->with('error', 'Booking not found');
        }

        $booking->status = 'Checked out';
        $booking->check_out = Carbon::now()->toDateString();
        $booking->save();

        return redirect()->route('customer.rooms')->with('success', 'Room checked out successfully');
    }
}
