<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InventoryItemSupplier extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'inventory_item_supplier';
    protected $fillable = [
        'inventory_id',
        'supplier_id'
    ];

}
