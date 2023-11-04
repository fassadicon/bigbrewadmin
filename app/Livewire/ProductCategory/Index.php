<?php

namespace App\Livewire\ProductCategory;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ProductCategory;

class Index extends Component
{
    use WithPagination;
    public $perPage = 5;

    public $search = '';
    public $status = 'active';

    public $sortBy = 'created_at';
    public $sortDir = 'DESC';

    public function setSortBy($column)
    {
        if ($this->sortBy === $column) {
            $this->sortDir = $this->sortDir == 'ASC' ? 'DESC' : 'ASC';
            return;
        }

        $this->sortBy = $column;
        $this->sortDir = 'DESC';
    }

    public function render()
    {
        $categories = ProductCategory::withTrashed()
        ->orderBy($this->sortBy, $this->sortDir)
        ->paginate($this->perPage);

        return view('livewire.product-category.index', ['categories' => $categories]);
    }
}
