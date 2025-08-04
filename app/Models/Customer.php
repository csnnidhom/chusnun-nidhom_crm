<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Deal;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','nama', 'kontak', 'alamat', 'kebutuhan', 'status'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function deals(){
        return $this->hasMany(Deal::class);
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
