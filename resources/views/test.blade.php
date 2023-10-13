{{-- <h1>Inventory</h1>
@foreach ($inventoryItems as $inventoryItem)
    <h2>{{ $inventoryItem->name }}</h1>
    <h4>{{ $inventoryItem->category->name }}</h4>
        @foreach ($inventoryItem->products as $product)
            <ul>
                <li>{{ $product->pivot->consumption_value }}</li>
            </ul>
        @endforeach
@endforeach --}}

<h1>POS</h1>
@foreach ($productDetails as $productDetail)
    <h2>{{ $productDetail->name }}</h1>
        <h4>{{ $productDetail->category->name }}</h4>
        @foreach ($productDetail->sizes as $size)
            <ul>
                <li>{{ $size->name }} - {{ $size->product->price }}</li>
                <li>
                    <ul>
                        @foreach ($size->product->inventoryItems as $inventoryItem) 
                            {{ $inventoryItem->pivot->consumption_value }}
                        @endforeach
                    </ul>

                </li>
            </ul>
        @endforeach
@endforeach
