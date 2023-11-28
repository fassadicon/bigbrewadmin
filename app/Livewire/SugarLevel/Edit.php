<?php

namespace App\Livewire\SugarLevel;

use App\Livewire\Forms\EditSugarLevelForm;
use App\Models\SizeSugarLevel;
use App\Models\SugarLevel;
use App\Models\Size;
use Livewire\Component;
use Livewire\Attributes\On;

class Edit extends Component
{
    public EditSugarLevelForm $form;

    public $sizes;
    public $sugarLevels;

    public function mount() {
        $this->sizes = Size::select('id', 'name')->get();
        $this->sugarLevels = SugarLevel::select('id', 'percentage')->get();
    }

    #[On('editing-sugar-level')]
    public function fillEditForm(SizeSugarLevel $sizeSugarLevel)
    {
        $this->form->loadFields($sizeSugarLevel);
    }

    public function update()
    {
        $this->form->update();
        $this->dispatch('close', 'edit-sugar-level');
        $this->dispatch('sugar-level-changed');
    }
}
