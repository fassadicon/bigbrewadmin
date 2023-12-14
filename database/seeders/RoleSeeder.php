<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $owner = Role::create(['name' => 'Owner']);
        $superadmin = Role::create(['name' => 'Super Admin']);
        $superadmin->givePermissionTo([
            'view-role',
            'create-role',
            'edit-role',
            'delete-role',
            'view-user',
            'create-user',
            'edit-user',
            'delete-user',
            'view-product',
            'create-product',
            'edit-product',
            'delete-product'
        ]);

        $admin = Role::create(['name' => 'Admin']);
        $admin->givePermissionTo([
            'view-product',
            'create-product',
            'edit-product',
        ]);

        Role::create(['name' => 'Employee']);
    }
}
