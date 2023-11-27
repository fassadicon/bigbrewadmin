<?php

namespace Database\Seeders;

use App\Models\SugarLevel;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SugarLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SugarLevel::create([
            'percentage' => '0%',
        ]);
        SugarLevel::create([
            'percentage' => '25%',
        ]);
        SugarLevel::create([
            'percentage' => '50%',
        ]);
        SugarLevel::create([
            'percentage' => '75%',
        ]);
        SugarLevel::create([
            'percentage' => '100%',
        ]);
    }
}
