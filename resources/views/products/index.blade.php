@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Products</h2>
    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Add Product</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Design Code</th>
                <th>Category</th>
                <th>Sale Price</th>
                <th>Stock</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>
                    @if($product->image_path)
                        <img src="{{ asset('storage/'.$product->image_path) }}" alt="product image" width="80">
                    @else
                        No Image
                    @endif
                </td>
                <td>{{ $product->title }}</td>
                <td>{{ $product->design_code }}</td>
                <td>{{ $product->subCategory->title }}</td>
                <td>{{ $product->sale_price }}</td>
                <td>{{ $product->opening_stock_quantity }}</td>
                <td>{{ $product->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $products->links() }}
</div>
@endsection
