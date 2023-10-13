<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Size extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'sizes';
    protected $fillable = [
        'name'
    ];

    // Relationships
    public function productDetails(): BelongsToMany
    {
        return $this->belongsToMany(ProductDetail::class, 'products', 'size_id')
            // ->as('product')
            ->withPivot(['price', 'id'])
            ->withTimestamps()
            ->using(Product::class);
    }
}
