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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('user_id');
            $table->string('name');
            $table->string('email');
            $table->string('phoneno');
            $table->text('token')->nullable();
            $table->string('organizer_name')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('imagefile')->nullable();
            $table->tinyInteger('role')->defult(2)->comment('1: organizer, 2: attendees');
            $table->tinyInteger('status')->default(0)->comment('0: inactive, 1: active, 2: unverified');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
