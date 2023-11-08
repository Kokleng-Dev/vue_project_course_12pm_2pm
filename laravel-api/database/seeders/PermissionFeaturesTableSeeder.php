<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionFeaturesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('permission_features')->delete();
        
        \DB::table('permission_features')->insert(array (
            0 => 
            array (
                'id' => 1,
                'permission_id' => 1,
                'name' => 'View',
                'key' => 'view',
                'note' => NULL,
                'created_at' => '2023-11-08 06:12:47',
                'updated_at' => '2023-11-08 06:12:47',
            ),
            1 => 
            array (
                'id' => 2,
                'permission_id' => 1,
                'name' => 'Create',
                'key' => 'create',
                'note' => NULL,
                'created_at' => '2023-11-08 06:13:15',
                'updated_at' => '2023-11-08 06:13:15',
            ),
            2 => 
            array (
                'id' => 3,
                'permission_id' => 1,
                'name' => 'Edit',
                'key' => 'edit',
                'note' => NULL,
                'created_at' => '2023-11-08 06:13:20',
                'updated_at' => '2023-11-08 06:13:20',
            ),
            3 => 
            array (
                'id' => 4,
                'permission_id' => 1,
                'name' => 'Delete',
                'key' => 'delete',
                'note' => NULL,
                'created_at' => '2023-11-08 06:13:24',
                'updated_at' => '2023-11-08 06:13:24',
            ),
            4 => 
            array (
                'id' => 5,
                'permission_id' => 1,
                'name' => 'Print',
                'key' => 'print',
                'note' => NULL,
                'created_at' => '2023-11-08 07:46:10',
                'updated_at' => '2023-11-08 07:46:10',
            ),
            5 => 
            array (
                'id' => 6,
                'permission_id' => 3,
                'name' => 'View',
                'key' => 'view',
                'note' => NULL,
                'created_at' => '2023-11-08 07:46:26',
                'updated_at' => '2023-11-08 07:46:26',
            ),
            6 => 
            array (
                'id' => 7,
                'permission_id' => 3,
                'name' => 'Create',
                'key' => 'create',
                'note' => NULL,
                'created_at' => '2023-11-08 07:46:31',
                'updated_at' => '2023-11-08 07:46:31',
            ),
            7 => 
            array (
                'id' => 8,
                'permission_id' => 3,
                'name' => 'Edit',
                'key' => 'edit',
                'note' => NULL,
                'created_at' => '2023-11-08 07:46:36',
                'updated_at' => '2023-11-08 07:46:36',
            ),
            8 => 
            array (
                'id' => 9,
                'permission_id' => 3,
                'name' => 'Delete',
                'key' => 'delete',
                'note' => NULL,
                'created_at' => '2023-11-08 07:46:40',
                'updated_at' => '2023-11-08 07:46:40',
            ),
        ));
        
        
    }
}