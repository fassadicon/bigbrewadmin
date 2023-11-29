<?php

namespace App\Livewire\Forms;

use App\Models\SizeSugarLevel;
use Livewire\Attributes\Rule;
use Livewire\Form;

class EditSugarLevelForm extends Form
{
    public SizeSugarLevel $sizeSugarLevel;
    public $size_id;
    public $sugar_level_id;
    public $consumption_value;

    public function rules()
    {
        return [
            'size_id' => 'required|numeric',
            'sugar_level_id' => 'required|numeric',
            'consumption_value' => 'required|numeric',
        ];
    }

    public function validationAttributes()
    {
        return [
            'size_id' => 'size',
            'sugar_level_id' => 'sugar level',
            'consumption_value' => 'consumption value',
        ];
    }

    public function loadFields(SizeSugarLevel $sizeSugarLevel)
    {
        $this->sizeSugarLevel = $sizeSugarLevel;
        $this->size_id = $sizeSugarLevel->size_id;
        $this->sugar_level_id = $sizeSugarLevel->sugar_level_id;
        $this->consumption_value = $sizeSugarLevel->consumption_value;
    }

    public function update()
    {
        $this->validate();

        $this->sizeSugarLevel->update([
            'size_id' => $this->size_id,
            'sugar_level_id' => $this->sugar_level_id,
            'consumption_value' => $this->consumption_value,
        ]);
    }
}
