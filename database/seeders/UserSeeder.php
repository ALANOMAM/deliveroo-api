<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Alan',
                'email' => 'alan@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Pietro',
                'email' => 'pietro@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Miriam',
                'email' => 'miriam@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Mario',
                'email' => 'mario@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Pitagora',
                'email' => 'pitagora@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Alberta',
                'email' => 'alberta@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Pamela',
                'email' => 'pamela@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Tizio',
                'email' => 'tizio@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Kevin',
                'email' => 'kevin@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Simona',
                'email' => 'simona@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Ignazio',
                'email' => 'ignazio@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Gigi',
                'email' => 'gigi@example.com',
                'password' => Hash::make('password'),
            ],
        ];

        foreach ($users as $userData) {
            User::create($userData);
        }
    }
}
