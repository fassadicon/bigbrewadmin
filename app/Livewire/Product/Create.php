<?php

namespace App\Livewire\Product;

use App\Livewire\Forms\CreateProductForm;
use App\Models\Size;
use Livewire\Component;
use App\Models\InventoryItem;
use App\Models\ProductCategory;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public CreateProductForm $form;

    public $all_sizes;
    public $all_categories;
    public $all_inventory_items;

    public function mount()
    {
        $this->all_sizes = Size::select('id', 'name')->get();
        $this->all_categories = ProductCategory::select('id', 'name')->get();
        $this->all_inventory_items = InventoryItem::select('id', 'name', 'measurement')->get();

        $this->form->product[] =
            [
                'size_id' => '',
                'price' => 0.00,
                'inventory_consumption' => [
                    [
                        'inventory_item_id' => '',
                        'consumption_value' => 0.00
                    ]
                ]
            ];
    }

    public function removeSizeAndPrice($index)
    {
        $this->form->removeSizeAndPriceData($index);
    }

    public function addSizeAndPrice()
    {
        if (count($this->form->product) >= $this->all_sizes->count()) {
            // Trigger modal/toast here
            dd('No more available sizes! Please select the available options.');
        }

        $this->form->addSizeAndPriceData();
    }

    public function removeInventoryItem($index, $key)
    {
        $this->form->removeInventoryItemData($index, $key);
    }

    public function addInventoryItem($index)
    {
        $this->form->addInventoryItemData($index);
    }

    public function changeSizeOrInventoryItem()
    {
        $this->form->changeSizeOrInventoryItemData();
    }

    public function save()
    {
        $this->form->store();
    }

    public function render()
    {
        return view('livewire.product.create');
    }
}
