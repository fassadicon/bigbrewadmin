<?php

namespace App\Livewire\Discount;

use Livewire\Component;
use App\Models\Discount;
use Livewire\Attributes\On;
use App\Livewire\Forms\EditDiscountForm;

class Edit extends Component
{
    public EditDiscountForm $form;

    #[On('editing-discount')]
    public function fillEditForm(Discount $discount)
    {
        $this->form->loadFields($discount);
    }

    public function update()
    {
        $this->form->update();
        $this->dispatch('close', 'edit-discount');
        $this->dispatch('discount-changed');
    }
}
