<?php

use Illuminate\Database\Seeder;

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
        DB::select(DB::raw(
            "
            INSERT INTO `product_tags` (`id`, `product_id`, `product_type`, `tag`, `created_at`, `updated_at`) VALUES
            (1, 1, 3, 'history', '2020-02-18 01:23:17', '2020-02-18 01:23:17'),
            (2, 1, 3, 'SSC', '2020-02-18 01:23:17', '2020-02-18 01:23:17'),
            (3, 1, 1, 'History', NULL, NULL),
            (4, 1, 1, 'SSC', NULL, NULL);
            ") );
    }
}
