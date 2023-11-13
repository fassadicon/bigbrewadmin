<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Livewire\Forms\EditUserForm;

class Edit extends Component
{
    public EditUserForm $form;

    #[On('editing-user')]
    public function fillEditForm(User $user)
    {
        $this->form->loadFields($user);
    }

    public function update()
    {
        // $this->form->update();
        // $this->dispatch('close', 'edit-product-size');
        // $this->dispatch('product-size-changed');
    }
}
