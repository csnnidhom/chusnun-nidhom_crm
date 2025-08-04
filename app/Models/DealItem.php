<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Deal;
use App\Models\Product;

class DealItem extends Model
{
    use HasFactory; 

    protected $fillable = [
        'deal_id', 'product_id', 'harga_deal'
    ];

    public function deal(){
        return $this->belongsTo(Deal::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
