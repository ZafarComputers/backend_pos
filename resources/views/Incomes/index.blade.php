@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Incomes</h2>
    <a href="{{ route('incomes.create') }}" class="btn btn-primary mb-3">Add Income</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Date</th>
                <th>Category</th>
                <th>Notes</th>
                <th>Amount</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($incomes as $income)
            <tr>
                <td>{{ $income->date }}</td>
                <td>{{ $income->income_category_name }}</td>
                <td>{{ $income->notes }}</td>
                <td>{{ number_format($income->amount, 2) }}</td>
                <td>
                    <a href="{{ route('incomes.edit', $income) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('incomes.destroy', $income) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $incomes->links() }}
</div>
@endsection
