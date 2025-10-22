@extends('layouts.app')

@section('title', 'Edit Employee')

@section('content')
    <div class="content-wrapper">
        <div class="px-6">
            <h1 class="text-3xl font-bold mb-6 text-black">Edit Employee</h1>

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

            <!-- Form to edit the employee -->
            <form action="{{ route('employees.update', $employee->id) }}" method="POST" class="bg-white shadow-md rounded-lg p-6 w-full">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-black">Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $employee->name) }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-black">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $employee->email) }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                </div>
                <div class="mb-4">
                    <label for="position" class="block text-sm font-medium text-black">Position</label>
                    <input type="text" name="position" id="position" value="{{ old('position', $employee->position) }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                </div>
                <div class="mb-4">
                    <label for="city_id" class="block text-sm font-medium text-black">City</label>
                    <select name="city_id" id="city_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        @foreach (\App\Models\City::all() as $city)
                            <option value="{{ $city->id }}" {{ $employee->city_id == $city->id ? 'selected' : '' }}>
                                {{ $city->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-black">Status</label>
                    <div class="flex space-x-2">
                        <button type="button" data-status="active"
                                class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition duration-200 {{ old('status', $employee->status) == 'active' ? 'bg-green-600' : '' }}"
                                onclick="this.form.status.value='active'; this.classList.add('bg-green-600'); document.querySelector('[data-status=\"inactive\"]').classList.remove('bg-red-600');">
                            Active
                        </button>
                        <button type="button" data-status="inactive"
                                class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition duration-200 {{ old('status', $employee->status) == 'inactive' ? 'bg-red-600' : '' }}"
                                onclick="this.form.status.value='inactive'; this.classList.add('bg-red-600'); document.querySelector('[data-status=\"active\"]').classList.remove('bg-green-600');">
                            Inactive
                        </button>
                        <input type="hidden" name="status" value="{{ old('status', $employee->status) ?? 'active' }}">
                    </div>
                </div>
                <div class="flex justify-end">
                    <button type="submit"
                            class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-200">
                        Update Employee
                    </button>
                    <a href="{{ route('employees.index') }}"
                       class="ml-4 text-black hover:text-gray-600">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection