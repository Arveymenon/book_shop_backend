<?php

use Illuminate\Database\Seeder;

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
        DB::select(DB::raw(
        "
            INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
            (1, 'Arvey Menon', 'arveymenon@gmail.com', NULL, '$2y$10$OPAcXvgFaD8Wnf.Ei3MluOXvfwnlErn76XHA4iBGLx5f0GNu5vutm', NULL, '2020-03-08 04:15:36', '2020-03-08 04:15:36');
            ") );
    }
}
