<?php

namespace Database\Seeders;

use App\Models\Size;
use App\Models\SugarLevel;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SizeSugarLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sizes = Size::whereNot('id', 4)->get();
        $sugarLevels = SugarLevel::all();

        foreach ($sizes as $size) {
            foreach ($sugarLevels as $sugarLevel) {
                $size->sugarLevels()->attach($sugarLevel->id, ['consumption_value' => $sugarLevel->id]);
            }
        }
    }
}
