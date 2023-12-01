<?php

namespace App\Livewire\Pos;

use Livewire\Component;
use Livewire\Attributes\On;

class ConfirmOrder extends Component
{
    public $currentTotalAmount;
    #[On('confirming-order')]
    public function fillCurrentTotalAmount($currentTotalAmount) {
        $this->currentTotalAmount = $currentTotalAmount;
    }
}
