@extends('layouts.app')

@section('content')
<div class="container">
    <h2>POS Invoices</h2>
    <a href="{{ route('pos.create') }}" class="btn btn-primary mb-3">New Invoice</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Customer</th>
                <th>Invoice Date</th>
                <th>Amount</th>
                <th>Tax</th>
                <th>Discount %</th>
                <th>Discount Amt</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pos as $invoice)
            <tr>
                <td>{{ $invoice->customer->name ?? 'N/A' }}</td>
                <td>{{ $invoice->inv_date }}</td>
                <td>{{ $invoice->inv_amout }}</td>
                <td>{{ $invoice->tax }}</td>
                <td>{{ $invoice->discPer }}</td>
                <td>{{ $invoice->discount }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $pos->links() }}
</div>
@endsection
