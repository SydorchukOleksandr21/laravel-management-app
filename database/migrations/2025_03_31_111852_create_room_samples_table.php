<?php

use App\Models\RoomSample;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * @return void
     */
    public function up(): void
    {
        Schema::create(RoomSample::tableName(), function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedInteger('person_count')->default(2);
            $table->unsignedInteger('square_area')->default(0);
            $table->text('description')->nullable();
            $table->float('price')->default(0);

            $table->timestamps();
        });
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists(RoomSample::tableName());
    }
};
