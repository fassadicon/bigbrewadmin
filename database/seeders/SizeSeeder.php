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
            'name' => 'small',
            'alias' => 'S',
            'measurement' => '12oz',
            'description' => 'Hot coffee only'
        ]);
        Size::create([
            'name' => 'medio',
            'alias' => 'M',
            'measurement' => '16oz',
            'description' => 'Milktea, Fruit tea, Iced Coffee, Praf'
        ]);
        Size::create([
            'name' => 'grande',
            'alias' => 'L',
            'measurement' => '22oz',
            'description' => 'Milktea, Fruit tea, Iced Coffee, Praf'
        ]);
        Size::create([
            'name' => 'fixed',
            'alias' => 'F',
            'measurement' => 'fixed',
            'description' => 'Default size for products that has only one size'
        ]);
    }
}
