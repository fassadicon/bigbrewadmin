<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Size::create([
            'name' => 'fixed',
            'measurement' => 'fixed',
            'description' => 'Default size for products that has only one size'
        ]);
        Size::create([
            'name' => 'small',
            'measurement' => '12oz',
            'description' => 'Hot coffee only'
        ]);
        Size::create([
            'name' => 'Medium',
            'measurement' => '16oz',
            'description' => 'Milktea, Fruit tea, Iced Coffee, Praf'
        ]);
        Size::create([
            'name' => 'Large',
            'measurement' => '22oz',
            'description' => 'Milktea, Fruit tea, Iced Coffee, Praf'
        ]);
    }
}
