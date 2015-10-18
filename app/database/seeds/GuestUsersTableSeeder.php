<?php

class GuestUsersTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        $faker = Faker\Factory::create();

        for ($i=0; $i < 5; $i++) { 
            
            GuestUser::create([
                'username' => $faker->name,
                'password' => Hash::make('guestpass')
            ]);

        }

    }

}