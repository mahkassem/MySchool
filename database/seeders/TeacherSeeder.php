<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // truncate all teachers cascade
        DB::query('TRUNCATE TABLE teachers');

        // create 10 teachers
        Teacher::factory()->count(10)->create();
    }
}
