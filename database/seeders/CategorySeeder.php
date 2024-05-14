<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Cinese',
            'Pizzeria',
            'Messicano',
            'Giapponese',
            'Fast food',
            'Vegetariano',
            'Vegano',
            'Italiano',
            'Hamburger',
            'Sushi',
            'Kebab',
            'Gourmet',
            'Osteria',
            'Trattoria',
            'Panineria',
        ];

        foreach($categories as $category) {

            $newCategory = new Category();

            $newCategory->category_name = $category;

            $newCategory->save();

        }
    }
}
