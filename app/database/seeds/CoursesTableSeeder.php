<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class CoursesTableSeeder extends Seeder {

	public function run()
	{
		$courseInfo = [
			[
				'course_number'  =>  'CSE101',
				'course_title'   =>  'Introduction to Computer Science & Engineering',
				'course_semester' => 1,
				'course_credit'	 =>	3,
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')
			]

		];

		DB::table('courses')->insert($courseInfo);
	}

}