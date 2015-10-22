<?php

class AnswersTableSeeder extends Seeder {

    public function run()
    {
        DB::table('answers')->delete();

        $faker = Faker\Factory::create();

        for ($i=0; $i < 5; $i++) { 
            
            Answer::create([

                
                'body' => $faker->sentence($nbWords= 7),
                'users_id' => $faker->randomElement(User::all()->lists('id')),
                'questions_id' => $faker->randomElement(Question::all()->lists('id')),
                
            ]);

        }

    }

}