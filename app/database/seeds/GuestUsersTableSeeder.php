<?php

class GuestUsersTableSeeder extends Seeder {

    public function run()
    {
        // DB::table('users')->delete();

        $faker = Faker\Factory::create();

        for ($i=0; $i < 5; $i++) { 
            
            GuestUser::create([

                'email' => $faker->unique()->email,
                'password' => Hash::make('guestpass'),
                'access_token' => Hash::make($faker->word)
                
            ]);

        }

    }

}