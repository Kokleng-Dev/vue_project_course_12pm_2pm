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
                'name' => 'kokleng kokleng',
                'email' => 'a@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$12$4bTdgXTAvO6ELA.PBY1iLev1HObQtN1eJXkgwJ3aeMMdRoVs0gFZC',
                'remember_token' => NULL,
                'created_at' => NULL,
                'updated_at' => '2023-11-06 07:00:02',
                'is_two_factor' => 0,
                'otp' => NULL,
                'photo' => NULL,
                'role_id' => 1,
            ),
            1 => 
            array (
                'id' => 6,
                'name' => 'g',
                'email' => 'g@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$12$bu9G/JIEVEWzhtsLLTdJKuYvSXYUskMX9WaOlEZ86mxPM5ewcjXB.',
                'remember_token' => NULL,
                'created_at' => '2023-11-06 07:15:51',
                'updated_at' => '2023-11-06 07:15:51',
                'is_two_factor' => 0,
                'otp' => NULL,
                'photo' => NULL,
                'role_id' => 1,
            ),
        ));
        
        
    }
}