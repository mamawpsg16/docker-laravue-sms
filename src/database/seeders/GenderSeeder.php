<?php

namespace Database\Seeders;

use App\Models\Gender;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gendersData = [
            ['name' => 'Male', 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Female', 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Other', 'created_by' => 1, 'updated_by' => 1],
        ];

        Gender::insert($gendersData);
    }
}
