<?php

namespace Database\Seeders;

use App\Models\GuardianType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GuardianTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $guardianTypes = [
            ['name' => 'Mother', 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Father', 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Grand Mother', 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Grand Father', 'created_by' => 1, 'updated_by' => 1],
        ];

        GuardianType::insert($guardianTypes);
    }

    
}
