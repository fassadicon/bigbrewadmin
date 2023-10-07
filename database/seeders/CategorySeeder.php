<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Coffee',
            'description' => 'test',
        ]);
        Category::create([
            'name' => 'Frappes',
            'description' => 'test',
        ]);
        Category::create([
            'name' => 'Iced Drinks',
            'description' => 'test',
        ]);
        Category::create([
            'name' => 'Hot Drinks',
            'description' => 'test',
        ]);
        Category::create([
            'name' => 'Snacks',
            'description' => 'test',
        ]);
    }
}
