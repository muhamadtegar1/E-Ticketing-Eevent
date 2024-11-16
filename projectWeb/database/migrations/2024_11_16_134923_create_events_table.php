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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->dateTime('DateTime_start');
            $table->dateTime('DateTime_end');
            $table->string('location');
            $table->float('Ticket_Price');
            $table->integer('Ticket_Quota');
            $table->integer('available_ticket');
            $table->string('Image_URL')->nullable();
            $table->foreignId('Creator_ID')->constrained('users');
            $table->timestamps();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
