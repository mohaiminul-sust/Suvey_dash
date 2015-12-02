<?php

class SurveysTableSeeder extends Seeder {

    public function run()
    {
        // DB::table('surveys')->delete();

        $faker = Faker\Factory::create();

        $admin_users_id = User::all()->lists('id');

        foreach (range(1, 25) as $i) {
            
            Survey::create([
                'title' => $faker->lexify($faker->firstname.' survey'),
                'admin_users_id' => $faker->randomElement($admin_users_id)
            ]);
        }

    }

}