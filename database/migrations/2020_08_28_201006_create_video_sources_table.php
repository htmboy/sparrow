<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoSourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sparrow_video_sources', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->integer('video_id')->unsigned();
            $table->string('title');
            $table->text('link');
            $table->integer('clicks')->unsigned();
            $table->tinyInteger('is_show')->unsigned();
            $table->integer('sort');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('video_sources');
    }
}
