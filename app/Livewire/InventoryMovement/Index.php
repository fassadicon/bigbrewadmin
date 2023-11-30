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

class Index extends Component
{
    use WithPagination;
    public $perPage = 5;

    public $search = '';
    public $inventoryItem = '';
    public $type = '';
    public $start;
    public $end;
    public $sortBy = 'created_at';
    public $sortDir = 'DESC';

    public $inventoryItems = [];

    public CreateInventoryLogForm $form;

    public function mount()
    {
        $this->inventoryItems = InventoryItem::withTrashed()
            ->get(['id', 'name']);
        // $this->start = Carbon::today()->format('m/d/Y');
        // $this->end = Carbon::today()->format('m/d/Y');
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

    public function export() {
        return Excel::download(new InventoryMovementExport, 'inventory_movement.xlsx');
    }

    public function render()
    {
        // dd([Carbon::parse($this->start), Carbon::parse($this->end), InventoryLog::pluck('created_at')->first()]);
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
            // ->when($this->start && $this->end, function($query) {
            //     $query->whereBetween('created_at', [Carbon::parse($this->start), Carbon::parse($this->end)]);
            // })
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage);

        return view('livewire.inventory-movement.index', [
            'inventoryLogs' => $inventoryLogs,
            'inventoryItems' => $this->inventoryItems
        ]);
    }
}
