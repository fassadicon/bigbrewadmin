<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\Size;
use App\Models\SizeSugarLevel;
use App\Models\SugarLevel;
use Livewire\Attributes\Rule;

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
        // dd($size->sugarLevels);
        foreach($size->sugarLevels as $sugarLevel) {
            if ($sugarLevel->id == $this->sugar_level_id) {
                dd('Sugar Level in this size already exists. Are you sure you want to update?');
            }
        }

        $size->sugarLevels()->attach($this->sugar_level_id, ['consumption_value' => $this->consumption_value]);

    }
}
