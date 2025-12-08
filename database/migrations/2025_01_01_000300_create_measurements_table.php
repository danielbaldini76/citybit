<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('measurements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sensor_id')->constrained('sensors')->cascadeOnDelete();
            $table->decimal('co2', 8, 2)->nullable();
            $table->decimal('hcho', 8, 3)->nullable();
            $table->decimal('tvoc', 8, 3)->nullable();
            $table->decimal('temperature', 5, 2)->nullable();
            $table->decimal('humidity', 5, 2)->nullable();
            $table->timestamp('recorded_at')->nullable()->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('measurements');
    }
};
