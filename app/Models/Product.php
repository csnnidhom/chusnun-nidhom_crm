<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DealItem;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_produk', 'hpp','margin','harga_jual'
    ];

    public function dealItems(){
        return $this->hasMany(DealItem::class);
    }

    protected static function booted(){
        static::saving(function ($product){
            $product->harga_jual = $product->hpp + ($product->hpp * $product->margin / 100);
        });
    }


}
