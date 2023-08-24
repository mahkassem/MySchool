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
        Schema::create('classrooms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('building_id'); // Foreign key
            $table->string('name', 50);
            $table->timestamps();

            // Relationships
            $table->foreign('building_id')
                ->references('id')
                ->on('buildings')
                ->onDelete('restrict'); // If building is deleted, delete classroom
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classrooms');
    }
};
