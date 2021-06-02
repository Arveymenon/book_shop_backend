<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParticularTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $particulars = array(
            array("name"=> "sub-total"),
            array("name"=> "coupon"),
            array("name"=> "tax"),
            array("name"=> "total")
        );

        DB::table('particular_types')->insert($particulars);
    }
}
