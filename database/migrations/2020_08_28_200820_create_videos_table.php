<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sparrow_videos', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('name');
            $table->tinyInteger('country_id')->unsigned();
            $table->string('starring');
            $table->string('director');
            $table->text('introduction');
            $table->timestamp('issued_at');
            $table->enum('kind', ['1', '2', '3', '4']);
            $table->string('cover');
            $table->tinyInteger('is_show')->unsigned();
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
        Schema::dropIfExists('sparrow_videos');
    }
}
