<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';
    protected $fillable = [
        'method',
        'payment_received',
        'amount',
        'change',
        'details'
    ];

    // Relationships
    public function order(): HasOne
    {
        return $this->hasOne(Order::class);
    }
}
