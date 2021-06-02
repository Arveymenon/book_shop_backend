<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $productTags = array(
            array("product_id" => 1, "product_type" => 3, "tag"=> "History"),
            array("product_id" => 1, "product_type" => 3, "tag"=> "SSC"),
            array("product_id" => 1, "product_type" => 1, "tag"=> "History"),
            array("product_id" => 1, "product_type" => 1, "tag"=> "SSC"),
        );

        DB::table('product_tags')->insert($productTags);
    }
}
