<?php

namespace App\Livewire\InventoryItem;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use App\Models\InventoryItem;
use Masmerise\Toaster\Toaster;

class Index extends Component
{
    use WithPagination;
    public $perPage = 5;

    public $search = '';
    public $status = '';

    public $sortBy = 'created_at';
    public $sortDir = 'DESC';

    public $allInventoryItems;

    public function mount()
    {
        $this->allInventoryItems = InventoryItem::select('name', 'warning_value', 'remaining_stocks')->get();
    }

    public function show(int $id)
    {
        $this->dispatch('showing-inventory-item', id: $id);
        $this->dispatch('open-modal', 'show-inventory-item');
    }

    public function edit(InventoryItem $inventoryItem)
    {
        $this->dispatch('editing-inventory-item', inventoryItem: $inventoryItem);
        $this->dispatch('open-modal', 'edit-inventory-item');
    }

    public function delete(InventoryItem $inventoryItem)
    {
        $inventoryItem->delete();
        Toaster::warning('Inventory Item archived successfully');
    }

    public function restore(int $id)
    {
        InventoryItem::withTrashed()->where('id', $id)->first()->restore();
        Toaster::success('Inventory Item restored successfully');
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

    #[On('inventory-items-changed')]
    public function refresh()
    {
    }

    public function render()
    {
        foreach ($this->allInventoryItems as $inventoryItem) {
            if ($inventoryItem->warning_value >= $inventoryItem->remaining_stocks) {
                Toaster::warning('Warning! ' . $inventoryItem->name . ' is running low on stocks!');
            }
            if ($inventoryItem->remaining_stocks <= 0) {
                Toaster::error('Error! ' . $inventoryItem->name . ' is out of stocks!');
            }
        }

        $inventoryItems = InventoryItem::withTrashed()
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

        return view('livewire.inventory-item.index', ['inventoryItems' => $inventoryItems]);
    }
}
