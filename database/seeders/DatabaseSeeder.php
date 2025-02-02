<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\InventoryItem;
use App\Models\InventoryItemCategory;
use App\Models\InventoryItemConsumption;
use App\Models\ProductCategory;
use App\Models\ProductSizeInventory;
use App\Models\SugarLevel;
use App\Models\Supplier;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // Roles, Permissions, and Users
            PermissionSeeder::class,
            RoleSeeder::class,
            OwnerSeeder::class,
            SuperAdminSeeder::class,
            AdminSeeder::class,
            EmployeeSeeder::class,

            // Products
            ProductCategorySeeder::class,
            ProductDetailSeeder::class,
            SizeSeeder::class,
            ProductSeeder::class,

            // Inventory
            // InventoryItemCategorySeeder::class,
            SupplierSeeder::class,
            InventoryItemSeeder::class,
            InventoryItemConsumptionSeeder::class,

            // Orders
            SugarLevelSeeder::class,
            SizeSugarLevelSeeder::class,
            DiscountSeeder::class,
            OrderSeeder::class,

            // Purchase Orders and Delivery Receives
            PurchaseOrderSeeder::class,
            DeliveryReceiveSeeder::class

        ]);
    }
}
