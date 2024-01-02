<?php

namespace App\Livewire\Supplier;

use Livewire\Component;
use App\Models\Supplier;
use Livewire\Attributes\On;
use App\Livewire\Forms\EditSupplierForm;

class Edit extends Component
{
    public EditSupplierForm $form;

    #[On('editing-supplier')]
    public function fillEditForm(Supplier $supplier)
    {
        $this->form->loadFields($supplier);
    }

    public function update()
    {
        $this->form->update();
        $this->dispatch('close', 'edit-supplier');
        $this->dispatch('supplier-created');
    }
}
