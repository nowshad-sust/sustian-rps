<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class ThreadTableSeeder extends Seeder {

	public function run()
	{
		$thread = [
			[
				'owner1_id' => 1,
				'owner2_id' => 3,
				'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
			]

		];

		DB::table('thread')->insert($thread);
	}

}