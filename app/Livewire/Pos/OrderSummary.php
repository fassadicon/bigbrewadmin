<?php

namespace App\Livewire\Pos;

use App\Models\InventoryItem;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use Livewire\Component;
use App\Models\OrderItem;
use Livewire\Attributes\On;
use App\Models\InventoryLog;
use App\Models\SizeSugarLevel;

class OrderSummary extends Component
{
    public $selectedProducts = [];
    public $currentTotalAmount = 0;
    public $payment = [
        'method' => 1,
        'payment_received' => 0,
        'amount' => 0,
        'change' => 0,
        'details' => ''
    ];

    protected function rules()
    {
        $rules = [
            'payment.payment_received' => 'required|numeric|min:' . $this->currentTotalAmount
        ];
        return $rules;
    }

    #[On('productAdded')]
    public function productAdded($productId)
    {
        $product = Product::with('productDetail', 'size')->where('id', $productId)->first();
        $defaultSugarLevelId = SizeSugarLevel::where('size_id', $product->size->id)
            ->orderByDesc('id')
            ->pluck('id')
            ->first();

        $this->selectedProducts[] = [
            'product' => $product,
            'quantity' => 1,
            'sugarLevelId' => $defaultSugarLevelId
        ];
    }

    public function editSugarLevel($key, $sugarLevelId)
    {
        $this->selectedProducts[$key]['sugarLevelId'] = $sugarLevelId;
    }

    public function removeItem($index)
    {
        unset($this->selectedProducts[$index]);
        $this->selectedProducts = array_values($this->selectedProducts);
    }

    public function addQuantity($key)
    {
        $currentQuantity = $this->selectedProducts[$key]['quantity'];
        $this->selectedProducts[$key]['quantity'] = $currentQuantity + 1;
        $this->computeCurrentTotalAmount();
    }

    public function subtractQuantity($key)
    {
        $currentQuantity = $this->selectedProducts[$key]['quantity'];
        if ($currentQuantity <= 1) {
            dd('Product must be equal or more than 1');
        }
        $this->selectedProducts[$key]['quantity'] = $currentQuantity - 1;
        $this->computeCurrentTotalAmount();
    }

    public function updateChange()
    {
        $this->validate();

        $this->payment['change'] = floatval($this->payment['payment_received']) - $this->currentTotalAmount;
    }

    public function placeOrder()
    {
        dd($this->selectedProducts);
        $this->computeCurrentTotalAmount();
        $this->payment['amount'] = $this->currentTotalAmount;
        $this->dispatch('open-modal', 'confirm-order');
    }

    private function computeCurrentTotalAmount()
    {
        $totalAmount = 0;
        foreach ($this->selectedProducts as $selectedProduct) {
            $totalAmount += $selectedProduct['product']->price * $selectedProduct['quantity'];
        }
        $this->currentTotalAmount = $totalAmount;
    }


    public function completeOrder()
    {
        $orderItems = [];
        foreach ($this->selectedProducts as $selectedProduct) {
            $orderItems[] = [
                'product_id' => $selectedProduct['product']->id,
                'amount' => $selectedProduct['product']->price * $selectedProduct['quantity'],
                'quantity' => $selectedProduct['quantity'],
                'sugar_level_id' => $selectedProduct['sugarLevelId']
            ];
        }

        $payment = Payment::create($this->payment);

        $order = Order::create([
            'user_id' => auth()->id(),
            'payment_id' => $payment->id,
            'total_amount' => $payment->amount,
        ]);
        foreach ($orderItems as $key => $orderItem) {
            $orderItem['order_id'] = $order->id;
            OrderItem::create($orderItem);

            $sugarConsumptionValue = SizeSugarLevel::where('id', $orderItem['sugar_level_id'])->pluck('consumption_value')->first();
            $sugar = InventoryItem::where('name', 'sugar')->first();
            $remainingStocks = $sugar->remaining_stocks;
            $newStocks = $remainingStocks - $sugarConsumptionValue;
            $sugar->update([
                'remaining_stocks' => $newStocks
            ]);
            InventoryLog::create([
                'inventory_item_id' => $sugar->id,
                'user_id' => 1,
                'type' => 'out',
                'amount' => $sugarConsumptionValue,
                'old_stock' => $remainingStocks,
                'new_stock' => $newStocks,
                'remarks' => 'Order for ' . $this->selectedProducts[$key]['product']->productDetail->name
            ]);
        }

        $orderItemsCreated = OrderItem::where('order_id', $order->id)->get();
        foreach ($orderItemsCreated as $orderItem) {
            $productInventoryItems = $orderItem->product->inventoryItems;
            foreach ($productInventoryItems as $productInventoryItem) {
                $consumptionValue = $productInventoryItem->pivot->consumption_value * $orderItem->quantity;
                $remainingStocks = $productInventoryItem->remaining_stocks;
                $newStocks = $remainingStocks - $consumptionValue;
                $productInventoryItem->update([
                    'remaining_stocks' => $newStocks
                ]);

                InventoryLog::create([
                    'inventory_item_id' => $productInventoryItem->id,
                    'user_id' => 1,
                    'type' => 'out',
                    'amount' => $consumptionValue,
                    'old_stock' => $remainingStocks,
                    'new_stock' => $newStocks,
                    'remarks' => 'Order for ' . $orderItem->product->productDetail->name
                ]);
            }
        }



        $this->selectedProducts = [];
        dd('Order completed!');
    }

    public function render()
    {
        $total = $this->computeCurrentTotalAmount();

        return view('livewire.pos.order-summary', compact('total'));
    }
}
