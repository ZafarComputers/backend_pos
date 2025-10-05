@extends('layouts.app')

@section('content')
<div class="container">
    <h2>New Purchase Return</h2>

    <form action="{{ route('purchase_returns.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Return Date</label>
            <input type="date" name="return_date" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Return Inv No</label>
            <input type="text" name="return_inv_no" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Vendor</label>
            <select name="vendor_id" class="form-control" required>
                @foreach ($vendors as $vendor)
                    <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Reason</label>
            <textarea name="reason" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label>Payment Status</label>
            <select name="payment_status" class="form-control" required>
                <option value="unpaid">Unpaid</option>
                <option value="paid">Paid</option>
                <option value="overdue">Overdue</option>
            </select>
        </div>

        <h4>Return Details</h4>
        <table class="table table-bordered" id="detailsTable">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Unit Price</th>
                    <th>Disc %</th>
                    <th>Disc Amt</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <select name="details[0][product_id]" class="form-control">
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td><input type="number" name="details[0][qty]" class="form-control"></td>
                    <td><input type="number" step="0.01" name="details[0][unit_price]" class="form-control"></td>
                    <td><input type="number" step="0.01" name="details[0][discPer]" class="form-control"></td>
                    <td><input type="number" step="0.01" name="details[0][discAmount]" class="form-control"></td>
                    <td><button type="button" class="btn btn-danger removeRow">X</button></td>
                </tr>
            </tbody>
        </table>

        <button type="button" id="addRow" class="btn btn-secondary">Add Row</button>
        <br><br>
        <button type="submit" class="btn btn-success">Save</button>
    </form>
</div>

<script>
let rowCount = 1;
document.getElementById('addRow').addEventListener('click', function () {
    let tbody = document.querySelector('#detailsTable tbody');
    let row = document.createElement('tr');
    row.innerHTML = `
        <td>
            <select name="details[${rowCount}][product_id]" class="form-control">
                @foreach ($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
        </td>
        <td><input type="number" name="details[${rowCount}][qty]" class="form-control"></td>
        <td><input type="number" step="0.01" name="details[${rowCount}][unit_price]" class="form-control"></td>
        <td><input type="number" step="0.01" name="details[${rowCount}][discPer]" class="form-control"></td>
        <td><input type="number" step="0.01" name="details[${rowCount}][discAmount]" class="form-control"></td>
        <td><button type="button" class="btn btn-danger removeRow">X</button></td>
    `;
    tbody.appendChild(row);
    rowCount++;
});

document.addEventListener('click', function (e) {
    if (e.target.classList.contains('removeRow')) {
        e.target.closest('tr').remove();
    }
});
</script>
@endsection
