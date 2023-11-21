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
            9 => 
            array (
                'id' => 10,
                'permission_id' => 4,
                'name' => 'View',
                'key' => 'view',
                'note' => NULL,
                'created_at' => '2023-11-13 06:49:07',
                'updated_at' => '2023-11-13 06:49:07',
            ),
            10 => 
            array (
                'id' => 11,
                'permission_id' => 4,
                'name' => 'Create',
                'key' => 'create',
                'note' => NULL,
                'created_at' => '2023-11-13 06:49:12',
                'updated_at' => '2023-11-13 06:49:12',
            ),
            11 => 
            array (
                'id' => 12,
                'permission_id' => 4,
                'name' => 'Edit',
                'key' => 'edit',
                'note' => NULL,
                'created_at' => '2023-11-13 06:49:17',
                'updated_at' => '2023-11-13 06:49:17',
            ),
            12 => 
            array (
                'id' => 13,
                'permission_id' => 4,
                'name' => 'Delete',
                'key' => 'delete',
                'note' => NULL,
                'created_at' => '2023-11-13 06:49:22',
                'updated_at' => '2023-11-13 06:49:22',
            ),
            13 => 
            array (
                'id' => 14,
                'permission_id' => 5,
                'name' => 'View',
                'key' => 'view',
                'note' => NULL,
                'created_at' => '2023-11-13 06:49:28',
                'updated_at' => '2023-11-13 06:49:28',
            ),
            14 => 
            array (
                'id' => 15,
                'permission_id' => 5,
                'name' => 'Create',
                'key' => 'create',
                'note' => NULL,
                'created_at' => '2023-11-13 06:49:32',
                'updated_at' => '2023-11-13 06:49:32',
            ),
            15 => 
            array (
                'id' => 16,
                'permission_id' => 5,
                'name' => 'Edit',
                'key' => 'edit',
                'note' => NULL,
                'created_at' => '2023-11-13 06:49:36',
                'updated_at' => '2023-11-13 06:49:36',
            ),
            16 => 
            array (
                'id' => 17,
                'permission_id' => 5,
                'name' => 'Delete',
                'key' => 'delete',
                'note' => NULL,
                'created_at' => '2023-11-13 06:49:40',
                'updated_at' => '2023-11-13 06:49:40',
            ),
            17 => 
            array (
                'id' => 18,
                'permission_id' => 6,
                'name' => 'View',
                'key' => 'view',
                'note' => NULL,
                'created_at' => '2023-11-13 06:49:47',
                'updated_at' => '2023-11-13 06:49:47',
            ),
            18 => 
            array (
                'id' => 19,
                'permission_id' => 6,
                'name' => 'Create',
                'key' => 'create',
                'note' => NULL,
                'created_at' => '2023-11-13 06:49:52',
                'updated_at' => '2023-11-13 06:49:52',
            ),
            19 => 
            array (
                'id' => 20,
                'permission_id' => 6,
                'name' => 'Edit',
                'key' => 'edit',
                'note' => NULL,
                'created_at' => '2023-11-13 06:49:55',
                'updated_at' => '2023-11-13 06:49:55',
            ),
            20 => 
            array (
                'id' => 21,
                'permission_id' => 6,
                'name' => 'Delete',
                'key' => 'delete',
                'note' => NULL,
                'created_at' => '2023-11-13 06:49:59',
                'updated_at' => '2023-11-13 06:49:59',
            ),
            21 => 
            array (
                'id' => 22,
                'permission_id' => 7,
                'name' => 'View',
                'key' => 'view',
                'note' => NULL,
                'created_at' => '2023-11-16 07:13:55',
                'updated_at' => '2023-11-16 07:13:55',
            ),
            22 => 
            array (
                'id' => 23,
                'permission_id' => 7,
                'name' => 'Create',
                'key' => 'create',
                'note' => NULL,
                'created_at' => '2023-11-16 07:14:03',
                'updated_at' => '2023-11-16 07:14:03',
            ),
            23 => 
            array (
                'id' => 24,
                'permission_id' => 7,
                'name' => 'Edit',
                'key' => 'edit',
                'note' => NULL,
                'created_at' => '2023-11-16 07:14:11',
                'updated_at' => '2023-11-16 07:14:11',
            ),
            24 => 
            array (
                'id' => 25,
                'permission_id' => 7,
                'name' => 'Delete',
                'key' => 'delete',
                'note' => NULL,
                'created_at' => '2023-11-16 07:14:18',
                'updated_at' => '2023-11-16 07:14:18',
            ),
            25 => 
            array (
                'id' => 26,
                'permission_id' => 7,
                'name' => 'Archive',
                'key' => 'archive',
                'note' => NULL,
                'created_at' => '2023-11-20 06:18:06',
                'updated_at' => '2023-11-20 06:18:06',
            ),
            26 => 
            array (
                'id' => 27,
                'permission_id' => 7,
                'name' => 'Book Marked',
                'key' => 'bookmark',
                'note' => NULL,
                'created_at' => '2023-11-21 06:13:45',
                'updated_at' => '2023-11-21 06:13:45',
            ),
        ));
        
        
    }
}