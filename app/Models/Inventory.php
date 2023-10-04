<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

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

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_inventory');
    }
}
