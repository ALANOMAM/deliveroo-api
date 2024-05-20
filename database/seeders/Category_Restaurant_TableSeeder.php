<?php

namespace Database\Seeders;

use App\Models\Category_Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Category_Restaurant_TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mixedCategories = config("mixedCategories");

        foreach ($mixedCategories as $dataCategory) {

            $newRow = new Category_Restaurant();

            $newRow->category_id = $dataCategory['category_id'];
            $newRow->restaurant_id = $dataCategory['restaurant_id'];


            $newRow->save();
            
        }
    }
}
