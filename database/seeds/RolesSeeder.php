<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('logn_roles')->insert([
            'name' => 'System',
            'role' => 1,
            'role_action_id' => (DB::table('logn_roles_actions')->first())->role_action_id,
            'system_id' => (DB::table('logn_systems')->first())->system_id,
            'created_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('logn_roles')->insert([
            'name' => 'Profiles',
            'role' => 2,
            'role_action_id' => (DB::table('logn_roles_actions')->first())->role_action_id,
            'role_father_id' => (DB::table('logn_roles')->where('role','1')->first())->role_id,
            'system_id' => (DB::table('logn_systems')->first())->system_id,
            'created_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('logn_roles')->insert([
            'name' => 'Roles (Functions)',
            'role' => 3,
            'role_action_id' => (DB::table('logn_roles_actions')->first())->role_action_id,
            'role_father_id' => (DB::table('logn_roles')->where('role','1')->first())->role_id,
            'system_id' => (DB::table('logn_systems')->first())->system_id,
            'created_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('logn_roles')->insert([
            'name' => 'Language',
            'role' => 4,
            'role_action_id' => (DB::table('logn_roles_actions')->first())->role_action_id,
            'role_father_id' => (DB::table('logn_roles')->where('role','1')->first())->role_id,
            'system_id' => (DB::table('logn_systems')->first())->system_id,
            'created_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('logn_roles')->insert([
            'name' => 'Role Profile',
            'role' => 5,
            'role_action_id' => (DB::table('logn_roles_actions')->first())->role_action_id,
            'role_father_id' => (DB::table('logn_roles')->where('role','2')->first())->role_id,
            'system_id' => (DB::table('logn_systems')->first())->system_id,
            'created_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('logn_roles')->insert([
            'name' => 'Parameter Setting',
            'role' => 6,
            'role_action_id' => (DB::table('logn_roles_actions')->first())->role_action_id,
            'system_id' => (DB::table('logn_systems')->first())->system_id,
            'created_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('logn_roles')->insert([
            'name' => 'Parameter',
            'role' => 7,
            'role_action_id' => (DB::table('logn_roles_actions')->first())->role_action_id,
            'role_father_id' => (DB::table('logn_roles')->where('role','6')->first())->role_id,
            'system_id' => (DB::table('logn_systems')->first())->system_id,
            'created_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('logn_roles')->insert([
            'name' => 'Group Parameter',
            'role' => 8,
            'role_action_id' => (DB::table('logn_roles_actions')->first())->role_action_id,
            'role_father_id' => (DB::table('logn_roles')->where('role','6')->first())->role_id,
            'system_id' => (DB::table('logn_systems')->first())->system_id,
            'created_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('logn_roles')->insert([
            'name' => 'Parameter Profile',
            'role' => 9,
            'role_action_id' => (DB::table('logn_roles_actions')->first())->role_action_id,
            'role_father_id' => (DB::table('logn_roles')->where('role','2')->first())->role_id,
            'system_id' => (DB::table('logn_systems')->first())->system_id,
            'created_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('logn_roles')->insert([
            'name' => 'User',
            'role' => 10,
            'role_action_id' => (DB::table('logn_roles_actions')->first())->role_action_id,
            'role_father_id' => (DB::table('logn_roles')->where('role','1')->first())->role_id,
            'system_id' => (DB::table('logn_systems')->first())->system_id,
            'created_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('logn_roles')->insert([
            'name' => 'Roles Actions',
            'role' => 11,
            'role_action_id' => (DB::table('logn_roles_actions')->first())->role_action_id,
            'role_father_id' => (DB::table('logn_roles')->where('role','1')->first())->role_id,
            'system_id' => (DB::table('logn_systems')->first())->system_id,
            'created_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('logn_roles')->insert([
            'name' => 'Roles Actions Itens',
            'role' => 12,
            'role_action_id' => (DB::table('logn_roles_actions')->first())->role_action_id,
            'role_father_id' => (DB::table('logn_roles')->where('role','11')->first())->role_id,
            'system_id' => (DB::table('logn_systems')->first())->system_id,
            'created_at' => date("Y-m-d H:i:s")
        ]);
    }
}
