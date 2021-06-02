<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BoardsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('boards')->insert(array(
            array(
                "id"=> 1,
                "name"=>"SSC",
                "created_at"=>NULL,
                "updated_at"=> NULL 
            ),
            array(
                "id"=> 2,
                "name"=>"CBSE",
                "created_at"=>NULL,
                "updated_at"=> NULL 
            ),
            array(
                "id"=> 3,
                "name"=>"ICSE",
                "created_at"=>NULL,
                "updated_at"=> NULL 
            ),
            array(
                "id"=> 7,
                "name"=>"NMIMS",
                "created_at"=>NULL,
                "updated_at"=> NULL 
            ),
        ));
        
        // DB::select(DB::raw("INSERT INTO "boards" ("id", "name", "created_at", "updated_at") VALUES
        // (1, 'SSC', NULL, NULL),
        // (2, 'CBSE', NULL, NULL),
        // (3, 'ICSE', NULL, NULL),
        // (7, 'NMIMS', NULL, NULL);"));
    }
}
