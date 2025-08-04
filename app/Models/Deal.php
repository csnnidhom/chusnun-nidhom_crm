<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\Customer;
use App\Models\DealItem;

class Deal extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id','user_id','status','total_harga'
    ];

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function items(){
        return $this->hasMany(DealItem::class);
    }

    public function approvals()
    {
        return $this->hasOne(Approval::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public static function totalByStatus($status, $userId = null)
    {
        $query = self::where('status', $status);

        if ($userId) {
            $query->where('user_id', $userId);
        }

        return $query->count();
    }
}
