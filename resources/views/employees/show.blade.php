@extends('layouts.app')

@section('title', 'Employee Details')

@section('content')
    <div class="content-wrapper">
        <div class="px-6">
            <h1 class="text-3xl font-bold mb-6 text-black">Employee Details</h1>

            <!-- Employee Details -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <strong class="text-black">Name:</strong>
                        <span class="ml-2 text-black">{{ $employee->name }}</span>
                    </div>
                    <div>
                        <strong class="text-black">Email:</strong>
                        <span class="ml-2 text-black">{{ $employee->email }}</span>
                    </div>
                    <div>
                        <strong class="text-black">Position:</strong>
                        <span class="ml-2 text-black">{{ $employee->position }}</span>
                    </div>
                    <div>
                        <strong class="text-black">City:</strong>
                        <span class="ml-2 text-black">{{ $employee->city->title ?? 'N/A' }}</span>
                    </div>
                    <div>
                        <strong class="text-black">Status:</strong>
                        <span class="ml-2 text-black">{{ $employee->status == 'active' ? 'Active' : 'Inactive' }}</span>
                    </div>
                </div>
                <div class="mt-6 text-right">
                    <a href="{{ route('employees.index') }}"
                       class="text-black hover:text-gray-600">Back to List</a>
                </div>
            </div>
        </div>
    </div>
@endsection