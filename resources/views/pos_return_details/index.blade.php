@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6">
    <h2 class="text-2xl font-bold mb-6">POS Return Details</h2>

    <a href="{{ route('pos_return_details.create') }}"
       class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">
       + Add New
    </a>

    @if(session('success'))
        <div class="mt-4 p-3 bg-green-100 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="mt-6 overflow-x-auto">
        <table class="w-full border border-gray-200 rounded-lg overflow-hidden">
            <thead class="bg-gray-100 text-left">
                <tr>
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">POS Return</th>
                    <th class="px-4 py-2">Product</th>
                    <th class="px-4 py-2">Qty</th>
                    <th class="px-4 py-2">Return Unit Price</th>
                    <th class="px-4 py-2">Total</th>
                    <th class="px-4 py-2 w-48">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($details as $detail)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $detail->id }}</td>
                        <td class="px-4 py-2">{{ $detail->posReturn->id ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $detail->product->title ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $detail->qty }}</td>
                        <td class="px-4 py-2">{{ number_format($detail->return_unit_price, 2) }}</td>
                        <td class="px-4 py-2">{{ number_format($detail->qty * $detail->return_unit_price, 2) }}</td>
                        <td class="px-4 py-2 flex gap-2">
                            <a href="{{ route('pos_return_details.show', $detail) }}"
                               class="px-3 py-1 bg-blue-500 text-white rounded-md text-sm hover:bg-blue-600">View</a>
                            <a href="{{ route('pos_return_details.edit', $detail) }}"
                               class="px-3 py-1 bg-yellow-500 text-white rounded-md text-sm hover:bg-yellow-600">Edit</a>
                            <form action="{{ route('pos_return_details.destroy', $detail) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit"
                                    onclick="return confirm('Are you sure?')"
                                    class="px-3 py-1 bg-red-600 text-white rounded-md text-sm hover:bg-red-700">
                                    Del
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $details->links() }}
        </div>
    </div>
</div>
@endsection
