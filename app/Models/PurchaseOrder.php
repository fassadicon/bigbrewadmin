<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PurchaseOrder extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'total_amount',
        'status'
    ];

    public function purchaseOrderItems() : HasMany {
        return $this->hasMany(PurchaseOrderItem::class);
    }

    public function deliveryReceive() : HasMany {
        return $this->hasMany(DeliveryReceive::class);
    }

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

}
