<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\Size;
use Livewire\Attributes\Rule;
use Masmerise\Toaster\Toaster;

class EditSizeForm extends Form
{
    public Size $size;
    public $name;
    public $alias;
    public $measurement;
    public $description;

    public function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:sizes,name,' . $this->size->id,
            'alias' => 'required|string|max:255|unique:sizes,alias,' . $this->size->id,
            'measurement' => 'required',
            'description' => 'nullable|string'
        ];
    }

    public function validationAttributes()
    {
        return [
            'name' => 'name',
            'alias' => 'alias',
            'measurement' => 'measurement',
            'description' => 'description'
        ];
    }

    public function loadFields(Size $size)
    {
        $this->size = $size;
        $this->name = $size->name;
        $this->alias = $size->alias;
        $this->description = $size->description;
        $this->measurement = $size->measurement;
    }

    public function update()
    {
        $this->validate();

        $this->size->update([
            'name' => $this->name,
            'alias' => $this->alias,
            'measurement' => $this->measurement,
            'description' => $this->description,
        ]);

        Toaster::success('Size updated!');
    }
}
