@extends('layouts.app')

@section('content')
<div class="container">
    <h2>New Purchase Return</h2>
    <form action="{{ route('purchase_returns.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Date</label>
            <input type="date" name="date" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Vendor ID</label>
            <input type="number" name="vendor_id" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Product ID</label>
            <input type="number" name="product_id" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Purchase ID</label>
            <input type="number" name="purchase_id" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Return Amount</label>
            <input type="number" step="0.01" name="return_inv_amount" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <button class="btn btn-success">Save</button>
    </form>
</div>
@endsection
