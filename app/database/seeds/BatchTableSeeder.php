<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class BatchTableSeeder extends Seeder {

    public function run()
    {
        $batchInfo = [
            [
                'batch' => 2010,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]

        ];

        DB::table('batch')->insert($batchInfo);
    }

}