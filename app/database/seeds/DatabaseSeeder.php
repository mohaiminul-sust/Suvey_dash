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


		$this->call('RolesTableSeeder');
		$this->command->info('Roles Table Seeded !');

		$this->call('AdminUsersTableSeeder');
		$this->command->info('Admin Users Table Seeded !');

		$this->call('SurveysTableSeeder');
		$this->command->info('Surveys Table Seeded !');

		$this->call('UsersTableSeeder');
		$this->command->info('Users Table Seeded !');

		$this->call('TrackSurveysTableSeeder');
		$this->command->info('Track Surveys Table Seeded !');


	}

}
