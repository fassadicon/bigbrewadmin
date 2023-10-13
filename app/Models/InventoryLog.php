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
        'inventory_id',
        'supplier_id',
        'user_id',
        'status',
        'message',
        'remarks',
    ];

    // Relationships
    // public function user(): BelongsTo
    // {
    //     return $this->belongsTo(User::class);
    // }

    // public function supplier(): BelongsTo
    // {
    //     return $this->belongsTo(Supplier::class);
    // }

    // public function inventory(): BelongsTo
    // {
    //     return $this->belongsTo(Inventory::class);
    // }

    // Functions
    public function in()
    {
        return $this->where('status', 1);
    }

    public function out()
    {
        return $this->where('status', 2);
    }
}
