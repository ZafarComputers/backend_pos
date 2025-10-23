@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Employees</h1>
    <a href="{{ route('employees.create') }}" class="btn btn-primary mb-3">Add Employee</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th><th>Name</th><th>Email</th><th>City ID</th><th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $emp)
            <tr>
                <td>{{ $emp->id }}</td>
                <td>{{ $emp->first_name }} {{ $emp->last_name }}</td>
                <td>{{ $emp->email }}</td>
                <td>{{ $emp->city_id }}</td>
                <td>
                    <a href="{{ route('employees.show', $emp) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('employees.edit', $emp) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('employees.destroy', $emp) }}" method="POST" style="display:inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this employee?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection