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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('Event_ID')->constrained('events');
            $table->foreignId('User_ID')->nullable()->constrained('users');
            $table->enum('Status', ['Booked', 'Cancelled']);
            $table->dateTime('Booking_Date');
            $table->dateTime('cancel_date')->nullable();
            $table->dateTime('modified_date')->nullable();
            $table->timestamps();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
