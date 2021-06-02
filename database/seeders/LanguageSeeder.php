<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('languages')->delete();
        $languages = array(
            array('name' => "English"),
            array('name' => "Hindi"),
            array('name' => "Marathi")
        );

        DB::table('languages')->insert($languages);
    }
}
