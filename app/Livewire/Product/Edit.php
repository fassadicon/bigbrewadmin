<?php

namespace App\Livewire\Product;

use Exception;
use App\Models\Size;
use Livewire\Component;
use App\Models\InventoryItem;
use App\Models\ProductDetail;
use Livewire\Attributes\Rule;
use App\Models\ProductCategory;
use App\Livewire\Forms\EditProductForm;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public ProductDetail $productDetail;
    public EditProductForm $form;

    public $all_sizes;
    public $all_categories;
    public $all_inventory_items;

    public $selectedSizeIds;
    public $selectedInventoryItemIds;

    public function mount(ProductDetail $productDetail)
    {
        $productDetail->load('category', 'sizes.pivot.inventoryItems');
        $this->form->name = ucwords($productDetail->name);
        $this->form->description = ucwords($productDetail->description);
        $this->form->category_id = ucwords($productDetail->category_id);
        $this->form->image = $productDetail->image_path;

        $this->all_sizes = Size::select('id', 'name')->get();
        $this->all_categories = ProductCategory::select('id', 'name')->get();
        $this->all_inventory_items = InventoryItem::select('id', 'name', 'measurement')->get();

        foreach ($productDetail->sizes as $index => $size) {
            $data = [
                'size_id' => $size->id,
                'price' => $size->pivot->price
            ];
            $this->selectedSizeIds[] = $size->id;

            foreach ($size->pivot->inventoryItems as $key => $inventoryItem) {
                $this->selectedInventoryItemIds[$index][] = $inventoryItem->id;
                $data['inventory_consumption'][] = [
                    'inventory_item_id' => $inventoryItem->id,
                    'consumption_value' => $inventoryItem->pivot->consumption_value
                ];
            }

            $this->form->product[] = $data;
        }
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
        $this->selectedInventoryItemIds = array_map(function ($product) {
            return array_column($product['inventory_consumption'], 'inventory_item_id');
        }, $products);
        $this->form->changeSizeOrInventoryItemData();
    }

    public function save()
    {
        $this->form->update($this->productDetail);
    }

    public function render()
    {
        // dd([
        //     'product' => $this->form->product,
        //     'inventoryItems' => $this->selectedInventoryItemIds
        // ]);
        return view('livewire.product.edit');
    }
}
