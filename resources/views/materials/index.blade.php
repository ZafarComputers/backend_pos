@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Materials</h2>
    <a href="{{ route('materials.create') }}" class="btn btn-primary">Add Material</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th><th>Title</th><th>Status</th><th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($materials as $material)
            <tr>
                <td>{{ $material->id }}</td>
                <td>{{ $material->title }}</td>
                <td>{{ $material->status }}</td>
                <td>
                    <a href="{{ route('materials.edit', $material) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('materials.destroy', $material) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $materials->links() }}
</div>
@endsection
