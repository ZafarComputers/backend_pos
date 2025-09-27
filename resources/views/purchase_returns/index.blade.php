@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Purchase Returns</h2>
    <a href="{{ route('purchase_returns.create') }}" class="btn btn-primary mb-3">New Return</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Date</th>
                <th>Vendor</th>
                <th>Product</th>
                <th>Return Amount</th>
                <th>Purchase Ref</th>
            </tr>
        </thead>
        <tbody>
            @foreach($returns as $return)
            <tr>
                <td>{{ $return->date }}</td>
                <td>{{ $return->vendor->first_name ?? 'N/A' }}</td>
                <td>{{ $return->product->title ?? 'N/A' }}</td>
                <td>{{ $return->return_inv_amount }}</td>
                <td>#{{ $return->purchase->id ?? 'N/A' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $returns->links() }}
</div>
@endsection
