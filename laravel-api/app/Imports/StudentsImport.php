<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use DB;

class StudentsImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $index => $row) 
        {
            if($index > 0){
                if(!DB::table('students')->where(['name' => $row[0]])->exists()){
                    $id = DB::table('students')->insertGetId([
                        'name' => $row[0],
                        'age' => $row[1]
                    ]);
                }
            }
        }
    }
}
