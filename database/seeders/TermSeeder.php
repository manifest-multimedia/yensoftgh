<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TermSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('terms')->insert([
            ['name' => 'First Term','start_date' => '2023-04-27','end_date' => '2023-06-27'],
            ['name' => 'Second Term','start_date' => '2023-07-27','end_date' => '2023-09-27'],
            ['name' => 'Third Term','start_date' => '2023-10-27','end_date' =>'2023-012-27'],
        ]);
    }

}
