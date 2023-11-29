<?php

namespace App\Exports;

use App\Models\InventoryLog;
use Illuminate\Support\Carbon;
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
    public function collection()
    {
        return InventoryLog::all();
    }

    public function map($inventoryLog): array
    {
        return [
            $inventoryLog->id,
            $inventoryLog->inventory_item_id,
            $inventoryLog->inventoryItem->name,
            $inventoryLog->supplier,
            $inventoryLog->user->name,
            $inventoryLog->type,
            $inventoryLog->amount,
            $inventoryLog->old_stock,
            $inventoryLog->new_stock,
            $inventoryLog->remarks,
            Carbon::parse($inventoryLog->created_at)->format('M n, Y h:i A')
        ];
    }

    public function headings(): array
    {
        return [
            'INVENTORY LOG ID',
            'INVENTORY ITEM ID',
            'INVENTORY ITEM NAME',
            'SUPPLIER',
            'ACTION BY',
            'TYPE',
            'AMOUNT',
            'OLD STOCK',
            'NEW STOCK',
            'REMARKS',
            'DATE',
        ];
    }
}
