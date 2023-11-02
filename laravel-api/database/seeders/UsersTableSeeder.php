<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'kokleng',
                'email' => 'a@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$12$4bTdgXTAvO6ELA.PBY1iLev1HObQtN1eJXkgwJ3aeMMdRoVs0gFZC',
                'remember_token' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}