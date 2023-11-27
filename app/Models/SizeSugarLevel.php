<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SizeSugarLevel extends Pivot
{
    use HasFactory;

    use HasFactory;
    use LogsActivity;
    public $incrementing = true;

    protected $table = 'size_sugar_level';
    protected $fillable = [
        'product_id',
        'size_id',
        'price'
    ];

    // Relationships
    public function sugarLevel(): BelongsTo
    {
        return $this->belongsTo(SugarLevel::class, 'sugar_level_id', 'id');
    }

    public function size(): BelongsTo
    {
        return $this->belongsTo(Size::class);
    }


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'product_id',
                'size',
                'sugar_level',
            ])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->useLogName('Sugar Levels')
            ->setDescriptionForEvent(fn (string $eventName) => "Sugar Level has been {$eventName}");
    }
}
