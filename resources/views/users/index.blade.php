@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Users</h1>
    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Add User</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th><th>Name</th><th>Email</th><th>Role</th><th>Status</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role->name ?? '-' }}</td>
                <td>{{ $user->status }}</td>
                <td>
                    <a href="{{ route('users.edit', $user) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
