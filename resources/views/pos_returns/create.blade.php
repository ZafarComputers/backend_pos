@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add POS Return</h2>
    <form action="{{ route('pos_returns.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Customer ID</label>
            <input type="number" name="customer_id" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Return Date</label>
            <input type="date" name="invRet_date" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>POS Invoice No</label>
            <input type="text" name="pos_inv_no" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Return Amount</label>
            <input type="number" step="0.01" name="return_inv_amout" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Save</button>
    </form>
</div>
@endsection
