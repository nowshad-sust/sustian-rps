<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class DeptTableSeeder extends Seeder {

    public function run()
    {
        $deptInfo = [
            [
                'dept' => 'CSE',
                'deptCode' => 331,
                'deptName'	 =>	'Computer Science & Engineering',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]

        ];

        DB::table('dept')->insert($deptInfo);
    }

}