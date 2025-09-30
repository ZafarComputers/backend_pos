@extends('layouts.app')

@section('content')
<div class="container">
    <h1>COA Subs</h1>
    <a href="{{ route('coa-subs.create') }}" class="btn btn-primary mb-2">Add New</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Main</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        @foreach ($coaSubs as $sub)
        <tr>
            <td>{{ $sub->id }}</td>
            <td>{{ $sub->title }}</td>
            <td>{{ $sub->coaMain->title }}</td>
            <td>{{ $sub->status }}</td>
            <td>
                <a href="{{ route('coa-subs.show', $sub) }}" class="btn btn-info btn-sm">View</a>
                <a href="{{ route('coa-subs.edit', $sub) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('coa-subs.destroy', $sub) }}" method="POST" style="display:inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
