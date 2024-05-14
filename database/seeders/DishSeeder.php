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
        //
        $newDish = new Dish();

        $newDish->restaurant_id = 1;
        $newDish->dish_name = "Margherita";
        $newDish->dish_price = 20.50;
        $newDish->visible = true;
        $newDish->dish_image = " ";
        $newDish->ingredients = implode(' , ', ["salt","mozzarella","tomato"]);
        //questo ci serve per salvare i campi e applicare e modifiche
        $newDish->save();





    }
}
