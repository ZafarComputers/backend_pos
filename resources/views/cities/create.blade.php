@extends('layouts.app')

@section('title', 'Add New City')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Add New City</h1>

        <!-- Display error messages if any -->
        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form to add a new city -->
        <form action="{{ route('cities.store') }}" method="POST" class="bg-white shadow-md rounded-lg p-6">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">City Title</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
            </div>
            <div class="mb-4">
                <label for="state_id" class="block text-sm font-medium text-gray-700">State</label>
                <select name="state_id" id="state_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    @foreach (\App\Models\State::all() as $state)
                        <option value="{{ $state->id }}">{{ $state->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" id="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Save City
            </button>
            <a href="{{ route('cities.index') }}" class="ml-4 text-gray-600 hover:text-gray-800">Cancel</a>
        </form>
    </div>
@endsection