@extends('layouts.app')

@section('title','Login')

@section('content')
<div class="bg-white rounded-2xl shadow-xl p-8 md:p-10">
  <h2 class="text-2xl font-semibold text-slate-800 mb-4">Welcome back</h2>
  <p class="text-sm text-slate-500 mb-6">Sign in to your account to continue.</p>

  {{-- show session message --}}
  @if(session('error'))
    <div class="mb-4 rounded border border-red-200 bg-red-50 p-3 text-sm text-red-800">
      {{ session('error') }}
    </div>
  @endif

  {{-- validation errors --}}
  @if($errors->any())
    <div class="mb-4 rounded border border-red-200 bg-red-50 p-3 text-sm text-red-800">
      <ul class="list-disc pl-5">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form method="POST" action="{{ route('login') }}" class="space-y-4">
    @csrf

    <div>
      <label class="block text-sm font-medium text-slate-700 mb-1">Email</label>
      <input
        name="email"
        value="{{ old('email') }}"
        type="email"
        required
        autofocus
        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
        placeholder="you@example.com"
      />
    </div>

    <div>
      <label class="block text-sm font-medium text-slate-700 mb-1">Password</label>
      <div class="relative">
        <input
          id="login-password"
          name="password"
          type="password"
          required
          class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
          placeholder="••••••••"
        />
        <button type="button" id="toggleLoginPassword" aria-label="Toggle password"
                class="absolute inset-y-0 right-2 px-2 flex items-center text-slate-500">
          Show
        </button>
      </div>
    </div>

    <div class="flex items-center justify-between">
      <label class="flex items-center text-sm">
        <input type="checkbox" name="remember" class="h-4 w-4 text-indigo-600 rounded" />
        <span class="ml-2 text-slate-600">Remember me</span>
      </label>

      <div class="text-sm">
        <a href="{{ route('password.request') }}" class="text-indigo-600 hover:underline">Forgot password?</a>
      </div>
    </div>

    <div>
      <button type="submit" class="w-full inline-flex justify-center items-center bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg font-medium shadow-sm">
        Sign in
      </button>
    </div>

    <p class="text-center text-sm text-slate-500">
      Don’t have an account?
      <a href="{{ route('register') }}" class="text-indigo-600 hover:underline">Create one</a>
    </p>
  </form>
</div>

@push('scripts')
<script>
  // toggle password visibility
  document.addEventListener('DOMContentLoaded', function () {
    const btn = document.getElementById('toggleLoginPassword');
    const input = document.getElementById('login-password');
    if (btn && input) {
      btn.addEventListener('click', function () {
        if (input.type === 'password') {
          input.type = 'text';
          btn.textContent = 'Hide';
        } else {
          input.type = 'password';
          btn.textContent = 'Show';
        }
      });
    }
  });
</script>
@endpush
@endsection
