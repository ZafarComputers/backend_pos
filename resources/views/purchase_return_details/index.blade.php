@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Purchase Return Details</h2>
    <a href="{{ route('purchase_return_details.create') }}" class="btn btn-primary mb-3">New Return Detail</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Return Ref</th>
                <th>Product</th>
                <th>Qty</th>
                <th>Purchase Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($details as $detail)
            <tr>
                <td>#{{ $detail->purchaseReturn->id ?? 'N/A' }}</td>
                <td>{{ $detail->product->title ?? 'N/A' }}</td>
                <td>{{ $detail->qty }}</td>
                <td>{{ $detail->pur_price }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $details->links() }}
</div>
@endsection
