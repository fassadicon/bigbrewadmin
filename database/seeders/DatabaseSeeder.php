<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\InventoryItem;
use App\Models\InventoryItemCategory;
use App\Models\InventoryItemConsumption;
use App\Models\ProductCategory;
use App\Models\ProductSizeInventory;
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
            SuperAdminSeeder::class,
            AdminSeeder::class,

            // Products
            ProductCategorySeeder::class,
            ProductDetailSeeder::class,
            SizeSeeder::class,
            ProductSeeder::class,

            // Inventory
            // InventoryItemCategorySeeder::class,
            InventoryItemSeeder::class,
            InventoryItemConsumptionSeeder::class,

            // Orders
            OrderSeeder::class
        ]);
    }
}
