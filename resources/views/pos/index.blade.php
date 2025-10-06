@extends('layouts.app')

@section('content')
<h1>POS List</h1>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Customer</th>
            <th>Date</th>
            <th>Amount</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pos as $p)
        <tr>
            <td>{{ $p->id }}</td>
            <td>{{ $p->customer->name ?? '' }}</td>
            <td>{{ $p->inv_date }}</td>
            <td>{{ $p->inv_amount }}</td>
            <td>
                <a href="{{ route('pos.show', $p->id) }}">View</a>
                <a href="{{ route('pos.edit', $p->id) }}">Edit</a>
                <form action="{{ route('pos.destroy', $p->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<a href="{{ route('pos.create') }}">Create New</a>
@endsection