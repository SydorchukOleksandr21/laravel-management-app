<?php

use App\Models\Room;
use App\Models\RoomSample;
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
        Schema::create(Room::tableName(), function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_sample_id')->constrained(RoomSample::tableName())->onDelete('cascade');
            $table->integer('floor');
            $table->integer('number');
            $table->string('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(Room::tableName());
    }
};
