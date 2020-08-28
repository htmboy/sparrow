<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepliesTable extends Migration 
{
	public function up()
	{
		Schema::create('sparrow_replies', function(Blueprint $table) {
            $table->increments('id');
            $table->biginteger('message_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->text('content');
            $table->timestamp('created_at');
            $table->tinyinteger('status')->unsigned()->default(0);
        });
	}

	public function down()
	{
		Schema::drop('sparrow_replies');
	}
}
