<?php

use App\Models\RoomParameter;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Table name.
     */
    private string $tableName = 'room_parameters';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(RoomParameter::tableName(), function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Parameter name');
            $table->unsignedTinyInteger('value_type');
            $table->string('value')->comment('Parameter value');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(RoomParameter::tableName());
    }
};
