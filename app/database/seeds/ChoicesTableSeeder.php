<?php

class ChoicesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('choices')->delete();

        $faker = Faker\Factory::create();
        $questions_id = Question::all()->lists('id');
        

        for ($i=0; $i < 20; $i++) { 
            
            Choice::create([

                'choice' => $faker->word,
                'questions_id' => $faker->randomElement($questions_id)
                
            ]);

        }

    }

}