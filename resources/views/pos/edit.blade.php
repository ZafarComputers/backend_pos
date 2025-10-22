@extends('layouts.app')

@section('content')
<h1>Edit POS #{{ $pos->id }}</h1>
<form action="{{ route('pos.update', $pos->id) }}" method="POST">
    @csrf
    @method('PUT')
    <label>Customer</label>
    <select name="customer_id">
        @foreach($customers as $customer)
        <option value="{{ $customer->id }}" {{ $pos->customer_id == $customer->id ? 'selected' : '' }}>{{ $customer->name }}</option>
        @endforeach
    </select>
    <label>Date</label>
    <input type="date" name="inv_date" value="{{ $pos->inv_date }}">
    <label>Amount</label>
    <input type="number" name="inv_amount" step="0.01" value="{{ $pos->inv_amount }}">
    <label>Tax</label>
    <input type="number" name="tax" step="0.01" value="{{ $pos->tax }}">
    <label>Discount %</label>
    <input type="number" name="disc_per" step="0.01" value="{{ $pos->disc_per }}">
    <label>Discount</label>
    <input type="number" name="discount" step="0.01" value="{{ $pos->discount }}">

    <h2>Details</h2>
    <div id="details">
        @foreach($pos->posDetails as $index => $detail)
        <div class="detail">
            <select name="details[{{ $index }}][product_id]">
                @foreach($products as $product)
                <option value="{{ $product->id }}" {{ $detail->product_id == $product->id ? 'selected' : '' }}>{{ $product->name }}</option>
                @endforeach
            </select>
            <input type="number" name="details[{{ $index }}][qty]" value="{{ $detail->qty }}">
            <input type="number" name="details[{{ $index }}][sale_price]" step="0.01" value="{{ $detail->sale_price }}">
        </div>
        @endforeach
    </div>
    <button type="button" onclick="addDetail({{ $pos->posDetails->count() }})">Add Detail</button>
    <button type="submit">Update</button>
</form>

<script>
let detailCount = {{ $pos->posDetails->count() }};
function addDetail(start) {
    const div = document.createElement('div');
    div.classList.add('detail');
    div.innerHTML = `
        <select name="details[${detailCount}][product_id]">
            {!! $products->map(fn($p) => '<option value="' . $p->id . '">' . $p->name . '</option>')->implode('') !!}
        </select>
        <input type="number" name="details[${detailCount}][qty]" placeholder="Qty">
        <input type="number" name="details[${detailCount}][sale_price]" step="0.01" placeholder="Price">
    `;
    document.getElementById('details').appendChild(div);
    detailCount++;
}
</script>
@endsection