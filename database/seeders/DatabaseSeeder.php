<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(BooksSeeder::class);
        $this->call(BoardsSeeder::class);
        $this->call(LanguageSeeder::class);
        $this->call(CouponSeeder::class);
        $this->call(ParticularTypesSeeder::class);
        $this->call(PackageSeeder::class);
        $this->call(ProductsTagsSeeder::class);
        $this->call(UserSeeder::class);
    }
}
