<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SampleSchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('school_settings')->insert([
        ['school_name' => 'Yensoft School','school_address' => 'P. O. Box 217','abbre' =>'YEN',
        'school_city' => 'Bolgatanga', 'school_region'=>'Upper East', 'school_country' => 'Ghana',
        'school_phone'=>'0545055050','school_email'=>'yensoftschool@yensoftgh.com',],
        ]);
    }
}
