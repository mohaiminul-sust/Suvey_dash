<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		
		Eloquent::unguard();

		$this->call('AdminUsersTableSeeder');
		$this->command->info('Admin Users Table Seeded !');

		$this->call('UsersTableSeeder');
		$this->command->info('Users Table Seeded !');
		

	}

}
