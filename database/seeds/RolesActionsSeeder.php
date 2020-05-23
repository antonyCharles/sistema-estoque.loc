<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesActionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('logn_roles_actions')->insert([
            'name' => 'CRUD básico',
            'created_at' => date("Y-m-d H:i:s")
        ]);
    }
}
