<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration 
{
	public function up()
	{
		Schema::create('sparrow_messages', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('position_id')->unsigned();
            $table->integer('theme_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('title');
            $table->longtext('content');
            $table->tinyInteger('reply_count')->unsigned()->nullable();
            $table->integer('sort')->unsigned();
            $table->string('seo_title')->nullable();
            $table->string('seo_keywords')->nullable();
            $table->text('seo_description')->nullable();
            $table->tinyinteger('status')->default(0);
            $table->timestamps();
        });
	}

	public function down()
	{
		Schema::drop('sparrow_messages');
	}
}
