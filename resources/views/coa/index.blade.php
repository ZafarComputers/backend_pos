@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Chart of Accounts</h2>
    <a href="{{ route('coa.create') }}" class="btn btn-primary mb-3">Add New</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Sub Account</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($coas as $coa)
                <tr>
                    <td>{{ $coa->id }}</td>
                    <td>{{ $coa->title }}</td>
                    <td>{{ $coa->coaSub->title ?? '-' }}</td>
                    <td>{{ $coa->status }}</td>
                    <td>
                        <a href="{{ route('coa.edit', $coa) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('coa.destroy', $coa) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
