<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesProfilesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = DB::table('logn_roles')->get();
        $itensList = DB::table('logn_roles_actions_itens')->get();

        foreach($roles as $role)
        {
            foreach($itensList as $i)
            {
                DB::table('logn_roles_profiles')->insert([
                    'profile_id' => (DB::table('logn_profiles')->first())->profile_id,
                    'role_id' => $role->role_id,
                    'role_action_item_id' => $i->role_action_item_id,
                    'created_at' => date("Y-m-d H:i:s")
                ]);
            }
        }
    }
}
