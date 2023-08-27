<?php

namespace Database\Seeders;

use App\Models\Building;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BuildingSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // truncate all buildings cascade
        DB::query('TRUNCATE TABLE buildings');

        $dataSource = Storage::get('seeding_data/buildings.json');

        $data = json_decode($dataSource, true);

        foreach ($data as $item) {
            Building::updateOrInsert(
                ['name' => $item['name']],
            );
        }
    }
}
