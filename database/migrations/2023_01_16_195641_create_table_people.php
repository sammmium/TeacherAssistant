<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePeople extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->string('firstname', 255);
            $table->string('lastname', 255);
            $table->string('patronymic', 255)->nullable();
            $table->date('birthdate', 10)->nullable();
            $table->string('description', 255)->nullable();
            $table->integer('role_id')->index();
            $table->integer('user_id')->index()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('people');
    }
}
