@extends('layouts.app')

@section('title','Users')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Users</h2>
        <a href="{{ route('users.create') }}"
           class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
            + Create User
        </a>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 border border-green-300 rounded relative">
            {{ session('success') }}
            <button onclick="this.parentElement.remove();"
                    class="absolute top-2 right-2 text-green-700 hover:text-green-900">
                ✕
            </button>
        </div>
    @endif

    <!-- Table -->
    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-indigo-600">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-white uppercase">#</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-white uppercase">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-white uppercase">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-white uppercase">Cell No</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-white uppercase">Role</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-white uppercase">Status</th>
                    <th class="px-6 py-3 text-right text-xs font-semibold text-white uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 text-gray-700">
                @foreach($users as $user)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4">{{ $user->first_name }} {{ $user->last_name }}</td>
                    <td class="px-6 py-4">{{ $user->email }}</td>
                    <td class="px-6 py-4">{{ $user->cell_no1 }}</td>
                    <td class="px-6 py-4">{{ $user->role->name }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full 
                            {{ $user->status=='active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ ucfirst($user->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right space-x-2">
                        <a href="{{ route('users.edit',$user) }}"
                           class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                            Edit
                        </a>
                        <form action="{{ route('users.destroy',$user) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit"
                                    onclick="return confirm('Delete this user?')"
                                    class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
