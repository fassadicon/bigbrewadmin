<?php

namespace App\Livewire\Product;

use Livewire\Component;
use App\Livewire\Modal;

class ViewModal extends Modal
{
    public function render()
    {
        return view('livewire.product.view-modal');
    }
}
