@extends('layouts.app')

@section('content')
<h1>POS #{{ $pos->id }}</h1>
<p>Customer: {{ $pos->customer->name ?? '' }}</p>
<p>Date: {{ $pos->inv_date }}</p>
<p>Amount: {{ $pos->inv_amount }}</p>
<p>Tax: {{ $pos->tax }}</p>
<p>Discount %: {{ $pos->disc_per }}</p>
<p>Discount: {{ $pos->discount }}</p>

<h2>Details</h2>
<table>
    <thead>
        <tr>
            <th>Product</th>
            <th>Qty</th>
            <th>Price</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pos->posDetails as $detail)
        <tr>
            <td>{{ $detail->product->name ?? '' }}</td>
            <td>{{ $detail->qty }}</td>
            <td>{{ $detail->sale_price }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<a href="{{ route('pos.index') }}">Back</a>
@endsection