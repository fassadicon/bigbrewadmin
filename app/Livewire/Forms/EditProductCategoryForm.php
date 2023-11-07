<?php

namespace App\Livewire\Forms;

use App\Models\ProductCategory;
use Livewire\Attributes\Rule;
use Livewire\Form;

class EditProductCategoryForm extends Form
{
    public ProductCategory $category;
    public $name;
    public $description;

    public function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:product_categories,name,' . $this->category->id,
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

    public function loadFields(ProductCategory $category)
    {
        $this->name = $category->name;
        $this->description = $category->description;
        $this->category = $category;
    }

    public function update() {
        $this->validate();

        $this->category->update([
            'name' => $this->name,
            'description' => $this->description,
        ]);
    }

}
