<?php

namespace App\Livewire\Pos;

use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use Livewire\Component;
use App\Models\OrderItem;
use Livewire\Attributes\On;
use App\Models\InventoryLog;

class OrderSummary extends Component
{
    public $selectedProducts = [];
    public $currentTotalAmount = 0;
    // protected $listeners = ['productAdded'];

    #[On('productAdded')]
    public function productAdded($productId, $sizeId, $sizeName)
    {
        if (!in_array($productId, $this->selectedProducts)) {
            $this->selectedProducts[] = [
                'productDetailId' => $productId,
                'sizeId' => $sizeId,
                'sizeName' => $sizeName,
            ];
            // dd($this->selectedProducts);
            // $this->dispatch('refresh-order-summary');
        }
    }

    public function removeItem($index)
    {
        unset($this->selectedProducts[$index]);
        $this->selectedProducts = array_values($this->selectedProducts);
    }

    // #[On('refresh-order-summary')]
    // public function refresh()
    // {
    // }

    public function placeOrder()
    {
        $orderItems = [];
        $totalAmount = 0;
        foreach ($this->selectedProducts as $selectedProduct) {
            $product = Product::where('product_id', $selectedProduct['productDetailId'])
                ->where('size_id', $selectedProduct['sizeId'])
                ->first();

            $orderItem = [
                'product_id' => $product->id,
                'amount' => $product->price, // Multiply by quantity
                // Add quantity
            ];
            $totalAmount += $product->price;
            array_push($orderItems, $orderItem);
        }

        $this->dispatch('confirming-order', currentTotalAmount: $totalAmount);
        $this->dispatch('open-modal', 'confirm-order');

        // $payment = Payment::create([
        //     'payment_received' => $totalAmount, // Update
        //     'amount' => $totalAmount,
        //     'change' => 0 // Update
        // ]);

        // $order = Order::create([
        //     'user_id' => auth()->id(),
        //     'payment_id' => $payment->id,
        //     'total_amount' => $payment->amount,
        // ]);

        // foreach ($orderItems as $orderItem) {
        //     $orderItem['order_id'] = $order->id;
        //     OrderItem::create($orderItem);
        // }


        // $orderItemsCreated = OrderItem::where('order_id', $order->id)->get();
        // foreach ($orderItemsCreated as $orderItem) {
        //     $productInventoryItems = $orderItem->product->inventoryItems;
        //     foreach ($productInventoryItems as $productInventoryItem) {
        //         $consumptionValue = $productInventoryItem->pivot->consumption_value * $orderItem->quantity;
        //         $remainingStocks = $productInventoryItem->remaining_stocks;
        //         $newStocks = $remainingStocks - $consumptionValue;
        //         $productInventoryItem->update([
        //             'remaining_stocks' => $newStocks
        //         ]);

        //         InventoryLog::create([
        //             'inventory_item_id' => $productInventoryItem->id,
        //             'user_id' => 1,
        //             'type' => 'out',
        //             'amount' => $consumptionValue,
        //             'old_stock' => $remainingStocks,
        //             'new_stock' => $newStocks,
        //             'remarks' => 'Order for ' . $orderItem->product->productDetail->name
        //         ]);
        //     }
        // }

        // $this->selectedProducts = [];
        // dd('Order completed!');
    }

    public function render()
    {
        $total = $this->calculateTotal();

        return view('livewire.pos.order-summary', compact('total'));
    }

    public function calculateTotal()
    {
        $total = collect($this->selectedProducts)->sum('price');
        info('Total Calculated: ' . $total);
        return $total;
    }
}
