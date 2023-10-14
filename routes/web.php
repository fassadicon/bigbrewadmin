<?php

use App\Models\Inventory;
use App\Models\InventoryItem;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\ProductSize;
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

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('products', 'livewire.product.index')
    ->middleware(['auth', 'verified'])
    ->name('products');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');


Route::get('test-model', function () {
    $productDetails = ProductDetail::with(['category', 'sizes.pivot.inventoryItems'])->get();
    return view('test', compact('productDetails'));
    // return ProductDetail::with(['category', 'sizes.pivot.inventoryItems'])->get();
});

require __DIR__ . '/auth.php';
