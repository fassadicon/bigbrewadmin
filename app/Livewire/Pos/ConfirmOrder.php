<?php

namespace App\Livewire\Pos;

use App\Models\Order;
use App\Models\Payment;
use Livewire\Component;
use App\Models\Discount;
use App\Models\OrderItem;
use Livewire\Attributes\On;
use App\Models\InventoryLog;
use App\Models\InventoryItem;
use App\Models\SizeSugarLevel;
use Illuminate\Support\Carbon;
use Masmerise\Toaster\Toaster;
use Barryvdh\DomPDF\Facade\Pdf;

class ConfirmOrder extends Component
{
    public $name;
    public $selectedProducts = [];
    public $currentTotalAmount;
    public $discounts;
    public $discount_id;

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
            'payment.payment_received' => 'required|numeric|min:' . $this->payment['amount'],
            'name' => 'nullable|alpha'
        ];
        return $rules;
    }

    public function mount()
    {
        $this->discounts = Discount::where('status', 1)->get();
    }

    #[On('placing-order')]
    public function fillEditForm($selectedProducts, $currentTotalAmount)
    {
        $this->selectedProducts = $selectedProducts;
        $this->currentTotalAmount = $currentTotalAmount;
        $this->payment['amount'] = $currentTotalAmount;
    }

    public function updateChange()
    {
        $this->validate();

        $this->payment['change'] = ceil(floatval($this->payment['payment_received']) - $this->payment['amount']);
    }

    public function updateDiscount()
    {
        $discount = Discount::where('id', $this->discount_id)->first();
        if ($discount->type == 2) {
            $this->payment['amount'] = $this->currentTotalAmount - ($this->currentTotalAmount * ($discount->value / 100));
        } else {
            $this->payment['amount'] = $this->currentTotalAmount - $discount->value;
        }
        $this->payment['amount'] = round($this->payment['amount']);

        $this->updateChange();
    }

    public function completeOrder()
    {
        if ($this->payment['payment_received'] < $this->payment['amount']) {
            Toaster::warning('Payment received is less than total amount!');
            return;
        }

        $orderItems = [];
        foreach ($this->selectedProducts as $selectedProduct) {
            $orderItems[] = [
                'product_id' => $selectedProduct['product']['id'],
                'amount' => floatval($selectedProduct['product']['price']) * floatval($selectedProduct['quantity']),
                'quantity' => floatval($selectedProduct['quantity']),
                'sugar_level_id' => $selectedProduct['sugarLevelId']
            ];
        }
        $payment = Payment::create($this->payment);

        $order = Order::create([
            'user_id' => auth()->id(),
            'payment_id' => $payment->id,
            'total_amount' => $payment->amount,
            'customer_name' => $this->name,
            'discount_id' => $this->discount_id ?? null
        ]);

        foreach ($orderItems as $key => $orderItem) {
            $orderItem['order_id'] = $order->id;
            OrderItem::create($orderItem);

            if ($orderItem['sugar_level_id'] != '') {
                $sugarConsumptionValue = SizeSugarLevel::where('id', $orderItem['sugar_level_id'])->pluck('consumption_value')->first();
                // dd($sugarConsumptionValue);
                if ($sugarConsumptionValue != floatval(0)) {
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
                        'remarks' => 'Order for ' . $this->selectedProducts[$key]['product']['product_detail']['name']
                    ]);
                }
            }
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

        $this->name = null;

        $this->discount_id = null;

        $this->payment = [
            'method' => 1,
            'payment_received' => 0,
            'amount' => 0,
            'change' => 0,
            'details' => ''
        ];

        $pdf = Pdf::setPaper(array(0, 0, 200, 500))
            ->loadView('exports.receipt', [
                'order' => $order,
                'date' => Carbon::now()->format('Y-m-d H:i:s')
            ]);

        $page_count = $pdf->get_canvas()->get_page_number();

        $printPDF =  Pdf::setPaper(array(0, 0, 200, 500 * $page_count))
            ->loadView('exports.receipt', [
                'order' => $order->load('payment', 'orderItems', 'orderItems.product', 'orderItems.product.productDetail', 'user'),
                'date' => Carbon::now()->format('M d, Y')
            ])
            ->output();

        Toaster::success('Order completed!');

        $this->dispatch('close', 'confirm-order');
        $this->dispatch('order-finished');

        return response()->streamDownload(
            fn () => print($printPDF),
            "receipt.pdf"
        );

        $all_discounts = Discount::all();

        foreach ($all_discounts as $discount) {
            if ($discount->end_date !== null) {
                if (Carbon::parse($discount->end_date)->lt(Carbon::today())) {
                    $discount->update(['status' => 2]);
                }
            }
        }
    }
}
