<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use AjCastro\EagerLoadPivotRelations\EagerLoadPivotTrait;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class ProductDetail extends Model
{
    use HasFactory, SoftDeletes, EagerLoadPivotTrait;
    use LogsActivity;

    protected $table = 'product_details';
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'image_path'
    ];

    public function sizes(): BelongsToMany
    {
        return $this->belongsToMany(Size::class, 'products', 'product_id', 'size_id')
            ->withPivot(['id', 'price'])
            ->withTimestamps()
            ->using(Product::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function scopeSearch($query, $value)
    {
        $query->where('name', 'like', "%{$value}%")
            ->orWhere('description', 'like', "%{$value}%");
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'name',
                'description',
                'image_path',
                'category.name',
            ])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->useLogName('Products')
            ->setDescriptionForEvent(fn (string $eventName) => "Product details has been {$eventName}");
    }
}
