<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'manager',
            'email' => 'manager@gmail.com',
            'password' => Hash::make('manager123'),
            'role' => 'manager'
        ]);

        User::create([
            'name' => 'sales',
            'email' => 'sales@gmail.com',
            'password' => Hash::make('sales123'),
            'role' => 'sales'
        ]);

        User::create([
            'name' => 'sales2',
            'email' => 'sales2@gmail.com',
            'password' => Hash::make('sales123'),
            'role' => 'sales'
        ]);
    }
}
