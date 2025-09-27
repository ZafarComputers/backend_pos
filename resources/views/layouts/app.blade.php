<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'My App')</title>

  <!-- Single Tailwind CDN link for consistency -->
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.0/dist/tailwind.min.css" rel="stylesheet">

  <style>
    body {
      background-color: #ffffff;
      min-height: 100vh;
      color: #000000;
    }
    .nav-bg {
      background-color: #000000;
      width: 100%;
    }
    .content-wrapper {
      min-height: calc(100vh - 100px); /* Adjust based on nav and footer height */
      padding: 20px;
      width: 100%;
    }
    .footer {
      background-color: #000000;
      padding: 1rem 0;
      width: 100%;
    }
  </style>
</head>
<body class="antialiased">
  <!-- Navigation Bar -->
  <nav class="nav-bg p-4 shadow-md">
    <div class="flex justify-between items-center px-6">
      <a href="{{ route('cities.index') }}" class="text-white text-xl font-bold">My App</a>
      <div class="space-x-4">
        <a href="{{ route('cities.index') }}" class="text-white hover:text-gray-300">Cities</a>
        <a href="#" class="text-white hover:text-gray-300">About</a>
      </div>
    </div>
  </nav>

  <!-- Main Content Area -->
  <div class="content-wrapper">
    <div>
      @yield('content')
    </div>
  </div>

  <!-- Footer -->
  <footer class="footer text-center">
    <div>
      &copy; {{ date('Y') }} My App
    </div>
  </footer>

  <!-- Alpine.js and Scripts Stack -->
  <script src="//unpkg.com/alpinejs" defer></script>
  @stack('scripts')
</body>
</html>