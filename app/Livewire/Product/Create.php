<?php

namespace App\Livewire\Product;

use App\Livewire\Forms\CreateProductForm;
use App\Models\InventoryItem;
use App\Models\Size;
use Livewire\Component;
use Livewire\Attributes\Rule;
use App\Models\ProductCategory;
use App\Models\ProductDetail;

class Create extends Component
{
    // Product Detail
    #[Rule('required|string|max:255')]
    public $name;

    #[Rule('nullable|string')]
    public $description;

    #[Rule('image')]
    public $image;

    #[Rule('required|numeric', as: 'category')]
    public $category_id;

    // Products
    #[Rule([
        'sizes' => 'required|array',
        'sizes.*' => [
            'required',
            'numeric',
            'exists:sizes,id',
        ],
        'prices' => 'required|array',
        'prices.*' => [
            'required',
            'numeric',
        ]
    ], [], [
        'sizes.*' => 'size',
        'prices.*' => 'price'
    ])]
    public $sizes = ["1"];
    public $prices = [""];

    // View Data
    public $all_sizes;
    public $all_categories;

    public function mount()
    {
        $this->all_sizes = Size::select('id', 'name')->get();
        $this->all_categories = ProductCategory::select('id', 'name')->get();
    }

    public function save()
    {
        $this->validate();
        $productDetail = ProductDetail::create([
            'category_id' => $this->category_id,
            'name' => $this->name,
            'description' => $this->description,
            'image' => $this->image,
        ]);

        foreach ($this->sizes as $key => $size) {
            $productDetail->sizes()->attach([
                $size => ['price' => $this->prices[$key]]
            ]);
        }
    }

    public function removeSizeAndPrice($index)
    {
        unset($this->sizes[$index]);
        unset($this->prices[$index]);
        $this->sizes = array_values($this->sizes);
        $this->prices = array_values($this->prices);
    }

    public function addSizeAndPrice()
    {
        if (count($this->sizes) >= $this->all_sizes->count()) {
            dd('No more available sizes!');
        }

        $this->sizes = array_values($this->sizes);
        $this->prices[] = '';
    }

    public function changeSize($event)
    {
        $this->sizes = array_values($this->sizes);
        $this->dispatch('change-sizes', sizes: $this->sizes);
    }

    public function render()
    {
        return view('livewire.product.create');
    }
}
