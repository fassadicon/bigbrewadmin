<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\Size;
use Livewire\Attributes\Rule;

class CreateSizeForm extends Form
{
    public $name;
    public $measurement;
    public $description;

    public function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:sizes,name',
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

    public function store()
    {
        $this->validate();

        // Raw Query
        //    INSERT INTO sizes (name, measurement, description, created_at, updated_at, delete_at)
        //     VALUES (Extra Large, 26oz, test, today(), today(), NULL);

        // Eloquent
        Size::create([
            'name' => $this->name,
            'measurement' => $this->measurement,
            'description' => $this->description
        ]);
    }
}
