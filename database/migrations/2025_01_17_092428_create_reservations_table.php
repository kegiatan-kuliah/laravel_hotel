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
        if (!Schema::hasTable('reservations')) {
            Schema::create('reservations', function (Blueprint $table) {
                $table->id();
                $table->date('check_in_date');
                $table->date('check_out_date');
                $table->decimal('total_price', 10, 2);
                $table->enum('status', ['reserved','checked_in','checked_out','cancelled'])->default('reserved');
                $table->unsignedBigInteger('guest_id');
                $table->unsignedBigInteger('room_id');
                $table->timestamps();

                $table->foreign('guest_id')->references('id')->on('guests')->onDelete('cascade');
                $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
