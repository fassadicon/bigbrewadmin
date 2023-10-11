@foreach ($productDetails as $productDetail)
    <h1>{{ $productDetail->name }}</h1>
    <h4>{{ $productDetail->category->name }}</h4>
    @foreach ($productDetail->sizes as $size)
        <ul>
            <li>{{ $size->name }} - {{ $size->product->price }}</li>
        </ul>
    @endforeach
@endforeach
