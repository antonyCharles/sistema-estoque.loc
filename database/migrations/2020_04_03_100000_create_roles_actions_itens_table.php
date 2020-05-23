<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesActionsItensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logn_roles_actions_itens', function (Blueprint $table) {
            $table->increments('role_action_item_id');
            $table->string('name',20)->nullable(false);
            $table->string('slug',10)->nullable(false);
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
        Schema::dropIfExists('logn_roles_lists_itens');
    }
}
