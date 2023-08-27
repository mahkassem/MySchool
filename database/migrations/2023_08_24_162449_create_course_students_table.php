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
        Schema::create('course_students', function (Blueprint $table) {
            $table->unsignedBigInteger('course_id'); // Foreign key
            $table->unsignedBigInteger('student_id'); // Foreign key

            // composite primary key
            $table->primary(['course_id', 'student_id']);

            // Relationships
            $table->foreign('course_id')
                ->references('id')
                ->on('courses')
                ->onDelete('cascade'); // If course is deleted, delete course_student

            $table->foreign('student_id')
                ->references('id')
                ->on('students')
                ->onDelete('cascade'); // If student is deleted, delete course_student
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_students');
    }
};
