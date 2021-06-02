<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $users = array(
            array(
                "name" => 'Arvey Menon',
                "email" => "arveymenon@gmail.com",
                "email_verified_at" => NULL,
                "password" => '$2y$10$OPAcXvgFaD8Wnf.Ei3MluOXvfwnlErn76XHA4iBGLx5f0GNu5vutm',
                "remember_token" => NULL
            ),
        );

        DB::table('users')->insert($users);
    }
}
