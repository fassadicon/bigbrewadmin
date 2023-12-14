<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\Size;
use App\Models\SugarLevel;
use Livewire\Attributes\Rule;
use App\Models\SizeSugarLevel;
use Masmerise\Toaster\Toaster;

class CreateSugarLevelForm extends Form
{
    public $size_id;
    public $sugar_level_id;
    public $consumption_value;

    public function rules()
    {
        return [
            'size_id' => 'required|numeric|exists:sizes,id',
            'sugar_level_id' => 'required|numeric|exists:sugar_levels,id',
            'consumption_value' => 'required|numeric'
        ];
    }

    public function validationAttributes()
    {
        return [
            'size_id' => 'size',
            'sugar_level_id' => 'percentage',
            'consumption_value' => 'consumption value'
        ];
    }

    public function store()
    {
        $this->validate();

        $size = Size::where('id', $this->size_id)->first();
        foreach($size->sugarLevels as $sugarLevel) {
            if ($sugarLevel->id == $this->sugar_level_id) {
                Toaster::warning('Sugar Level in this size already exists. Please edit the existing sugar level instead.');
                return;
            }
        }

        $size->sugarLevels()->attach($this->sugar_level_id, ['consumption_value' => $this->consumption_value]);

        Toaster::success('Sugar level created!');
    }
}
