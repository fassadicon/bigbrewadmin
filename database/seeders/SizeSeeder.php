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
            'name' => 'regular'
        ]);
        Size::create([
            'name' => 'small'
        ]);
        Size::create([
            'name' => 'large'
        ]);
        Size::create([
            'name' => 'extra large'
        ]);
    }
}
