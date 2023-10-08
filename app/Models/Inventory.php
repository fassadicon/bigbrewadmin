<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Inventory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'type',
        'measurement',
        'stock_value',
        'warning_value',
        'status',
        'image'
    ];

    // Relationships
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_inventory')->withTimestamps();
    }

    public function InventoryLogs(): HasMany
    {
        return $this->hasMany(InventoryLog::class);
    }

     // Functions
     public function active()
     {
         return $this->where('status', 1);
     }

     public function inactive()
     {
         return $this->where('status', 3);
     }
}
