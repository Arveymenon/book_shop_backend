<?php

namespace Database\Seeders;

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
        DB::table('books')->insert(array(
            array("name"=> 'History CBSC',
             "image"=> 'cover_images/history.jpg',
             "mrp_in_rupees" => '230',
             "board_id" => 2, 
             "subject" => 'History',
             "authors" => NULL, 
             "language_id" => 1,
             "print_date" => NULL,
             "standard" => '1st',
             "refurbished_available" => 1,
             "active" => 1,
             "created_at" => NULL,
             "updated_at" => NULL
            ),
            array("name"=> 'English SSC',
             "image"=> 'cover_images/english.jpg',
             "mrp_in_rupees" => '100',
             "board_id" => 1, 
             "subject" => 'English',
             "authors" => NULL, 
             "language_id" => 1,
             "print_date" => NULL,
             "standard" => '1st',
             "refurbished_available" => 0,
             "active" => 1,
             "created_at" => NULL,
             "updated_at" => NULL
            ),
            array("name"=> 'Marathi SSC',
             "image"=> 'cover_images/marathi.jpg',
             "mrp_in_rupees" => '50',
             "board_id" => 1, 
             "subject" => 'Marathi',
             "authors" => 'test', 
             "language_id" => 1,
             "print_date" => NULL,
             "standard" => '4th',
             "refurbished_available" => 0,
             "active" => 1,
             "created_at" => NULL,
             "updated_at" => NULL
            ),
            array("name"=> 'Hindi SSC',
             "image"=> 'cover_images/hindi.jpg',
             "mrp_in_rupees" => '30',
             "board_id" => 1, 
             "subject" => 'Hindi',
             "authors" => 'test', 
             "language_id" => 1,
             "print_date" => NULL,
             "standard" => '4th',
             "refurbished_available" => 1,
             "active" => 1,
             "created_at" => NULL,
             "updated_at" => NULL
            ),
            array("name"=> 'Operation Studies 2nd Year',
             "image"=> 'cover_images/production.jpg',
             "mrp_in_rupees" => '300',
             "board_id" => 7, 
             "subject" => 'Operation Studies',
             "authors" => 'test', 
             "language_id" => 1,
             "print_date" => NULL,
             "standard" => '4th',
             "refurbished_available" => 1,
             "active" => 1,
             "created_at" => NULL,
             "updated_at" => NULL
            ),
        ));
    }
}
