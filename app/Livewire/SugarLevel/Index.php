<?php

namespace App\Livewire\SugarLevel;

use App\Models\Size;
use Livewire\Component;
use App\Models\SugarLevel;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use App\Models\SizeSugarLevel;
use Masmerise\Toaster\Toaster;
use App\Livewire\Forms\CreateSugarLevelForm;

class Index extends Component
{
    use WithPagination;
    public $perPage = 5;

    public $search = '';

    public $sortBy = 'created_at';
    public $sortDir = 'DESC';

    public $sizes;
    public $sugarLevels;

    public CreateSugarLevelForm $form;

    public function mount() {
        $this->sizes = Size::get();
        $this->sugarLevels = SugarLevel::get();
    }

    public function store()
    {
        $this->form->store();
    }

    public function edit(SizeSugarLevel $sizeSugarLevel)
    {
        $this->dispatch('editing-sugar-level', sizeSugarLevel: $sizeSugarLevel);
        $this->dispatch('open-modal', 'edit-sugar-level');
    }

    public function delete(SizeSugarLevel $sizeSugarLevel)
    {
        $sizeSugarLevel->delete();
        Toaster::warning('Sugar level deleted!');
    }

    #[On('sugar-level-changed')]
    public function refresh()
    {
    }

    public function render()
    {
        $sizeSugarLevels = SizeSugarLevel::with('size', 'sugarLevel')
        ->latest()
        ->paginate($this->perPage);
        return view('livewire.sugar-level.index', ['sizeSugarLevels' => $sizeSugarLevels]);
    }
}
