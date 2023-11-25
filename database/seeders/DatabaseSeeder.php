<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $this->call([
            ownerSeeder::class,
            shopsSeeder::class,
            ImageSeeder::class,
            ProductSeeder::class,
            StockSeeder::class,
            UserSeeder::class
        ]);
    }
}
