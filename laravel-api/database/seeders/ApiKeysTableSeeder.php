<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ApiKeysTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('api_keys')->delete();
        
        \DB::table('api_keys')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Web',
                'key' => 'web',
                'api_key' => 'abc',
                'note' => 'no',
                'active' => 1,
                'created_at' => '2023-11-10 05:33:47',
                'updated_at' => '2023-11-10 05:33:47',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Android',
                'key' => 'android',
                'api_key' => 'kkkkk',
                'note' => 'no',
                'active' => 1,
                'created_at' => '2023-11-10 05:52:20',
                'updated_at' => '2023-11-10 05:52:20',
            ),
        ));
        
        
    }
}