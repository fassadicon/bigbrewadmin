<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ProductDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'product_details';
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'status',
        'image_path'
    ];

    // Relationships
    // public function sizes(): BelongsToMany
    // {
    //     return $this->belongsToMany(Size::class, 'products', 'product_id')
    //         ->withPivot('price')
    //         ->as('product')
    //         ->withTimestamps();
    // }

    public function sizes(): BelongsToMany
    {
        return $this->belongsToMany(Size::class, 'products', 'product_id', 'size_id')
            ->as('product')
            ->withPivot('price')
            ->withTimestamps();
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'id');
    }

    // public function inventories(): BelongsToMany
    // {
    //     return $this->belongsToMany(ProductSize::class, 'product_size_inventory')->withPivot('use_value')->withTimestamps();
    // }

    // public function orderItems(): BelongsTo
    // {
    //     return $this->BelongsTo(OrderItem::class);
    // }


    // // Functions
    // public function active()
    // {
    //     return $this->where('status', 1);
    // }

    // public function inactive()
    // {
    //     return $this->where('status', 0);
    // }
}
