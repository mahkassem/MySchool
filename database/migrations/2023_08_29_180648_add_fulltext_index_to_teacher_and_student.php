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
        Schema::table('teachers', function (Blueprint $table) {
            // fulltext index
            $table->index(['first_name', 'last_name'], 'teacher_fulltext');
        });


        Schema::table('students', function (Blueprint $table) {
            // fulltext index
            $table->index(['first_name', 'last_name'], 'student_fulltext');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('teachers', function (Blueprint $table) {
            $table->dropIndex('teacher_fulltext');
        });

        Schema::table('students', function (Blueprint $table) {
            $table->dropIndex('student_fulltext');
        });
    }
};
