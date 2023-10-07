<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdminLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'target_id',
        'target_type',
        'message',
    ];

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Functions
    public function products()
    {
        return $this->where('target_type', 'product');
    }

    public function categories()
    {
        return $this->where('target_type', 'category');
    }

    public function inventories()
    {
        return $this->where('target_type', 'inventory');
    }

    public function suppliers()
    {
        return $this->where('target_type', 'supplier');
    }

    public function accounts()
    {
        return $this->where('target_type', 'account');
    }
}
