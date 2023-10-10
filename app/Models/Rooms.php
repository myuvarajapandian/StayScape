<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{
    use HasFactory;

    // Define the fillable attributes of the model to create() or update() methods.
    protected $fillable = [
        'id',            // Room's Id
        'owner_name',    // Name of the room owner
        'email',         // Email of the room owner
        'location',      // Location of the room
        'room_name',     // Name of the room
        'no_of_beds',    // Number of beds in the room
        'floor_size',    // Size of the room's floor
        'amenities',     // Room amenities (stored as JSON)
        'address',       // Address of the room
        'description',   // Description of the room
        'min_stay',      // Minimum stay duration
        'max_stay',      // Maximum stay duration
        'rent',          // Room rent amount
        'booking',       // Booking status ("Booked" or "Not Booked")
        'images'         // Room images (stored as JSON)
    ];

    // Define an accessor to decode the JSON amenities attribute to an array
    public function getAmenitiesAttribute($value)
    {
        return json_decode($value, true);
    }

    // Define an accessor to decode the JSON images attribute to an array
    public function getImagesAttribute($value)
    {
        return json_decode($value, true);
    }
}
