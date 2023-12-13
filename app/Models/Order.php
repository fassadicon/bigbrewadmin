<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Order extends Model
{
    use HasFactory, SoftDeletes;
    use LogsActivity;

    protected $table = 'orders';
    protected $fillable = [
        'user_id',
        'payment_id',
        'discount_id',
        'total_amount',
        'customer_name',
        'status'
    ];

    public function scopeSearch($query, $value)
    {
        $query->where('id', $value)
            ->orWhereHas(
                'user',
                function ($query) use ($value) {
                    $query->where('name', 'like', "%$value%");
                }
            );
    }


    // RELATIONSHIPS
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }

    public function discount(): BelongsTo
    {
        return $this->belongsTo(Discount::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'user_id',
                'payment_id',
                'discount_id',
                'total_amount',
                'status',
                'payment.method',
                'payment.payment_received',
                'payment.amount',
                'payment.change',
                'payment.details',
                'orderItems',
            ])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->useLogName('Orders')
            ->setDescriptionForEvent(fn (string $eventName) => "Order details has been {$eventName}");
    }

    // public function products(): HasManyThrough
    // {
    //     return $this->hasManyThrough(OrderItem::class, Product::class);
    // }

    // Functions
    // public function paid() {}
    // public function cancelled() {}
}
