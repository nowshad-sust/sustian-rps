<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class MessageTableSeeder extends Seeder {

    public function run()
    {
        $messageInfo = [
            [
                'sender_id' =>  2,
                'receiver_id'   =>  1,
                'seen_status'   => false,
                'thread_id' => 1,
                'subject'   =>  'test message',
                'message'   =>  'this is the body of the test message. this is for admin only',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]

        ];

        DB::table('message')->insert($messageInfo);
    }

}