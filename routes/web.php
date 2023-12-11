<?php

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use App\Models\ProductDetail;
use App\Models\PurchaseOrder;
use Illuminate\Support\Carbon;
use App\Models\DeliveryReceive;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\PurchaseOrderItem;
use App\Models\DeliveryReceiveItem;
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
    // Route::view('dashboard', 'dashboard')
    //     ->name('dashboard');
    Route::get('dashboard', App\Livewire\Dashboard\Index::class)->name('dashboard');
    Route::get('pos', App\Livewire\Pos\Index::class)->name('pos');

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

    // Purchase Orders
    Route::prefix('purchase-orders')->group(function () {
        Route::get('/', App\Livewire\PurchaseOrder\Index::class)
            ->name('purchase-orders');
        Route::get('create', App\Livewire\PurchaseOrder\Create::class)
            ->name('purchase-orders.create');
        Route::get('edit/{purchaseOrder}', App\Livewire\PurchaseOrder\Edit::class)
            ->name('purchase-orders.edit');
    });

    // Delivery Receives
    Route::prefix('delivery-receives')->group(function () {
        Route::get('/', App\Livewire\DeliveryReceive\Index::class)
            ->name('delivery-receives');
        Route::get('create/{purchaseOrder}', App\Livewire\DeliveryReceive\Create::class)
            ->name('delivery-receives.create');
    });

    // Profile
    Route::view('profile', 'profile')
        ->name('profile');

    Route::get('test', function () {
        $purchaseOrdersTotal = PurchaseOrder::sum('total_amount');
        $deliveryReceiveTotal = DeliveryReceive::sum('total_amount');
        dd([
            $purchaseOrdersTotal,
            $deliveryReceiveTotal
        ]);
    });
});

require __DIR__ . '/auth.php';
