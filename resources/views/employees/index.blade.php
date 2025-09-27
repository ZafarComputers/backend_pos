@extends('layouts.app')

@section('title', 'Employees List')

@section('content')
    <div class="content-wrapper">
        <div class="px-6">
            <h1 class="text-3xl font-bold mb-6 text-black">Employees List</h1>

            <!-- Display success message -->
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-black p-4 mb-6" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Display error messages if any -->
            @if ($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-black p-4 mb-6" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Employees Table -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Position</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">City</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($employees as $employee)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-black">{{ $employee->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-black">{{ $employee->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-black">{{ $employee->position }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                                    {{ $employee->city->title ?? 'N/A' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                                    {{ $employee->status == 'active' ? 'Active' : 'Inactive' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                                    <a href="{{ route('employees.edit', $employee->id) }}"
                                       class="inline-block bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-200">
                                        Edit
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-sm text-black">
                                    No employees found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Add New Employee Button -->
            <div class="mt-6 text-right pr-6">
                <a href="{{ route('employees.create') }}"
                   class="inline-block bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition duration-200">
                    Add New Employee
                </a>
            </div>
        </div>
    </div>
@endsection