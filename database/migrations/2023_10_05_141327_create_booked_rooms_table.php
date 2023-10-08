<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('booked_rooms', function (Blueprint $table) {
            $table->id();
            $table->integer('roomid');
            $table->string('room_name');
            $table->string('customer_name');
            $table->string('owner_name');
            $table->string('email');
            $table->string('location');
            $table->string('check_in');
            $table->string('check_out');
            $table->integer('rent_amt');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booked_rooms');
    }
};
