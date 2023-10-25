<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\Size;
use App\Models\Product;
use App\Models\ProductDetail;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Reactive;
use Illuminate\Support\Collection;

class CreateProductForm extends Form
{
    // Product Detail
    #[Rule('required|string|max:255')]
    public $name;

    #[Rule('nullable|string')]
    public $description;

    #[Rule('nullable|image')]
    public $image;

    #[Rule('required|exists:product_categories,id|numeric', as: 'category')]
    public $category_id;

    // Products
    // #[Rule([
    //     'form.sizes' => 'required|array',
    //     'form.sizes.*' => [
    //         'required',
    //         'numeric',
    //         'exists:sizes,id',
    //     ],
    //     'form.prices' => 'required|array',
    //     'form.prices.*' => [
    //         'required',
    //         'numeric',
    //         'min:1',
    //     ]
    // ], [], [
    //     'form.sizes.*' => 'size',
    //     'form.prices.*' => 'price'
    // ])]
    // public $sizes = [""];
    // public $prices = [0.00];

    public Collection $productData;
    // public $inventoryItems = [[""]];
    // public Collection $inventory_consumptions;
    // public $consumptionvalues = [[""]];

    public $selected_size_names;

    public function store()
    {
        $this->validate();

        $productDetail = ProductDetail::create([
            'category_id' => $this->category_id,
            'name' => $this->name,
            'description' => $this->description,
            'image' => $this->image,
        ]);

        foreach ($this->productData as $sizeKey => $data) {
            $productDetail->sizes()->attach([
                $data['size_id'] => ['price' => $data['price']]
            ]);

            $inventory_consumption = $data['inventory_consumption'];
            foreach ($inventory_consumption as $itemKey => $item) {
                $product = Product::where('product_id', $productDetail->id)
                    ->where('size_id', $data['size_id'])->first();

                $product->inventoryItems()->attach([
                    $item['inventory_item_id'] => ['consumption_value' => $item['consumption_value']]
                ]);
            }
        }
    }

    public function removeSizeAndPriceData($index)
    {
        if (count($this->productData) <= 1) {
            // Trigger modal/toast here
            dd('Product must have at least one size. For products with only one size, please select "Fixed".');
        }

        $this->productData->pull($index);
        $this->changeSizeOrInventoryItemData();
    }

    public function addSizeAndPriceData()
    {
        if ($this->productData->contains('size_id', '===', "")) {
            // Trigger modal/toast here
            dd('Please select a size before adding another one.');
        }

        $this->productData->push([
            'size_id' => '',
            'price' => 0.00,
            'inventory_consumption' => collect([
                [
                    'inventory_item_id' => '',
                    'consumption_value' => 0.00,
                ]
            ])
        ]);
    }

    public function removeInventoryItemData($index, $key)
    {
        $inventoryConsumption = $this->productData[$index]['inventory_consumption'];
        if (count($inventoryConsumption) <= 1) {
            // Trigger modal/toast here
            dd('This product instance must have at least one inventory item consumption. Please select an item.');
        }

        $this->productData[$index]['inventory_consumption']->pull($key);
        $this->changeSizeOrInventoryItemData();
    }

    public function addInventoryItemData($index)
    {
        if ($this->productData[$index]['inventory_consumption']->contains('inventory_item_id', '===', "")) {
            // Trigger modal/toast here
            dd('Please select an item before adding another one.');
        }

        $this->productData[$index]['inventory_consumption']->push(
            [
                'inventory_item_id' => '',
                'consumption_value' => 0.00,
            ]
        );
    }

    public function changeSizeOrInventoryItemData()
    {
        $this->productData = $this->productData->values();
    }
}
