<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Pivot
{
    use HasFactory, SoftDeletes;

    protected $table = 'products';
    protected $fillable = [
        'product_id',
        'size_id',
        'price'
    ];

    // Relationships
    public function productDetail(): BelongsTo
    {
        return $this->belongsTo(ProductDetail::class, 'id');
    }

    public function size(): BelongsTo
    {
        return $this->belongsTo(Size::class);
    }

    public function inventoryItems(): BelongsToMany
    {
        return $this->belongsToMany(
            InventoryItem::class,
            'inventory_item_consumption',
            'product_id'
        )
            ->withPivot(['id', 'consumption_value'])
            ->withTimestamps()
            ->using(InventoryItemConsumption::class);
    }

    // public function inventories(): BelongsToMany
    // {
    //     return $this->belongsToMany(Inventory::class, 'product_size_inventory', 'product_size_id')
    //         ->withPivot('use_value')
    //         ->withTimestamps()
    //         ->using(ProductSizeInventory::class);
    // }
}
