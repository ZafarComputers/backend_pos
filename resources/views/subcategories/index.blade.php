@extends('layouts.app')

@section('content')
<div class="container">
    <h2>SubCategories</h2>
    <a href="{{ route('subcategories.create') }}" class="btn btn-primary">Add SubCategory</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th><th>Title</th><th>Category</th><th>Status</th><th>Image</th><th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($subcategories as $subcategory)
            <tr>
                <td>{{ $subcategory->id }}</td>
                <td>{{ $subcategory->title }}</td>
                <td>{{ $subcategory->category->title ?? '-' }}</td>
                <td>{{ $subcategory->status }}</td>
                <td>
                    @if($subcategory->img_path)
                        <img src="{{ $subcategory->img_path }}" width="50">
                    @endif
                </td>
                <td>
                    <a href="{{ route('subcategories.edit', $subcategory) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('subcategories.destroy', $subcategory) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $subcategories->links() }}
</div>
@endsection
