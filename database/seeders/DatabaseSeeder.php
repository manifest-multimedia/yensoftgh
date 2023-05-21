<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call(DepartmentSeeder::class);
        $this->call(LevelsSeeder::class);
        $this->call(AcademicYearsTableSeeder::class);
        $this->call(TermSeeder::class);
        $this->call(SampleSchoolSeeder::class);
        $this->call(StudentsSeeder::class);

        \App\Models\User::factory(10)->create();

    }
}
