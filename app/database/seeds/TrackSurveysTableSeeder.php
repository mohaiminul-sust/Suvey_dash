<?php

class TrackSurveysTableSeeder extends Seeder {

    public function run()
    {
        // DB::table('track_surveys')->delete();

        $faker = Faker\Factory::create();

        $surveys_id = Survey::all()->lists('id');
        $users_id = GuestUser::all()->lists('id');


        foreach (range(1, 200) as $i) {
            
            TrackSurvey::create([
                'lat' => $faker->latitude,
                'lon' => $faker->longitude,
                'surveys_id' => $faker->randomElement($surveys_id),
                'users_id' => $faker->randomElement($users_id)

            ]);
        }

    }

}