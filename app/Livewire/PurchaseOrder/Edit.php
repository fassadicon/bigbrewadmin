<?php

namespace App\Livewire\PurchaseOrder;

use Livewire\Component;
use App\Models\Supplier;
use Livewire\Attributes\On;
use App\Models\InventoryItem;
use App\Models\PurchaseOrder;
use Masmerise\Toaster\Toaster;
use App\Models\PurchaseOrderItem;

class Edit extends Component
{
    public PurchaseOrder $purchaseOrder;
    public $purchaseOrderItems;
    public $suppliers;
    public $inventoryItems;
    public $supplier_id;
    public $currentPOItems;

    public function rules()
    {
        return [
            'supplier_id' => 'required|exists:suppliers,id',
            'purchaseOrderItems.*.quantity' => 'required|min:1',
            'purchaseOrderItems.*.inventory_item_id' => 'required|exists:inventory_items,id'
        ];
    }

    public function attributes()
    {
        return [
            'supplier_id' => 'Supplier',
            'purchaseOrderItems.*.quantity' => 'Quantity',
            'purchaseOrderItems.*.inventory_item_id' => 'Inventory Item'
        ];
    }


    public function mount()
    {
        $this->purchaseOrder->load('purchaseOrderItems');

        $this->supplier_id = $this->purchaseOrder->supplier_id;
        foreach ($this->purchaseOrder->purchaseOrderItems as $purchaseOrderitem) {
            $this->purchaseOrderItems[] =  [
                'id' => $purchaseOrderitem->id,
                'inventory_item_id' => $purchaseOrderitem->inventory_item_id,
                'quantity' => $purchaseOrderitem->quantity,
                'unit_measurement' => $purchaseOrderitem->unit_measurement,
                'unit_price' => $purchaseOrderitem->unit_price,
                'amount' => $purchaseOrderitem->amount,
                'description' => $purchaseOrderitem->description
            ];

            $this->currentPOItems[] = $purchaseOrderitem->id;
        }

        $this->suppliers = Supplier::all();
        $this->inventoryItems = InventoryItem::all();
    }

    public function addPurchaseOrderItem()
    {
        if ($this->purchaseOrderItems[count($this->purchaseOrderItems) - 1]['inventory_item_id'] === '') {
            Toaster::warning('Please fill the PO Item details before adding a new one');
            return;
        }

        $this->purchaseOrderItems[] =
            [
                'id' => '',
                'inventory_item_id' => '',
                'quantity' => 1,
                'unit_measurement' => '',
                'unit_price' => 0,
                'amount' => 0,
                'description' => ''
            ];
    }

    public function removePurchaseOrderItem($key) {
        unset($this->purchaseOrderItems[$key]);
        $this->purchaseOrderItems = array_values($this->purchaseOrderItems);
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
        if ($inventoryItem) {
            $this->purchaseOrderItems[$key]['unit_measurement'] = $inventoryItem->measurement;
            $this->purchaseOrderItems[$key]['unit_price'] = $inventoryItem->unit_price;
            $this->purchaseOrderItems[$key]['amount'] = floatval($this->purchaseOrderItems[$key]['quantity']) * floatval($inventoryItem->unit_price);
        } else {
            $this->purchaseOrderItems[$key]['unit_measurement'] = null;
            $this->purchaseOrderItems[$key]['unit_price'] = null;
            $this->purchaseOrderItems[$key]['amount'] = null;
            $this->purchaseOrderItems[$key]['quantity'] = null;
        }
    }


    public function update()
    {
        $this->validate();

        $totalAmount = 0;
        foreach ($this->purchaseOrderItems as $purchaseOrderItem) {
            $totalAmount += $purchaseOrderItem['amount'];
        }

        $purchaseOrder = PurchaseOrder::where('id', $this->purchaseOrder->id)->first();

        $purchaseOrder->update([
            'user_id' => auth()->id(),
            'supplier_id' => $this->supplier_id,
            'total_amount' => $totalAmount,
        ]);
        // dd($this->purchaseOrderItems);
        $newPurchaseOrderItems = [];
        foreach ($this->purchaseOrderItems as $purchaseOrderItem) {
            if ($purchaseOrderItem['id'] != '') {
                if (in_array($purchaseOrderItem['id'], $this->currentPOItems)) {
                    PurchaseOrderItem::where('id', $purchaseOrderItem['id'])->update([
                        'purchase_order_id' => $purchaseOrder->id,
                        'user_id' => auth()->id(),
                        'inventory_item_id' => $purchaseOrderItem['inventory_item_id'],
                        'quantity' => $purchaseOrderItem['quantity'],
                        'unit_measurement' => $purchaseOrderItem['unit_measurement'],
                        'unit_price' => $purchaseOrderItem['unit_price'],
                        'amount' => $purchaseOrderItem['amount'],
                        'description' => $purchaseOrderItem['description']
                    ]);
                    $newPurchaseOrderItems[] = intval($purchaseOrderItem['id']);
                }
            } else {
                $newPOItem = PurchaseOrderItem::create([
                    'purchase_order_id' => $purchaseOrder->id,
                    'user_id' => auth()->id(),
                    'inventory_item_id' => $purchaseOrderItem['inventory_item_id'],
                    'quantity' => $purchaseOrderItem['quantity'],
                    'unit_measurement' => $purchaseOrderItem['unit_measurement'],
                    'unit_price' => $purchaseOrderItem['unit_price'],
                    'amount' => $purchaseOrderItem['amount'],
                    'description' => $purchaseOrderItem['description']
                ]);
                $newPurchaseOrderItems[] = $newPOItem->id;
            }
        }

        foreach ($this->currentPOItems as $currentPOItemId) {
            if (!in_array($currentPOItemId, $newPurchaseOrderItems)) {
                PurchaseOrderItem::where('id', $currentPOItemId)->delete();
            }
        }

        Toaster::success('Purchase Order updated successfully!');
        return redirect()->route('purchase-orders');
    }

    #[On('supplier-created')]
    public function loadSuppliers()
    {
        $this->suppliers = Supplier::select('id', 'name')->get();
    }

    public function render()
    {
        return view('livewire.purchase-order.edit');
    }
}
