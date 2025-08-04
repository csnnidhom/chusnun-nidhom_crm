<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::create([
            'user_id' => 2,
            'nama' => 'Nidhom1',
            'kontak' => 763839,
            'alamat' => 'surabaya',
        ]);

        Customer::create([
            'user_id' => 2,
            'nama' => 'Nidhom2',
            'kontak' => 763839,
            'alamat' => 'surabaya'
        ]);

        Customer::create([
            'user_id' => 3,
            'nama' => 'Nidhom3',
            'kontak' => 763839,
            'alamat' => 'surabaya'
        ]);

        Customer::create([
            'user_id' => 3,
            'nama' => 'Nidhom4',
            'kontak' => 763839,
            'alamat' => 'surabaya'
        ]);
    }
}
