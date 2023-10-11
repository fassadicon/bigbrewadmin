<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class InventoryItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'inventory_items';
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'measurement',
        'stock_value',
        'warning_value',
        'image_path'
    ];

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
