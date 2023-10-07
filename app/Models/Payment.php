<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'method',
        'link_id',
        'payment_id',
        'url',
        'amount',
        'status',
    ];

    // Relationships
    public function order(): HasOne
    {
        return $this->hasOne(Order::class);
    }
}
