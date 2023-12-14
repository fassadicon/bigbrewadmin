<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use Livewire\Attributes\Rule;
use App\Models\ProductCategory;
use Masmerise\Toaster\Toaster;

class CreateProductCategory extends Form
{
    public ProductCategory $category;
    public $name;
    public $description;

    public function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:product_categories,name',
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

        ProductCategory::create([
            'name' => $this->name,
            'description' => $this->description,
        ]);

        Toaster::success('Product category created!');
    }
}
