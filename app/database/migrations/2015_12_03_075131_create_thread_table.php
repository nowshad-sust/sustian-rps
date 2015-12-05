<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThreadTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('thread', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('owner1_id')->unsigned();
			$table->integer('owner2_id')->unsigned();
			$table->timestamps();
			
			$table->foreign('owner1_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
			$table->foreign('owner2_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('thread');
	}

}
