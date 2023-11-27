<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SugarLevel extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'percentage',
    ];

    public function sizes(): BelongsToMany
    {
        return $this->belongsToMany(SugarLevel::class, 'size_sugar_level', 'sugar_level_id', 'size_id')
            ->withPivot(['consumption_value', 'id'])
            ->withTimestamps()
            ->using(SizeSugarLevel::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
