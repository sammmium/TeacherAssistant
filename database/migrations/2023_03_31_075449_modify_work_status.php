<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyWorkStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('work_status', function (Blueprint $table) {
            $table->integer('educational_institution_id')->index()->nullable();
            $table->integer('teacher_id')->index()->nullable();
            $table->integer('pupil_id')->index()->nullable();
            $table->integer('unit_group_pupil_id')->index()->nullable();
            $table->integer('test_type_id')->index()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
