<?php

namespace Database\Seeders;

use App\Models\InventoryItem;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PurchaseOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //po1start
        $Plasticcupregular = InventoryItem::where('name', 'Plastic Cup - Regular')->first();
        $PlasticCupSmall = InventoryItem::where('name', 'Plastic Cup - Small')->first();
        $purchaseOrderItems = [
            [
                'user_id' => 1,
                'inventory_item_id' => $Plasticcupregular->id,
                'quantity' => 1000,
                'unit_measurement' => $Plasticcupregular->measurement,
                'unit_price' => $Plasticcupregular->unit_price,
                'amount' => 1000 * $Plasticcupregular->unit_price,
                'description' => '',
                'status' => 1 // 1 - Pending, 2 - Incomplete, 3 - Completed
            ],
            [
                'user_id' => 1,
                'inventory_item_id' => $PlasticCupSmall->id,
                'quantity' => 1000,
                'unit_measurement' => $PlasticCupSmall->measurement,
                'unit_price' => $PlasticCupSmall->unit_price,
                'amount' => 1000 * $PlasticCupSmall->unit_price,
                'description' => '',
                'status' => 1 // 1 - Pending, 2 - Incomplete, 3 - Completed
            ]
        ];



        $PO1TOTALAMOUNT=0;
        foreach ($purchaseOrderItems as $purchaseOrderItem) {
            $PO1TOTALAMOUNT += $purchaseOrderItem['amount'];

        }
        $purchaseOrder = PurchaseOrder::create([
            'user_id' => 1,
            'supplier_id' => 1, // 1 - BigBrew, 2 and others new suppliers
            'total_amount'=>$PO1TOTALAMOUNT,
            'status' => 1 // 1 - Pending, 2 - Incomplete, 3 - Completed
        ]);

        foreach ($purchaseOrderItems as $purchaseOrderItem) {
            $purchaseOrderItem['purchase_order_id'] = $purchaseOrder->id;
            PurchaseOrderItem::create($purchaseOrderItem);
        }
        //PO1END

         //po2start
         $okinawapowder = InventoryItem::where('name', 'okinawa powder')->first();
         $wintermelonpowder = InventoryItem::where('name', 'wintermelon powder')->first();
         $purchaseOrderItems = [
             [
                 'user_id' => 1,
                 'inventory_item_id' => $okinawapowder->id,
                 'quantity' => 10000,
                 'unit_measurement' => $okinawapowder->measurement,
                 'unit_price' => $okinawapowder->unit_price,
                 'amount' => 10000 * $okinawapowder->unit_price,
                 'description' => '',
                 'status' => 1 // 1 - Pending, 2 - Incomplete, 3 - Completed
             ],
             [
                 'user_id' => 1,
                 'inventory_item_id' => $wintermelonpowder->id,
                 'quantity' => 1000,
                 'unit_measurement' => $wintermelonpowder->measurement,
                 'unit_price' => $wintermelonpowder->unit_price,
                 'amount' => 1000 * $wintermelonpowder->unit_price,
                 'description' => '',
                 'status' => 1 // 1 - Pending, 2 - Incomplete, 3 - Completed
             ]
         ];



         $PO2TOTALAMOUNT=0;
         foreach ($purchaseOrderItems as $purchaseOrderItem) {
             $PO2TOTALAMOUNT += $purchaseOrderItem['amount'];

         }

         $purchaseOrder = PurchaseOrder::create([
             'user_id' => 1,
             'supplier_id' => 1, // 1 - BigBrew, 2 and others new suppliers
             'total_amount'=>$PO2TOTALAMOUNT,
             'status' => 1 // 1 - Pending, 2 - Incomplete, 3 - Completed
         ]);

         foreach ($purchaseOrderItems as $purchaseOrderItem) {
             $purchaseOrderItem['purchase_order_id'] = $purchaseOrder->id;
             PurchaseOrderItem::create($purchaseOrderItem);
         }
         //PO2END
         //po3start
         $water = InventoryItem::where('name', 'water')->first();
         $coffeecreamer = InventoryItem::where('name', 'coffee creamer')->first();
         $purchaseOrderItems = [
             [
                 'user_id' => 1,
                 'inventory_item_id' => $water->id,
                 'quantity' => 11358,
                 'unit_measurement' => $water->measurement,
                 'unit_price' => $water->unit_price,
                 'amount' => 11358 * $water->unit_price,
                 'description' => '',
                 'status' => 1 // 1 - Pending, 2 - Incomplete, 3 - Completed
             ],
             [
                 'user_id' => 1,
                 'inventory_item_id' => $coffeecreamer->id,
                 'quantity' => 1000,
                 'unit_measurement' => $coffeecreamer->measurement,
                 'unit_price' => $coffeecreamer->unit_price,
                 'amount' => 1000 * $coffeecreamer->unit_price,
                 'description' => '',
                 'status' => 1 // 1 - Pending, 2 - Incomplete, 3 - Completed
             ]
         ];



         $PO3TOTALAMOUNT=0;
         foreach ($purchaseOrderItems as $purchaseOrderItem) {
             $PO3TOTALAMOUNT += $purchaseOrderItem['amount'];

         }

         $purchaseOrder = PurchaseOrder::create([
             'user_id' => 1,
             'supplier_id' => 1, // 1 - BigBrew, 2 and others new suppliers
             'total_amount'=>$PO3TOTALAMOUNT,
             'status' => 1 // 1 - Pending, 2 - Incomplete, 3 - Completed
         ]);

         foreach ($purchaseOrderItems as $purchaseOrderItem) {
             $purchaseOrderItem['purchase_order_id'] = $purchaseOrder->id;
             PurchaseOrderItem::create($purchaseOrderItem);
         }
         //po4start
         $sugar = InventoryItem::where('name', 'sugar')->first();
         $pearl = InventoryItem::where('name', 'pearl')->first();
         $purchaseOrderItems = [
             [
                 'user_id' => 1,
                 'inventory_item_id' => $sugar->id,
                 'quantity' => 10000,
                 'unit_measurement' => $sugar->measurement,
                 'unit_price' =>  $sugar->unit_price,
                 'amount' => 5 *  $sugar->unit_price,
                 'description' => '',
                 'status' => 1 // 1 - Pending, 2 - Incomplete, 3 - Completed
             ],
             [
                 'user_id' => 1,
                 'inventory_item_id' => $pearl->id,
                 'quantity' => 10000,
                 'unit_measurement' =>  $pearl->measurement,
                 'unit_price' => $pearl->unit_price,
                 'amount' => 5 * $pearl->unit_price,
                 'description' => '',
                 'status' => 1 // 1 - Pending, 2 - Incomplete, 3 - Completed
             ]
         ];



         $PO4TOTALAMOUNT=0;
         foreach ($purchaseOrderItems as $purchaseOrderItem) {
             $PO4TOTALAMOUNT += $purchaseOrderItem['amount'];

         }

         $purchaseOrder = PurchaseOrder::create([
             'user_id' => 1,
             'supplier_id' => 1, // 1 - BigBrew, 2 and others new suppliers
             'total_amount'=>$PO4TOTALAMOUNT,
             'status' => 1 // 1 - Pending, 2 - Incomplete, 3 - Completed
         ]);

         foreach ($purchaseOrderItems as $purchaseOrderItem) {
             $purchaseOrderItem['purchase_order_id'] = $purchaseOrder->id;
             PurchaseOrderItem::create($purchaseOrderItem);
         }

         //po5start
         $crystal = InventoryItem::where('name', 'crystal')->first();
         $vacuumsealedplasticcover = InventoryItem::where('name', 'vacuum sealed plastic cover')->first();
         $purchaseOrderItems = [
             [
                 'user_id' => 1,
                 'inventory_item_id' => $crystal->id,
                 'quantity' => 10000,
                 'unit_measurement' => $crystal->measurement,
                 'unit_price' => $crystal->unit_price,
                 'amount' => 10000 * $crystal->unit_price,
                 'description' => '',
                 'status' => 1 // 1 - Pending, 2 - Incomplete, 3 - Completed
             ],
             [
                 'user_id' => 1,
                 'inventory_item_id' => $vacuumsealedplasticcover->id,
                 'quantity' => 10000,
                 'unit_measurement' =>  $vacuumsealedplasticcover->measurement,
                 'unit_price' =>  $vacuumsealedplasticcover->unit_price,
                 'amount' => 1000 *  $vacuumsealedplasticcover->unit_price,
                 'description' => '',
                 'status' => 1 // 1 - Pending, 2 - Incomplete, 3 - Completed
             ]
         ];



         $PO5TOTALAMOUNT=0;
         foreach ($purchaseOrderItems as $purchaseOrderItem) {
             $PO5TOTALAMOUNT += $purchaseOrderItem['amount'];

         }

         $purchaseOrder = PurchaseOrder::create([
             'user_id' => 1,
             'supplier_id' => 1, // 1 - BigBrew, 2 and others new suppliers
             'total_amount'=>$PO5TOTALAMOUNT,
             'status' => 1 // 1 - Pending, 2 - Incomplete, 3 - Completed
         ]);

         foreach ($purchaseOrderItems as $purchaseOrderItem) {
             $purchaseOrderItem['purchase_order_id'] = $purchaseOrder->id;
             PurchaseOrderItem::create($purchaseOrderItem);
         }
         //PO5END
    }
}
