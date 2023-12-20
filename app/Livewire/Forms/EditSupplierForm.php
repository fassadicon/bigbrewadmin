<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\Supplier;
use Masmerise\Toaster\Toaster;
use Livewire\Attributes\Validate;

class EditSupplierForm extends Form
{
    public Supplier $supplier;
    public $name;
    public $description;

    public function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:suppliers,name,' . $this->supplier->id,
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

    public function loadFields(Supplier $supplier)
    {
        $this->supplier = $supplier;
        $this->name = $supplier->name;
        $this->description = $supplier->description;
    }

    public function update()
    {
        $this->validate();

        $this->supplier->update([
            'name' => $this->name,
            'description' => $this->description,
        ]);

        Toaster::success('Supplier updated!');
    }
}
