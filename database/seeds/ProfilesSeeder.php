<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfilesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('logn_profiles')->insert([
            'name' => 'Developer',
            'created_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('logn_profiles')->insert([
            'name' => 'Free',
            'created_at' => date("Y-m-d H:i:s")
        ]);
    }
}
