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
    public $supplier_id;
    public $remarks;
    public $user_id;

    public function rules()
    {
        return [
            'type' => 'required|numeric',
            'inventory_item_id' => 'required|numeric|exists:inventory_items,id',
            'amount' => 'required|numeric|gt:0',
            'supplier_id' => 'required',
            'remarks' => 'nullable',
        ];
    }

    public function validationAttributes()
    {
        return [
            'type' => 'type',
            'inventory_item_id' => 'inventory item',
            'amount' => 'amount',
            'supplier_id' => 'supplier',
            'remarks' => 'remarks',
        ];
    }

    public function store()
    {
        $this->validate();

        $inventoryItem = InventoryItem::where('id', $this->inventory_item_id)->first();
        $remainingStock = $inventoryItem->remaining_stocks;
        $newStock = 0;
        if ($this->type == 2 || $this->type == 3) {
            $newStock = $remainingStock - $this->amount;
        } else {
            $newStock = $remainingStock + $this->amount;
        }
        $inventoryItem->update([
            'remaining_stocks' => $newStock
        ]);

        InventoryLog::create([
            'inventory_item_id' => $inventoryItem->id,
            'user_id' => auth()->id(),
            'type' => $this->type,
            'amount' => $this->amount,
            'old_stock' => $remainingStock,
            'new_stock' => $newStock,
            'remarks' => $this->remarks
        ]);


        $this->reset();
    }
}
