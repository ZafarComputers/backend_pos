@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Seasons</h2>
    <a href="{{ route('seasons.create') }}" class="btn btn-primary">Add Season</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th><th>Title</th><th>Status</th><th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($seasons as $season)
            <tr>
                <td>{{ $season->id }}</td>
                <td>{{ $season->title }}</td>
                <td>{{ $season->status }}</td>
                <td>
                    <a href="{{ route('seasons.edit', $season) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('seasons.destroy', $season) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $seasons->links() }}
</div>
@endsection
