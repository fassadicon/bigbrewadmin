<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Supplier::create([
            'name' => 'Iced Coffee Original',
            'description' => 'test',
            'price' => 80.00,
        ]);
        Supplier::create([
            'name' => 'Hot Brewed Coffee',
            'description' => 'test',
            'price' => 120.00,
        ]);
    }
}
