<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductCategory extends Model
{
    use HasFactory, SoftDeletes;
    use LogsActivity;

    protected $table = 'product_categories';
    protected $fillable = [
        'name',
        'description'
    ];

    public function scopeSearch($query, $value)
    {
        $query->where('name', 'like', "%{$value}%")
            ->orWhere('description', 'like', "%{$value}%");
    }

    public function productDetails(): HasMany
    {
        return $this->hasMany(ProductDetail::class, 'category_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'name',
                'description',
            ])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->useLogName('Product Categories')
            ->setDescriptionForEvent(fn (string $eventName) => "Product details has been {$eventName}");
    }
}
