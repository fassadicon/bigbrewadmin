<?php

namespace App\Livewire\DeliveryReceive;

use Livewire\Component;
use App\Models\InventoryLog;
use App\Models\InventoryItem;
use App\Models\PurchaseOrder;
use App\Models\DeliveryReceive;
use App\Models\DeliveryReceiveItem;
use Masmerise\Toaster\Toaster;

class Create extends Component
{
    public PurchaseOrder $selectedPurchaseOrder;
    public $deliveryReceiveItems;
    public $inventoryItems;

    public function rules()
    {
        return [
            'deliveryReceiveItems.*.quantity' => 'required|min:1',
        ];
    }

    public function mount(PurchaseOrder $purchaseOrder)
    {
        $this->selectedPurchaseOrder = $purchaseOrder->load('purchaseOrderItems', 'supplier', 'user');

        // $this->selectedPurchaseOrder = PurchaseOrder::with('purchaseOrderItems', 'supplier', 'user')
        // ->where('id', $purchaseOrderId)
        // ->first();
        foreach ($this->selectedPurchaseOrder->purchaseOrderItems as $purchaseOrderItem) {
            $this->deliveryReceiveItems[] =  [
                'purchase_order_item_id' => $purchaseOrderItem->id,
                'inventory_item_id' => $purchaseOrderItem->inventory_item_id,
                'expected_quantity' => $purchaseOrderItem->quantity,
                'quantity' => 0,
                'pending' => $purchaseOrderItem->quantity,
                'unit_measurement' => $purchaseOrderItem->unit_measurement,
                'unit_price' => $purchaseOrderItem->unit_price,
                'amount' => $purchaseOrderItem->amount,
                'description' => $purchaseOrderItem->description
            ];
        }
        $this->inventoryItems = InventoryItem::all();
    }

    public function updateReceived($key, $value)
    {
        foreach ($this->deliveryReceiveItems as $deliveryReceiveItem) {
            if ($deliveryReceiveItem['quantity'] != $deliveryReceiveItem['expected_quantity']) {
                Toaster::warning('Incorrect receive count!');
                return;
            }
        }

        $pending = floatval($this->deliveryReceiveItems[$key]['expected_quantity']) - floatval($value);
        $this->deliveryReceiveItems[$key]['pending'] = $pending;
        $this->deliveryReceiveItems[$key]['quantity'] = $value;
    }

    public function store()
    {
        $this->validate();
        dd($this->deliveryReceiveItems);
        $deliveryReceiveItemsCreated = [];
        $totalAmount = 0;
        // $incomplete = false;

        foreach ($this->deliveryReceiveItems as $deliveryReceiveItem) {
            if (floatval($deliveryReceiveItem['quantity']) != floatval($deliveryReceiveItem['expected_quantity'])) {
                Toaster::warning('Incorrect receive count!');
                return;
            }
        }
        foreach ($this->deliveryReceiveItems as $deliveryReceiveItem) {
            $deliveryReceiveItemsCreated[] =
                [
                    'purchase_order_item_id' => $deliveryReceiveItem['purchase_order_item_id'],
                    'user_id' => auth()->id(),
                    'inventory_item_id' => $deliveryReceiveItem['inventory_item_id'],
                    'quantity' => $deliveryReceiveItem['quantity'],
                    'pending' => $deliveryReceiveItem['pending'],
                    'unit_measurement' => $deliveryReceiveItem['unit_measurement'],
                    'unit_price' => $deliveryReceiveItem['unit_price'],
                    'amount' => floatval($deliveryReceiveItem['quantity']) * floatval($deliveryReceiveItem['unit_price']),
                    'description' => $deliveryReceiveItem['description']
                ];
            $totalAmount += floatval($deliveryReceiveItem['quantity']) * floatval($deliveryReceiveItem['unit_price']);
        }

        $deliveryReceive = DeliveryReceive::create([
            'user_id' => 1,
            'purchase_order_id' => $this->selectedPurchaseOrder->id,
            'total_amount' => $totalAmount
        ]);

        foreach ($deliveryReceiveItemsCreated as $deliveryReceiveItem) {
            $deliveryReceiveItem['delivery_receive_id'] = $deliveryReceive->id;
            DeliveryReceiveItem::create($deliveryReceiveItem);
        }

        // foreach ($this->selectedPurchaseOrder->purchaseOrderItems as $key => $purchaseOrderItem) {
        //     $purchaseOrderItem->update([
        //         'status' => $deliveryReceiveItemsCreated[$key]['status']
        //     ]);
        // }

        $this->selectedPurchaseOrder->update([
            'status' => 2
        ]);

        foreach ($deliveryReceive->deliveryReceiveItems as $deliveryReceiveItem) {
            $addedStock = $deliveryReceiveItem->quantity;
            $remainingStocks = $deliveryReceiveItem->inventoryitem->remaining_stocks;
            $newStocks = $remainingStocks + $addedStock;
            $deliveryReceiveItem->inventoryItem->update([
                'remaining_stocks' => $newStocks
            ]);

            InventoryLog::create([
                'inventory_item_id' => $deliveryReceiveItem->inventoryItem->id,
                'user_id' => auth()->id(),
                'type' => 'in',
                'amount' => $addedStock,
                'old_stock' => $remainingStocks,
                'new_stock' => $newStocks,
                'remarks' => "Added stock from PO: " . $deliveryReceive->purchaseOrder->id .
                    "-" .
                    $deliveryReceiveItem->purchaseOrderItem->id .
                    " DR: " .
                    $deliveryReceive->id .
                    "-" .
                    $deliveryReceiveItem->id .
                    " for " .
                    $deliveryReceiveItem->inventoryItem->name
            ]);
        }

        Toaster::success('Delivery receive created successfully');
        return redirect()->route('delivery-receives');
    }

    // public function selectPurchaseOrder($purchaseOrderId)
    // {
    //     $this->selectedPurchaseOrder = PurchaseOrder::with('purchaseOrderItems', 'supplier', 'user')
    //         ->where('id', $purchaseOrderId)
    //         ->first();
    //     foreach ($this->selectedPurchaseOrder->purchaseOrderItems as $purchaseOrderItem) {
    //         $this->deliveryReceiveItems[] =  [
    //             'purchase_order_item_id' => $purchaseOrderItem->id,
    //             'inventory_item_id' => $purchaseOrderItem->inventory_item_id,
    //             'expected_quantity' => $purchaseOrderItem->quantity,
    //             'quantity' => 0,
    //             'pending' => $purchaseOrderItem->quantity,
    //             'unit_measurement' => $purchaseOrderItem->unit_measurement,
    //             'unit_price' => $purchaseOrderItem->unit_price,
    //             'amount' => $purchaseOrderItem->amount,
    //             'description' => $purchaseOrderItem->description
    //         ];
    //     }

    //     // dd($this->deliveryReceiveItems);

    // }

    public function render()
    {
        // dd($this->selectedPurchaseOrder->purchaseOrderItems->pluck('inventory_item_id')->toArray());
        return view('livewire.delivery-receive.create');
    }
}
