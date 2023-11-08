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
        ));
        
        
    }
}