<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\Product;
use App\Models\ProductDetail;
use Livewire\Attributes\Rule;

class EditProductForm extends Form
{
    // Product Detail
    public $name;
    public $description;
    public $image;
    public $category_id;
    // Product
    public $product = [];

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
            'category_id' => 'required|exists:product_categories,id|numeric',
            'product' => 'required|array|min:1',
            'product.*.size_id' => 'required|numeric|exists:sizes,id',
            'product.*.price' => 'required|numeric|min:1',
            'product.*.inventory_consumption' => 'required|array|min:1',
            'product.*.inventory_consumption.*.inventory_item_id' => 'required|exists:inventory_items,id|numeric',
            'product.*.inventory_consumption.*.consumption_value' => 'required|numeric|min:1',
        ];
    }

    public function validationAttributes()
    {
        return [
            'name' => 'name',
            'description' => 'description',
            'image' => 'image',
            'category_id' => 'category',
            'product.*.size_id' => 'size',
            'product.*.price' => 'price',
            'product.*.inventory_consumption.*.inventory_item_id' => 'inventory item',
            'product.*.inventory_consumption.*.consumption_value' => 'consumption',
        ];
    }

    public function update($productDetail)
    {
        $this->validate();

        $sizesAndPrices = [];
        foreach ($this->product as $productSize) {
            $sizesAndPrices[$productSize['size_id']]['price'] = $productSize['price'];
        }
        $productDetail->sizes()->sync($sizesAndPrices);

        foreach ($this->product as $productSize) {
            $product = Product::where('product_id', $productDetail->id)
                ->where('size_id', $productSize['size_id'])->first();
            $inventoryConsumption = [];
            foreach ($productSize['inventory_consumption'] as $item) {
                $inventoryConsumption[$item['inventory_item_id']]['consumption_value'] = $item['consumption_value'];
            }
            $product->inventoryItems()->sync($inventoryConsumption);
        }

        $productDetail->update([
            'category_id' => $this->category_id,
            'name' => $this->name,
            'description' => $this->description,
            'image' => $this->image,
        ]);
    }

    public function removeSizeAndPriceData($index)
    {
        if (count($this->product) <= 1) {
            // Trigger modal/toast here
            dd('Product must have at least one size. For products with only one size, please select "Fixed".');
        }

        unset($this->product[$index]);
        $this->changeSizeOrInventoryItemData();
    }

    public function addSizeAndPriceData()
    {
        if ($this->product[count($this->product) - 1]['size_id'] === "") {
            // Trigger modal/toast here
            dd('Please select a size before adding another one.');
        }

        $this->product[] = [
            'size_id' => '',
            'price' => 0.00,
            'inventory_consumption' => [
                [
                    'inventory_item_id' => '',
                    'consumption_value' => 0.00,
                ]
            ]
        ];
    }

    public function removeInventoryItemData($index, $key)
    {
        $inventoryConsumption = $this->product[$index]['inventory_consumption'];
        if (count($inventoryConsumption) <= 1) {
            // Trigger modal/toast here
            dd('This product instance must have at least one inventory item consumption. Please select an item.');
        }

        unset($this->product[$index]['inventory_consumption'][$key]);
        $this->changeSizeOrInventoryItemData();
    }

    public function addInventoryItemData($index)
    {
        $lastInventoryItem = count($this->product[$index]['inventory_consumption']) - 1;
        if ($this->product[$index]['inventory_consumption'][$lastInventoryItem]['inventory_item_id'] === "") {
            // Trigger modal/toast here
            dd('Please select an item before adding another one.');
        }

        $this->product[$index]['inventory_consumption'][] =
            [
                'inventory_item_id' => '',
                'consumption_value' => 0.00,
            ];
    }

    public function changeSizeOrInventoryItemData()
    {
        $this->product = array_values($this->product);
    }
}
