<?php

namespace App\Livewire\ProductCategory;

use App\Livewire\Forms\EditProductCategoryForm;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\ProductCategory;

class Edit extends Component
{
    public EditProductCategoryForm $form;

    #[On('editing-product-category')]
    public function fillEditForm(ProductCategory $category) {
        $this->form->loadFields($category);
    }

    public function update()
    {
        $this->form->update();
        $this->dispatch('close', 'edit-product-category');
        $this->dispatch('product-category-changed');
    }
}
