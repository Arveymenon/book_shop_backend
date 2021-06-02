<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::select(DB::raw(
            "

                INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
                (3, 'Complete Book Master Access', 'web', NULL, NULL),
                (4, 'Complete Package Master Access', 'web', NULL, NULL),
                (5, 'Complete All Orders Access', 'web', NULL, NULL),
                (6, 'Complete All Resale Access', 'web', NULL, NULL),
                (7, 'Complete Coupon Access', 'web', NULL, NULL),
                (8, 'Complete User Management Access', 'web', NULL, NULL),
                (9, 'Complete Roles Access', 'web', NULL, NULL);

            ") );
    }
}
