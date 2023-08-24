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
        Schema::create('classroom_teachers', function (Blueprint $table) {
            $table->unsignedBigInteger('classroom_id'); // Foreign key
            $table->unsignedBigInteger('teacher_id'); // Foreign key

            // composite primary key
            $table->primary(['classroom_id', 'teacher_id']);

            // Relationships
            $table->foreign('classroom_id')
                ->references('id')
                ->on('classrooms')
                ->onDelete('cascade'); // If classroom is deleted, delete classroom_teacher

            $table->foreign('teacher_id')
                ->references('id')
                ->on('teachers')
                ->onDelete('cascade'); // If teacher is deleted, delete classroom_teacher
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classroom_teachers');
    }
};
