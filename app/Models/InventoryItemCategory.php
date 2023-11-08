<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InventoryItemCategory extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'inventory_item_categories';
    protected $fillable = [
        'name',
        'description'
    ];
}
