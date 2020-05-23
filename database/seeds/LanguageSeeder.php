<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('logn_languages')->insert([
            'name' => 'Português Br',
            'abrrev' => 'pt-br',
            'created_at' => date("Y-m-d H:i:s")
        ]);
    }
}
