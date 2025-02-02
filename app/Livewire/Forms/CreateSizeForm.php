<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\Size;
use Livewire\Attributes\Rule;
use Masmerise\Toaster\Toaster;

class CreateSizeForm extends Form
{
    public $name;
    public $alias;
    public $measurement;
    public $description;

    public function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:sizes,name',
            'alias' => 'required|string|max:255|unique:sizes,alias',
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

    public function store()
    {
        $this->validate();

        Size::create([
            'name' => $this->name,
            'alias' => $this->alias,
            'measurement' => $this->measurement,
            'description' => $this->description
        ]);

        Toaster::success('Size created!');
    }
}
