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

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');


Route::get('test-model', function () {

    $productDetails = ProductDetail::all();
    // dd($inventoryItem->products());
    // foreach($inventoryItem->products() as $product) {
    //     dump($product->name);
    //     // foreach ($inventoryItem->product as $item) {
    //     //     dump($item);
    //     // }
    // }
    // // dd($inventoryItems[0]->products());
    // foreach ($products[0]->inventoryItems as $inventoryItem) {
    //     dump($inventoryItem->pivot->consumption_value);
    // }
    dd(ProductDetail::with('sizes')->get());
    $productDetails = ProductDetail::with('sizes.product.inventoryItems')->get();
    foreach ($productDetails as $productDetail) {
        foreach ($productDetail->sizes as $size) {
            $price = $size->product->pivot->price;
            foreach ($size->product->inventoryItems as $inventoryItem) {
                $consumptionValue = $inventoryItem->pivot->consumption_value;
                dump($consumptionValue);
            }
        }
    }
    // return view('test', compact('productDetails'));
});

require __DIR__ . '/auth.php';
