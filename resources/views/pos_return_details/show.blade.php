@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white shadow rounded-lg">
    <h2 class="text-xl font-bold mb-4">POS Return Detail</h2>

    <div class="space-y-2">
        <p><strong>ID:</strong> {{ $detail->id }}</p>
        <p><strong>POS Return:</strong> {{ $detail->posReturn->id ?? '-' }}</p>
        <p><strong>Product:</strong> {{ $detail->product->title ?? '-' }}</p>
        <p><strong>Quantity:</strong> {{ $detail->qty }}</p>
        <p><strong>Return Unit Price:</strong> {{ number_format($detail->return_unit_price, 2) }}</p>
        <p><strong>Total:</strong> {{ number_format($detail->qty * $detail->return_unit_price, 2) }}</p>
    </div>

    <div class="mt-6 flex gap-3">
        <a href="{{ route('pos_return_details.index') }}"
           class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">Back</a>
        <a href="{{ route('pos_return_details.edit', $detail) }}"
           class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">Edit</a>
    </div>
</div>
@endsection
