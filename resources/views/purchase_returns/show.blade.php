@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Purchase Return Details</h1>

    <div class="card mb-3">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $purchaseReturn->id }}</p>
            <p><strong>Date:</strong> {{ $purchaseReturn->return_date }}</p>
            <p><strong>Invoice No:</strong> {{ $purchaseReturn->return_inv_no }}</p>
            <p><strong>Vendor:</strong> {{ $purchaseReturn->vendor_id }}</p>
            <p><strong>Reason:</strong> {{ $purchaseReturn->reason }}</p>
            <p><strong>Discount %:</strong> {{ $purchaseReturn->discount_percent }}</p>
            <p><strong>Discount Amount:</strong> {{ $purchaseReturn->discount_amt }}</p>
            <p><strong>Total Amount:</strong> {{ $purchaseReturn->return_amount }}</p>
            <p><strong>Payment Status:</strong> {{ ucfirst($purchaseReturn->payment_status) }}</p>
        </div>
    </div>

    <h3>Returned Products</h3>
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
                    <td>{{ $detail->product_id }}</td>
                    <td>{{ $detail->qty }}</td>
                    <td>{{ $detail->unit_price }}</td>
                    <td>{{ $detail->discPer }}</td>
                    <td>{{ $detail->discAmount }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('purchase-returns.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection
