@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100">
    <!-- Navbar -->
    <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center font-bold text-indigo-600 text-lg">
                        My App
                    </div>
                </div>
                <div class="flex items-center">
                    <span class="text-gray-700 mr-4">{{ auth()->user()->first_name ?? auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <main class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Dashboard</h1>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Card 1 -->
                <div class="bg-white shadow rounded-lg p-6">
                    <h2 class="text-lg font-semibold text-gray-700">Users</h2>
                    <p class="mt-2 text-gray-500">Manage application users</p>
                </div>

                <!-- Card 2 -->
                <div class="bg-white shadow rounded-lg p-6">
                    <h2 class="text-lg font-semibold text-gray-700">Roles</h2>
                    <p class="mt-2 text-gray-500">Assign and manage roles</p>
                </div>

                <!-- Card 3 -->
                <div class="bg-white shadow rounded-lg p-6">
                    <h2 class="text-lg font-semibold text-gray-700">Reports</h2>
                    <p class="mt-2 text-gray-500">View system reports</p>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection
