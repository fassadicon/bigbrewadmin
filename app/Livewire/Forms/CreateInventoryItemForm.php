<?php

namespace App\Livewire\Forms;

use App\Models\InventoryItem;
use Livewire\Attributes\Rule;
use Livewire\Form;

class CreateInventoryItemForm extends Form
{
    public $name;
    public $measurement;
    public $description;
    public $remaining_stocks;
    public $warning_value;
    public $initial_supplier = 'Big Brew';

    public function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:product_categories,name',
            'measurement' => 'required|string',
            'description' => 'nullable|string',
            'remaining_stocks' => 'required|numeric',
            'warning_value' => 'required|numeric',
            'initial_supplier' => 'required|string',
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

        InventoryItem::create([
            'name' => $this->name,
            'description' => $this->description,
            'measurement' => $this->measurement,
            'remaining_stocks' => $this->remaining_stocks,
            'warning_value' => $this->warning_value,
        ]);

        $this->reset();
    }
}
