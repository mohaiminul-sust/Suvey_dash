<?php

class QuestionsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('questions')->delete();

        $faker = Faker\Factory::create();

        foreach (range(1, 5) as $i) {
            
            Question::create([

                'username' => $faker->firstname,
                'password' => Hash::make('userskey'),
                'access_token' => NULL

            ]);
        }

    }

}