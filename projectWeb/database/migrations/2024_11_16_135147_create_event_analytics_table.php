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
        Schema::create('event_analytics', function (Blueprint $table) {
            $table->id('analytics_id');
            $table->foreignId('event_id')->constrained('events');
            $table->integer('total_ticket_sold')->default(0);
            $table->float('total_revenue')->default(0.00);
            $table->float('average_rating')->default(0.00);
            $table->date('event_date');
            $table->timestamps();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_analytics');
    }
};
