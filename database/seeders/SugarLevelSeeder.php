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
        // Small
        SugarLevel::create([
            'size_id' => 1,
            'percentage' => '0%',
            'consumption_value' => 1,
        ]);
        SugarLevel::create([
            'size_id' => 1,
            'percentage' => '25%',
            'consumption_value' => 1,
        ]);
        SugarLevel::create([
            'size_id' => 1,
            'percentage' => '50%',
            'consumption_value' => 1,
        ]);
        SugarLevel::create([
            'size_id' => 1,
            'percentage' => '75%',
            'consumption_value' => 1,
        ]);
        SugarLevel::create([
            'size_id' => 1,
            'percentage' => '100%',
            'consumption_value' => 1,
        ]);
        // Medium
        SugarLevel::create([
            'size_id' => 2,
            'percentage' => '0%',
            'consumption_value' => 2,
        ]);
        SugarLevel::create([
            'size_id' => 2,
            'percentage' => '25%',
            'consumption_value' => 2,
        ]);
        SugarLevel::create([
            'size_id' => 2,
            'percentage' => '50%',
            'consumption_value' => 2,
        ]);
        SugarLevel::create([
            'size_id' => 2,
            'percentage' => '75%',
            'consumption_value' => 2,
        ]);
        SugarLevel::create([
            'size_id' => 2,
            'percentage' => '100%',
            'consumption_value' => 2,
        ]);
        // Large
        SugarLevel::create([
            'size_id' => 3,
            'percentage' => '0%',
            'consumption_value' => 3,
        ]);
        SugarLevel::create([
            'size_id' => 3,
            'percentage' => '25%',
            'consumption_value' => 3,
        ]);
        SugarLevel::create([
            'size_id' => 3,
            'percentage' => '50%',
            'consumption_value' => 3,
        ]);
        SugarLevel::create([
            'size_id' => 3,
            'percentage' => '75%',
            'consumption_value' => 3,
        ]);
        SugarLevel::create([
            'size_id' => 3,
            'percentage' => '100%',
            'consumption_value' => 3,
        ]);
    }
}
