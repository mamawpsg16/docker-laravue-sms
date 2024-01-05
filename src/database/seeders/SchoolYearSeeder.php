<?php

namespace Database\Seeders;

use App\Models\SchoolYear;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchoolYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schoolYears = [
            ['name' => '2023-2024', 'start_date' => '2023-06-06', 'end_date' => '2024-05-06'],
        ];

        SchoolYear::insert($schoolYears);
    }
}
