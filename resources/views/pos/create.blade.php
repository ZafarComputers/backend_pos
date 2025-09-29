@extends('layouts.app')

@section('content')
<div class="container">
    <h2>New POS Invoice</h2>
    <form action="{{ route('pos.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Customer ID</label>
            <input type="number" name="customer_id" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Invoice Date</label>
            <input type="date" name="inv_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Invoice Amount</label>
            <input type="number" step="0.01" name="inv_amout" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Tax</label>
            <input type="number" step="0.01" name="tax" class="form-control">
        </div>

        <div class="mb-3">
            <label>Discount %</label>
            <input type="number" step="0.01" name="discPer" class="form-control">
        </div>

        <div class="mb-3">
            <label>Discount Amount</label>
            <input type="number" step="0.01" name="discount" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Save</button>
    </form>
</div>
@endsection
