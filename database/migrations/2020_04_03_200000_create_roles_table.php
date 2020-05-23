<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logn_roles', function (Blueprint $table) {
            $table->increments('role_id');
            $table->string('name',50)->nullable(false);
            $table->integer('role')->unique();
            $table->unsignedInteger('role_father_id')->nullable();
            $table->foreign('role_father_id')->references('role_id')->on('logn_roles');
            $table->unsignedInteger('system_id')->nullable(false);
            $table->foreign('system_id')->references('system_id')->on('logn_systems');
            $table->unsignedInteger('role_action_id')->nullable(false);
            $table->foreign('role_action_id')->references('role_action_id')->on('logn_roles_actions');
            $table->char('status',1)->default('A')->nullable(false);
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
        Schema::dropIfExists('logn_roles');
    }
}
