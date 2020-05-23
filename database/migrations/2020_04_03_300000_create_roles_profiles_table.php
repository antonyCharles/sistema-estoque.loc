<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logn_roles_profiles', function (Blueprint $table) {
            $table->increments('role_profile_id');
            $table->unsignedInteger('profile_id')->nullable(false);
            $table->foreign('profile_id')->references('profile_id')->on('logn_profiles');
            $table->unsignedInteger('role_id')->nullable(false);
            $table->foreign('role_id')->references('role_id')->on('logn_roles');
            $table->unsignedInteger('role_action_item_id')->nullable(false);
            $table->foreign('role_action_item_id')->references('role_action_item_id')->on('logn_roles_actions_itens');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logn_roles_profiles');
    }
}
