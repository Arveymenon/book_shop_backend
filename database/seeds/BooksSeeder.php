<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::select(DB::raw("INSERT INTO `books` (`name`, `image`, `mrp_in_rupees`, `board_id`, `subject`, `authors`, `language_id`, `print_date`, `standard`, `refurbished_available`, `active`, `created_at`, `updated_at`) VALUES
        ( 'History CBSC', 'cover_images/history.jpg', '230', 2, 'History', NULL, 1, NULL, '1st', 1, 1, NULL, NULL),
        ( 'English SSC', 'cover_images/eng.jpg', '100', 1, 'Hindi', 'Someone', 1, NULL, 'blah', 0, 1, NULL, NULL),
        ( 'Marathi SSC', 'cover_images/marathi.jpg', '50', 1, 'Marathi', 'test', 1, NULL, '3rd', 0, 1, NULL, NULL),
        ( 'Hindi SSC', 'cover_images/hindi.jpg', '30', 1, 'Hindi', 'Someeone', 1, NULL, '4th', 0, 1, NULL, NULL),
        ( 'Operation Studies 2nd Year', 'cover_images/production.jpg', '300', 7, 'Operation Studies', NULL, 1, NULL, '2nd Year', 1, 1, NULL, NULL);"));
    }
}
