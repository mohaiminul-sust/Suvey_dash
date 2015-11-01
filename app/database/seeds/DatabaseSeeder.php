<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// if(App::environment() === 'production'){
		// 	exit('Application in production Mode ! No can do!!');
		// }


		Eloquent::unguard(); //mass assignment enabler

		$tables = [
			'choices',
			'answers',
			'questions',
			'track_surveys',
			'users',
			'surveys',
			'admin_users',
			'roles'
		];
		
		$this->command->info('...... Truncating Tables ......');

		DB::statement('SET FOREIGN_KEY_CHECKS=0;');

		foreach ($tables as $table) {
			$this->command->info('Truncating '.$table.' ...');
			DB::table($table)->truncate();
		}
		
		$this->command->info('...... Tables Truncated ......');

		$this->command->info('...... SEEDING ......');

		$this->call('RolesTableSeeder');
		$this->call('AdminUsersTableSeeder');
		$this->call('SurveysTableSeeder');
		$this->call('GuestUsersTableSeeder');
		$this->call('TrackSurveysTableSeeder');
		$this->call('QuestionsTableSeeder');
		$this->call('AnswersTableSeeder');
		$this->call('ChoicesTableSeeder');

		DB::statement('SET FOREIGN_KEY_CHECKS=1;');
		$this->command->info('...... SEEDING DONE ! ......');

		


	}

}
