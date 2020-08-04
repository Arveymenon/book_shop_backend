<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BoardsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::select(DB::raw("INSERT INTO `boards` (`id`, `name`, `created_at`, `updated_at`) VALUES
        (1, 'SSC', NULL, NULL),
        (2, 'CBSE', NULL, NULL),
        (3, 'ICSE', NULL, NULL),
        (7, 'NMIMS', NULL, NULL);"));
    }
}
