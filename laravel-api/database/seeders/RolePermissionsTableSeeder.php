<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolePermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('role_permissions')->delete();
        
        \DB::table('role_permissions')->insert(array (
            0 => 
            array (
                'id' => 5,
                'role_id' => 1,
                'permission_id' => 1,
                'permission_feature_id' => '[4,5,3,1,2]',
                'created_at' => '2023-11-08 08:05:31',
                'updated_at' => '2023-11-13 06:20:27',
            ),
            1 => 
            array (
                'id' => 6,
                'role_id' => 1,
                'permission_id' => 3,
                'permission_feature_id' => '[8,9,7,6]',
                'created_at' => '2023-11-08 08:05:33',
                'updated_at' => '2023-11-16 06:04:31',
            ),
            2 => 
            array (
                'id' => 7,
                'role_id' => 1,
                'permission_id' => 4,
                'permission_feature_id' => '[10,11,12,13]',
                'created_at' => '2023-11-13 06:50:04',
                'updated_at' => '2023-11-13 06:50:12',
            ),
            3 => 
            array (
                'id' => 8,
                'role_id' => 1,
                'permission_id' => 5,
                'permission_feature_id' => '[15,16,17,14]',
                'created_at' => '2023-11-13 06:50:05',
                'updated_at' => '2023-11-13 07:35:03',
            ),
            4 => 
            array (
                'id' => 9,
                'role_id' => 1,
                'permission_id' => 6,
                'permission_feature_id' => '[19,20,21,18]',
                'created_at' => '2023-11-13 06:50:05',
                'updated_at' => '2023-11-13 07:34:06',
            ),
            5 => 
            array (
                'id' => 10,
                'role_id' => 3,
                'permission_id' => 1,
                'permission_feature_id' => '[1,2,3,4,5]',
                'created_at' => '2023-11-13 06:54:42',
                'updated_at' => '2023-11-13 06:54:46',
            ),
            6 => 
            array (
                'id' => 11,
                'role_id' => 3,
                'permission_id' => 3,
                'permission_feature_id' => '[6,7,8,9]',
                'created_at' => '2023-11-13 06:54:49',
                'updated_at' => '2023-11-13 06:54:52',
            ),
            7 => 
            array (
                'id' => 12,
                'role_id' => 3,
                'permission_id' => 5,
                'permission_feature_id' => '[15,16,17,14]',
                'created_at' => '2023-11-13 07:34:50',
                'updated_at' => '2023-11-13 07:35:28',
            ),
            8 => 
            array (
                'id' => 13,
                'role_id' => 3,
                'permission_id' => 4,
                'permission_feature_id' => '[]',
                'created_at' => '2023-11-16 07:08:27',
                'updated_at' => '2023-11-16 07:08:28',
            ),
            9 => 
            array (
                'id' => 14,
                'role_id' => 1,
                'permission_id' => 7,
                'permission_feature_id' => '[24,25,22,23,26,27]',
                'created_at' => '2023-11-16 07:14:22',
                'updated_at' => '2023-11-21 06:14:02',
            ),
            10 => 
            array (
                'id' => 15,
                'role_id' => 3,
                'permission_id' => 7,
                'permission_feature_id' => '[22,23,24,25,26,27]',
                'created_at' => '2023-11-20 06:25:33',
                'updated_at' => '2023-11-21 06:14:06',
            ),
            11 => 
            array (
                'id' => 16,
                'role_id' => 1,
                'permission_id' => 8,
                'permission_feature_id' => '["28","29","30","31"]',
                'created_at' => '2023-11-29 13:42:23',
                'updated_at' => '2023-11-29 13:42:26',
            ),
            12 => 
            array (
                'id' => 17,
                'role_id' => 3,
                'permission_id' => 8,
                'permission_feature_id' => '["28","29","30","31"]',
                'created_at' => '2023-11-29 14:26:04',
                'updated_at' => '2023-11-29 14:26:07',
            ),
        ));
        
        
    }
}