@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white shadow rounded-lg">
    <h2 class="text-xl font-bold mb-4">Add POS Return Detail</h2>

    <form action="{{ route('pos_return_details.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block text-gray-700 font-medium mb-1">POS Return</label>
            <select name="pos_return_id" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                @foreach($posReturns as $return)
                    <option value="{{ $return->id }}">{{ $return->id }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Product</label>
            <select name="product_id" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->title }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Quantity</label>
            <input type="number" name="qty" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Return Unit Price</label>
            <input type="number" step="0.01" name="return_unit_price" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <div class="flex justify-end">
            <button type="submit"
                class="px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                Save
            </button>
        </div>
    </form>
</div>
@endsection
