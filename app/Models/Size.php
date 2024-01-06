<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use AjCastro\EagerLoadPivotRelations\EagerLoadPivotTrait;
use Database\Seeders\SizeSugarLevelSeeder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Size extends Model
{
    use HasFactory, SoftDeletes, EagerLoadPivotTrait;
    use LogsActivity;

    protected $table = 'sizes';
    protected $fillable = [
        'name',
        'alias',
        'measurement',
        'description'
    ];

    public function scopeSearch($query, $value)
    {
        $query->where('name', 'like', "%{$value}%")
            ->orWhere('description', 'like', "%{$value}%")
            ->orWhere('measurement', 'like', "%{$value}%");
    }

    // Relationships
    public function productDetails(): BelongsToMany
    {
        return $this->belongsToMany(ProductDetail::class, 'products', 'size_id', 'product_id')
            ->withPivot(['price', 'id'])
            ->withTimestamps()
            ->using(Product::class);
    }

    public function sugarLevels(): BelongsToMany
    {
        return $this->belongsToMany(SugarLevel::class, 'size_sugar_level', 'size_id', 'sugar_level_id')
            ->withPivot(['consumption_value', 'id'])
            ->withTimestamps()
            ->using(SizeSugarLevel::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'name',
                'measurement',
                'description',
            ])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->useLogName('Product Sizes')
            ->setDescriptionForEvent(fn (string $eventName) => "Product size has been {$eventName}");
    }
}
