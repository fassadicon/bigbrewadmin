<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use AjCastro\EagerLoadPivotRelations\EagerLoadPivotTrait;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Size extends Model
{
    use HasFactory, SoftDeletes, EagerLoadPivotTrait;

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
