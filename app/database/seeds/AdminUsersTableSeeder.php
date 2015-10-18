<?php

class AdminUsersTableSeeder extends Seeder {

    public function run()
    {
        DB::table('admin_users')->delete();

        $faker = Faker\Factory::create();

        $super_admin_role_id = Role::where('type', 'super_admin')->first()->id;
        $admin_role_id = Role::where('type', 'admin')->first()->id;
        
        User::create([
            'username'    =>  'admin',
            'password'    =>  Hash::make('admindev'),
         	'roles_id'    =>  $super_admin_role_id
        ]);

        foreach (range(1, 5) as $i) {
			User::create([
	            'username'    =>  $faker->firstname,
	            'password'    =>  Hash::make('admin'),
	         	'roles_id'    =>  $admin_role_id
	        ]);        	
        }

    }

}