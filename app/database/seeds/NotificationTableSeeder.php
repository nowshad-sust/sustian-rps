<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class NotificationTableSeeder extends Seeder {

    public function run()
    {
        $notificationInfo = [
            [
                'notification_text' =>  'test notification',
                'status'    =>  true,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]

        ];

        DB::table('notification')->insert($notificationInfo);
    }

}