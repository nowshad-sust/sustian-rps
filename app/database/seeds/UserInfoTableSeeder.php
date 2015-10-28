<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class UserInfoTableSeeder extends Seeder {

    public function run()
    {
        $userInfo = [
            [
                'fullName'  =>  'yousuf Khan Ratul',
                'user_id'   =>  1,
                'activation' => true,
                'activation_key' => null,
                'reg_no'  =>    '2012331000',
                'batch_id'  => 1,
                'dept_id'  =>  1,
                'avatar_url' => null,
                'icon_url'     => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]

        ];

        DB::table('userinfo')->insert($userInfo);
    }

}