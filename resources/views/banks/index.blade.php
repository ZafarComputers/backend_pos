@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Banks</h2>
    <a href="{{ route('banks.create') }}" class="btn btn-primary mb-3">Add Bank</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th><th>Holder</th><th>Account No</th><th>Type</th><th>Status</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($banks as $bank)
            <tr>
                <td>{{ $bank->id }}</td>
                <td>{{ $bank->acc_holder_name }}</td>
                <td>{{ $bank->acc_no }}</td>
                <td>{{ $bank->acc_type }}</td>
                <td>{{ $bank->status }}</td>
                <td>
                    <a href="{{ route('banks.show', $bank) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('banks.edit', $bank) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('banks.destroy', $bank) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Delete?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $banks->links() }}
</div>
@endsection
