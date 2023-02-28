<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDicts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dicts', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('parent_id')->index()->nullable();
            $table->string('code', 255)->index()->nullable();
            $table->string('value', 255)->index();
            $table->string('description', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dicts');
    }
}
