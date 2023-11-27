<?php

namespace App\Livewire\SugarLevel;

use App\Livewire\Forms\CreateSugarLevelForm;
use App\Models\SizeSugarLevel;
use Livewire\Component;
use App\Models\SugarLevel;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $perPage = 5;

    public $search = '';
    public $status = 'active';

    public $sortBy = 'created_at';
    public $sortDir = 'DESC';

    public CreateSugarLevelForm $form;

    public function render()
    {
        $sizeSugarLevels = SizeSugarLevel::with('size', 'sugarLevel')
        ->paginate(5);
        return view('livewire.sugar-level.index', ['sizeSugarLevels' => $sizeSugarLevels]);
    }
}
