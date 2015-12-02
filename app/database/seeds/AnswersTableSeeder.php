<?php

class AnswersTableSeeder extends Seeder {

    public function run()
    {
        // DB::table('answers')->delete();

        $faker = Faker\Factory::create();

        $questions = Question::all()->lists('id');
        $users = User::all()->lists('id');

        for ($i=0; $i < 250; $i++) { 
            
            Answer::create([
                'body' => $faker->sentence($nbWords= 7),
                'questions_id' => $faker->randomElement($questions),
                'users_id' => $faker->randomElement($users)
            ]);

        }

    }

}