<?php

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
        $this->call(UsersSeeder::class);
        $this->call(CategoriasSeeder::class);
        $this->call(RecetasSeeder::class);
        // $this->call(UsersTableSeeder::class);
    }
}
