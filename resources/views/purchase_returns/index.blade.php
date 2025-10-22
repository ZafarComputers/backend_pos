@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Purchase Returns</h2>

    <!-- Filter Form -->
    <form method="GET" action="{{ route('purchase_returns.index') }}" class="mb-3">
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

    <a href="{{ route('purchase_returns.create') }}" class="btn btn-primary mb-3">New Return</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Return Inv No</th>
                <th>Vendor</th>
                <th>Return Date</th>
                <th>Amount</th>
                <th>Payment Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @forelse ($purchaseReturns as $pr)
            <tr>
                <td>{{ $pr->id }}</td>
                <td>{{ $pr->return_inv_no }}</td>
                <td>{{ $pr->vendor->name ?? 'N/A' }}</td>
                <td>{{ $pr->return_date }}</td>
                <td>{{ $pr->return_amount }}</td>
                <td>
                    <span class="badge 
                        @if($pr->payment_status == 'paid') bg-success 
                        @elseif($pr->payment_status == 'overdue') bg-danger 
                        @else bg-warning @endif">
                        {{ ucfirst($pr->payment_status) }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('purchase_returns.show', $pr) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('purchase_returns.edit', $pr) }}" class="btn btn-primary btn-sm">Edit</a>
                    <form action="{{ route('purchase_returns.destroy', $pr) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center">No Purchase Returns found</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
