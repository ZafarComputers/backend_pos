@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Customer</h2>
    <form action="{{ route('customers.store') }}" method="POST">
        @csrf
        <div>
            <label>CNIC:</label>
            <input type="text" name="cnic" required>
        </div>
        <div>
            <label>Name:</label>
            <input type="text" name="name" required>
        </div>
        <div>
            <label>Email:</label>
            <input type="email" name="email">
        </div>
        <div>
            <label>Address:</label>
            <textarea name="address"></textarea>
        </div>
        <div>
            <label>City ID:</label>
            <input type="number" name="city_id" required>
        </div>
        <div>
            <label>Cell No 1:</label>
            <input type="text" name="cell_no1" required>
        </div>
        <div>
            <label>Cell No 2:</label>
            <input type="text" name="cell_no2">
        </div>
        <div>
            <label>Image Path:</label>
            <input type="text" name="image_path">
        </div>
        <div>
            <label>Status:</label>
            <select name="status" required>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>
        <button type="submit">Save</button>
    </form>
</div>
@endsection
