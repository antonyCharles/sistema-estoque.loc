<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParametersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logn_parameters', function (Blueprint $table) {
            $table->increments('parameter_id');
            $table->string('label',80)->nullable(false);
            $table->text('values_select')->nullable();
            $table->unsignedInteger('group_parameter_id')->nullable(false);
            $table->foreign('group_parameter_id')->references('group_parameter_id')->on('logn_groups_parameters');
            $table->char('type_parameter',1)->nullable(false);
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
        Schema::dropIfExists('logn_parameters');
    }
}
