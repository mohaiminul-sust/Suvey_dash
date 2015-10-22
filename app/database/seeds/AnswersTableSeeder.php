<?php

class AnswersTableSeeder extends Seeder {

    public function run()
    {
        DB::table('answers')->delete();

        $faker = Faker\Factory::create();
        $admin_users_id = User::all()->lists('id');
        $questions_id = Question::all()->lists('id');

        for ($i=0; $i < 5; $i++) { 
            
            Answer::create([

                
                'body' => $faker->sentence($nbWords= 7),
                'users_id' => $faker->randomElement($admin_users_id),
                'questions_id' => $faker->randomElement($questions_id),
                
            ]);

        }

    }

}