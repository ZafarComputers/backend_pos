@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Vendors</h2>
    <a href="{{ route('vendors.create') }}" class="btn btn-primary">Add Vendor</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th><th>Name</th><th>CNIC</th><th>City</th><th>Status</th><th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vendors as $vendor)
            <tr>
                <td>{{ $vendor->id }}</td>
                <td>{{ $vendor->first_name }} {{ $vendor->last_name }}</td>
                <td>{{ $vendor->cnic }}</td>
                <td>{{ $vendor->city->name ?? '-' }}</td>
                <td>{{ $vendor->status }}</td>
                <td>
                    <a href="{{ route('vendors.edit', $vendor) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('vendors.destroy', $vendor) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $vendors->links() }}
</div>
@endsection
