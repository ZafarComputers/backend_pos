@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Purchase Return</h1>
    <form action="{{ route('purchase-returns.store') }}" method="POST">
        @csrf
        {{-- Parent Fields --}}
        <div class="mb-3">
            <label>Return Date</label>
            <input type="date" name="return_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Return Invoice No</label>
            <input type="text" name="return_inv_no" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Vendor ID</label>
            <input type="number" name="vendor_id" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Reason</label>
            <textarea name="reason" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>Payment Status</label>
            <select name="payment_status" class="form-control" required>
                <option value="paid">Paid</option>
                <option value="unpaid">Unpaid</option>
                <option value="overdue">Overdue</option>
            </select>
        </div>

        {{-- Child Details Table --}}
        <h3>Returned Products</h3>
        <table class="table table-bordered" id="detailsTable">
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Qty</th>
                    <th>Unit Price</th>
                    <th>Disc %</th>
                    <th>Disc Amt</th>
                    <th><button type="button" class="btn btn-success btn-sm" onclick="addRow()">+</button></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="number" name="details[0][product_id]" class="form-control" required></td>
                    <td><input type="number" name="details[0][qty]" class="form-control" required></td>
                    <td><input type="number" step="0.01" name="details[0][unit_price]" class="form-control" required></td>
                    <td><input type="number" step="0.01" name="details[0][discPer]" class="form-control"></td>
                    <td><input type="number" step="0.01" name="details[0][discAmount]" class="form-control"></td>
                    <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">x</button></td>
                </tr>
            </tbody>
        </table>

        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('purchase-returns.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<script>
    let rowIndex = 1;

    function addRow() {
        let table = document.getElementById('detailsTable').getElementsByTagName('tbody')[0];
        let newRow = table.insertRow();

        newRow.innerHTML = `
            <td><input type="number" name="details[${rowIndex}][product_id]" class="form-control" required></td>
            <td><input type="number" name="details[${rowIndex}][qty]" class="form-control" required></td>
            <td><input type="number" step="0.01" name="details[${rowIndex}][unit_price]" class="form-control" required></td>
            <td><input type="number" step="0.01" name="details[${rowIndex}][discPer]" class="form-control"></td>
            <td><input type="number" step="0.01" name="details[${rowIndex}][discAmount]" class="form-control"></td>
            <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">x</button></td>
        `;
        rowIndex++;
    }

    function removeRow(button) {
        let row = button.parentNode.parentNode;
        row.parentNode.removeChild(row);
    }
</script>
@endsection
