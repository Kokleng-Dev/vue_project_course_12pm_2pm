<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('permissions')->delete();
        
        \DB::table('permissions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Role',
                'key' => 'role',
                'note' => NULL,
                'created_at' => '2023-11-08 05:44:11',
                'updated_at' => '2023-11-08 05:44:11',
            ),
            1 => 
            array (
                'id' => 3,
                'name' => 'User',
                'key' => 'user',
                'note' => NULL,
                'created_at' => '2023-11-08 07:46:21',
                'updated_at' => '2023-11-08 07:46:21',
            ),
            2 => 
            array (
                'id' => 4,
                'name' => 'Permission',
                'key' => 'permission',
                'note' => 'only dev',
                'created_at' => '2023-11-13 06:44:32',
                'updated_at' => '2023-11-13 06:44:32',
            ),
            3 => 
            array (
                'id' => 5,
                'name' => 'Config',
                'key' => 'config',
                'note' => NULL,
                'created_at' => '2023-11-13 06:44:49',
                'updated_at' => '2023-11-13 06:44:49',
            ),
            4 => 
            array (
                'id' => 6,
                'name' => 'Api Key',
                'key' => 'api_key',
                'note' => NULL,
                'created_at' => '2023-11-13 06:44:55',
                'updated_at' => '2023-11-13 06:44:55',
            ),
            5 => 
            array (
                'id' => 7,
                'name' => 'Staff',
                'key' => 'staff',
                'note' => NULL,
                'created_at' => '2023-11-16 07:13:46',
                'updated_at' => '2023-11-16 07:13:46',
            ),
            6 => 
            array (
                'id' => 8,
                'name' => 'Student',
                'key' => 'student',
                'note' => NULL,
                'created_at' => '2023-11-29 13:41:57',
                'updated_at' => '2023-11-29 13:41:57',
            ),
        ));
        
        
    }
}