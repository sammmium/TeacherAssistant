<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableWorkStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_status', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('user_id')->index();
            $table->integer('unit_id')->index()->nullable();
            $table->integer('group_id')->index()->nullable();
            $table->integer('subject_id')->index()->nullable();
            $table->integer('test_id')->index()->nullable();
            $table->integer('card_id')->index()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('work_status');
    }
}
