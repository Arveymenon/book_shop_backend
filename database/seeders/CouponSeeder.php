<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('coupons')->insert(array(
            array(
                "id" => 1,
                "code" => "TEST",
                "uses" => 0,
                "max_uses" => 20,
                "max_user" => 10,
                "max_user_uses" => 2,
                "minimum_cart_total" => 200,
                "minimum_cart_total_type" => 1,
                "minimum_cart_total_type_value" => 150,
                "discount_amount" => 50,
                "discount_type" => 2,
                "created_at" => NULL,
                "updated_at" => NULL
            )
        ));
    }
}
