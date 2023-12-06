<?php

namespace App\Livewire\InventoryMovement;

use App\Exports\InventoryMovementExport;
use Livewire\Component;
use App\Models\InventoryLog;
use Livewire\WithPagination;
use App\Models\InventoryItem;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Livewire\Forms\CreateInventoryLogForm;
use App\Models\Supplier;

class Index extends Component
{
    use WithPagination;
    public $perPage = 5;

    public $search = '';
    public $type = '';
    public $start;
    public $end;
    public $sortBy = 'created_at';
    public $sortDir = 'DESC';

    public $inventoryItems = [];

    public $suppliers;

    public CreateInventoryLogForm $form;

    public function mount()
    {
        $this->suppliers = Supplier::all();
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

    public function export()
    {
        return Excel::download(new InventoryMovementExport(
            $this->search,
            $this->type,
            $this->start,
            $this->end,
            $this->sortBy,
            $this->sortDir
        ), 'inventory_movement.xlsx');
    }

    public function render()
    {
        if ($this->start == "") {
            $this->start = null;
        }

        if ($this->end == "") {
            $this->end = null;
        }

        $inventoryLogs = InventoryLog::with('inventoryItem', 'user')
            ->search($this->search)
            ->when($this->type !== '', function ($query) {
                $query->where('type', $this->type);
            })
            ->when($this->start && $this->end, function ($query) {
                $query->when($this->start == $this->end, function ($query) {
                    return $query->whereDate('created_at', Carbon::parse($this->end)->endOfDay()->format('Y-m-d'));
                })->when($this->start != $this->end, function ($query) {
                    $query->whereBetween('created_at', [
                        Carbon::parse($this->start)->subDay()->startOfDay()->format('Y-m-d'),
                        Carbon::parse($this->end)->addDay()->endOfDay()->format('Y-m-d')
                    ]);
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
