<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InventoryItemConsumption extends Model
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
