<?php

namespace App\Livewire\PurchaseOrder;

use Livewire\Component;
use App\Models\Supplier;
use App\Models\InventoryItem;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;

class Create extends Component
{
    public $suppliers;
    public $inventoryItems;
    public $purchaseOrderItems = [];
    public $selectedInventoryItems = [];
    public $supplier_id;

    public function mount()
    {
        $this->suppliers = Supplier::all();
        $this->inventoryItems = InventoryItem::all();
        $this->purchaseOrderItems = [
            [
                'inventory_item_id' => '',
                'quantity' => 1,
                'unit_measurement' => '',
                'unit_price' => 0,
                'amount' => 0,
                'description' => ''
            ]
        ];
    }

    public function addPurchaseOrderItem()
    {
        if ($this->purchaseOrderItems[count($this->purchaseOrderItems) - 1]['inventory_item_id'] === '') {
            dd('Please fill the PO Item details before adding a new one');
        }

        $this->purchaseOrderItems[] =
            [
                'inventory_item_id' => '',
                'quantity' => 1,
                'unit_measurement' => '',
                'unit_price' => 0,
                'amount' => 0,
                'description' => ''
            ];
    }

    public function updateAmount($key, $value)
    {
        $this->purchaseOrderItems[$key]['amount'] = floatval($value) * floatval($this->purchaseOrderItems[$key]['unit_price']);
    }

    public function inventoryItemSelected($key, $value)
    {
        $this->purchaseOrderItems[$key]['inventory_item_id'] = $value;
        $inventoryItem = InventoryItem::select('measurement', 'unit_price')
            ->where('id', $value)
            ->first();
        $this->purchaseOrderItems[$key]['unit_measurement'] = $inventoryItem->measurement;
        $this->purchaseOrderItems[$key]['unit_price'] = $inventoryItem->unit_price;
        $this->purchaseOrderItems[$key]['amount'] = floatval($this->purchaseOrderItems[$key]['quantity']) * floatval($inventoryItem->unit_price);
    }

    public function store()
    {
        $totalAmount = 0;
        foreach ($this->purchaseOrderItems as $purchaseOrderItem) {
            $totalAmount += $purchaseOrderItem['amount'];
        }

        $purchaseOrder = PurchaseOrder::create([
            'user_id' => auth()->id(),
            'supplier_id' => $this->supplier_id, // 1 - BigBrew, 2 and others new suppliers
            'total_amount' => $totalAmount,
        ]);

        foreach ($this->purchaseOrderItems as $purchaseOrderItem) {
            $purchaseOrderItem['purchase_order_id'] = $purchaseOrder->id;
            $purchaseOrderItem['user_id'] = auth()->id();
            PurchaseOrderItem::create($purchaseOrderItem);
        }
    }

    public function render()
    {
        return view('livewire.purchase-order.create');
    }
}
