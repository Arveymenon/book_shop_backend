<?php

use Illuminate\Database\Seeder;

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
