<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\CategoryRestaurant;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call([
            UserSeeder::class,
            RestaurantSeeder::class,
            CategorySeeder::class,
            DishSeeder::class,
            CategoryRestaurantTableSeeder::class,
            OrderSeeder::class,
            DishOrderTableSeeder::class,
        ]);
    }
}
