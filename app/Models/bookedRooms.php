<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bookedRooms extends Model
{
    use HasFactory;

    // Define the fillable attributes of the model to create() or update() methods.
    protected $fillable = [
        'id',              // Room booking's Id
        'roomid',          // Room ID associated with the booking
        'room_name',       // Name of the booked room
        'customer_name',   // Name of the customer making the booking
        'owner_name',      // Name of the room owner
        'email',           // Email of the room owner
        'location',        // Location of the room
        'check_in',        // Check-in date
        'check_out',       // Check-out date
        'rent_amt',        // Rent amount for the booking
        'status',          // Booking status ("Booked" or "Checked Out")
        'image',           // Image associated with the booking
    ];
}

