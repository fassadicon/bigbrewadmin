<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Discount extends Model
{
    use HasFactory, SoftDeletes;
    use LogsActivity;

    protected $table = 'discounts';
    protected $fillable = [
        'name',
        'type',
        'value',
        'start_date',
        'end_date',
        'status',
    ];

    public function scopeSearch($query, $value)
    {
        $query->where('name', 'like', "%{$value}%");
    }

    // Relationships
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    // Functions
    public function ongoing()
    {
        return $this->where('status', 1);
    }

    public function expired()
    {
        return $this->where('status', 2);
    }

    public function scheduled()
    {
        return $this->where('status', 3);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'name',
                'type',
                'value',
                'start_date',
                'end_date',
                'status',
            ])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->useLogName('Discounts')
            ->setDescriptionForEvent(fn (string $eventName) => "Discount has been {$eventName}");
    }
}
