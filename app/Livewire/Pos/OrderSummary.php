<?php

namespace App\Livewire\Pos;

use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use Livewire\Component;
use App\Models\OrderItem;
use Livewire\Attributes\On;
use App\Models\InventoryLog;
use App\Models\InventoryItem;
use App\Models\SizeSugarLevel;
use Illuminate\Support\Carbon;
use Masmerise\Toaster\Toaster;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderSummary extends Component
{
    public $selectedProducts = [];
    public $currentTotalAmount = 0;
    public $currentInventoryConsumption = [];

    #[On('productAdded')]
    public function productAdded($productId)
    {
        $product = Product::with('productDetail', 'size')->where('id', $productId)->first();

        if (!$product) {
            Toaster::warning('Product not found!');
            return;
        }

        // $productInventoryItems = $product->inventoryItems;
        // foreach ($productInventoryItems as $productInventoryItem) {
        //     if ($productInventoryItem->remaining_stocks <= 0 || $productInventoryItem->trashed()) {
        //         Toaster::warning($product->productDetail->name . ' cannot be added.' . $productInventoryItem->name . ' is out of stock. Please add stocks and/or revise your current order.');
        //         return;
        //     }
        // }

        $newProductInCart = false;
        foreach ($this->selectedProducts as $key => $selectedProduct) {
            if ($selectedProduct['product']->id == $productId) {
                $newProductInCart = true;
                $this->addQuantity($key);
            }
        }

        if (!$newProductInCart) {
            $defaultSugarLevelId = SizeSugarLevel::where('size_id', $product->size->id)
                ->orderByDesc('id')
                ->pluck('id')
                ->first();

            $this->selectedProducts[] = [
                'product' => $product,
                'quantity' => 1,
                'sugarLevelId' => $defaultSugarLevelId
            ];

            foreach ($product->inventoryItems as $item) {
                $consumptionValue = $item->pivot->consumption_value;
                $oldCurrentInventoryConsumption = $this->currentInventoryConsumption;

                if (array_key_exists($item->name, $this->currentInventoryConsumption)) {
                    $this->currentInventoryConsumption[$item->name] -= $consumptionValue;
                } else {
                    $remainingStocks = $item->remaining_stocks;
                    $newStocks = $remainingStocks - $consumptionValue;
                    $this->currentInventoryConsumption[$item->name] = $newStocks;
                }

                if ($this->currentInventoryConsumption[$item->name] <= 0) {
                    Toaster::warning($product->productDetail->name . ' cannot be added.' . $item->name . ' is out of stock. Please add stocks and/or revise your current order.');
                    $this->currentInventoryConsumption = $oldCurrentInventoryConsumption;
                    return;
                }
            }

            Toaster::info($product->productDetail->name . ' has been added to order!');
        }
    }

    public function checkInventory()
    {
        dd($this->currentInventoryConsumption);
    }

    public function editSugarLevel($key, $sugarLevelId)
    {
        $this->selectedProducts[$key]['sugarLevelId'] = $sugarLevelId;
    }

    public function removeItem($index)
    {
        if (count($this->selectedProducts) <= 0 || !$this->selectedProducts[$index]) {
            Toaster::warning('Product already removed!');
            return;
        }

        Toaster::warning($this->selectedProducts[$index]['product']->productDetail->name . ' removed from order');
        unset($this->selectedProducts[$index]);
        $this->selectedProducts = array_values($this->selectedProducts);
    }

    public function addQuantity($key)
    {
        $currentQuantity = $this->selectedProducts[$key]['quantity'];
        $this->selectedProducts[$key]['quantity'] = intval($currentQuantity) + 1;
        $this->computeCurrentTotalAmount();
    }

    public function subtractQuantity($key)
    {
        $currentQuantity = $this->selectedProducts[$key]['quantity'];
        if ($currentQuantity <= 1) {
            Toaster::warning($this->selectedProducts[$key]['product']->productDetail->name . ' removed from order');
            unset($this->selectedProducts[$key]);
            $this->selectedProducts = array_values($this->selectedProducts);
            return;
        }

        $this->selectedProducts[$key]['quantity'] = $currentQuantity - 1;
        $this->computeCurrentTotalAmount();
    }

    public function updateQuantity()
    {
        $this->computeCurrentTotalAmount();
    }


    private function computeCurrentTotalAmount()
    {
        $totalAmount = 0;
        if (!empty($this->selectedProducts)) {
            foreach ($this->selectedProducts as $selectedProduct) {
                $totalAmount += floatval($selectedProduct['product']->price) * floatval($selectedProduct['quantity']);
            }
        }
        $this->currentTotalAmount = $totalAmount;
    }

    public function placeOrder()
    {
        $this->computeCurrentTotalAmount();
        $this->dispatch('placing-order', selectedProducts: $this->selectedProducts, currentTotalAmount: $this->currentTotalAmount);
        $this->dispatch('open-modal', 'confirm-order');
    }

    #[On('order-finished')]
    public function clearSelectedProducts()
    {
        $this->selectedProducts = [];
    }
    public function render()
    {
        $total = $this->computeCurrentTotalAmount();

        return view('livewire.pos.order-summary', compact('total'));
    }
}
