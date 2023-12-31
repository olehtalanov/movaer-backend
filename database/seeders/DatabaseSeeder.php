<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UsersSeeder::class,
            ServicesSeeder::class,
            CountriesSeeder::class,
            WishesSeeder::class,
            PagesSeeder::class,
        ]);
    }
}
