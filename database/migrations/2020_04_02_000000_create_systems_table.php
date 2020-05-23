<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logn_systems', function(Blueprint $table){
            $table->increments('system_id');
            $table->string('name',60)->nullable(false);
            $table->char('abrrev',3)->nullable(false);
            $table->text('description',1000)->nullable();
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
        Schema::dropIfExists('logn_systems');
    }
}
