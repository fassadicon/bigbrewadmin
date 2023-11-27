<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // Roles
            'view-role',
            'create-role',
            'edit-role',
            'delete-role',
            // Users
            'view-user',
            'create-user',
            'edit-user',
            'delete-user',
            // Products
            'view-product',
            'create-product',
            'edit-product',
            'delete-product',
            // Inventory
        ];

        // Looping and Inserting Array's Permissions into Permission Table
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
