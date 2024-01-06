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
        // Sizes
        $small = Size::where('id', 1)->first();
        $medio = Size::where('id', 2)->first();
        $grande = Size::where('id', 3)->first();

        // Sugar Levels
        $_0 = SugarLevel::where('id', 1)->pluck('id')->first();
        $_25 = SugarLevel::where('id', 2)->pluck('id')->first();
        $_50 = SugarLevel::where('id', 3)->pluck('id')->first();
        $_75 = SugarLevel::where('id', 4)->pluck('id')->first();
        $_100 = SugarLevel::where('id', 5)->pluck('id')->first();

        $small->sugarLevels()->sync([
            $_0 => ['consumption_value' => 0],
            $_25 => ['consumption_value' => 10],
            $_50 => ['consumption_value' => 20],
            $_75 => ['consumption_value' => 30],
            $_100 => ['consumption_value' => 40],
        ]);

        $medio->sugarLevels()->sync([
            $_0 => ['consumption_value' => 0],
            $_25 => ['consumption_value' => 20],
            $_50 => ['consumption_value' => 30],
            $_75 => ['consumption_value' => 40],
            $_100 => ['consumption_value' => 50],
        ]);

        $grande->sugarLevels()->sync([
            $_0 => ['consumption_value' => 0],
            $_25 => ['consumption_value' => 30],
            $_50 => ['consumption_value' => 40],
            $_75 => ['consumption_value' => 50],
            $_100 => ['consumption_value' => 60],
        ]);

      /*   foreach ($sizes as $size) {
            foreach ($sugarLevels as $sugarLevel) {
                $size->sugarLevels()->attach($sugarLevel->id, ['consumption_value' => $sugarLevel->id]);
            }
        } */
    }
}
