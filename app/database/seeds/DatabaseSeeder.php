<?php

class DatabaseSeeder extends Seeder {

	private $tables = [
		'users',
		'roles',
		'permissions',
		'dept',
		'batch',
		'userInfo',
		'courses',
		'entrust',
		'notification',
		'results',

	];
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS=0');

		foreach($this->tables as $tableName){
			DB::table($tableName)->truncate();
		}

		DB::statement('SET FOREIGN_KEY_CHECKS=1');

		Eloquent::unguard();

		 $this->call('RolesTableSeeder');
		 $this->call('PermissionsTableSeeder');
		 $this->call('UsersTableSeeder');
		 $this->call('EntrustTableSeeder');
		 $this->call('BatchTableSeeder');
		 $this->call('DeptTableSeeder');
		 $this->call('UserInfoTableSeeder');
		 $this->call('CoursesTableSeeder');
		 $this->call('ResultsTableSeeder');
		 $this->call('NotificationTableSeeder');
		 $this->call('MessageTableSeeder');
	}

}
