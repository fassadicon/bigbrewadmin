<?php

namespace App\Livewire\Product;

use App\Livewire\Forms\EditProductForm;
use App\Models\Size;
use Livewire\Component;
use App\Models\ProductDetail;
use Livewire\Attributes\Rule;
use App\Models\ProductCategory;
use Exception;

class Edit extends Component
{
    public EditProductForm $form;
    // Model
    public ProductDetail $productDetail;
    public $currentSizes;

    // Product Detail
    #[Rule('required|string|max:255')]
    public $name;

    #[Rule('nullable|string')]
    public $description;

    #[Rule('nullable|image')]
    public $image;

    #[Rule('required|numeric', as: 'category')]
    public $category;

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
            'distinct'
        ]
    ], [], [
        'sizes.*' => 'size',
        'prices.*' => 'price'
    ])]
    public $sizes = [];
    public $prices = [];

    // View Data
    public $all_sizes;
    public $all_categories;

    public function mount(ProductDetail $productDetail)
    {
        $this->productDetail = $productDetail;
        $this->currentSizes = $this->productDetail->sizes;
        $this->name = ucwords($productDetail->name);
        $this->description = ucwords($productDetail->description);
        $this->category = ucwords($productDetail->category_id);

        foreach ($this->currentSizes as $size) {
            $this->sizes[] = $size->id;
            $this->prices[] = $size->pivot->price;
        }

        $this->all_sizes = Size::select('id', 'name')->get();
        $this->all_categories = ProductCategory::select('id', 'name')->get();
    }

    public function updateProduct()
    {
        $this->validate();
        $this->productDetail->category_id = $this->category;
        $this->productDetail->name = $this->name;
        $this->productDetail->description = $this->description;
        $this->productDetail->save();

        $sizesArray = [];
        foreach ($this->sizes as $key => $size) {
            $sizesArray[$size] = ['price' => $this->prices[$key]];
        }

        $this->productDetail->sizes()->sync($sizesArray);
    }

    public function removeSizeAndPrice($index)
    {
        unset($this->prices[$index]);
        unset($this->sizes[$index]);
        $this->prices = array_values($this->prices);
        $this->sizes = array_values($this->sizes);
    }

    public function addSizeAndPrice()
    {
        if (count($this->sizes) >= $this->all_sizes->count()) {
            dd('No more available sizes!');
        }

        $suggestedNewSize = $this->all_sizes->whereNotIn('id', $this->sizes)->pluck('id')->first();
        $this->sizes[] = $suggestedNewSize;
        $this->prices[] = 0.00;
    }

    public function getErrorMessageForIndex($attribute, $index)
    {
        $fieldName = $attribute . '.' . $index;
        return $this->getErrorBag()->has($fieldName) ? $this->getErrorBag()->first($fieldName) : null;
    }

    public function render()
    {
        return view('livewire.product.edit');
    }
}
