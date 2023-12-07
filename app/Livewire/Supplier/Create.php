<?php

namespace App\Livewire\Supplier;

use Livewire\Component;
use App\Livewire\Forms\CreateSupplierForm;

class Create extends Component
{
    public CreateSupplierForm $form;

    public function storeSupplier() {
        $this->form->store();
        $this->dispatch('supplier-created');
        $this->dispatch('close', 'create-supplier');
    }
}
