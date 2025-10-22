@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Sizes</h2>
    <a href="{{ route('sizes.create') }}" class="btn btn-primary">Add Size</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th><th>Title</th><th>Status</th><th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sizes as $size)
            <tr>
                <td>{{ $size->id }}</td>
                <td>{{ $size->title }}</td>
                <td>{{ $size->status }}</td>
                <td>
                    <a href="{{ route('sizes.edit', $size) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('sizes.destroy', $size) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $sizes->links() }}
</div>
@endsection
