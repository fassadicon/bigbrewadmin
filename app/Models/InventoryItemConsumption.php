<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InventoryItemConsumption extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'inventory_item_consumption';
    protected $fillable = [
        'product_id',
        'inventory_item_id',
        'consumption_value'
    ];

}
