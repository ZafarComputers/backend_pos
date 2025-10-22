@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Purchase Return</h1>
    <form action="{{ route('purchase-returns.update', $purchaseReturn) }}" method="POST">
        @csrf @method('PUT')
        
        <div class="mb-3">
            <label>Return Date</label>
            <input type="date" name="return_date" class="form-control" value="{{ $purchaseReturn->return_date }}" required>
        </div>

        <div class="mb-3">
            <label>Return Invoice No</label>
            <input type="text" name="return_inv_no" class="form-control" value="{{ $purchaseReturn->return_inv_no }}" required>
        </div>

        <div class="mb-3">
            <label>Vendor ID</label>
            <input type="number" name="vendor_id" class="form-control" value="{{ $purchaseReturn->vendor_id }}" required>
        </div>

        <div class="mb-3">
            <label>Reason</label>
            <textarea name="reason" class="form-control">{{ $purchaseReturn->reason }}</textarea>
        </div>

        <div class="mb-3">
            <label>Discount (%)</label>
            <input type="number" step="0.01" name="discount_percent" class="form-control" value="{{ $purchaseReturn->discount_percent }}">
        </div>

        <div class="mb-3">
            <label>Discount Amount</label>
            <input type="number" step="0.01" name="discount_amt" class="form-control" value="{{ $purchaseReturn->discount_amt }}">
        </div>

        <div class="mb-3">
            <label>Return Amount</label>
            <input type="number" step="0.01" name="return_amount" class="form-control" value="{{ $purchaseReturn->return_amount }}" required>
        </div>

        <div class="mb-3">
            <label>Payment Status</label>
            <select name="payment_status" class="form-control" required>
                <option value="paid" {{ $purchaseReturn->payment_status == 'paid' ? 'selected' : '' }}>Paid</option>
                <option value="unpaid" {{ $purchaseReturn->payment_status == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                <option value="overdue" {{ $purchaseReturn->payment_status == 'overdue' ? 'selected' : '' }}>Overdue</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('purchase-returns.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
