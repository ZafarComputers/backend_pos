@extends('layouts.app')

@section('content')
    <h1>Coa Mains</h1>
    <a href="{{ route('coa_mains.create') }}" class="btn btn-primary">Create New</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($coaMains as $coaMain)
                <tr>
                    <td>{{ $coaMain->id }}</td>
                    <td>{{ $coaMain->title }}</td>
                    <td>{{ $coaMain->status ? 'Active' : 'Inactive' }}</td>
                    <td>
                        <a href="{{ route('coa_mains.show', $coaMain) }}" class="btn btn-info">Show</a>
                        <a href="{{ route('coa_mains.edit', $coaMain) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('coa_mains.destroy', $coaMain) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection