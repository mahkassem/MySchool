<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // delete all admins
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::query('TRUNCATE TABLE admins');

        User::factory()->admin()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('secret'),
        ]);


        if (app()->isLocal()) {
            // development seeder
            $this->call([
                BuildingSeeder::class,
                StudentSeeder::class,
                TeacherSeeder::class,
            ]);
        }

        if (app()->isProduction()) {
            // production seeder

        }


        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
