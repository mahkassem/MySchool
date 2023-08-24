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
        Schema::create('classroom_students', function (Blueprint $table) {
            $table->unsignedBigInteger('classroom_id'); // Foreign key
            $table->unsignedBigInteger('student_id'); // Foreign key

            // composite primary key
            $table->primary(['classroom_id', 'student_id']);

            // Relationships
            $table->foreign('classroom_id')
                ->references('id')
                ->on('classrooms')
                ->onDelete('cascade'); // If classroom is deleted, delete classroom_student

            $table->foreign('student_id')
                ->references('id')
                ->on('students')
                ->onDelete('cascade'); // If student is deleted, delete classroom_student
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classroom_students');
    }
};
