<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('levels')->insert([
            ['abbre' => 'BS1','name' => 'Basic One','department_id' => '2'],
            ['abbre' => 'BS2','name' => 'Basic Two','department_id' => '2'],
            ['abbre' => 'BS3','name' => 'Basic Three','department_id' => '2'],
            ['abbre' => 'BS4','name' => 'Basic Four','department_id' => '3'],
            ['abbre' => 'BS5','name' => 'Basic Five','department_id' => '3'],
            ['abbre' => 'BS6','name' => 'Basic Six','department_id' => '3'],
            ['abbre' => 'BS7','name' => 'Basic Seven','department_id' => '4'],
            ['abbre' => 'BS8','name' => 'Basic Eight','department_id' => '4'],
            ['abbre' => 'BS9','name' => 'Basic Nine','department_id' => '4'],
        ]);
    }
}
