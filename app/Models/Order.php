<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'order_type',
        'type',
        'amount',
        'exchange_rate_toman',
        'wallet',
        'txid',
        'e_vocher',
        'activation_code',
        'bank_account_id',
        'bank_gateway',
        'bank_recive_code',
        'description',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
