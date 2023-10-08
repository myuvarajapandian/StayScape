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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('owner_name');
            $table->string('email');
            $table->string('location');
            $table->string('room_name');
            $table->integer('no_of_beds');
            $table->integer('floor_size');
            $table->json('amenities');
            $table->string('address');
            $table->string('description');
            $table->integer('min_stay');
            $table->integer('max_stay');
            $table->integer('rent');
            $table->string('booking')->default('Not Booked');
            $table->json('images');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
