<?php

namespace App\Livewire\Forms;

use App\Models\SugarLevel;
use Livewire\Attributes\Rule;
use Livewire\Form;

class CreateSugarLevelForm extends Form
{
    public $size_id;
    public $percentage;
    public $consumption_value;

    public function rules()
    {
        return [
            'size_id' => 'required|string|max:255|exists:sizes,id',
            'percentage' => 'required',
            'consumption_value' => 'required|numeric'
        ];
    }

    public function validationAttributes()
    {
        return [
            'size_id' => 'size',
            'percentage' => 'percentage',
            'consumption_value' => 'consumption value'
        ];
    }

    public function store()
    {
        $this->validate();

        // Raw Query
        //    INSERT INTO sizes (name, measurement, description, created_at, updated_at, delete_at)
        //     VALUES (Extra Large, 26oz, test, today(), today(), NULL);

        // Eloquent
        SugarLevel::create([
            'size_id' => $this->size_id,
            'percentage' => $this->percentage,
            'consumption_value' => $this->consumption_value
        ]);
    }
}
