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
                'name' => 'Admin User',
                'email' => 'adasdmin@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Test User',
                'email' => 'tasdadssdest@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'miriam',
                'email' => 'miriam@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'alan',
                'email' => 'alandest@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'mario',
                'email' => 'marion@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'alberto',
                'email' => 'albertodest@example.com',
                'password' => Hash::make('password'),
            ],
        ];

        foreach ($users as $userData) {
            User::create($userData);
        }
    }
}
