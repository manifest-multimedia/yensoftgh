<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaxBracket extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tax_brackets')->insert([
        ['min_value' => '0','max_value' => '402','percent' =>'0.00'],
        ['min_value' => '403','max_value' => '512','percent' =>'0.05'],
        ['min_value' => '513','max_value' => '642','percent' =>'0.10'],
        ['min_value' => '643','max_value' => '3642','percent' =>'0.175'],
        ['min_value' => '3643','max_value' => '20037','percent' =>'0.25'],
        ['min_value' => '20038','max_value' => '50000','percent' =>'0.3'],
        ['min_value' => '50001','max_value' => '10000000000','percent' =>'0.35'],
        ]);
    }
}
