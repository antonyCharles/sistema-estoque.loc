<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParametersProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logn_parameters_profiles', function (Blueprint $table) {
            $table->increments('parameter_profile_id');
            $table->string('value',250)->nullable(false);
            $table->unsignedInteger('profile_id')->nullable(false);
            $table->foreign('profile_id')->references('profile_id')->on('logn_profiles');
            $table->unsignedInteger('parameter_id')->nullable(false);
            $table->foreign('parameter_id')->references('parameter_id')->on('logn_parameters');
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
        Schema::dropIfExists('logn_parameters_profiles');
    }
}
