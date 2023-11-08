<?php

use App\Models\Product;
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

    // Profile
    Route::view('profile', 'profile')
        ->name('profile');
});



Route::get('test-model', function () {
    // $productDetails = ProductDetail::with(['category', 'sizes.pivot.inventoryItems'])->get();
    // return view('test', compact('productDetails'));

    $test = Product::where('id', 1)->first();
    dd($test->inventoryItems);
    foreach ($test->sizes as $size) {
        dump($size);
    }
});

require __DIR__ . '/auth.php';
