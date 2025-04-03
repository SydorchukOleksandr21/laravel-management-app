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
            $table->uuid('id')->primary();  // UUID для ідентифікатора
            $table->foreignId('room_id')
                ->constrained('rooms')  // автоматично створює зовнішній ключ
                ->onDelete('cascade');  // каскадне видалення
            $table->foreignId('guest_id')
                ->constrained('guests')  // автоматично створює зовнішній ключ
                ->onDelete('cascade');  // каскадне видалення
            $table->integer('pin_code');
            $table->date('date_start');
            $table->date('date_end');
            $table->float('price');
            $table->boolean('is_paid')->default(false);  // стовпець зі значенням за замовчуванням
            $table->timestamps();  // стандартні мітки часу для створення та оновлення
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
