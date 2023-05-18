<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AcademicYear;

class AcademicYearsTableSeeder extends Seeder
{
    public function run()
    {
        AcademicYear::create([
            'name' => '2022/2023',
            'start_date' => '2022-09-01',
            'end_date' => '2023-06-30'
        ]);

        AcademicYear::create([
            'name' => '2023/2024',
            'start_date' => '2023-09-01',
            'end_date' => '2024-06-30'
        ]);
    }
}
