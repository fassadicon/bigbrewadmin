<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'orders';
    protected $fillable = [
        'user_id',
        'payment_id',
        'discount_id',
        'total_amount',
        'status'
    ];

    // public function scopeSearch($query, $value)
    // {
    //     $query->where('name', 'like', "%{$value}%")
    //         ->orWhere('description', 'like', "%{$value}%")
    //         ->orWhere('measurement', 'like', "%{$value}%");
    // }


    // RELATIONSHIPS
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }

    public function discount(): BelongsTo
    {
        return $this->belongsTo(Discount::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // public function products(): HasManyThrough
    // {
    //     return $this->hasManyThrough(OrderItem::class, Product::class);
    // }

    // Functions
    // public function paid() {}
    // public function cancelled() {}
}
