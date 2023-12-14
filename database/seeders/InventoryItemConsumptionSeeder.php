<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\InventoryItem;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class InventoryItemConsumptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // comment here
        // $products = Product::all();

        // foreach ($products as $product) {
        //     foreach(range(1, 2) as $inventoryItemAttached) {
        //         $product->inventoryItems()->attach([
        //             rand(1, 51) => ['consumption_value' => 1]
        //         ]);
        //     }
        // }
        // until here

        // Example
        // Get the product with the specific size
         $okinawaMedio = Product::where('product_id', 1) // product_details 1 - okinawa
         ->where('size_id', 2) // 2 - medio
         ->first();

         $okinawaMedio->inventoryItems()->attach([
             //inventory_item_id => ['consumption_value' => kung ilan consume per bili]
            49 => ['consumption_value' => 1], // 51 kasi ayun yung plastic cup regular, consumption value 1 kasi isa langg naman need na cup
            5 => ['consumption_value' => 20], // 7 - ayun yugn okinawa powder, 2 grams imbento lang
            46 => ['consumption_value' => 473],
            3 => ['consumption_value' => 1],
            47 => ['consumption_value' => 34],
            50 => ['consumption_value' => 6],
         ]);
         $okinawaGrande = Product::where('product_id', 1)
         ->where('size_id', 3)
         ->first();

         $okinawaGrande->inventoryItems()->attach([
            49 => ['consumption_value' => 1],
            5 => ['consumption_value' => 30],
            46 => ['consumption_value' => 651],
            3 => ['consumption_value' => 1],
            47 => ['consumption_value' => 46],
            50 => ['consumption_value' => 8],
         ]);
         $wintermelonMedio = Product::where('product_id', 2) // product_details 1 - okinawa
         ->where('size_id', 2) // 2 - medio
         ->first();

         $wintermelonMedio->inventoryItems()->attach([
             //inventory_item_id => ['consumption_value' => kung ilan consume per bili]
            49 => ['consumption_value' => 1], // 51 kasi ayun yung plastic cup regular, consumption value 1 kasi isa langg naman need na cup
            6 => ['consumption_value' => 20], // 7 - ayun yugn okinawa powder, 2 grams imbento lang
            46 => ['consumption_value' => 473],
            3 => ['consumption_value' => 1],
            47 => ['consumption_value' => 34],
            50 => ['consumption_value' => 6],
         ]);
         $wintermelonGrande = Product::where('product_id', 2)
         ->where('size_id', 3)
         ->first();

         $wintermelonGrande->inventoryItems()->attach([
            49 => ['consumption_value' => 1],
            6 => ['consumption_value' => 30],
            46 => ['consumption_value' => 651],
            3 => ['consumption_value' => 1],
            47 => ['consumption_value' => 46],
            50 => ['consumption_value' => 8],
         ]);
         $RedVelvetMedio = Product::where('product_id', 3) // product_details 1 - okinawa
         ->where('size_id', 2) // 2 - medio
         ->first();

         $RedVelvetMedio->inventoryItems()->attach([
             //inventory_item_id => ['consumption_value' => kung ilan consume per bili]
            49 => ['consumption_value' => 1], // 51 kasi ayun yung plastic cup regular, consumption value 1 kasi isa langg naman need na cup
            7 => ['consumption_value' => 20], // 7 - ayun yugn okinawa powder, 2 grams imbento lang
            46 => ['consumption_value' => 473],
            3 => ['consumption_value' => 1],
            47 => ['consumption_value' => 34],
            50 => ['consumption_value' => 6],
         ]);
         $RedVelvetGrande = Product::where('product_id', 3)
         ->where('size_id', 3)
         ->first();

         $RedVelvetGrande->inventoryItems()->attach([
            49 => ['consumption_value' => 1],
            7 => ['consumption_value' => 30],
            46 => ['consumption_value' => 651],
            3 => ['consumption_value' => 1],
            47 => ['consumption_value' => 46],
            50 => ['consumption_value' => 8],
         ]);
         $MatchaMedio = Product::where('product_id', 4) // product_details 1 - okinawa
         ->where('size_id', 2) // 2 - medio
         ->first();

         $MatchaMedio->inventoryItems()->attach([
             //inventory_item_id => ['consumption_value' => kung ilan consume per bili]
            49 => ['consumption_value' => 1], // 51 kasi ayun yung plastic cup regular, consumption value 1 kasi isa langg naman need na cup
            8 => ['consumption_value' => 20], // 7 - ayun yugn okinawa powder, 2 grams imbento lang
            46 => ['consumption_value' => 473],
            3 => ['consumption_value' => 1],
            47 => ['consumption_value' => 34],
            50 => ['consumption_value' => 6],
         ]);
         $MatchaGrande = Product::where('product_id', 4)
         ->where('size_id', 3)
         ->first();

         $MatchaGrande->inventoryItems()->attach([
            49 => ['consumption_value' => 1],
            8 => ['consumption_value' => 30],
            46 => ['consumption_value' => 651],
            3 => ['consumption_value' => 1],
            47 => ['consumption_value' => 46],
            50 => ['consumption_value' => 8],
         ]);
         $DoubleDutchMedio = Product::where('product_id', 5) // product_details 1 - okinawa
         ->where('size_id', 2) // 2 - medio
         ->first();

         $DoubleDutchMedio->inventoryItems()->attach([
             //inventory_item_id => ['consumption_value' => kung ilan consume per bili]
            49 => ['consumption_value' => 1], // 51 kasi ayun yung plastic cup regular, consumption value 1 kasi isa langg naman need na cup
            9 => ['consumption_value' => 20], // 7 - ayun yugn okinawa powder, 2 grams imbento lang
            46 => ['consumption_value' => 473],
            3 => ['consumption_value' => 1],
            47 => ['consumption_value' => 34],
            50 => ['consumption_value' => 6],
         ]);
         $DoubleDutchGrande = Product::where('product_id', 5)
         ->where('size_id', 3)
         ->first();

         $DoubleDutchGrande->inventoryItems()->attach([
            49 => ['consumption_value' => 1],
            9 => ['consumption_value' => 30],
            46 => ['consumption_value' => 651],
            3 => ['consumption_value' => 1],
            47 => ['consumption_value' => 46],
            50 => ['consumption_value' => 8],
         ]);
         $CheesecakeMedio = Product::where('product_id', 6) // product_details 1 - okinawa
         ->where('size_id', 2) // 2 - medio
         ->first();

         $CheesecakeMedio->inventoryItems()->attach([
             //inventory_item_id => ['consumption_value' => kung ilan consume per bili]
            49 => ['consumption_value' => 1], // 51 kasi ayun yung plastic cup regular, consumption value 1 kasi isa langg naman need na cup
            10 => ['consumption_value' => 20], // 7 - ayun yugn okinawa powder, 2 grams imbento lang
            46 => ['consumption_value' => 473],
            3 => ['consumption_value' => 1],
            47 => ['consumption_value' => 34],
            50 => ['consumption_value' => 6],
         ]);
         $CheesecakeGrande = Product::where('product_id', 6)
         ->where('size_id', 3)
         ->first();

         $CheesecakeGrande->inventoryItems()->attach([
            49 => ['consumption_value' => 1],
            10 => ['consumption_value' => 30],
            46 => ['consumption_value' => 651],
            3 => ['consumption_value' => 1],
            47 => ['consumption_value' => 46],
            50 => ['consumption_value' => 8],
         ]);
         $DarkChocoMedio = Product::where('product_id', 8) // product_details 1 - okinawa
         ->where('size_id', 2) // 2 - medio
         ->first();

         $DarkChocoMedio->inventoryItems()->attach([
             //inventory_item_id => ['consumption_value' => kung ilan consume per bili]
            49 => ['consumption_value' => 1], // 51 kasi ayun yung plastic cup regular, consumption value 1 kasi isa langg naman need na cup
            11 => ['consumption_value' => 20], // 7 - ayun yugn okinawa powder, 2 grams imbento lang
            46 => ['consumption_value' => 473],
            3 => ['consumption_value' => 1],
            47 => ['consumption_value' => 34],
            50 => ['consumption_value' => 6],
         ]);
         $DarkChocoGrande = Product::where('product_id', 8)
         ->where('size_id', 3)
         ->first();

         $DarkChocoGrande->inventoryItems()->attach([
            49 => ['consumption_value' => 1],
            11 => ['consumption_value' => 30],
            46 => ['consumption_value' => 651],
            3 => ['consumption_value' => 1],
            47 => ['consumption_value' => 46],
            50 => ['consumption_value' => 8],
         ]);
         $SaltedCaramelMedio = Product::where('product_id', 9) // product_details 1 - okinawa
         ->where('size_id', 2) // 2 - medio
         ->first();

         $SaltedCaramelMedio->inventoryItems()->attach([
             //inventory_item_id => ['consumption_value' => kung ilan consume per bili]
            49 => ['consumption_value' => 1], // 51 kasi ayun yung plastic cup regular, consumption value 1 kasi isa langg naman need na cup
            12 => ['consumption_value' => 20], // 7 - ayun yugn okinawa powder, 2 grams imbento lang
            46 => ['consumption_value' => 473],
            3 => ['consumption_value' => 1],
            47 => ['consumption_value' => 34],
            50 => ['consumption_value' => 6],
         ]);
         $SaltedCaramelGrande = Product::where('product_id', 9)
         ->where('size_id', 3)
         ->first();

         $SaltedCaramelGrande->inventoryItems()->attach([
            49 => ['consumption_value' => 1],
            12 => ['consumption_value' => 30],
            46 => ['consumption_value' => 651],
            3 => ['consumption_value' => 1],
            47 => ['consumption_value' => 46],
            50 => ['consumption_value' => 8],
         ]);
         $CookiesnCreamMedio = Product::where('product_id', 10) // product_details 1 - okinawa
         ->where('size_id', 2) // 2 - medio
         ->first();

         $CookiesnCreamMedio->inventoryItems()->attach([
             //inventory_item_id => ['consumption_value' => kung ilan consume per bili]
            49 => ['consumption_value' => 1], // 51 kasi ayun yung plastic cup regular, consumption value 1 kasi isa langg naman need na cup
            13 => ['consumption_value' => 20], // 7 - ayun yugn okinawa powder, 2 grams imbento lang
            46 => ['consumption_value' => 473],
            3 => ['consumption_value' => 1],
            47 => ['consumption_value' => 34],
            50 => ['consumption_value' => 6],
         ]);
         $CookiesnCreamGrande = Product::where('product_id', 10)
         ->where('size_id', 3)
         ->first();

         $CookiesnCreamGrande->inventoryItems()->attach([
            49 => ['consumption_value' => 1],
            13 => ['consumption_value' => 30],
            46 => ['consumption_value' => 651],
            3 => ['consumption_value' => 1],
            47 => ['consumption_value' => 46],
            50 => ['consumption_value' => 8],
         ]);
         $TaroMedio = Product::where('product_id', 11) // product_details 1 - okinawa
         ->where('size_id', 2) // 2 - medio
         ->first();

         $TaroMedio->inventoryItems()->attach([
             //inventory_item_id => ['consumption_value' => kung ilan consume per bili]
            49 => ['consumption_value' => 1], // 51 kasi ayun yung plastic cup regular, consumption value 1 kasi isa langg naman need na cup
            14 => ['consumption_value' => 20], // 7 - ayun yugn okinawa powder, 2 grams imbento lang
            46 => ['consumption_value' => 473],
            3 => ['consumption_value' => 1],
            47 => ['consumption_value' => 34],
            50 => ['consumption_value' => 6],
         ]);
         $TaroGrande = Product::where('product_id', 11)
         ->where('size_id', 3)
         ->first();

         $TaroGrande->inventoryItems()->attach([
            49 => ['consumption_value' => 1],
            14 => ['consumption_value' => 30],
            46 => ['consumption_value' => 651],
            3 => ['consumption_value' => 1],
            47 => ['consumption_value' => 46],
            50 => ['consumption_value' => 8],
         ]);
         $StrawberryMedio = Product::where('product_id', 12) // product_details 1 - okinawa
         ->where('size_id', 2) // 2 - medio
         ->first();

         $StrawberryMedio->inventoryItems()->attach([
             //inventory_item_id => ['consumption_value' => kung ilan consume per bili]
            49 => ['consumption_value' => 1], // 51 kasi ayun yung plastic cup regular, consumption value 1 kasi isa langg naman need na cup
            15 => ['consumption_value' => 20], // 7 - ayun yugn okinawa powder, 2 grams imbento lang
            46 => ['consumption_value' => 473],
            3 => ['consumption_value' => 1],
            47 => ['consumption_value' => 34],
            50 => ['consumption_value' => 6],
         ]);
         $StrawberryGrande = Product::where('product_id', 12)
         ->where('size_id', 3)
         ->first();

         $StrawberryGrande->inventoryItems()->attach([
            49 => ['consumption_value' => 1],
            15 => ['consumption_value' => 30],
            46 => ['consumption_value' => 651],
            3 => ['consumption_value' => 1],
            47 => ['consumption_value' => 46],
            50 => ['consumption_value' => 8],
         ]);
         $KiwiMedio = Product::where('product_id', 13) // product_details 1 - okinawa
         ->where('size_id', 2) // 2 - medio
         ->first();

         $KiwiMedio->inventoryItems()->attach([
             //inventory_item_id => ['consumption_value' => kung ilan consume per bili]
            49 => ['consumption_value' => 1], // 51 kasi ayun yung plastic cup regular, consumption value 1 kasi isa langg naman need na cup
            16 => ['consumption_value' => 20], // 7 - ayun yugn okinawa powder, 2 grams imbento lang
            46 => ['consumption_value' => 473],
            3 => ['consumption_value' => 1],
            47 => ['consumption_value' => 34],
            50 => ['consumption_value' => 6],
         ]);
         $KiwiGrande = Product::where('product_id', 13)
         ->where('size_id', 3)
         ->first();

         $KiwiGrande->inventoryItems()->attach([
            49 => ['consumption_value' => 1],
            16 => ['consumption_value' => 30],
            46 => ['consumption_value' => 651],
            3 => ['consumption_value' => 1],
            47 => ['consumption_value' => 46],
            50 => ['consumption_value' => 8],
         ]);
         $LycheMedio = Product::where('product_id', 14) // product_details 1 - okinawa
         ->where('size_id', 2) // 2 - medio
         ->first();

         $LycheMedio->inventoryItems()->attach([
             //inventory_item_id => ['consumption_value' => kung ilan consume per bili]
            49 => ['consumption_value' => 1], // 51 kasi ayun yung plastic cup regular, consumption value 1 kasi isa langg naman need na cup
            17 => ['consumption_value' => 20], // 7 - ayun yugn okinawa powder, 2 grams imbento lang
            46 => ['consumption_value' => 473],
            3 => ['consumption_value' => 1],
            47 => ['consumption_value' => 34],
            50 => ['consumption_value' => 6],
         ]);
         $LycheGrande = Product::where('product_id', 14)
         ->where('size_id', 3)
         ->first();

         $LycheGrande->inventoryItems()->attach([
            49 => ['consumption_value' => 1],
            17 => ['consumption_value' => 30],
            46 => ['consumption_value' => 651],
            3 => ['consumption_value' => 1],
            47 => ['consumption_value' => 46],
            50 => ['consumption_value' => 8],
         ]);
         $GreenAppleMedio = Product::where('product_id', 15) // product_details 1 - okinawa
         ->where('size_id', 2) // 2 - medio
         ->first();

         $GreenAppleMedio->inventoryItems()->attach([
             //inventory_item_id => ['consumption_value' => kung ilan consume per bili]
            49 => ['consumption_value' => 1], // 51 kasi ayun yung plastic cup regular, consumption value 1 kasi isa langg naman need na cup
            18 => ['consumption_value' => 20], // 7 - ayun yugn okinawa powder, 2 grams imbento lang
            46 => ['consumption_value' => 473],
            3 => ['consumption_value' => 1],
            47 => ['consumption_value' => 34],
            50 => ['consumption_value' => 6],
         ]);
         $GreenAppleGrande = Product::where('product_id', 15)
         ->where('size_id', 3)
         ->first();

         $GreenAppleGrande->inventoryItems()->attach([
            49 => ['consumption_value' => 1],
            18 => ['consumption_value' => 30],
            46 => ['consumption_value' => 651],
            3 => ['consumption_value' => 1],
            47 => ['consumption_value' => 46],
            50 => ['consumption_value' => 8],
         ]);
         $LemonMedio = Product::where('product_id', 16) // product_details 1 - okinawa
         ->where('size_id', 2) // 2 - medio
         ->first();

         $LemonMedio->inventoryItems()->attach([
             //inventory_item_id => ['consumption_value' => kung ilan consume per bili]
            49 => ['consumption_value' => 1], // 51 kasi ayun yung plastic cup regular, consumption value 1 kasi isa langg naman need na cup
            19 => ['consumption_value' => 20], // 7 - ayun yugn okinawa powder, 2 grams imbento lang
            46 => ['consumption_value' => 473],
            3 => ['consumption_value' => 1],
            47 => ['consumption_value' => 34],
            50 => ['consumption_value' => 6],
         ]);
         $LemonGrande = Product::where('product_id', 16)
         ->where('size_id', 3)
         ->first();

         $LemonGrande->inventoryItems()->attach([
            49 => ['consumption_value' => 1],
            19 => ['consumption_value' => 30],
            46 => ['consumption_value' => 651],
            3 => ['consumption_value' => 1],
            47 => ['consumption_value' => 46],
            50 => ['consumption_value' => 8],
         ]);
         $HoneyPeachMedio = Product::where('product_id', 17) // product_details 1 - okinawa
         ->where('size_id', 2) // 2 - medio
         ->first();

         $HoneyPeachMedio->inventoryItems()->attach([
             //inventory_item_id => ['consumption_value' => kung ilan consume per bili]
            49 => ['consumption_value' => 1], // 51 kasi ayun yung plastic cup regular, consumption value 1 kasi isa langg naman need na cup
            20 => ['consumption_value' => 20], // 7 - ayun yugn okinawa powder, 2 grams imbento lang
            46 => ['consumption_value' => 473],
            3 => ['consumption_value' => 1],
            47 => ['consumption_value' => 34],
            50 => ['consumption_value' => 6],
         ]);
         $HoneyPeachGrande = Product::where('product_id', 17)
         ->where('size_id', 3)
         ->first();

         $HoneyPeachGrande->inventoryItems()->attach([
            49 => ['consumption_value' => 1],
            20 => ['consumption_value' => 30],
            46 => ['consumption_value' => 651],
            3 => ['consumption_value' => 1],
            47 => ['consumption_value' => 46],
            50 => ['consumption_value' => 8],
         ]);
         $MangoMedio = Product::where('product_id', 18) // product_details 1 - okinawa
         ->where('size_id', 2) // 2 - medio
         ->first();

         $MangoMedio->inventoryItems()->attach([
             //inventory_item_id => ['consumption_value' => kung ilan consume per bili]
            49 => ['consumption_value' => 1], // 51 kasi ayun yung plastic cup regular, consumption value 1 kasi isa langg naman need na cup
            21 => ['consumption_value' => 20], // 7 - ayun yugn okinawa powder, 2 grams imbento lang
            46 => ['consumption_value' => 473],
            3 => ['consumption_value' => 1],
            47 => ['consumption_value' => 34],
            50 => ['consumption_value' => 6],
         ]);
         $MangoGrande = Product::where('product_id', 18)
         ->where('size_id', 3)
         ->first();

         $MangoGrande->inventoryItems()->attach([
            49 => ['consumption_value' => 1],
            21 => ['consumption_value' => 30],
            46 => ['consumption_value' => 651],
            3 => ['consumption_value' => 1],
            47 => ['consumption_value' => 46],
            50 => ['consumption_value' => 8],
         ]);
         $BlueberryMedio = Product::where('product_id', 19) // product_details 1 - okinawa
         ->where('size_id', 2) // 2 - medio
         ->first();

         $BlueberryMedio->inventoryItems()->attach([
             //inventory_item_id => ['consumption_value' => kung ilan consume per bili]
            49 => ['consumption_value' => 1], // 51 kasi ayun yung plastic cup regular, consumption value 1 kasi isa langg naman need na cup
            22 => ['consumption_value' => 20], // 7 - ayun yugn okinawa powder, 2 grams imbento lang
            46 => ['consumption_value' => 473],
            3 => ['consumption_value' => 1],
            47 => ['consumption_value' => 34],
            50 => ['consumption_value' => 6],
         ]);
         $BlueberryGrande = Product::where('product_id', 19)
         ->where('size_id', 3)
         ->first();

         $BlueberryGrande->inventoryItems()->attach([
            49 => ['consumption_value' => 1],
            22 => ['consumption_value' => 30],
            46 => ['consumption_value' => 651],
            3 => ['consumption_value' => 1],
            47 => ['consumption_value' => 46],
            50 => ['consumption_value' => 8],
         ]);
         $HotBruskoCoffeeSmall = Product::where('product_id', 21)
         ->where('size_id', 1)
         ->first();

         $HotBruskoCoffeeSmall->inventoryItems()->attach([
           23 => ['consumption_value' => 1],
           51 => ['consumption_value' => 12],
           4 => ['consumption_value' => 1],
           52 => ['consumption_value' => 1],
           46 => ['consumption_value' => 355],
           47 => ['consumption_value' => 25],
         ]);
         $HotChocoCoffeeSmall = Product::where('product_id', 22)
         ->where('size_id', 1)
         ->first();

         $HotChocoCoffeeSmall->inventoryItems()->attach([
           24 => ['consumption_value' => 1],
           51 => ['consumption_value' => 12],
           4 => ['consumption_value' => 1],
           52 => ['consumption_value' => 1],
           46 => ['consumption_value' => 355],
           47 => ['consumption_value' => 25],
         ]);
         $HotMocaCoffeeSmall = Product::where('product_id', 23)
         ->where('size_id', 1)
         ->first();

         $HotMocaCoffeeSmall->inventoryItems()->attach([
           23 => ['consumption_value' => 1],
           51 => ['consumption_value' => 12],
           48 => ['consumption_value' => 10],
           4 => ['consumption_value' => 1],
           52 => ['consumption_value' => 1],
           46 => ['consumption_value' => 355],
           47 => ['consumption_value' => 25],
         ]);
         $HotMatchaCoffeeSmall = Product::where('product_id', 24)
         ->where('size_id', 1)
         ->first();

         $HotMatchaCoffeeSmall->inventoryItems()->attach([
           23 => ['consumption_value' => 1],
           51 => ['consumption_value' => 12],
           48 => ['consumption_value' => 10],
           4 => ['consumption_value' => 1],
           52 => ['consumption_value' => 1],
           46 => ['consumption_value' => 355],
           47 => ['consumption_value' => 25],
         ]);
         $HotKaramelCoffeeSmall = Product::where('product_id', 25)
         ->where('size_id', 1)
         ->first();

         $HotKaramelCoffeeSmall->inventoryItems()->attach([
           23 => ['consumption_value' => 1],
           51 => ['consumption_value' => 12],
           48 => ['consumption_value' => 10],
           4 => ['consumption_value' => 1],
           52 => ['consumption_value' => 1],
           46 => ['consumption_value' => 355],
           47 => ['consumption_value' => 25],
         ]);
         $KapeBruskoMedio = Product::where('product_id', 26) // product_details 1 - okinawa
         ->where('size_id', 2) // 2 - medio
         ->first();

         $KapeBruskoMedio->inventoryItems()->attach([
             //inventory_item_id => ['consumption_value' => kung ilan consume per bili]
            49 => ['consumption_value' => 1], // 51 kasi ayun yung plastic cup regular, consumption value 1 kasi isa langg naman need na cup
            28 => ['consumption_value' => 20], // 7 - ayun yugn okinawa powder, 2 grams imbento lang
            46 => ['consumption_value' => 473],
            3 => ['consumption_value' => 1],
            47 => ['consumption_value' => 34],
            50 => ['consumption_value' => 6],
         ]);
         $KapeBruskoGrande = Product::where('product_id', 26)
         ->where('size_id', 3)
         ->first();

         $KapeBruskoGrande->inventoryItems()->attach([
            49 => ['consumption_value' => 1],
            28 => ['consumption_value' => 30],
            46 => ['consumption_value' => 651],
            3 => ['consumption_value' => 1],
            47 => ['consumption_value' => 46],
            50 => ['consumption_value' => 8],
         ]);
         $KapeMacchMedio = Product::where('product_id', 27) // product_details 1 - okinawa
         ->where('size_id', 2) // 2 - medio
         ->first();

         $KapeMacchMedio->inventoryItems()->attach([
             //inventory_item_id => ['consumption_value' => kung ilan consume per bili]
            49 => ['consumption_value' => 1], // 51 kasi ayun yung plastic cup regular, consumption value 1 kasi isa langg naman need na cup
            29 => ['consumption_value' => 20], // 7 - ayun yugn okinawa powder, 2 grams imbento lang
            46 => ['consumption_value' => 473],
            3 => ['consumption_value' => 1],
            47 => ['consumption_value' => 34],
            50 => ['consumption_value' => 6],
            48 => ['consumption_value' => 15]
         ]);
         $KapeMacchGrande = Product::where('product_id', 27)
         ->where('size_id', 3)
         ->first();

         $KapeMacchGrande->inventoryItems()->attach([
            49 => ['consumption_value' => 1],
            29 => ['consumption_value' => 30],
            46 => ['consumption_value' => 651],
            3 => ['consumption_value' => 1],
            47 => ['consumption_value' => 46],
            50 => ['consumption_value' => 8],
            48 => ['consumption_value' => 20],
         ]);
         $KapeMocaMedio = Product::where('product_id', 28) // product_details 1 - okinawa
         ->where('size_id', 2) // 2 - medio
         ->first();

         $KapeMocaMedio->inventoryItems()->attach([
             //inventory_item_id => ['consumption_value' => kung ilan consume per bili]
            49 => ['consumption_value' => 1], // 51 kasi ayun yung plastic cup regular, consumption value 1 kasi isa langg naman need na cup
            30 => ['consumption_value' => 20], // 7 - ayun yugn okinawa powder, 2 grams imbento lang
            46 => ['consumption_value' => 473],
            3 => ['consumption_value' => 1],
            47 => ['consumption_value' => 34],
            50 => ['consumption_value' => 6],
            48 => ['consumption_value' => 15]
         ]);
         $KapeMocaGrande = Product::where('product_id', 28)
         ->where('size_id', 3)
         ->first();

         $KapeMocaGrande->inventoryItems()->attach([
            49 => ['consumption_value' => 1],
            30 => ['consumption_value' => 30],
            46 => ['consumption_value' => 651],
            3 => ['consumption_value' => 1],
            47 => ['consumption_value' => 46],
            50 => ['consumption_value' => 8],
            48 => ['consumption_value' => 20],
         ]);
         $KapeVanillaMedio = Product::where('product_id', 29) // product_details 1 - okinawa
         ->where('size_id', 2) // 2 - medio
         ->first();

         $KapeVanillaMedio->inventoryItems()->attach([
             //inventory_item_id => ['consumption_value' => kung ilan consume per bili]
            49 => ['consumption_value' => 1], // 51 kasi ayun yung plastic cup regular, consumption value 1 kasi isa langg naman need na cup
            31 => ['consumption_value' => 20], // 7 - ayun yugn okinawa powder, 2 grams imbento lang
            46 => ['consumption_value' => 473],
            3 => ['consumption_value' => 1],
            47 => ['consumption_value' => 34],
            50 => ['consumption_value' => 6],
            48 => ['consumption_value' => 15]
         ]);
         $KapeVanillaGrande = Product::where('product_id', 29)
         ->where('size_id', 3)
         ->first();

         $KapeVanillaGrande->inventoryItems()->attach([
            49 => ['consumption_value' => 1],
            31 => ['consumption_value' => 30],
            46 => ['consumption_value' => 651],
            3 => ['consumption_value' => 1],
            47 => ['consumption_value' => 46],
            50 => ['consumption_value' => 8],
            48 => ['consumption_value' => 20],
         ]);
         $KapeFudgeMedio = Product::where('product_id', 30) // product_details 1 - okinawa
         ->where('size_id', 2) // 2 - medio
         ->first();

         $KapeFudgeMedio->inventoryItems()->attach([
             //inventory_item_id => ['consumption_value' => kung ilan consume per bili]
            49 => ['consumption_value' => 1], // 51 kasi ayun yung plastic cup regular, consumption value 1 kasi isa langg naman need na cup
            32 => ['consumption_value' => 20], // 7 - ayun yugn okinawa powder, 2 grams imbento lang
            46 => ['consumption_value' => 473],
            3 => ['consumption_value' => 1],
            47 => ['consumption_value' => 34],
            50 => ['consumption_value' => 6],
            48 => ['consumption_value' => 15]
         ]);
         $KapeFudgeGrande = Product::where('product_id', 30)
         ->where('size_id', 3)
         ->first();

         $KapeFudgeGrande->inventoryItems()->attach([
            49 => ['consumption_value' => 1],
            32 => ['consumption_value' => 30],
            46 => ['consumption_value' => 651],
            3 => ['consumption_value' => 1],
            47 => ['consumption_value' => 46],
            50 => ['consumption_value' => 8],
            48 => ['consumption_value' => 20],
         ]);
         $KapeMatchaMedio = Product::where('product_id', 31) // product_details 1 - okinawa
         ->where('size_id', 2) // 2 - medio
         ->first();

         $KapeMatchaMedio->inventoryItems()->attach([
             //inventory_item_id => ['consumption_value' => kung ilan consume per bili]
            49 => ['consumption_value' => 1], // 51 kasi ayun yung plastic cup regular, consumption value 1 kasi isa langg naman need na cup
            33 => ['consumption_value' => 20], // 7 - ayun yugn okinawa powder, 2 grams imbento lang
            46 => ['consumption_value' => 473],
            3 => ['consumption_value' => 1],
            47 => ['consumption_value' => 34],
            50 => ['consumption_value' => 6],
            48 => ['consumption_value' => 15]
         ]);
         $KapeMatchaGrande = Product::where('product_id', 31)
         ->where('size_id', 3)
         ->first();

         $KapeMatchaGrande->inventoryItems()->attach([
            49 => ['consumption_value' => 1],
            33 => ['consumption_value' => 30],
            46 => ['consumption_value' => 651],
            3 => ['consumption_value' => 1],
            47 => ['consumption_value' => 46],
            50 => ['consumption_value' => 8],
            48 => ['consumption_value' => 20],
         ]);
         $KapeKaramelMedio = Product::where('product_id', 32) // product_details 1 - okinawa
         ->where('size_id', 2) // 2 - medio
         ->first();

         $KapeKaramelMedio->inventoryItems()->attach([
             //inventory_item_id => ['consumption_value' => kung ilan consume per bili]
            49 => ['consumption_value' => 1], // 51 kasi ayun yung plastic cup regular, consumption value 1 kasi isa langg naman need na cup
            34 => ['consumption_value' => 20], // 7 - ayun yugn okinawa powder, 2 grams imbento lang
            46 => ['consumption_value' => 473],
            3 => ['consumption_value' => 1],
            47 => ['consumption_value' => 34],
            50 => ['consumption_value' => 6],
            48 => ['consumption_value' => 15]
         ]);
         $KapeKaramelGrande = Product::where('product_id', 32)
         ->where('size_id', 3)
         ->first();

         $KapeKaramelGrande->inventoryItems()->attach([
            49 => ['consumption_value' => 1],
            34 => ['consumption_value' => 30],
            46 => ['consumption_value' => 651],
            3 => ['consumption_value' => 1],
            47 => ['consumption_value' => 46],
            50 => ['consumption_value' => 8],
            48 => ['consumption_value' => 20],
         ]);
         $MocaMedio = Product::where('product_id', 33) // product_details 1 - okinawa
         ->where('size_id', 2) // 2 - medio
         ->first();

         $MocaMedio->inventoryItems()->attach([
             //inventory_item_id => ['consumption_value' => kung ilan consume per bili]
            49 => ['consumption_value' => 1], // 51 kasi ayun yung plastic cup regular, consumption value 1 kasi isa langg naman need na cup
            34 => ['consumption_value' => 20], // 7 - ayun yugn okinawa powder, 2 grams imbento lang
            46 => ['consumption_value' => 473],
            3 => ['consumption_value' => 1],
            47 => ['consumption_value' => 34],
            50 => ['consumption_value' => 6],
            48 => ['consumption_value' => 15]
         ]);
         $MocaGrande = Product::where('product_id', 33)
         ->where('size_id', 3)
         ->first();

         $MocaGrande->inventoryItems()->attach([
            49 => ['consumption_value' => 1],
            34 => ['consumption_value' => 30],
            46 => ['consumption_value' => 651],
            3 => ['consumption_value' => 1],
            47 => ['consumption_value' => 46],
            50 => ['consumption_value' => 8],
            48 => ['consumption_value' => 20],
         ]);
         $CoffeeJellyMedio = Product::where('product_id', 34) // product_details 1 - okinawa
         ->where('size_id', 2) // 2 - medio
         ->first();

         $CoffeeJellyMedio->inventoryItems()->attach([
             //inventory_item_id => ['consumption_value' => kung ilan consume per bili]
            49 => ['consumption_value' => 1], // 51 kasi ayun yung plastic cup regular, consumption value 1 kasi isa langg naman need na cup
            35 => ['consumption_value' => 20], // 7 - ayun yugn okinawa powder, 2 grams imbento lang
            46 => ['consumption_value' => 473],
            3 => ['consumption_value' => 1],
            47 => ['consumption_value' => 34],
            50 => ['consumption_value' => 6],
            48 => ['consumption_value' => 15]
         ]);
         $CoffeeJellyGrande = Product::where('product_id', 34)
         ->where('size_id', 3)
         ->first();

         $CoffeeJellyGrande->inventoryItems()->attach([
            49 => ['consumption_value' => 1],
            35 => ['consumption_value' => 30],
            46 => ['consumption_value' => 651],
            3 => ['consumption_value' => 1],
            47 => ['consumption_value' => 46],
            50 => ['consumption_value' => 8],
            48 => ['consumption_value' => 20],
         ]);
         $CaramelMacchMedio = Product::where('product_id', 35) // product_details 1 - okinawa
         ->where('size_id', 2) // 2 - medio
         ->first();

         $CaramelMacchMedio->inventoryItems()->attach([
             //inventory_item_id => ['consumption_value' => kung ilan consume per bili]
            49 => ['consumption_value' => 1], // 51 kasi ayun yung plastic cup regular, consumption value 1 kasi isa langg naman need na cup
            36 => ['consumption_value' => 20], // 7 - ayun yugn okinawa powder, 2 grams imbento lang
            46 => ['consumption_value' => 473],
            3 => ['consumption_value' => 1],
            47 => ['consumption_value' => 34],
            50 => ['consumption_value' => 6],
            48 => ['consumption_value' => 15]
         ]);
         $CaramelMacchGrande = Product::where('product_id', 35)
         ->where('size_id', 3)
         ->first();

         $CaramelMacchGrande->inventoryItems()->attach([
            49 => ['consumption_value' => 1],
            36 => ['consumption_value' => 30],
            46 => ['consumption_value' => 651],
            3 => ['consumption_value' => 1],
            47 => ['consumption_value' => 46],
            50 => ['consumption_value' => 8],
            48 => ['consumption_value' => 20],
         ]);
         $VanillaCoffeeMedio = Product::where('product_id', 36) // product_details 1 - okinawa
         ->where('size_id', 2) // 2 - medio
         ->first();

         $VanillaCoffeeMedio->inventoryItems()->attach([
             //inventory_item_id => ['consumption_value' => kung ilan consume per bili]
            49 => ['consumption_value' => 1], // 51 kasi ayun yung plastic cup regular, consumption value 1 kasi isa langg naman need na cup
            37 => ['consumption_value' => 20], // 7 - ayun yugn okinawa powder, 2 grams imbento lang
            46 => ['consumption_value' => 473],
            3 => ['consumption_value' => 1],
            47 => ['consumption_value' => 34],
            50 => ['consumption_value' => 6],
            48 => ['consumption_value' => 15]
         ]);
         $VanillaCoffeeGrande = Product::where('product_id', 36)
         ->where('size_id', 3)
         ->first();

         $VanillaCoffeeGrande->inventoryItems()->attach([
            49 => ['consumption_value' => 1],
            37 => ['consumption_value' => 30],
            46 => ['consumption_value' => 651],
            3 => ['consumption_value' => 1],
            47 => ['consumption_value' => 46],
            50 => ['consumption_value' => 8],
            48 => ['consumption_value' => 20],
         ]);
         $CookiesNCreamMedio = Product::where('product_id', 37) // product_details 1 - okinawa
         ->where('size_id', 2) // 2 - medio
         ->first();

         $CookiesNCreamMedio->inventoryItems()->attach([
             //inventory_item_id => ['consumption_value' => kung ilan consume per bili]
            49 => ['consumption_value' => 1], // 51 kasi ayun yung plastic cup regular, consumption value 1 kasi isa langg naman need na cup
            13 => ['consumption_value' => 20], // 7 - ayun yugn okinawa powder, 2 grams imbento lang
            46 => ['consumption_value' => 473],
            3 => ['consumption_value' => 1],
            47 => ['consumption_value' => 34],
            50 => ['consumption_value' => 6],
         ]);
         $CookiesNCreamGrande = Product::where('product_id', 37)
         ->where('size_id', 3)
         ->first();

         $CookiesNCreamGrande->inventoryItems()->attach([
            49 => ['consumption_value' => 1],
            13 => ['consumption_value' => 30],
            46 => ['consumption_value' => 651],
            3 => ['consumption_value' => 1],
            47 => ['consumption_value' => 46],
            50 => ['consumption_value' => 8],
         ]);
         $CheesecakeCreamMedio = Product::where('product_id', 38) // product_details 1 - okinawa
         ->where('size_id', 2) // 2 - medio
         ->first();

         $CheesecakeCreamMedio->inventoryItems()->attach([
             //inventory_item_id => ['consumption_value' => kung ilan consume per bili]
            49 => ['consumption_value' => 1], // 51 kasi ayun yung plastic cup regular, consumption value 1 kasi isa langg naman need na cup
            38 => ['consumption_value' => 20], // 7 - ayun yugn okinawa powder, 2 grams imbento lang
            46 => ['consumption_value' => 473],
            3 => ['consumption_value' => 1],
            47 => ['consumption_value' => 34],
            50 => ['consumption_value' => 6],
         ]);
         $CheesecakeCreamGrande = Product::where('product_id', 38)
         ->where('size_id', 3)
         ->first();

         $CheesecakeCreamGrande->inventoryItems()->attach([
            49 => ['consumption_value' => 1],
            38 => ['consumption_value' => 30],
            46 => ['consumption_value' => 651],
            3 => ['consumption_value' => 1],
            47 => ['consumption_value' => 46],
            50 => ['consumption_value' => 8],
         ]);
         $TaroCreamMedio = Product::where('product_id', 39) // product_details 1 - okinawa
         ->where('size_id', 2) // 2 - medio
         ->first();

         $TaroCreamMedio->inventoryItems()->attach([
             //inventory_item_id => ['consumption_value' => kung ilan consume per bili]
            49 => ['consumption_value' => 1], // 51 kasi ayun yung plastic cup regular, consumption value 1 kasi isa langg naman need na cup
            39 => ['consumption_value' => 20], // 7 - ayun yugn okinawa powder, 2 grams imbento lang
            46 => ['consumption_value' => 473],
            3 => ['consumption_value' => 1],
            47 => ['consumption_value' => 34],
            50 => ['consumption_value' => 6],
         ]);
         $TaroCreamGrande = Product::where('product_id', 39)
         ->where('size_id', 3)
         ->first();

         $TaroCreamGrande->inventoryItems()->attach([
            49 => ['consumption_value' => 1],
            39 => ['consumption_value' => 30],
            46 => ['consumption_value' => 651],
            3 => ['consumption_value' => 1],
            47 => ['consumption_value' => 46],
            50 => ['consumption_value' => 8],
         ]);
         $MatchaCreamMedio = Product::where('product_id', 40) // product_details 1 - okinawa
         ->where('size_id', 2) // 2 - medio
         ->first();

         $MatchaCreamMedio->inventoryItems()->attach([
             //inventory_item_id => ['consumption_value' => kung ilan consume per bili]
            49 => ['consumption_value' => 1], // 51 kasi ayun yung plastic cup regular, consumption value 1 kasi isa langg naman need na cup
            40 => ['consumption_value' => 20], // 7 - ayun yugn okinawa powder, 2 grams imbento lang
            46 => ['consumption_value' => 473],
            3 => ['consumption_value' => 1],
            47 => ['consumption_value' => 34],
            50 => ['consumption_value' => 6],
         ]);
         $MatchaCreamGrande = Product::where('product_id', 40)
         ->where('size_id', 3)
         ->first();

         $MatchaCreamGrande->inventoryItems()->attach([
            49 => ['consumption_value' => 1],
            40 => ['consumption_value' => 30],
            46 => ['consumption_value' => 651],
            3 => ['consumption_value' => 1],
            47 => ['consumption_value' => 46],
            50 => ['consumption_value' => 8],
         ]);
         $ChocolateCreamMedio = Product::where('product_id', 41) // product_details 1 - okinawa
         ->where('size_id', 2) // 2 - medio
         ->first();

         $ChocolateCreamMedio->inventoryItems()->attach([
             //inventory_item_id => ['consumption_value' => kung ilan consume per bili]
            49 => ['consumption_value' => 1], // 51 kasi ayun yung plastic cup regular, consumption value 1 kasi isa langg naman need na cup
            41 => ['consumption_value' => 20], // 7 - ayun yugn okinawa powder, 2 grams imbento lang
            46 => ['consumption_value' => 473],
            3 => ['consumption_value' => 1],
            47 => ['consumption_value' => 34],
            50 => ['consumption_value' => 6],
         ]);
         $ChocolateCreamGrande = Product::where('product_id', 41)
         ->where('size_id', 3)
         ->first();

         $ChocolateCreamGrande->inventoryItems()->attach([
            49 => ['consumption_value' => 1],
            41 => ['consumption_value' => 30],
            46 => ['consumption_value' => 651],
            3 => ['consumption_value' => 1],
            47 => ['consumption_value' => 46],
            50 => ['consumption_value' => 8],
         ]);
         $StrawberryCreamMedio = Product::where('product_id', 42) // product_details 1 - okinawa
         ->where('size_id', 2) // 2 - medio
         ->first();

         $StrawberryCreamMedio->inventoryItems()->attach([
             //inventory_item_id => ['consumption_value' => kung ilan consume per bili]
            49 => ['consumption_value' => 1], // 51 kasi ayun yung plastic cup regular, consumption value 1 kasi isa langg naman need na cup
            42 => ['consumption_value' => 20], // 7 - ayun yugn okinawa powder, 2 grams imbento lang
            46 => ['consumption_value' => 473],
            3 => ['consumption_value' => 1],
            47 => ['consumption_value' => 34],
            50 => ['consumption_value' => 6],
         ]);
         $StrawberryCreamGrande = Product::where('product_id', 42)
         ->where('size_id', 3)
         ->first();

         $StrawberryCreamGrande->inventoryItems()->attach([
            49 => ['consumption_value' => 1],
            42 => ['consumption_value' => 30],
            46 => ['consumption_value' => 651],
            3 => ['consumption_value' => 1],
            47 => ['consumption_value' => 46],
            50 => ['consumption_value' => 8],
         ]);
         $Pearl = Product::where('product_id', 43)
         ->where('size_id', 4)
         ->first();

         $Pearl->inventoryItems()->attach([
            43 => ['Consumption_value' => 5]
         ]);
         $Crystal = Product::where('product_id', 44)
         ->where('size_id', 4)
         ->first();

         $Crystal->inventoryItems()->attach([
            44 =>['consumption_id' => 5]
         ]);
         $CreamCheese = Product::where('product_id', 45)
         ->where('size_id', 4)
         ->first();

         $CreamCheese->inventoryItems()->attach([
            56 =>['consumption_id' => 5]
         ]);
         $Coffeejelly = Product::where('product_id', 46)
         ->where('size_id', 4)
         ->first();

         $Coffeejelly->inventoryItems()->attach([
            57 =>['consumption_id' => 5]
         ]);
         $CreamPuff = Product::where('product_id', 47)
         ->where('size_id', 4)
         ->first();

         $CreamPuff->inventoryItems()->attach([
            45 =>['consumption_id' => 5]
         ]);
         $CheeseCake = Product::where('product_id', 48)
         ->where('size_id', 4)
         ->first();

         $CheeseCake->inventoryItems()->attach([
            58 =>['consumption_id' =>5]
         ]);
        // after niyo magawa to lahat, comment niyo yung nasa line 17 to 25, yung Product::all() saka foreach loop
        }
}
