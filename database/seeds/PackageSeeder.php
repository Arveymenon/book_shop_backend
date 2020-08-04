<?php

use Illuminate\Database\Seeder;

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
        DB::select(DB::raw(
            "
            INSERT INTO `packages` (`id`, `name`, `image`, `mrp_in_rupees`, `board_id`, `language_id`, `active`, `created_at`, `updated_at`) VALUES
            (1, 'test history package', 'cover_images/history.jpg', '500', 1, 2, 1, '2020-02-18 01:23:17', '2020-02-18 01:23:17');
            ") );
    }
}
