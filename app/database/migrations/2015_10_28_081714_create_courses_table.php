<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('courses', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('course_number');
			$table->string('course_title');
			$table->integer('dept_id')->unsigned();
			$table->integer('batch_id')->unsigned();
			$table->integer('course_semester');
			$table->float('course_credit');
			$table->timestamps();

			$table->foreign('dept_id')->references('id')->on('dept')->onUpdate('cascade')->onDelete('cascade');
			$table->foreign('batch_id')->references('id')->on('batch')->onUpdate('cascade')->onDelete('cascade');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('courses');
	}

}
