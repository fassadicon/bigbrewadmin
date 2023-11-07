<x-modal name="show-product-category">
    <div wire:loading.class="invinsible">
        @if ($category)
            <h1>{{ $category->name }}</h1>
            <h1>{{ $category->description }}</h1>
            <h1>Products with this category:</h1>

            @forelse ($category->productDetails as $product)
                <li>{{ $product->name }}</li>
            @empty
                <li>None</li>
            @endforelse
        @endif
    </div>

</x-modal>
