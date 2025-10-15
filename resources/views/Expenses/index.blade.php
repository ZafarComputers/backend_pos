@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Expenses</h2>
    <a href="{{ route('expenses.create') }}" class="btn btn-primary mb-3">Add Expense</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Category</th>
                <th>Date</th>
                <th>Amount</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($expenses as $expense)
            <tr>
                <td>{{ $expense->name }}</td>
                <td>{{ $expense->category->category ?? '-' }}</td>
                <td>{{ $expense->date }}</td>
                <td>{{ number_format($expense->amount, 2) }}</td>
                <td>
                    <a href="{{ route('expenses.edit', $expense) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('expenses.destroy', $expense) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $expenses->links() }}
</div>
@endsection
