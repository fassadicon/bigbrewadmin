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
        'supplier_id',
        'user_id',
        'type',
        'amount',
        'old_stock',
        'new_stock',
        'remarks',
    ];

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class)->withTrashed();
    }

    public function inventoryItem(): BelongsTo
    {
        return $this->belongsTo(InventoryItem::class)->withTrashed();
    }

    // Functions
    public function scopeSearch($query, $value)
    {
        $query->whereHas('inventoryItem', function ($query) use ($value) {
                $query->where('name', 'like', "%{$value}%");
            });
            // ->orWhere('remarks', 'like', "%{$value}%");
    }
}
