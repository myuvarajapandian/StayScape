<?php

namespace App\Http\Controllers;

use App\Models\bookedRooms;
use App\Models\Rooms;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserManager extends Controller
{
    public function users()
    {
        if (Auth::user()->user_role === 'customer') {
            $rooms = Rooms::all();

            if ($rooms->isEmpty()) {
                $noRoomsAvailable = true;
            } else {
                $noRoomsAvailable = false;
            }

            return view('customer.index', compact('rooms', 'noRoomsAvailable'));
        } else {
            $owner = Auth::user();
            $rooms = Rooms::where('email', $owner->email)->get();

            return view('owner.index', compact('rooms', 'owner'));
        }
    }


    public function profile()
    {
        if (Auth::user()->user_role === 'customer') {
            $user = Auth::user();
            return view('customer.profile', compact('user'));
        } else {
            $user = Auth::user();
            return view('owner.profile', compact('user'));
        }
    }

    public function editprofile(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name' => 'required',
            'phone' => 'required|max:10',
            'about' => 'required',
        ]);

        $user->update([
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'about' => $request->input('about'),
        ]);

        $redirectRoute = ($user->user_role === 'customer') ? 'customer.profile' : 'owner.profile';

        return redirect()->route($redirectRoute)->with('success', 'Details updated successfully');
    }

    public function removeAccount()
    {
        $user = Auth::user();

        if ($user->user_role === 'house owner') {
            $rooms = Rooms::where('email', $user->email)->get();

            foreach ($rooms as $room) {
                $activeBookings = bookedRooms::where('roomid', $room->id)
                    ->where('status', '!=', 'Checked out')
                    ->count();

                if ($activeBookings > 0) {
                    return redirect()->route('owner.profile')->with('error', 'Cannot delete account. There are active bookings associated with your rooms.');
                }

                bookedRooms::where('roomid', $room->id)->delete();
                $room->delete();
            }
        }

        $user->delete();
        Auth::logout();

        return redirect()->route('login')->with('success', 'Your account has been removed.');
    }
}
