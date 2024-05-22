<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DishOrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $associations = config("associations");

        // Inserimento delle associazioni nella tabella dish_order
        foreach ($associations as $association) {
            DB::table('dish_order')->insert([

                'dish_id' => $association['dish_id'],
                'order_id' => $association['order_id'],
                'price' => $association['price'],
                'quantity' => $association['quantity'],
                
            ]);
    
        }
    }

}