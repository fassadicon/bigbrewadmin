<?php

namespace App\Livewire\Supplier;

use Livewire\Component;
use App\Models\Supplier;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;

class Index extends Component
{
    use WithPagination;
    public $perPage = 5;

    public $search = '';
    public $status = '';

    public $sortBy = 'created_at';
    public $sortDir = 'DESC';

    #[On('supplier-created')]
    public function refresh()
    {
    }

    public function show(int $id)
    {
        $this->dispatch('showing-supplier', id: $id);
        $this->dispatch('open-modal', 'show-supplier');
    }

    public function edit(Supplier $supplier)
    {
        $this->dispatch('editing-supplier', supplier: $supplier);
        $this->dispatch('open-modal', 'edit-supplier');
    }

    public function delete(Supplier $supplier)
    {
        $supplier->delete();
        Toaster::warning('Supplier archived!');
    }

    public function restore(int $id)
    {
        Supplier::withTrashed()->where('id', $id)->first()->restore();
        Toaster::success('Supplier restored!');
    }

    public function render()
    {
        $suppliers = Supplier::withTrashed()
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
        return view('livewire.supplier.index', ['suppliers' => $suppliers]);
    }
}
