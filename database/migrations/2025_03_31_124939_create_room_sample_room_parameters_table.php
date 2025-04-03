<?php

use App\Models\RoomParameter;
use App\Models\RoomSample;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * @var string
     */
    protected $tableName = 'room_sample_room_parameters';

    /**
     * @return void
     */
    public function up(): void
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();

            // Foreign keys
            $table->foreignId('room_sample_id')->constrained(RoomSample::tableName())->onDelete('cascade');
            $table->foreignId('room_parameter_id')->constrained(RoomParameter::tableName())->onDelete('cascade');

            $table->timestamps();

            // Prevent duplicates (shortened index name)
            $table->unique(['room_sample_id', 'room_parameter_id'], 'room_sample_param_unique');
        });
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists($this->tableName);
    }
};
