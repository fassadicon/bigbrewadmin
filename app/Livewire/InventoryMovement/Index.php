<?php

namespace App\Livewire\InventoryMovement;

use App\Livewire\Forms\CreateInventoryLogForm;
use Livewire\Component;
use App\Models\InventoryLog;
use Livewire\WithPagination;
use App\Models\InventoryItem;

class Index extends Component
{
    use WithPagination;
    public $perPage = 5;

    public $search = '';
    public $inventoryItem = '';
    public $type = '';

    public $sortBy = 'created_at';
    public $sortDir = 'DESC';

    public $inventoryItems = [];

    public CreateInventoryLogForm $form;

    public function mount()
    {
        $this->inventoryItems = InventoryItem::withTrashed()
            ->get(['id', 'name']);
    }

    public function store()
    {
        $this->form->store();
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

    public function render()
    {
        $inventoryLogs = InventoryLog::with('inventoryItem', 'user')
            ->search($this->search)
            ->when($this->type !== '', function ($query) {
                $query->where('type', $this->type);
            })
            ->when($this->inventoryItem !== '', function ($query) {
                $query->whereHas('inventoryItem', function ($query) {
                    $query->where('id', $this->inventoryItem);
                });
            })
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage);

        return view('livewire.inventory-movement.index', [
            'inventoryLogs' => $inventoryLogs,
            'inventoryItems' => $this->inventoryItems
        ]);
    }
}
