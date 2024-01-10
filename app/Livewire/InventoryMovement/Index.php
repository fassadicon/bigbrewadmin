<?php

namespace App\Livewire\InventoryMovement;

use Livewire\Component;
use App\Models\Supplier;
use Livewire\Attributes\On;
use App\Models\InventoryLog;
use Livewire\WithPagination;
use App\Models\InventoryItem;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\InventoryMovementExport;
use App\Livewire\Forms\CreateInventoryLogForm;
use Masmerise\Toaster\Toaster;

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

    public $inventoryItems;

    public $suppliers;

    public CreateInventoryLogForm $form;

    public function mount()
    {
        $this->inventoryItems = InventoryItem::select('id', 'name')->get();
        $this->suppliers = Supplier::select('id', 'name')->get();
    }

    public function changeStartDate($value) {
        $this->start = $value;
    }

    public function changeEndDate($value) {
        $this->end = $value;
    }

    public function store()
    {
        $this->form->store();
    }

    #[On('supplier-created')]
    public function loadSuppliers()
    {
        $this->suppliers = Supplier::select('id', 'name')->get();
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
        Toaster::info('Exporting. Please wait.');
        return Excel::download(new InventoryMovementExport(
            $this->search,
            $this->type,
            $this->start,
            $this->end,
            $this->sortBy,
            $this->sortDir
        ), 'inventory_movement.xlsx');
    }

    public function generateWastage()
    {
        Toaster::info('Exporting. Please wait.');
        $inventoryLogs = InventoryLog::with('inventoryItem', 'user')
        ->search($this->search)
        ->where('type', 3)
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
        ->get();

        $totalAmount = $inventoryLogs->sum('amount');

        $wasteItems = [];
        foreach($inventoryLogs as $inventoryLog) {
            $wasteItems[] = $inventoryLog->inventoryItem->name;
        }
        $wasteItems = array_unique($wasteItems);

        $pdf = Pdf::loadView('exports.wastage', [
            'inventoryLogs' => $inventoryLogs,
            'start_date' => Carbon::parse($this->start)->format('F j, Y'),
            'end_date' => Carbon::parse($this->end)->format('F j, Y'),
            'totalAmount' => $totalAmount,
            'wasteInventoryItemsCount' => count($wasteItems)
        ])->output();

        return response()->streamDownload(
            fn () => print($pdf),
            "wastage.pdf"
        );
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
