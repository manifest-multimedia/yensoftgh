<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    public function run()
    {
        DB::table('departments')->insert([
            ['name' => 'Kindergarten'],
            ['name' => 'Lower Primary'],
            ['name' => 'Upper Primary'],
            ['name' => 'Junior High'],
        ]);
    }
}
