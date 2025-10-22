@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Purchases</h1>
    <a href="{{ route('purchases.create') }}" class="btn btn-primary mb-3">Add Purchase</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th><th>Date</th><th>Barcode</th><th>Vendor</th><th>Amount</th><th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($purchases as $purchase)
                <tr>
                    <td>{{ $purchase->id }}</td>
                    <td>{{ $purchase->pur_date }}</td>
                    <td>{{ $purchase->pur_inv_barcode }}</td>
                    <td>{{ $purchase->vendor_id }}</td>
                    <td>{{ $purchase->inv_amount }}</td>
                    <td>{{ $purchase->payment_status }}</td>
                    <td>
                        <a href="{{ route('purchases.show', $purchase) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('purchases.edit', $purchase) }}" class="btn btn-warning btn-sm">Edit</a>
                        {{-- <form action="{{ route('purchases.destroy', $purchase) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Delete?')">Del</button>
                        </form> --}}

                        <form method="GET" action="{{ route('purchases.index') }}" class="mb-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <select name="payment_status" class="form-control" onchange="this.form.submit()">
                                        <option value="">-- All Payment Status --</option>
                                        <option value="paid" {{ $selectedStatus == 'paid' ? 'selected' : '' }}>Paid</option>
                                        <option value="unpaid" {{ $selectedStatus == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                                        <option value="overdue" {{ $selectedStatus == 'overdue' ? 'selected' : '' }}>Overdue</option>
                                    </select>
                                </div>
                            </div>
                        </form>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $purchases->links() }}
</div>
@endsection
