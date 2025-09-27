@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Colors</h2>
    <a href="{{ route('colors.create') }}" class="btn btn-primary">Add Color</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th><th>Title</th><th>Status</th><th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($colors as $color)
            <tr>
                <td>{{ $color->id }}</td>
                <td>{{ $color->title }}</td>
                <td>{{ $color->status }}</td>
                <td>
                    <a href="{{ route('colors.edit', $color) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('colors.destroy', $color) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $colors->links() }}
</div>
@endsection
