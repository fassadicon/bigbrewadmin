<?php

use App\Models\Inventory;
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

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');


Route::get('test-model', function () {
    // foreach ($productSizes as $productSize) {
    //     $inventoriesCount = rand(1, 4);
    //     for ($i = 1; $i <= $inventoriesCount; $i++) {
    //         $productSize->inventories()->attach(['product_size_id' => $productSize->id, 'inventory_id' => $i, 'use_value' => rand(1, 100)]);
    //     }
    // }

    $productDetails = ProductDetail::all();
    // dd($productSizes[0]->inventories()->get());
    // dd($productDetails[0]->sizes());
    // dd($productSizes[0]->inventories());
    return view('test', compact('productDetails'));
});

require __DIR__ . '/auth.php';
