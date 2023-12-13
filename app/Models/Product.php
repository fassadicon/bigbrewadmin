<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Product extends Pivot
{
    use HasFactory;
    use LogsActivity;
    public $incrementing = true;

    protected $table = 'products';
    protected $fillable = [
        'product_id',
        'size_id',
        'price'
    ];

    // Relationships
    public function productDetail(): BelongsTo
    {
        return $this->belongsTo(ProductDetail::class, 'product_id', 'id');
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

    public function orderItems(): HasMany {
        return $this->hasMany(OrderItem::class, 'product_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'product_id',
                'size.name',
                'price',
            ])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->useLogName('Products')
            ->setDescriptionForEvent(fn (string $eventName) => "Product price/size has been {$eventName}");
    }
}
