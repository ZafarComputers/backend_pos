@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Purchase Return #{{ $purchaseReturn->id }}</h2>

    <p><strong>Return Date:</strong> {{ $purchaseReturn->return_date }}</p>
    <p><strong>Return Inv No:</strong> {{ $purchaseReturn->return_inv_no }}</p>
    <p><strong>Vendor:</strong> {{ $purchaseReturn->vendor->name ?? 'N/A' }}</p>
    <p><strong>Reason:</strong> {{ $purchaseReturn->reason }}</p>
    <p><strong>Return Amount:</strong> {{ $purchaseReturn->return_amount }}</p>
    <p><strong>Payment Status:</strong> {{ ucfirst($purchaseReturn->payment_status) }}</p>

    <h4>Return Details</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Product</th>
                <th>Qty</th>
                <th>Unit Price</th>
                <th>Disc %</th>
                <th>Disc Amt</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($purchaseReturn->details as $detail)
            <tr>
                <td>{{ $detail->product->name ?? 'N/A' }}</td>
                <td>{{ $detail->qty }}</td>
                <td>{{ $detail->unit_price }}</td>
                <td>{{ $detail->discPer }}</td>
                <td>{{ $detail->discAmount }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
