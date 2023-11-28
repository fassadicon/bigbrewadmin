<?php

namespace App\Livewire\Product;

use App\Models\Size;
use Livewire\Component;
use App\Models\InventoryItem;
use Livewire\WithFileUploads;
use App\Models\ProductCategory;
use Spatie\Activitylog\Models\Activity;
use App\Livewire\Forms\CreateProductForm;
use Livewire\Attributes\On;

class Create extends Component
{
    use WithFileUploads;

    public CreateProductForm $form;

    public $all_sizes;
    public $all_categories;
    public $all_inventory_items;

    public $selectedSizeIds;
    public $selectedInventoryItemIds;

    public function mount()
    {
        // dd(Activity::all()->last());
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
        $this->changeSizeOrInventoryItem();
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
        $this->changeSizeOrInventoryItem();
    }

    public function addInventoryItem($index)
    {
        $this->form->addInventoryItemData($index);
    }

    public function changeSizeOrInventoryItem()
    {
        $products = $this->form->product;
        $this->selectedSizeIds = array_column($products, 'size_id');
        $this->selectedInventoryItemIds = array_map(function($product) {
            return array_column($product['inventory_consumption'], 'inventory_item_id');
        }, $products);

        $this->form->changeSizeOrInventoryItemData();
    }

    public function save()
    {
        $this->form->store();
    }

    #[On('product-category-added')]
    public function loadCategories()
    {
        $this->all_categories = ProductCategory::select('id', 'name')->get();
    }

    public function render()
    {
        return view('livewire.product.create');
    }
}
