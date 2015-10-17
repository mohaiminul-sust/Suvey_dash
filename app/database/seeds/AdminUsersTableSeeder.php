<?php

class AdminUsersTableSeeder extends Seeder {

    public function run()
    {
        DB::table('admin_users')->delete();

        $user = [
            'username'    =>  'admin',
            'password'      =>  Hash::make('admindev'),
            
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ];

        DB::table('admin_users')->insert($user);
    }

}