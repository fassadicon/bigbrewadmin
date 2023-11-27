<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InventoryLog extends Model
{
    use HasFactory;

    protected $table = 'inventory_logs';
    protected $fillable = [
        'inventory_item_id',
        'supplier',
        'user_id',
        'type',
        'amount',
        'remarks',
    ];

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function inventoryItem(): BelongsTo
    {
        return $this->belongsTo(InventoryItem::class);
    }

    // Functions
    public function scopeSearch($query, $value)
    {
        $query->whereHas('user', function ($query) use ($value) {
            $query->where('name', 'like', "%{$value}%");
        })
            ->orWhereHas('inventoryItem', function ($query) use ($value) {
                $query->where('name', 'like', "%{$value}%");
            })
            ->orWhere('supplier', 'like', "%{$value}%")
            ->orWhere('remarks', 'like', "%{$value}%");
    }
}
