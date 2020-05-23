<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('logn_systems')->insert([
            'name' => 'FATEC - Sistema Estoque',
            'abrrev' => 'LMR',
            'created_at' => date("Y-m-d H:i:s")
        ]);
    }
}
