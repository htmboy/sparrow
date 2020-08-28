<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoDiscussesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sparrow_video_discusses', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('video_id')->unsigned();
            $table->string('ip');
            $table->text('content');
            $table->timestamp('created_at');
            $table->tinyInteger('status')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('video_discusses');
    }
}
