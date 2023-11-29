<?php

use App\Models\Product;
use App\Models\OrderItem;
use App\Models\ProductDetail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/', 'welcome');

Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::view('dashboard', 'dashboard')
        ->name('dashboard');

    // Product
    Route::prefix('products')->group(function () {
        Route::get('/', App\Livewire\Product\Index::class)
            ->name('products');
        Route::get('create', App\Livewire\Product\Create::class)
            ->name('products.create');
        Route::get('edit/{productDetail}', App\Livewire\Product\Edit::class)
            ->name('products.edit');
        Route::get('{productDetailId}', App\Livewire\Product\Show::class)
            ->name('products.show');
    });

    // Product Category
    Route::get('product-categories', App\Livewire\ProductCategory\Index::class)
        ->name('product-categories');

    // Size
    Route::get('sizes', App\Livewire\Size\Index::class)
        ->name('sizes');

    // Inventory Items
    Route::get('inventory-items', App\Livewire\InventoryItem\Index::class)
        ->name('inventory-items');

    // Inventory Movement
    Route::get('inventory-movements', App\Livewire\InventoryMovement\Index::class)
        ->name('inventory-movements');

    // Product
    Route::prefix('users')->group(function () {
        Route::get('/', App\Livewire\User\Index::class)
            ->name('users');
        Route::get('create', App\Livewire\User\Create::class)
            ->name('users.create');
    });

    // Orders
    Route::prefix('orders')->group(function () {
        Route::get('/', App\Livewire\Order\Index::class)
            ->name('orders');
    });

    // Size
    Route::get('sugar-levels', App\Livewire\SugarLevel\Index::class)
        ->name('sugar-levels');

    // Profile
    Route::view('profile', 'profile')
        ->name('profile');

    Route::get('test', function() {
        $orderItemsCreated = OrderItem::all();
        foreach ($orderItemsCreated as $orderItem) {
            $productInventoryItems = $orderItem->product->inventoryItems;
            foreach ($productInventoryItems as $productInventoryItem) {
                $consumptionValue = $productInventoryItem->pivot->consumption_value * $orderItem->quantity;
                $remainingStocks = $productInventoryItem->remaining_stocks;
                dump([
                    "Order ID: $orderItem->id",
                    "Product Id: $productInventoryItem->id",
                    "InventoryItem Id: $productInventoryItem->id",
                    "InventoryItem Remaining Stocks: $remainingStocks",
                    "Consumption Value: $consumptionValue",
                    "InventoryItem Remaining Stocks After Consumption: $remainingStocks - $consumptionValue",
                ]);
                // dump();
                // $productInventoryItem->update([
                //     'remaining_stocks' => $remainingStocks - $consumptionValue
                // ]);
            }
        }
    });
});

require __DIR__ . '/auth.php';
