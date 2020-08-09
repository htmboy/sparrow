<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sparrow_positions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('parent_id');
            $table->string('place');
            $table->unsignedInteger('level');
            $table->enum('is_town', ['0', '1']);
            $table->string('path');
            $table->enum('is_show', ['0', '1']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sparrow_positions');
    }
}
