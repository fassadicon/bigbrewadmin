<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DeliveryReceiveItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'delivery_receive_id',
        'purchase_order_item_id',
        'user_id',
        'inventory_item_id',
        'quantity',
        'pending',
        'unit_measurement',
        'unit_price',
        'amount',
        'description',
        'status'
    ];

    public function deliveryReceive() : BelongsTo {
        return $this->belongsTo(DeliveryReceive::class);
    }

    public function inventoryItem() : BelongsTo {
        return $this->belongsTo(inventoryItem::class);
    }

    public function purchaseOrderItem() : BelongsTo {
        return $this->belongsTo(PurchaseOrderItem::class);
    }

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }
}
