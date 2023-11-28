<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class SizeSugarLevel extends Pivot
{
    use HasFactory;
    use LogsActivity;

    public $incrementing = true;

    protected $table = 'size_sugar_level';
    protected $fillable = [
        'sugar_level_id',
        'size_id',
        'consumption_value'
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
                'size_id',
                'consumption_value',
                'sugar_level_id',
            ])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->useLogName('Sugar Levels')
            ->setDescriptionForEvent(fn (string $eventName) => "Sugar Level has been {$eventName}");
    }
}
