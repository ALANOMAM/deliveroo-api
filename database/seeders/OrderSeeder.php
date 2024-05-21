<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = config("orders");

        foreach ($orders as $order) {
            Order::create([
                'customer_name' => $order['customer_name'],
                'customer_surname' => $order['customer_surname'],
                'customer_email' => $order['customer_email'],
                'customer_phone' => $order['customer_phone'],
                'customer_address' => $order['customer_address'],
                'total_price' => $order['total_price'],
                'message' => $order['message'],
            ]);
            
        }
    }
}
