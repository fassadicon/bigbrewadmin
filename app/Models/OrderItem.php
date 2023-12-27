<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class OrderItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'order_items';
    protected $fillable = [
        'order_id',
        'product_id',
        'sugar_level_id',
        'quantity',
        'amount'
    ];

    // Relationships
    // public function products(): HasMany
    // {
    //     return $this->hasMany(Product::class);
    // }
    public function sugarLevel() : BelongsTo {
        return $this->belongsTo(SizeSugarLevel::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    // public function productDetail(): BelongsTo {
    //     return $this->belongsTo(ProductDetail::class, 'product_id', 'id');
    // }

    public function product(): BelongsTo {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

}
