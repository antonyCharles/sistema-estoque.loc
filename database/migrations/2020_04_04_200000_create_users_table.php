<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_funcionario', function (Blueprint $table) {
            $table->string('password');
            $table->unsignedInteger('profile_id');
            $table->foreign('profile_id')->references('profile_id')->on('logn_profiles');
            $table->char('status',1)->default('A')->nullable(false);
            $table->rememberToken();
            $table->timestamps();
        });
        
        /*Schema::create('logn_users', function (Blueprint $table) {
            $table->bigIncrements('user_id');
            $table->string('name',40)->nullable(false);
            $table->string('surname',40)->nullable();
            $table->string('email',80)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedInteger('language_id');
            $table->foreign('language_id')->references('language_id')->on('logn_languages');
            $table->unsignedInteger('profile_id');
            $table->foreign('profile_id')->references('profile_id')->on('logn_profiles');
            $table->char('status',1)->default('A')->nullable(false);
            $table->rememberToken();
            $table->timestamps();
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logn_users');
    }
}
