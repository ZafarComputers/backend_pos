@extends('layouts.app')

@section('content')
<h1>Create POS</h1>
<form action="{{ route('pos.store') }}" method="POST">
    @csrf
    <label>Customer</label>
    <select name="customer_id">
        @foreach($customers as $customer)
        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
        @endforeach
    </select>
    <label>Date</label>
    <input type="date" name="inv_date">
    <label>Amount</label>
    <input type="number" name="inv_amount" step="0.01">
    <label>Tax</label>
    <input type="number" name="tax" step="0.01">
    <label>Discount %</label>
    <input type="number" name="disc_per" step="0.01">
    <label>Discount</label>
    <input type="number" name="discount" step="0.01">

    <h2>Details</h2>
    <div id="details">
        <div class="detail">
            <select name="details[0][product_id]">
                @foreach($products as $product)
                <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
            <input type="number" name="details[0][qty]" placeholder="Qty">
            <input type="number" name="details[0][sale_price]" step="0.01" placeholder="Price">
        </div>
    </div>
    <button type="button" onclick="addDetail()">Add Detail</button>
    <button type="submit">Save</button>
</form>

<script>
let detailCount = 1;
function addDetail() {
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