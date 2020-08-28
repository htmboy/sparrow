<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarouselsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sparrow_carousels', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('summary');
            $table->string('source');
            $table->text('link');
            $table->string('alt');
            $table->string('title');
            $table->timestamp('created_at');
            $table->tinyInteger('is_show');
            $table->integer('sort')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sparrow_carousels');
    }
}
