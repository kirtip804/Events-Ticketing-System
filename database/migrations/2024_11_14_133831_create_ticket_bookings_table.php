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
        Schema::create('ticket_bookings', function (Blueprint $table) {
            $table->increments('ticket_booking_id');
            $table->integer('event_id')->unsigned()->comment('ref table: events');
            $table->integer('ticket_id')->unsigned()->comment('ref table: tickets');
            $table->integer('user_id')->unsigned()->comment('ref table: users');
            $table->integer('quantity');
            $table->decimal('total_price', 10, 2);
            $table->integer('payment_status')->default(1)->comment('1: pending, 2: paid, 3: failed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_bookings');
    }
};
