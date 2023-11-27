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

    public function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:product_categories,name',
            'measurement' => 'required|string',
            'description' => 'nullable|string',
            'remaining_stocks' => 'required|numeric',
            'warning_value' => 'required|numeric',
            'initial_supplier' => 'nullable',
        ];
    }

    public function validationAttributes()
    {
        return [
            'name' => 'name',
            'description' => 'description',
            'measurement' => 'description',
            'remaining_stocks' => 'remaining stocks',
            'warning_value' => 'warning value',
            'initial_supplier' => 'supplier',
        ];
    }

    public function store()
    {
        $this->validate();

        $inventoryItem = InventoryItem::create([
            'name' => $this->name,
            'description' => $this->description,
            'measurement' => $this->measurement,
            'remaining_stocks' => $this->remaining_stocks,
            'warning_value' => $this->warning_value,
        ]);

        $this->initial_supplier = $this->initial_supplier === null ? 'Big Brew' : $this->initial_supplier;
        InventoryLog::create([
            'inventory_item_id' => $inventoryItem->id,
            'supplier' => $this->initial_supplier,
            'user_id' => auth()->id(),
            'status' => 'in',
            'amount' => $inventoryItem->remaining_stocks,
            'old_stock' => 0,
            'new_stock' => $inventoryItem->remaining_stocks,
            'remarks' => 'Initial stock for ' . $inventoryItem->name
        ]);

        $this->reset();
    }
}
