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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('classroom_id'); // Foreign key
            $table->unsignedBigInteger('teacher_id'); // Foreign key
            $table->string('name', 50)->unique();
            $table->string('duration', 50);
            $table->timestamps();

            // Relationships
            $table->foreign('classroom_id')
                ->references('id')
                ->on('classrooms')
                ->onDelete('restrict'); // If classroom is deleted, prevent deletion

            $table->foreign('teacher_id')
                ->references('id')
                ->on('teachers')
                ->onDelete('restrict'); // If teacher is deleted, prevent deletion
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
