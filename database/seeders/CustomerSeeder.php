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
            'nama' => 'Ole Romeny',
            'kontak' => 01234,
            'alamat' => 'surabaya',
        ]);

        Customer::create([
            'user_id' => 2,
            'nama' => 'Marcelino Ferdinan',
            'kontak' => 56789,
            'alamat' => 'surabaya'
        ]);

        Customer::create([
            'user_id' => 3,
            'nama' => 'Calvin Verdonk',
            'kontak' => 01231,
            'alamat' => 'surabaya'
        ]);

        Customer::create([
            'user_id' => 3,
            'nama' => 'Justin Hubner',
            'kontak' => 48575,
            'alamat' => 'surabaya'
        ]);
    }
}
