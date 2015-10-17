<?php

class GuestUsersTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        $faker = Faker\Factory::create();

        for ($i=0; $i < 5; $i++) { 
            GuestUser::create([
                'username' => $faker->name,
                'password' => Hash::make('guestpass'),

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' =>  date('Y-m-d H:i:s')
            ]);

        }

    }

}