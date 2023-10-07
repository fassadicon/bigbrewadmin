<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Discount extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'type',
        'value',
        'start_date',
        'end_date',
        'status',
    ];

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
}
