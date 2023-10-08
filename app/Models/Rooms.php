<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'owner_name',
        'email',
        'location',
        'room_name',
        'no_of_beds',
        'floor_size',
        'amenities',
        'address',
        'description',
        'min_stay',
        'max_stay',
        'rent',
        'booking',
        'images'
    ];

    public function getAmenitiesAttribute($value)
    {   
        return json_decode($value, true);
    }

    public function getImagesAttribute($value)
    {
        return json_decode($value, true);
    }
}
