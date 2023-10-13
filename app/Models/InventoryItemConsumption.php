<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class InventoryItemConsumption extends Pivot
{
    use HasFactory, SoftDeletes;

    protected $table = 'inventory_item_consumption';
    protected $fillable = [
        'product_id',
        'inventory_item_id',
        'consumption_value'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class,);
    }

    public function inventoryItem(): BelongsTo
    {
        return $this->belongsTo(InventoryItem::class);
    }

}
