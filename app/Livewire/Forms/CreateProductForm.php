<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\Product;
use App\Models\ProductDetail;
use Masmerise\Toaster\Toaster;

class CreateProductForm extends Form
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
            'image' => 'nullable|image|max:1024',
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

    public function store()
    {
        $this->validate();

        $image_path = null;
        if ($this->image) {
            $image_path = $this->image->store('products', 'public');
        }

        $productDetail = ProductDetail::create([
            'category_id' => $this->category_id,
            'name' => $this->name,
            'description' => $this->description,
            'image_path' => $image_path,
        ]);


        foreach ($this->product as $productSize) {
            $productDetail->sizes()->attach([
                $productSize['size_id'] => ['price' => $productSize['price']]
            ]);

            $inventory_consumption = $productSize['inventory_consumption'];
            foreach ($inventory_consumption as $itemKey => $item) {
                $product = Product::where('product_id', $productDetail->id)
                    ->where('size_id', $productSize['size_id'])->first();

                $product->inventoryItems()->attach([
                    $item['inventory_item_id'] => ['consumption_value' => $item['consumption_value']]
                ]);
            }
        }
        return redirect()->to('/products');
    }

    public function removeSizeAndPriceData($index)
    {
        if (count($this->product) <= 1) {
            Toaster::warning('Product must have at least one size. For products with only one size, please select "Fixed".');
            return;
        }

        unset($this->product[$index]);
        $this->changeSizeOrInventoryItemData();
    }

    public function addSizeAndPriceData()
    {
        if ($this->product[count($this->product) - 1]['size_id'] === "") {
            Toaster::warning('Please select a size before adding another one.');
            return;
        }

        if ($this->product[count($this->product) - 1]['price'] <= 0) {
            Toaster::warning('Please put a valid price.');
            return;
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
            Toaster::warning('This product instance must have at least one inventory item consumption. Please select an item.');
            return;
        }

        unset($this->product[$index]['inventory_consumption'][$key]);
        $this->changeSizeOrInventoryItemData();
    }

    public function addInventoryItemData($index)
    {
        if ($index !== 0) {
            $lastInventoryItem = count($this->product[$index]['inventory_consumption']) - 1;
            if ($this->product[$index]['inventory_consumption'][$lastInventoryItem]['inventory_item_id'] === "") {
                Toaster::warning('Please select an item before adding another one.');
                return;
            }
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
