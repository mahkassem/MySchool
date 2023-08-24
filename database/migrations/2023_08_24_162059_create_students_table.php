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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique(); // Foreign key
            $table->string('first_name', 50);
            $table->string('last_name', 50)->nullable();
            $table->string('major', 50)->nullable();
            $table->timestamps(); // created_at, updated_at

            // Relationships
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade'); // If user is deleted, delete student
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
