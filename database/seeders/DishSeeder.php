<?php

namespace Database\Seeders;

use App\Models\Dish;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dishes = config("dishes");

        foreach ($dishes as $dish) {
            Dish::create([
                'restaurant_id' => $dish['restaurant_id'],
                'dish_name' => $dish['dish_name'],
                'ingredients' => $dish['ingredients'],
                'dish_price' => $dish['dish_price'],
                'visible' => $dish['visible'],
                'dish_image' => $dish['dish_image'],
            ]);
        }
    }
}
