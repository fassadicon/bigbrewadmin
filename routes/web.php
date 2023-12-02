<?php

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use App\Models\ProductDetail;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
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

    // Purchase Orders
    Route::prefix('purchase-orders')->group(function () {
        Route::get('/', App\Livewire\PurchaseOrder\Index::class)
            ->name('purchase-orders');
        Route::get('create', App\Livewire\PurchaseOrder\Create::class)
            ->name('purchase-orders.create');
    });

    // Delivery Receives
    Route::prefix('delivery-receives')->group(function () {
        Route::get('/', App\Livewire\DeliveryReceive\Index::class)
            ->name('delivery-receives');
    });

    // Profile
    Route::view('profile', 'profile')
        ->name('profile');

    Route::get('test', function () {
        $orders = Order::withTrashed()
            ->with('payment', 'orderItems', 'user')
            ->get();

        $totalSales = $orders->where('status', 1)->sum('total_amount');
        $completedOrders = $orders->where('status', 1)->count();
        $cancelledOrders = $orders->where('status', 2)->count();

        $totalCashPayments = $orders->where('status', 1)
            ->where('payment.method', 1)
            ->sum('total_amount');
        $totalOnlinePayments = $orders->where('status', 1)
            ->where('payment.method', 2)
            ->sum('total_amount');

        $pdf = Pdf::loadView('exports.sales', [
            'orders' => $orders,
            'totalSales' => $totalSales,
            'totalCashPayments' => $totalCashPayments,
            'totalOnlinePayments' => $totalOnlinePayments,
            'completedOrders' => $completedOrders,
            'cancelledOrders' => $cancelledOrders,
            'date' => Carbon::today()->format('F j, Y')
        ]);

        return $pdf->download('sales.pdf');
    });
});

require __DIR__ . '/auth.php';
