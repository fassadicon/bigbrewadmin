<?php

namespace Database\Seeders;

use App\Models\Discount;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Discount::create([
            'name' => 'PWD',
            'type' => 2,
            'value' => 20,
            'status' => 1,
        ]);

        Discount::create([
            'name' => 'Senior Citizen',
            'type' => 2,
            'value' => 20,
            'status' => 1,
        ]);

        Discount::create([
            'name' => 'New Year New Me',
            'type' => 1,
            'value' => 24,
            'start_date' => '2024-01-01',
            'end_date' => '2024-01-31',
            'status' => 1,
        ]);

        Discount::create([
            'name' => 'Valentines',
            'type' => 1,
            'value' => 14,
            'start_date' => '2024-02-14',
            'end_date' => '2024-02-15',
            'status' => 3,
        ]);

        Discount::create([
            'name' => 'Xmas Special',
            'type' => 1,
            'value' => 25,
            'start_date' => '2023-12-01',
            'end_date' => '2023-12-31',
            'status' => 2,
        ]);

        Discount::create([
            'name' => 'Happy Day',
            'type' => 1,
            'value' => 10,
            'start_date' => Carbon::today()->format('Y-m-d'),
            'end_date' => Carbon::tomorrow()->format('Y-m-d'),
            'status' => 2,
        ]);
    }
}
