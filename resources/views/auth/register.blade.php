@extends('layouts.app')

@section('title','Register')

@section('content')
<div class="bg-white rounded-2xl shadow-xl p-8 md:p-10">
  <h2 class="text-2xl font-semibold text-slate-800 mb-4">Create an account</h2>
  <p class="text-sm text-slate-500 mb-6">Fill the details to get started.</p>

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

  <form method="POST" action="{{ route('register') }}" class="space-y-4">
    @csrf

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">First name</label>
        <input name="first_name" value="{{ old('first_name') }}" required
               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
      </div>

      <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">Last name</label>
        <input name="last_name" value="{{ old('last_name') }}" required
               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
      </div>
    </div>

    <div>
      <label class="block text-sm font-medium text-slate-700 mb-1">Email</label>
      <input name="email" value="{{ old('email') }}" type="email" required
             class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">Password</label>
        <div class="relative">
          <input id="reg-password" name="password" type="password" required
                 class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
          <button type="button" id="toggleRegPassword" class="absolute inset-y-0 right-2 px-2 text-slate-500">Show</button>
        </div>
      </div>

      <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">Confirm Password</label>
        <input name="password_confirmation" type="password" required
               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
      </div>
    </div>

    <div>
      <label class="block text-sm font-medium text-slate-700 mb-1">Phone (optional)</label>
      <input name="cell_no1" value="{{ old('cell_no1') }}"
             class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
    </div>

    <div class="flex items-center justify-between">
      <div class="text-sm text-slate-500">
        By creating an account you agree to our <a href="#" class="text-indigo-600 underline">Terms</a>.
      </div>
    </div>

    <div>
      <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium">
        Create account
      </button>
    </div>

    <p class="text-center text-sm text-slate-500">
      Already have an account?
      <a href="{{ route('login') }}" class="text-indigo-600 hover:underline">Sign in</a>
    </p>
  </form>
</div>

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const btn = document.getElementById('toggleRegPassword');
    const input = document.getElementById('reg-password');
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
