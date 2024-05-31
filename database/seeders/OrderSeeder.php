<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        function generateRandomUsers($numUsers) {
            $users = [];
            $names = ['Mario', 'Gino', 'Pietro', 'Alan', 'Miriam', 'Giulia', 'Luana', 'Laura', 'Andrea', 'Valeria'];
            $surnames = ['Rossi', 'Bianchi', 'Verdi', 'Neri', 'Gialli', 'Blu', 'Rosa', 'Grigi', 'Viola', 'Marroni'];
            $streets = ['Palermo', 'Ungaretti', 'Leopardi', 'Serpotta', 'Cagliari', 'Mattarella', 'Giulio Cesare', 'Roma', 'Libertà', 'San Domenico'];
            $startDate = Carbon::now()->subYear()->timestamp;
            $endDate = Carbon::now()->timestamp;
        
            for ($i = 0; $i < $numUsers; $i++) {
                $name = $names[array_rand($names)];
                $surname = $surnames[array_rand($surnames)];
                $email = strtolower($name) . strtolower($surname) . '@example.com';
                $phone = '+39 3456789' . str_pad($i + 1, 3, '0', STR_PAD_LEFT);
                $address = 'Via ' . $streets[array_rand($streets)] . ', ' . rand(1, 50) . ', ' . 'Milano';
                $totalPrice = rand(30, 200);
                $message = null;

                $randomTimestamp = rand($startDate, $endDate);
               
                $created_at = Carbon::createFromTimestamp($randomTimestamp);
        
                $users[] = [
                    'customer_name' => $name,
                    'customer_surname' => $surname,
                    'customer_email' => $email,
                    'customer_phone' => $phone,
                    'customer_address' => $address,
                    'total_price' => $totalPrice,
                    'message' => $message,
                    'created_at' => $created_at,
                    'updated_at' => $created_at, 

                ];
            }
        
            return $users;
        }

        $orders = generateRandomUsers(300);

        // Order::withoutEvents(function () use ($orders) {
        //     foreach ($orders as $order) {
        //         Order::create($order);
        //     }
        // });

        foreach ($orders as $order) {
            Order::create([

                'customer_name' => $order['customer_name'],
                'customer_surname' => $order['customer_surname'],
                'customer_email' => $order['customer_email'],
                'customer_phone' => $order['customer_phone'],
                'customer_address' => $order['customer_address'],
                'total_price' => $order['total_price'],
                'message' => $order['message'],
                'created_at' => $order['created_at'],
                'updated_at' => $order['updated_at'],



            ]);
            
        }
    }
}
