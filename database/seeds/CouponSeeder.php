<?php

use Illuminate\Database\Seeder;

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
        DB::select(DB::raw(" INSERT INTO `coupons` (`id`, `code` ,`uses`, `max_uses`, `max_user`, `max_user_uses`, `minimum_cart_total`, `minimum_cart_total_type`, `minimum_cart_total_type_value`, `discount_amount`, `discount_type`, `created_at`, `updated_at`)
                VALUES (1,'TEST', 0, 20, 10, 2, 200, 1, 150, 50, 2, NULL, NULL);"
                ) );
    }
}
