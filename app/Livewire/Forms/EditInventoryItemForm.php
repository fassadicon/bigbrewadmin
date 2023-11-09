<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\InventoryItem;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Reactive;

class EditInventoryItemForm extends Form
{
    public InventoryItem $inventoryItem;

    public $name;
    public $measurement;
    public $description;
    public $warning_value;

    public function loadFields(InventoryItem $inventoryItem)
    {
        $this->inventoryItem = $inventoryItem;
        $this->name = $inventoryItem->name;
        $this->measurement = $inventoryItem->measurement;
        $this->description = $inventoryItem->description;
        $this->warning_value = $inventoryItem->warning_value;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:inventory_items,name,' . $this->inventoryItem->id,
            'measurement' => 'required|string',
            'description' => 'nullable|string',
            'warning_value' => 'required|numeric',
        ];
    }

    public function validationAttributes()
    {
        return [
            'name' => 'name',
            'description' => 'description',
            'measurement' => 'description',
            'warning_value' => 'warning value',
        ];
    }

    public function update()
    {
        $this->validate();

        $this->inventoryItem->update([
            'name' => $this->name,
            'description' => $this->description,
            'measurement' => $this->measurement,
            'warning_value' => $this->warning_value,
        ]);
    }
}
