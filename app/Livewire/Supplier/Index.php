<?php

namespace App\Livewire\Supplier;

use Livewire\Component;
use App\Models\Supplier;
use Livewire\Attributes\On;
use Masmerise\Toaster\Toaster;

class Index extends Component
{
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
        $this->dispatch('editing-supplier', size: $supplier);
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
        $suppliers = Supplier::paginate(5);
        return view('livewire.supplier.index', ['suppliers' => $suppliers]);
    }
}
