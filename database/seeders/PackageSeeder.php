<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $packages = array(
            array(
                "id" => 1,
                "name" => "History Package",
                "image" => "cover_images/history.jpg",
                "mrp_in_rupees" =>"500",
                "board_id" => 1,
                "language_id" => 2,
                "active" => 1,
                "created_at" => NULL,
                "updated_at" => NULL
            ),
        );

        DB::table('packages')->insert($packages);
    }
}
