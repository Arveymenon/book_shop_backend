<?php

use Illuminate\Database\Seeder;

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
        DB::select(DB::raw(
        " INSERT INTO `particular_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
                    (1, 'sub-total', NULL, NULL),
                    (2, 'coupon', NULL, NULL),
                    (3, 'tax', NULL, NULL),
                    (4, 'total', NULL, NULL);
        ") );
    }
}
