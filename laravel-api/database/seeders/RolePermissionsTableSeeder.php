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
                'permission_feature_id' => '[2,1,3,4,5]',
                'created_at' => '2023-11-08 08:05:31',
                'updated_at' => '2023-11-08 08:06:00',
            ),
            1 => 
            array (
                'id' => 6,
                'role_id' => 1,
                'permission_id' => 3,
                'permission_feature_id' => '[8,6,7,9]',
                'created_at' => '2023-11-08 08:05:33',
                'updated_at' => '2023-11-08 08:06:01',
            ),
        ));
        
        
    }
}