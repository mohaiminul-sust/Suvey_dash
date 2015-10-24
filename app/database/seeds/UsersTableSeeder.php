<?php

class UsersTableSeeder extends Seeder {

    public function run()
    {
        // DB::table('users')->delete();

        $faker = Faker\Factory::create();

        foreach (range(1, 5) as $i) {
            
            GuestUser::create([

                'username' => $faker->firstname,
                'password' => Hash::make('userskey'),
                'access_token' => NULL

            ]);
        }

    }

}