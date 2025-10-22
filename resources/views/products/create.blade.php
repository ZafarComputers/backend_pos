@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add Product</h2>
    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Design Code</label>
            <input type="text" name="design_code" class="form-control">
        </div>

        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image" class="form-control">
        </div>

        <div class="mb-3">
            <label>Sale Price</label>
            <input type="number" name="sale_price" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Stock Quantity</label>
            <input type="number" name="opening_stock_quantity" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
            </select>
        </div>

        <div class="mb-3">
            <label>User ID</label>
            <input type="number" name="user_id" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Sub Category</label>
            <input type="number" name="sub_category_id" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Save</button>
    </form>
</div>
@endsection
