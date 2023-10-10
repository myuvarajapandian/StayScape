<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // Define the fillable attributes of the model to create() or update() methods.
    protected $fillable = [
        'name',         // User's name
        'email',        // User's email address
        'password',     // User's password (hashed)
        'user_role',    // User's role ("House owner" or "customer")
        'about',        // User's about information
        'phone',        // User's phone number
    ];

    // Define attributes that should be hidden when the model is serialized.
    // Typically, you hide sensitive attributes like the password.
    protected $hidden = [
        'password',         // Hide the password field
        'remember_token',   // Hide the remember token (used for "remember me" functionality)
    ];
}
