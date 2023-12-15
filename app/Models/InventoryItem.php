<?php

namespace App\Models;

use App\Models\Product;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use AjCastro\EagerLoadPivotRelations\EagerLoadPivotTrait;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class InventoryItem extends Model
{
    use HasFactory, SoftDeletes, EagerLoadPivotTrait;
    use LogsActivity;

    protected $table = 'inventory_items';
    protected $fillable = [
        'name',
        'description',
        'measurement',
        'remaining_stocks',
        'warning_value',
        'unit_price'
    ];

    public function scopeSearch($query, $value)
    {
        $query->where('name', 'like', "%{$value}%")
            ->orWhere('description', 'like', "%{$value}%")
            ->orWhere('measurement', 'like', "%{$value}%");
    }

    // Relationshiips
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(
            Product::class,
            'inventory_item_consumption',
            'inventory_item_id',
            'product_id',
        )
            ->withPivot(['id', 'consumption_value'])
            ->withTimestamps()
            ->using(InventoryItemConsumption::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'name',
                'description',
                'measurement',
                'warning_value',
            ])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->useLogName('Inventory Items')
            ->setDescriptionForEvent(fn (string $eventName) => "Inventory Item has been {$eventName}");
    }

    // public function category(): BelongsTo
    // {
    //     return $this->belongsTo(InventoryItemCategory::class, 'category_id');
    // }
    // public function productSizes()
    // {
    //     return $this->belongsToMany(ProductSize::class, 'product_size_inventory', 'inventory_id')
    //         ->withPivot('use_value')
    //         ->withTimestamps()
    //         ->using(ProductSizeInventory::class);
    // }

    // public function InventoryLogs(): HasMany
    // {
    //     return $this->hasMany(InventoryLog::class);
    // }

    // // Functions
    // public function active()
    // {
    //     return $this->where('status', 1);
    // }

    // public function inactive()
    // {
    //     return $this->where('status', 3);
    // }
}
