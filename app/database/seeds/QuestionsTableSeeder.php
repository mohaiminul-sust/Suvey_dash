<?php

class QuestionsTableSeeder extends Seeder {

    public function run()
    {
        // DB::table('questions')->delete();

        $faker = Faker\Factory::create();
        $surveys_id = Survey::all()->lists('id');

        for ($i=0; $i < 50; $i++) { 
            
            Question::create([

                'type' => 'mcq',
                'body' => $faker->sentence($nbWords= 5).' ?',
                'surveys_id' => $faker->randomElement($surveys_id)
                
            ]);

            Question::create([

                'type' => 'written',
                'body' => $faker->sentence($nbWords= 5).' ?',
                'surveys_id' => $faker->randomElement($surveys_id)
                
            ]);

        }

    }

}