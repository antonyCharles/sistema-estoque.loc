<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesActionsItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('logn_roles_actions_itens')->insert([
            'role_action_id' => (DB::table('logn_roles_actions')->first())->role_action_id,
            'name' => 'Create',
            'slug' => 'CREATE',
            'created_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('logn_roles_actions_itens')->insert([
            'role_action_id' => (DB::table('logn_roles_actions')->first())->role_action_id,
            'name' => 'Read',
            'slug' => 'READ',
            'created_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('logn_roles_actions_itens')->insert([
            'role_action_id' => (DB::table('logn_roles_actions')->first())->role_action_id,
            'name' => 'Update',
            'slug' => 'UPDATE',
            'created_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('logn_roles_actions_itens')->insert([
            'role_action_id' => (DB::table('logn_roles_actions')->first())->role_action_id,
            'name' => 'Delete',
            'slug' => 'DELETE',
            'created_at' => date("Y-m-d H:i:s")
        ]);
    }
}
