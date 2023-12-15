<?php

namespace App\Exports;

use App\Models\InventoryLog;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class InventoryMovementExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public $count;

    public $search = '';
    public $type = '';
    public $start;
    public $end;
    public $sortBy = 'created_at';
    public $sortDir = 'DESC';

    public function __construct(
        $search,
        $type,
        $start,
        $end,
        $sortBy,
        $sortDir
    ) {
        $this->search = $search;
        $this->type = $type;
        $this->start = $start;
        $this->end = $end;
        $this->sortBy = $sortBy;
        $this->sortDir = $sortDir;
    }

    public function collection()
    {
        // $inventoryLogs = InventoryLog::limit(100)->get();
        $inventoryLogs = InventoryLog::with('inventoryItem', 'user', 'supplier')
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
            ->get();

        $this->count = $inventoryLogs->count();

        return $inventoryLogs;
    }

    public function map($inventoryLog): array
    {
        return [
            $inventoryLog->id,
            $inventoryLog->inventory_item_id,
            $inventoryLog->inventoryItem->name,
            $inventoryLog->user->name,
            $inventoryLog->type,
            $inventoryLog->amount,
            $inventoryLog->old_stock,
            $inventoryLog->new_stock,
            $inventoryLog->remarks,
            $inventoryLog->supplier->name,
            Carbon::parse($inventoryLog->created_at)
            // ->format('M n, Y h:i A')
        ];
    }

    // public function registerEvents(): array
    // {
    //     return [
    //         AfterSheet::class => function (AfterSheet $event) {
    //             // Get the total number of rows
    //             $event->sheet->getStyle('A' . 2)->getFont()->setBold(true);
    //             // $totalRows = 10;

    //             // // Loop through each row and apply conditional formatting
    //             // for ($row = 2; $row <= $totalRows + 1; $row++) {
    //             //     $cellValue = $event->sheet->getCell('A' . $row)->getValue();
    //             //     if ($cellValue == "1") {
    //             //         // Apply bold font to cell A in the current row
    //             //         $event->sheet->getStyle('A' . $row)->getFont()->setBold(true);
    //             //     }
    //             // }
    //         },
    //     ];
    // }

    public function headings(): array
    {
        return [
            'INVENTORY LOG ID',
            'INVENTORY ITEM ID',
            'INVENTORY ITEM NAME',
            'ACTION BY',
            'TYPE',
            'AMOUNT',
            'OLD STOCK',
            'NEW STOCK',
            'REMARKS',
            'SUPPLIER',
            'DATE',
        ];
    }
}
