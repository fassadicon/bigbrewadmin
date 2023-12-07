<?php

namespace App\Livewire\Forms;

use App\Models\Supplier;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CreateSupplierForm extends Form
{
    public $name;
    public $description;

    public function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:suppliers,name',
            'description' => 'nullable|string'
        ];
    }

    public function validationAttributes()
    {
        return [
            'name' => 'name',
            'description' => 'description'
        ];
    }

    public function store()
    {
        $this->validate();

        Supplier::create([
            'name' => $this->name,
            'description' => $this->description
        ]);
    }
}
