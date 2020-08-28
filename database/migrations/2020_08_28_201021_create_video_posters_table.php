<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoPostersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sparrow_video_posters', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->integer('video_id')->unsigned();
            $table->string('title');
            $table->string('source');
            $table->string('alt');
            $table->text('link');
            $table->tinyInteger('is_show');
            $table->integer('sort')->unsigned();
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
        Schema::dropIfExists('video_posters');
    }
}
