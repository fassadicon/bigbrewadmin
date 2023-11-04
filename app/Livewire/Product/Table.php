<?php

namespace App\Livewire\Product;

use App\Models\Size;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ProductDetail;
use App\Models\ProductCategory;

class Table extends Component
{
    use WithPagination;
    public $perPage = 5;

    public $search = '';
    public $category = '';
    public $size = '';
    public $status = 'active';

    public $sortBy = 'created_at';
    public $sortDir = 'DESC';

    public $categories;
    public $sizes;

    public function mount() {
        $this->categories = ProductCategory::all();
        $this->sizes = Size::all();
    }

    public function render()
    {
        $productDetails = ProductDetail::withTrashed()
            ->search($this->search)
            ->when($this->category !== '', function ($query) {
                $query->where('category_id', $this->category);
            })
            ->when($this->size !== '', function ($query) {
                $query->whereHas('sizes', function($query) {
                    $query->where('name', $this->size);
                });
            })
            ->when($this->status !== '', function ($query) {
                $query->when($this->status === 'active', function ($query) {
                    $query->whereNull('deleted_at');
                })->when($this->status === 'inactive', function ($query) {
                    $query->whereNotNull('deleted_at');
                });
            })
            ->with(['category', 'sizes.pivot.inventoryItems'])
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage);

        return view(
            'livewire.product.table',
            [
                'productDetails' => $productDetails,
            ]
        );
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

    public function delete(ProductDetail $productDetail)
    {
        $productDetail->delete();
    }

    public function restore($productDetailId)
    {
        ProductDetail::withTrashed()->find($productDetailId)->restore();
    }
}
