<?php

namespace App\Livewire\Forms;

use App\Models\InventoryItem;
use App\Models\InventoryLog;
use Livewire\Attributes\Rule;
use Livewire\Form;

class CreateInventoryLogForm extends Form
{
    public $type;
    public $inventory_item_id;
    public $amount;
    public $supplier;
    public $remarks;
    public $user_id;

    public function rules()
    {
        return [
            'type' => 'required|string',
            'inventory_item_id' => 'required|numeric|exists:inventory_items,id',
            'amount' => 'required|numeric|gt:0',
            'supplier' => 'nullable',
            'remarks' => 'nullable',
        ];
    }

    public function validationAttributes()
    {
        return [
            'type' => 'type',
            'inventory_item_id' => 'inventory item',
            'amount' => 'amount',
            'supplier' => 'supplier',
            'remarks' => 'remarks',
        ];
    }

    public function store()
    {
        $this->validate();

        $this->user_id = auth()->id();
        $this->supplier = $this->supplier === null ? 'Big Brew' : $this->supplier;

        InventoryLog::create($this->all());

        $inventoryItem = InventoryItem::where('id', $this->inventory_item_id)->first();
        $newStock = $inventoryItem->remaining_stocks;

        if ($this->type === 'out') {
            $newStock -= $this->amount;
        } else {
            $newStock += $this->amount;
        }

        $inventoryItem->update([
            'remaining_stocks' => $newStock
        ]);

        $this->reset();
    }
}
