@extends('layouts.app')

@section('content')
<div class="container">
    <h2>New Purchase Return Detail</h2>
    <form action="{{ route('purchase_return_details.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Purchase Return ID</label>
            <input type="number" name="purchase_return_id" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Product ID</label>
            <input type="number" name="product_id" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Quantity</label>
            <input type="number" name="qty" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Purchase Price</label>
            <input type="number" step="0.01" name="pur_price" class="form-control" required>
        </div>
        <button class="btn btn-success">Save</button>
    </form>
</div>
@endsection
