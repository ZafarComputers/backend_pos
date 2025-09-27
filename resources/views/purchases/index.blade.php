@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Purchases</h2>
    <a href="{{ route('purchases.create') }}" class="btn btn-primary mb-3">New Purchase</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Date</th>
                <th>Vendor Inv #</th>
                <th>Amount</th>
                <th>Discount</th>
                <th>Final</th>
            </tr>
        </thead>
        <tbody>
            @foreach($purchases as $purchase)
            <tr>
                <td>{{ $purchase->date }}</td>
                <td>{{ $purchase->ven_inv_no }}</td>
                <td>{{ $purchase->inv_amount }}</td>
                <td>{{ $purchase->discount_amt }}</td>
                <td>{{ $purchase->inv_amount - $purchase->discount_amt }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $purchases->links() }}
</div>
@endsection
