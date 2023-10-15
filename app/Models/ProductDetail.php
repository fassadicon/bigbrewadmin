<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use AjCastro\EagerLoadPivotRelations\EagerLoadPivotTrait;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ProductDetail extends Model
{
    use HasFactory, SoftDeletes, EagerLoadPivotTrait;

    protected $table = 'product_details';
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'status',
        'image_path'
    ];

    public function sizes(): BelongsToMany
    {
        return $this->belongsToMany(Size::class, 'products', 'product_id', 'size_id')
            // ->as('product')
            ->withPivot(['id', 'price'])
            ->withTimestamps()
            ->using(Product::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function scopeSearch($query, $value) {
        $query->where('name', 'like', "%{$value}%");
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
