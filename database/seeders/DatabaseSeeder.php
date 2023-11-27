<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Products;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $products = [
            [
                'name' => 'Black Iced Coffee',
                'description' => 'black coffee',
                'price' => '100',
                'status' => '1',
                'image' => '17hdyss777x',
            ],
            [
                'name' => 'Latte',
                'description' => 'Creamy espresso with steamed milk',
                'price' => '150',
                'status' => '1',
                'image' => 'xyz123',
            ],
            [
                'name' => 'Cappuccino',
                'description' => 'Espresso with equal parts of steamed milk and milk foam',
                'price' => '120',
                'status' => '1',
                'image' => 'abc456',
            ],
            [
                'name' => 'Mocha',
                'description' => 'Espresso with steamed milk and chocolate',
                'price' => '160',
                'status' => '1',
                'image' => 'mocha789',
            ],
            [
                'name' => 'Espresso',
                'description' => 'Strong and concentrated coffee',
                'price' => '90',
                'status' => '1',
                'image' => 'espresso123',
            ],
            [
                'name' => 'Macchiato',
                'description' => 'Espresso with a dollop of frothy milk',
                'price' => '130',
                'status' => '1',
                'image' => 'macchiato456',
            ],
            [
                'name' => 'Americano',
                'description' => 'Diluted espresso with hot water',
                'price' => '110',
                'status' => '1',
                'image' => 'americano789',
            ],
            [
                'name' => 'Chai Latte',
                'description' => 'Spiced tea with steamed milk',
                'price' => '140',
                'status' => '1',
                'image' => 'chai123',
            ],
            [
                'name' => 'Flat White',
                'description' => 'Espresso with velvety microfoam',
                'price' => '170',
                'status' => '1',
                'image' => 'flatwhite456',
            ],
        ];
        

        foreach ($products as $product) {
            Products::create($product);
        }
    }
}
