<?php

class RolesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('roles')->delete();

        // DB::statement('ALTER TABLE roles AUTO_INCREMENT = '.(count(Role::all())+1).';');

        Role::create([
            'type'    =>  'super_admin'
        ]);

        Role::create([
            'type'    =>  'admin'
        ]);

    }

}