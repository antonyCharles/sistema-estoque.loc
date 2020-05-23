<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call('LanguageSeeder');
        $this->call('SystemSeeder');
        $this->call('RolesActionsSeeder');
        $this->call('RolesActionsItemSeeder');
        $this->call('RolesSeeder');
        $this->call('ProfilesSeeder');
        $this->call('RolesProfilesSeeder');
    }
}
