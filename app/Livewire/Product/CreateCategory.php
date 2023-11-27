<?php

namespace App\Livewire\Product;
use App\Livewire\Forms\CreateProductCategory;
use Livewire\Component;

class CreateCategory extends Component
{
    public CreateProductCategory $form;

    public function store()
    {
        $this->form->store();

        $this->dispatch('close', 'create-product-category');
        $this->dispatch('inventory-items-changed');
    }
}
