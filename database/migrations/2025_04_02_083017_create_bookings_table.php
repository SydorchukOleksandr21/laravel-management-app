<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignId('room_id')
                ->constrained('rooms')
                ->onDelete('cascade');
            $table->foreignId('guest_id')
                ->constrained('guests')
                ->onDelete('cascade');

            $table->integer('pin_code');
            $table->date('date_start');
            $table->date('date_end');
            $table->float('price');
            $table->boolean('is_paid')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
