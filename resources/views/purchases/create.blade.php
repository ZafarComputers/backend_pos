@extends('layouts.app')

@section('content')
<div class="container">
    <h2>New Purchase</h2>
    <form action="{{ route('purchases.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Date</label>
            <input type="date" name="date" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Vendor Invoice No</label>
            <input type="text" name="ven_inv_no" class="form-control">
        </div>
        <div class="mb-3">
            <label>Amount</label>
            <input type="number" name="inv_amount" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Discount %</label>
            <input type="number" step="0.01" name="discount_percent" class="form-control">
        </div>
        <div class="mb-3">
            <label>Discount Amount</label>
            <input type="number" step="0.01" name="discount_amt" class="form-control">
        </div>
        <div class="form-group">
            <label for="payment_status">Payment Status</label>
            <select name="payment_status" id="payment_status" class="form-control" required>
                <option value="unpaid" {{ old('payment_status', $purchase->payment_status ?? '') == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                <option value="paid" {{ old('payment_status', $purchase->payment_status ?? '') == 'paid' ? 'selected' : '' }}>Paid</option>
                <option value="overdue" {{ old('payment_status', $purchase->payment_status ?? '') == 'overdue' ? 'selected' : '' }}>Overdue</option>
            </select>
        </div>

        <button class="btn btn-success">Save</button>
    </form>
</div>
@endsection
