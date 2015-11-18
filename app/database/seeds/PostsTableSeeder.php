<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class PostsTableSeeder extends Seeder {

    public function run()
    {
        $PostsInfo = [
            [
                'post_user_id' =>  3,
                'batch'       => 2012,
                'post_body'   =>  'this is the body of the test body. this is for test',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]

        ];

        DB::table('posts')->insert($PostsInfo);
    }

}