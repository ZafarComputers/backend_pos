@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add POS Detail</h2>
    <form action="{{ route('pos_details.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>POS ID</label>
            <input type="number" name="pos_id" class="form-control" required>
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
            <label>Sale Price</label>
            <input type="number" step="0.01" name="sale_price" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Save</button>
    </form>
</div>
@endsection
