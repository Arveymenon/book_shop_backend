<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('customers')->insert(array(
            array(
                "id" => 1,
                "name" => "Arvey",
                "email" => 'arveymenon@gmail.com',
                "mobile" => '9920807002',
                "player_id" => '4a00675e-a4c4-4349-af55-de96920dd579',
                "created_at" => '2020-02-20 01:37:15',
                "updated_at" => '2020-02-20 01:37:15'
            )
        ));
    }
}
