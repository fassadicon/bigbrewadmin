<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\Size;
use Livewire\Attributes\Rule;

class EditSizeForm extends Form
{
    public Size $size;
    public $name;
    public $measurement;
    public $description;

    public function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:sizes,name,' . $this->size->id,
            'measurement' => 'required',
            'description' => 'nullable|string'
        ];
    }

    public function validationAttributes()
    {
        return [
            'name' => 'name',
            'measurement' => 'measurement',
            'description' => 'description'
        ];
    }

    public function loadFields(Size $size)
    {
        $this->size = $size;
        $this->name = $size->name;
        $this->description = $size->description;
        $this->measurement = $size->measurement;
        $this->size = $size;
    }

    public function update()
    {
        $this->validate();

        $this->size->update([
            'name' => $this->name,
            'measurement' => $this->measurement,
            'description' => $this->description,
        ]);
    }
}
