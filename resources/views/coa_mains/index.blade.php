@extends('layouts.app')

@section('content')
<div class="container">
    <h1>COA-Mains</h1>
    <a href="{{ route('coa-mains.create') }}" class="btn btn-primary mb-2">Add New</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        @foreach ($coaMains as $coaMain)
        <tr>
            <td>{{ $coaMain->id }}</td>
            <td>{{ $coaMain->title }}</td>
            <td>{{ $coaMain->status }}</td>
            <td>
                <a href="{{ route('coa-mains.show', $coaMain) }}" class="btn btn-info btn-sm">View</a>
                <a href="{{ route('coa-mains.edit', $coaMain) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('coa-mains.destroy', $coaMain) }}" method="POST" style="display:inline">
                    @csrf @method('DELETE')
                    <button type="submit" onclick="return confirm('Delete this?')" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
