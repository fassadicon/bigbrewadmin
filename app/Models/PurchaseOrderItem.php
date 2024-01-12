<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PurchaseOrderItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'purchase_order_id',
        'user_id',
        'inventory_item_id',
        'quantity',
        'unit_measurement',
        'unit_price',
        'amount',
        'description',
        'status'
    ];

    public function purchaseOrder() : BelongsTo {
        return $this->belongsTo(PurchaseOrder::class);
    }

    public function inventoryItem() : BelongsTo {
        return $this->belongsTo(InventoryItem::class);
    }

    public function deliveryReceiveItems() : HasMany {
        return $this->hasMany(DeliveryReceiveItem::class);
    }

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

}
