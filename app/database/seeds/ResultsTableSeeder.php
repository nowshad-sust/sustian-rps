<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class ResultsTableSeeder extends Seeder {

	public function run()
	{
		$resultInfo = [
			[
				'user_id'  =>  1,
				'course_id'   =>  1,
				'grade_point' => 3.00,
				'grade_letter'	=> 'B',
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')
			]

		];

		DB::table('results')->insert($resultInfo);
	}

}