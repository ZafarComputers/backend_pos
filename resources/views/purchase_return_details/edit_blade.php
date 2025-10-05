@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Purchase Return Detail</h1>
    <form action="{{ route('purchase-return-details.update', $purchaseReturnDetail) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Purchase Return ID</label>
            <input type="number" name="purchase_return_id" class="form-control" value="{{ $purchaseReturnDetail->purchase_return_id }}" required>
        </div>

        <div class="mb-3">
            <label>Product ID</label>
            <input type="number" name="product_id" class="form-control" value="{{ $purchaseReturnDetail->product_id }}" required>
        </div>

        <div class="mb-3">
            <label>Quantity</label>
            <input type="number" name="qty" class="form-control" value="{{ $purchaseReturnDetail->qty }}" required>
        </div>

        <div class="mb-3">
            <label>Unit Price</label>
            <input type="number" step="0.01" name="unit_price" class="form-control" value="{{ $purchaseReturnDetail->unit_price }}" required>
        </div>

        <div class="mb-3">
            <label>Discount %</label>
            <input type="number" step="0.01" name="discPer" class="form-control" value="{{ $purchaseReturnDetail->discPer }}">
        </div>

        <div class="mb-3">
            <label>Discount Amount</label>
            <input type="number" step="0.01" name="discAmount" class="form-control" value="{{ $purchaseReturnDetail->discAmount }}">
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('purchase-return-details.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
