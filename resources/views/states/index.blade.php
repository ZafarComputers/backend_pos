@extends('layouts.app')

@section('title','States')

@section('content')
<div class="flex justify-between mb-4">
    <h2 class="text-xl font-bold">States</h2>
    <a href="{{ route('states.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">+ Add State</a>
</div>

<table class="min-w-full bg-white rounded shadow">
    <thead class="bg-gray-800 text-white">
        <tr>
            <th class="px-4 py-2">#</th>
            <th class="px-4 py-2">Title</th>
            <th class="px-4 py-2">Country</th>
            <th class="px-4 py-2">Status</th>
            <th class="px-4 py-2">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($states as $state)
        <tr class="border-b">
             {{-- <td>{{ $state->title }}</td> --}}
             {{-- <td>{{ $state->status ? 'Active' : 'Inactive' }}</td> --}}
             
             
             
             
             <td class="px-4 py-2">{{ $loop->iteration }}</td>
             <td class="px-4 py-2">{{ $state->title }}</td>
             <td>{{ $state->country->title ?? 'N/A' }}</td>
            {{-- <td class="px-4 py-2">{{ $country->title }}</td> --}}
            <td class="px-4 py-2">
                <span class="px-2 py-1 rounded {{ $state->status=='active'?'bg-green-500 text-white':'bg-red-500 text-white' }}">
                    {{ ucfirst($state->status) }}
                </span>
            </td>
            <td class="px-4 py-2">
                <a href="{{ route('states.edit',$state) }}" class="px-3 py-1 bg-yellow-500 text-white rounded">Edit</a>
                <form action="{{ route('states.destroy',$state) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this state?')">
                    @csrf @method('DELETE')
                    <button class="px-3 py-1 bg-red-600 text-white rounded">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
