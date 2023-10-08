<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bookedRooms extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'roomid',
        'room_name',
        'customer_name',
        'owner_name',
        'email',
        'location',
        'check_in',
        'check_out',
        'rent_amt',
        'status',
    ];
}
