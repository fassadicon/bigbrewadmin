<?php

namespace App\Livewire\ProductCategory;

use App\Livewire\Forms\CreateProductCategory;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use App\Models\ProductCategory;
use Masmerise\Toaster\Toaster;

class Index extends Component
{
    use WithPagination;
    public $perPage = 5;

    public $search = '';
    public $status = '';

    public $sortBy = 'created_at';
    public $sortDir = 'DESC';

    public CreateProductCategory $form;

    public function store()
    {
        $this->form->store();
        $this->dispatch('product-category-changed');

    }

    public function showCategory(int $id)
    {
        $this->dispatch('showing-product-category', id: $id);
        $this->dispatch('open-modal', 'show-product-category');
    }

    public function editCategory(ProductCategory $category)
    {
        $this->dispatch('editing-product-category', category: $category);
        $this->dispatch('open-modal', 'edit-product-category');
    }

    public function delete(ProductCategory $category)
    {
        $category->delete();
        Toaster::warning('Product category archived!');
    }

    public function restore(int $id)
    {
        ProductCategory::withTrashed()->where('id', $id)->first()->restore();
        Toaster::success('Product category restored!');
    }

    public function setSortBy($column)
    {
        if ($this->sortBy === $column) {
            $this->sortDir = $this->sortDir == 'ASC' ? 'DESC' : 'ASC';
            return;
        }

        $this->sortBy = $column;
        $this->sortDir = 'DESC';
    }

    #[On('product-category-changed')]
    public function refresh()
    {
    }

    public function render()
    {
        $categories = ProductCategory::withTrashed()
            ->search($this->search)
            ->when($this->status !== '', function ($query) {
                $query->when($this->status === 'active', function ($query) {
                    $query->whereNull('deleted_at');
                })->when($this->status === 'inactive', function ($query) {
                    $query->whereNotNull('deleted_at');
                });
            })
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage);

        return view('livewire.product-category.index', ['categories' => $categories]);
    }
}
