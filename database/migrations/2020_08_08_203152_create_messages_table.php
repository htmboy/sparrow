<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration 
{
	public function up()
	{
		Schema::create('messages', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('position_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('title');
            $table->longtext('content');
            $table->integer('sort')->unsigned();
            $table->string('seo_title');
            $table->string('seo_keywords');
            $table->text('seo_description');
            $table->tinyinteger('status')->default(1);
            $table->timestamps();
        });
	}

	public function down()
	{
		Schema::drop('messages');
	}
}
