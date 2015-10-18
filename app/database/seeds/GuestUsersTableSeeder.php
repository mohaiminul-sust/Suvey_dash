<?php

class GuestUsersTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        $faker = Faker\Factory::create();

        $survey_id = Survey::all()->lists('id');

        for ($i=0; $i < 5; $i++) { 
            
            GuestUser::create([

                'username' => $faker->name,
                'password' => Hash::make('guestpass'),
                'access_token' => Hash::make($faker->word),
                'survey_id' => $faker->randomElement($survey_id),
                
            ]);

        }

    }

}