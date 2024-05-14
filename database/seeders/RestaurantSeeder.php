<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $restaurants = config("restaurants");

        foreach ($restaurants as $restaurant) {
            $newRestaurant = new Restaurant;
            $newRestaurant->user_id = $restaurant['user_id'];
            $newRestaurant->restaurant_name = $restaurant['restaurant_name'];
            $newRestaurant->phone = $restaurant['phone'];
            $newRestaurant->vat = $restaurant['vat'];
            $newRestaurant->image = $restaurant['image'];
            $newRestaurant->address = $restaurant['address'];
            $newRestaurant->save();
        }
    }
}
