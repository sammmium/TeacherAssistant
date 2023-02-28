<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUnitsGroupsPupils extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('units_groups_pupils', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('unit_group_id')->index()->nullable();
            $table->integer('pupil_id')->index()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('units_groups_pupils');
    }
}
