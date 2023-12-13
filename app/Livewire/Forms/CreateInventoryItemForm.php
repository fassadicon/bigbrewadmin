<?php

namespace App\Livewire\Forms;

use App\Models\InventoryItem;
use App\Models\InventoryLog;
use Livewire\Attributes\Rule;
use Livewire\Form;

class CreateInventoryItemForm extends Form
{
    public $name;
    public $measurement;
    public $description;
    public $remaining_stocks;
    public $warning_value;
    public $initial_supplier;
    public $unit_price;

    public function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:product_categories,name',
            'measurement' => 'required|string',
            'description' => 'nullable|string',
            'remaining_stocks' => 'nullable|numeric',
            'warning_value' => 'nullable|numeric',
            'initial_supplier' => 'required|exists:suppliers,id',
            'unit_price' => 'numeric|min:0'
        ];
    }

    public function validationAttributes()
    {
        return [
            'name' => 'name',
            'description' => 'description',
            'measurement' => 'measurement',
            'remaining_stocks' => 'remaining stocks',
            'warning_value' => 'warning value',
            'initial_supplier' => 'supplier',
            'unit_price' => 'price'
        ];
    }

    public function store()
    {
        $this->validate();

        $inventoryItem = InventoryItem::create([
            'name' => $this->name,
            'description' => $this->description,
            'measurement' => $this->measurement,
            'remaining_stocks' => $this->remaining_stocks ? $this->remaining_stocks : 0,
            'warning_value' => $this->warning_value ? $this->warning_value : 0,
            'unit_price' => $this->unit_price
        ]);

        InventoryLog::create([
            'inventory_item_id' => $inventoryItem->id,
            'supplier' => $this->initial_supplier,
            'user_id' => auth()->id(),
            'status' => 'in',
            'amount' => $inventoryItem->remaining_stocks,
            'old_stock' => 0,
            'new_stock' => $inventoryItem->remaining_stocks,
            'remarks' => 'Created ' . $inventoryItem->name . ' with an initial stock of ' . $this->remaining_stocks
        ]);

        $this->reset();
    }
}
