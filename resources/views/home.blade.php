@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="max-w-3xl mx-auto bg-white rounded-lg shadow p-8 text-center">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Welcome 🎉</h1>
        <p class="text-gray-600">You are logged in successfully.</p>

        <div class="mt-6">
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
               class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
        </div>
    </div>
</div>
@endsection
