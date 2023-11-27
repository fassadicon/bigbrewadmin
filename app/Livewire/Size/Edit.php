<?php

namespace App\Livewire\Size;

use App\Models\Size;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Livewire\Forms\EditSizeForm;

class Edit extends Component
{
    public EditSizeForm $form;

    #[On('editing-product-size')]
    public function fillEditForm(Size $size)
    {
        $this->form->loadFields($size);
    }

    public function update()
    {
        $this->form->update();
        $this->dispatch('close', 'edit-product-size');
        $this->dispatch('product-size-changed');
    }
}
