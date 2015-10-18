<?php

class AdminUsersTableSeeder extends Seeder {

    public function run()
    {
        DB::table('admin_users')->delete();

        User::create([
            'username'    =>  'admin',
            'password'      =>  Hash::make('admindev')
        ]);

    }

}