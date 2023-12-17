<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\InventoryLog;
use App\Models\InventoryItem;
use Livewire\Attributes\Rule;
use Masmerise\Toaster\Toaster;

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
        // 10758
        return [
            'type' => 'required|numeric',
            'inventory_item_id' => 'required|numeric|exists:inventory_items,id',
            'amount' => 'required|numeric',
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

        if ($this->amount < 1) {
            Toaster::warning('Inventory movement amount must be greater than 0');
            return;
        }

        $inventoryItem = InventoryItem::where('id', $this->inventory_item_id)->first();

        if ($this->amount > $inventoryItem->remaining_stocks && ($this->type == 2 || $this->type == 3)) {
            $this->addError('amount', 'Amount is greater than remaining stocks');
            return;
        }

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
