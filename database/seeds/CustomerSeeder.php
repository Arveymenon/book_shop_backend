<?php

use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::select(DB::raw("
        INSERT INTO `customers` (`id`, `name`, `email`, `mobile`, `player_id`, `created_at`, `updated_at`) VALUES
                                (1, 'Arvey', 'arveymenon@gmail.com', '9920807002', '4a00675e-a4c4-4349-af55-de96920dd579', '2020-02-20 01:37:15', '2020-02-20 01:37:15');"
                ) );
    }
}
