<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'nama_produk' => 'Paket Internet 50Mbps',
            'hpp' => 200000,
            'margin' => 50,
            'harga_jual' => 300000
        ]);

        Product::create([
            'nama_produk' => 'Paket Internet 100Mbps',
            'hpp' => 350000,
            'margin' => 43,
            'harga_jual' => 500000
        ]);
    }
}
