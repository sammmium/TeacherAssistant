<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEducationalInstitutions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('educational_institutions', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->string('full_name');
            $table->string('short_name');
            $table->string('address');
            $table->integer('city_id');
        });
    }
    /*
     * id
     * name
     * address
     * city_id
     */

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('educational_institutions');
    }
}
